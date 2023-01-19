<?php

namespace App\Http\Middleware;

use App\Models\Subcription;
use Closure;
use Illuminate\Http\Request;

class isSubcribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $subcription = Subcription::where('user_id', $user->id)->first();

        if(!$subcription) {
           return response()->json(['error' => 'no subcription yet.'], 402); 
        }
        
        if(!$subcription->is_subcribed) {
            return response()->json(['error' => 'you are not subcribed anymore.'], 402); 
        }

        if($subcription->due_date && $subcription->due_date_today) {
            if($subcription->status == 'subcribed') {
               $subcription->update(['status' => 'not-subcribed']); 
            }
            return response()->json(['error' => 'your subcription is end today.'], 402); 
        }

        return $next($request);
    }
}
