<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchResource;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class SearchContorller extends Controller
{
    
    public function autoSearchKeyword(Request $request)
    {
        try {
            $searchsresults = [];

            if($request->term == "keyword") {
                $searchsresults = $this->searchkey($request);
            } 
            elseif($request->term == "company") {
                $searchsresults = $this->autoSearchCompany($request);
            }
            else { 
                $searchsresults = $this->autoSearchLocation($request);
            } 
            
            return response()->json([
                'results' => $searchsresults
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'results' => $e->getMessage()
            ], 500);
        }
    }

    public function autoSearchLocation($request)
    {
        return Company::select('address as search')->where('address', 'LIKE', '%' . $request->location.'%')->get();
    }

    public function autoSearchCompany($request)
    {
        return Company::select(['name', 'id'])->where('name', 'LIKE', '%' . $request->company.'%')->get();
    }

    public function searchkey($request)
    {
        $search1 = Job::select('title as search')->where('title', "LIKE", "%".$request->keyword."%")->get();

        $search2 = Company::select('name as search')->where('name', "LIKE", "%".$request->keyword."%")->get();

        $searchsresults = collect([...$search2, ...$search1]);

        $searchsresults = $searchsresults->unique('search');
        
        $searchsresults = $searchsresults->all();

        return $searchsresults;
    }

}
