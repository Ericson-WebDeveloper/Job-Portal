<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Helper\TokenClass;
use App\Http\Requests\UpdateResetPassRequest;
use App\Mail\ResetPassMail;
use App\Models\UserTokenResetPass;
use App\Traits\SendingEmail;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use SendingEmail;
    // private $helperClass;
    // public function __construct()
    // {
    //     $this->helperClass = new HelperToken();
    // }

    public function index(Request $request)
    {
        try {
            return response()->json([
                'user' => $request->user(),
                'details' => $request->user()->details,
                'role' => $request->user()->getRoleNames()[0],
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $user = User::where('email', $request->email)->first();

            if($user && !$user->email_verified_at) {
                return response()->json([
                    'error' => 'Account not verified. please verified first'
                ], 400);
            }

            if(Auth::attempt($credentials)) {
                $users = Auth::user();
                return response()->json([
                    'message' => 'Success',
                    'user' => $users
                ], 200);
            } else {
                return response()->json([
                    'error' => 'invalid credentials'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

        
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('web')->logout();
            return response()->json(['meessage' => 'Logout Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateResettingPassword(UpdateResetPassRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            $tokenDetails = UserTokenResetPass::where('user_id', $user->id)->first();

            if(!$tokenDetails) {
                return response()->json(['error' => 'You not conduct a request of rset password. request first.'], 400);
            }   

            if($tokenDetails->token != $request->token) {
                return response()->json(['error' => 'Token invalid. please try again.'], 400);
            }

            $datenow = Carbon::now('Asia/Manila');
            // $expired = Carbon::parse($tokenDetails->expired);
            $minutes = $datenow->diffInMinutes($tokenDetails->expired);
     
            if($minutes >= 5) {
                UserTokenResetPass::where('user_id', $user->id)->delete();
                return response()->json(['error' => 'Token expired please request again.'], 400);
            }
            $response = $user->update(['password' => Hash::make($request->password)]);
            return response()->json(['message' => 'Reset Password Complete. you can login now.'], 200);
        }  catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }

    public function resetPassword(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if(!$user) {
                return response()->json(['error' => 'Email Invalid/not exist'], 400);
            }
            $token = TokenClass::generate(15);
            // Log::info($token);
            $response = UserTokenResetPass::updateOrCreate(
                ['user_id' =>  $user->id],
                [
                    'token' => $token,
                    'expired' => Carbon::now('Asia/Manila')
                ]
            );
            if($response) {
         
                $responseemail = $this->sendEmailResetPass($user->email, $user, $token);
          
                return response()->json(['message' => 'Request Success. check email for link of reset password page'], 200);
            } 
            return response()->json(['error' => 'Request Failed. try again later.'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }

    public function signup_employeer(Request $request)
    {
        $request->validate([
            'business' => 'required',
            'name' => 'required',
            'address' => 'required',
            'industry' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            DB::beginTransaction();
            $request['role'] = 3;

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->company()->create([
                'name' => $request->business,
                'address' => $request->address,
                'industry' => $request->industry
            ]);

            $user->assignRole($request->role);

            $token = TokenClass::generate(15);
            $tokenResponse = UserTokenResetPass::updateOrCreate(
                ['user_id' =>  $user->id],
                [
                    'token' => $token,
                    'expired' => Carbon::now('Asia/Manila')
                ]
            );
            // send email
            $this->sendEmailVerifyAccount($user->email, $user, $token);

            if($user && $tokenResponse) {
                DB::commit();
                return response()->json([
                    'message' => 'Registration Complete!. you can login now',
                ], 200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Registration Failed'
                ], 400);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
        

    }

    public function register(Request $request)
    {
        // $request->role = $request->page == 'Signup' ? 1 : 1;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
            'age' => 'numeric',
            'address' => 'string',
            'course' => 'string',
        ]);

        $image = '';

        DB::beginTransaction();

        if($request->has('image')) {

            $request->validate([
                'image' => 'image|mimes:jpg,png'
            ]);

            try {
                $extension = $request->image->extension();
                // $request->image->name = Str::random(30).'.'.$extension;
                // $path = $request->image->storeAs('users', Str::random(30).'.'.$extension);
                $path = Storage::put('public/users', $request->image);
                //$path = $request->file('image')->save(storage_path('app/public/users/' . Str::random(30).'.'.$extension));
                if(!$path) {
                    return response()->json(['error' => 'uploading image is failed'], 400);
                }

                // $request->image = $path;
                // $image = $path;
                $request['newimage'] = $path;
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $response = UserDetail::create([
                'user_id' => $user->id,
                'age' => $request->age,
                'address' => $request->address,
                'course' => $request->course,
            ]);
            $response->image = $request['newimage'];
            $response->save();

            $user->assignRole($request->role);

            $token = TokenClass::generate(15);
            $tokenResponse = UserTokenResetPass::updateOrCreate(
                ['user_id' =>  $user->id],
                [
                    'token' => $token,
                    'expired' => Carbon::now('Asia/Manila')
                ]
            );
            // send email
            $this->sendEmailVerifyAccount($user->email, $user, $token);

            if($user && $tokenResponse) {
                DB::commit();
                return response()->json([
                    'message' => 'Registration Complete!. you can login now',
                ], 200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Registration Failed'
                ], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
        
    }


    public function verified(Request $request)
    {
        try {
            $user = User::where('email', $request->user()->email)->first();
            if($user) {
                if($user->email_verified_at) {
                    return response()->json(['account already verified'],400);
                }
                $user->email_verified_at = Carbon::now();
                $user->save();
                return response()->json(['account verified success'],200);
            } else {
                return response()->json(['account verified failed'],400);
            }
        }catch(\Exception $e){
            return response()->json(['error' => 'Server down', $e->getMessage()],500);
        }
    }

    public function verifiyAccount($email, $code)
    {
        try {
            $user = User::where('email', '=', $email)->first();
            if(!$user) {
                return response()->json(['error' => 'Email invalid.'], 400);
            }   
            $tokenDetails = UserTokenResetPass::where('user_id', $user->id)->first();

            if(!$tokenDetails) {
                return response()->json(['error' => 'You request is invalid. please register first.'], 400);
            }   

            if($tokenDetails->token != $code) {
                return response()->json(['error' => 'Token invalid. please try again.'], 400);
            }

            // $datenow = Carbon::now('Asia/Manila');
            // // $expired = Carbon::parse($tokenDetails->expired);
            // $minutes = $datenow->diffInMinutes($tokenDetails->expired);
     
            // if($minutes >= 5) {
            //     UserTokenResetPass::where('user_id', $user->id)->delete();
            //     return response()->json(['error' => 'Token expired please request again.'], 400);
            // }
            $user->email_verified_at = Carbon::now();
            $user->save();
            $tokenDetails->delete();
            return response()->json(['account verified success'],200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Server down', $e->getMessage()],500);
        }
    }


    public function getSpecializations(Request $request)
    {
        try {
            $specializations = Specialization::with('subspecializations')->get();
            return response()->json(['specializations' => $specializations], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
