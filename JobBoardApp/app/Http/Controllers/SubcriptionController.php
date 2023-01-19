<?php

namespace App\Http\Controllers;

use App\Models\Subcription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcriptionController extends Controller
{
    

    public function checkingSubcription(Request $request)
    {
        $user = $request->user();
        try {
            $subcription = $this->returnSubcription($user);
            $haveSubcription = $subcription ? true : false;
            // $isSubcribed =  $subcription->status == "subcribed" ? true : false;
            // $isSubcribedValid =  $subcription->end == null ? false : explode(' ', $subcription->end)[0] == $subcription->end ? false : true;

            $datenow = Carbon::now('Asia/Manila');
            $hours = $datenow->diffInHours(Carbon::parse($subcription->end));

            return response()->json([
                'subcription' => $subcription ?? null,
                'haveSubcription' => $haveSubcription,
                'isSubcribed' => $subcription ? $subcription->is_subcribed : null,
                // 'isSubcribedValid' => $subcription ? $subcription->is_subcribed_valid : null,
                // 'DuedateToday' => $subcription ? $subcription->due_date_time : null,
                'DueDate' => $subcription ? $subcription->due_date : null, // un date now ngaun is mas ahead sa subcription // false -> valid, true -> invalid subcription
                'DuedateToday' => $subcription ? $subcription->due_date_today : null, // exact date only no time = true -> invalid subcription, false -> valid
                'UntilWhen' => $subcription ? $subcription->until_when : null,
                'UntilWhenTime' => $subcription ? $subcription->end : null,
                // 'OneWeek' => $subcription ? $subcription->one_week : null,
                
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function fetchSubcriptionDetails(Request $request)
    {
        $user = $request->user();
        try {
            $subcription = $this->returnSubcription($user);
            return response()->json([
                'subcription' => $subcription
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function returnSubcription($user)
    {
        return Subcription::where('user_id', $user->id)->first();
    }
}
