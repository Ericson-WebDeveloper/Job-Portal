<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public $carbon;

    public function __construct()
    {
        $this->carbon = new Carbon(new \DateTime('first day of January 2008'), new \DateTimeZone('Asia/Manila'));
    }
    
    public function users(Request $request)
    {
        try {
            $users = User::with(['company', 'applications'])->whereHas('roles', function($query) {
                $query->where('name','=', 'user')->orderBy('id');
            })->paginate(5);
            return response()->json([
                'users' => $users 
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function updateStatusEmployeer(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            DB::beginTransaction();
            
            if ($user) {
                $response = false;
                if($request->type == "activate") {
                    $user->email_verified_at = $this->carbon->now()->format('Y-m-d H:i:s');
                    $response = $user->save();
                } else {
                    $user->email_verified_at = null;
                    $response = $user->save(); 
                }
                
                DB::commit();
                if($response) {
                    return response()->json([
                        'message' => "User $request->type Success",
                    ],200);
                } else {
                    return response()->json([
                        'error' => "User $request->type Failed"
                    ],400);
                }
            } else {
                return response()->json([
                    'error' => 'User not found'
                ],400);
            }
        } catch (\Exception $e) {
             return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }
    
}
