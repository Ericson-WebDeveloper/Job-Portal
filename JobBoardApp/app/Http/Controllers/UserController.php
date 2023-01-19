<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json(new UserResource($user), 200);
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
        DB::beginTransaction();

        try {
            $response = $user->update([
                'password' => Hash::make($request->password)
            ]);
            if($response) {
                DB::commit();
                return response()->json([
                    'meessage' => 'Updating Password Complete!'
                ], 200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Something wrong'
                ], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'age' => 'required|numeric',
            'address' => 'required|string',
            'course' => 'required|string',
            'college' => 'required|string',
            'experience' => 'required|array',
            'current_job' => 'required|string'
        ]);
        DB::beginTransaction();

        if($request->has('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png'
            ]);

            try {
                $extension = $request->image->extension();
                $path = $request->image->storeAs('users', Str::random(30).'.'.$extension);
                if(!$path) {
                    return response()->json(['error' => 'uploading image is failed'], 400);
                }
                $request->image = $path;
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        try {
            $response = UserDetail::create([
                'user_id' => $user->id,
                'age' => $request->age,
                'address' => $request->address,
                'course' => $request->course,
                'college' => $request->college,
                'experience' => json_encode($request->experience),
                'current_job' => $request->current_job,
                'image' => $request->image
            ]);

            if($response) {
                DB::commit();
                return response()->json([
                    'meessage' => 'Updating Details Complete!'
                ], 200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Something wrong'
                ], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function profileUpdate(Request $request)
    {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
            ]);
            // Storage::move($request->file, 'public/users/' . $request->file);
                // $path = $request->file->storeAs('users', Str::random(30).'.'.$extension);
            try {
                $user = $request->user();
                $userdetail = UserDetail::where('user_id', $user->id)->first();
                $extension = $request->file->getClientOriginalExtension();
                $path = Storage::put('public/users', $request->file);
                if(!$path) {
                    return response()->json(['error' => 'uploading image failed'], 400);
                }
                $request->file = $path;
                if($userdetail->image) {
                    $images = explode('/',$userdetail->image);
                    Storage::delete('public/users/'.$images[5]);
                }
                $userdetail->image = $request->file;
                $userdetail->save();
                return response()->json(['message' => 'uploading image Success'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
    }

    public function updateJob(Request $request) 
    {
        $user = $request->user();

        $request->validate([
            'experience' => 'required|array',
            'current_job' => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $response = $user->detail()->update([
                'experience' => json_encode($request->experience),
                'current_job' => $request->current_job
            ]);

            if($response) {
                DB::commit();
                return response()->json([
                    'meessage' => 'Updating Details Complete!'
                ], 200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Something wrong'
                ], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'age' => 'required|numeric',
            'address' => 'required|string',
            'course' => 'required|string',
            'college' => 'required|string',
            // 'experience' => 'required|array',
            // 'current_job' => 'required|string'
        ]);
        

        DB::beginTransaction();

        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            $userdetail = UserDetail::where('user_id', $user->id)->first();
            $response = false;

            if($userdetail) {
                $response = $userdetail->update([
                    'age' => $request->age,
                    'address' => $request->address,
                    'course' => $request->course,
                    'college' => $request->college,
                    // 'experience' => json_encode($request->experience),
                    // 'current_job' => $request->current_job
                ]);
            } else {
                $response = UserDetail::create([
                    'user_id' => $user->id,
                    'age' => $request->age,
                    'address' => $request->address,
                    'course' => $request->course,
                    'college' => $request->college,
                ]);
            }

            if($response) {
                DB::commit();
                return response()->json([
                    'meessage' => 'Updating Details Complete!'
                ], 200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Something wrong'
                ], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function fetchUser(Request $request)
    {
        try {
            if($request->email) {
                $user = User::with(['applications', 'company'])->where('email', '=', $request->email)->first();
                return response()->json([
                    'user' => $user
                ]);
            } else {
                return response()->json([
                    'error' => 'Email is empty'
                ],400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function fetchEmployeers(Request $request)
    {
        try {
            $employeers = User::with(['applications', 'company'])->whereHas('roles', function($query) {
                $query->where('name','=', 'employeer');
            })->paginate(5);
            return response()->json([
                'employeers' => $employeers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function jobApplicationHistory(Request $request)
    {
        try {
            $user = $request->user();
            $applications = JobApplication::with('job')->where('user_id', $user->id)->get();
            return response()->json([
                'applications' => $applications
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function users(Request $request)
    {
        try {
            $users = User::with(['company', 'applications'])->whereHas('roles', function($query) {
                $query->where('name','=', 'user')->orderBy('id');
            })->get();
            return response()->json([
                'users' => $users 
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function fetchJobs(Request $request)
    {
        try {
            $jobs = Job::all();
            return response()->json([
                'jobs' => $jobs 
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function dashboardApplication(Request $request)
    {
        try {
            $user = $request->user();

            $total = JobApplication::where('user_id',$user->id)->count();
            $pending = JobApplication::where('user_id',$user->id)->where('status', null)->count();
            $considering = JobApplication::where('user_id',$user->id)->whereIn('status',['review', 'select'])->count();
            return response()->json([
                'total' => $total,
                'pending' => $pending,
                'considering' => $considering
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

}
