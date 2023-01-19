<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class JobController extends Controller
{

    public function index2(Request $request)
    {
        try {
            $key = $request->keyword;
            $location = $request->location;

            $jobs = Job::with(['company', 'applications'])
            ->where('open', 0);

            if(isset($request->keyword)) {
                $tempJobs = $jobs;
                $tempJobs = $tempJobs->where('title', 'LIKE', '%'.$key.'%')->get();
                if(count($tempJobs) > 0) {
                    $jobs = $jobs->where('title', 'LIKE', '%'.$key.'%');
                    $jobs = $jobs->whereHas('company', function($q) use ($key) {
                        $q->orWhere('name', 'LIKE', '%'.$key.'%');
                    });
                } else {
                    $jobs = $jobs->whereHas('company', function($q) use ($key) {
                        $q->where('name', 'LIKE', '%'.$key.'%');
                    });
                }
            }

            if(isset($request->location)) {
                $jobs = $jobs->whereHas('company', function($q) use ($location) {
                    $q->where('address', 'LIKE', '%' . $location . '%');
                });
            }
            
            $ids = isset($request->specialization) && $request->specialization  != null ? $request->specialization : [];
            if(!empty($ids)) {
                if(str_contains($ids, '&')) {
                    $ids = explode("&",$ids);
                } else {
                    $ids = explode("-",$ids);
                }
            } else {
                $ids = null;
            }

            if($ids) {     
                $jobs = $jobs->where(function($query)use($ids) {
                    foreach($ids as $id) {
                        $query->orWhereJsonContains('specialization',  ['id' => $id]);
                    }
                });
            }
            $jobs = $jobs->orderBy('created_at', 'desc');
            $jobs = $jobs->paginate(10); 
       
            return response()->json([
                'jobs' => $jobs,
                $request->keyword
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
        
    }
   
    
    public function index(Request $request)
    {
        // $jobresult;
        // $jobs1 = [];
        // $jobs2 = [];
        // $jobs3 = [];
        // $jobs4 = [];
        try 
        {
            $key = $request->keyword;
            $location = $request->location;
            // $jobs = Job::with(['company', 'applications'])->where('open', 0);
            // ->orWhere('title', 'LIKE', '%' . $key . '%')
            // ->orWhereHas('company', function($query) use ($key) {
            //     $query->where('name', 'like', '%' . $key . '%');
            // })
            
            // ->whereHas('company',  function($query) use ($location) {
            //     $query->orWhere('address', 'like', '%' . $location . '%');
            // })
            
            // ->where(function($query) use ($location) {
            //     $query->company->orWhere('address', 'like', '%' . $location . '%');
            // })
            // ->get();

            // if($key) {
            //     $jobs2 = $jobs;
            //     // ->orWhere('title', 'LIKE', '%' . $key . '%')
                
       
            //     // $jobs = $jobs->whereHas('company',  function($query) use ($key) {
            //     //     return $query->orWhere('name', 'LIKE', 'CSR');
            //     // });
            // }

            // if($location) {
            //     $jobs = $jobs->whereHas('company',  function($query) use ($location, $key) {
            //             return $query->orWhere('address', 'like', '%' . $location . '%')
            //             ->orWhere('name', 'like', '%' . $key . '%');
            //     });
            // }

            // $jobresult =  $jobs->get();
            // if($key) {
            //     $jobresult = $jobs->where('title', 'LIKE', '%' . $key . '%')->all();
            // }
            

            // $jobresult = collect($jobs)->where('company', function ($query) use($key) {
            //     return $query->select('name');
            // });

            // $jobs = $jobs->company->where(function($query) use ($key) {
            //     return $query->where('name', 'LIKE', '%'.$key.'%');
            // })->get();
 
            

            // if($request->keyword) {
            //     $key = $request->keyword;
            //     $jobs = $jobs->where('company',  function($query) use ($key) {
            //         $query->where('name', 'like', '%' . $key . '%');
            //     })->get();

            //     $jobs = $jobs->where('title', 'like', '%' . $key . '%')->get();
            // }
    
            // if($request->location) {
            //     $location = $request->location;
            //     $jobs = $jobs->whereHas('company',  function($query) use ($location) {
            //         $query->where('address', 'like', '%' . $location . '%');
            //     })->get();
            //     // $jobs = $jobs->all(function($q) use ($address) {
            //     //     return $q->company->address == $address;
            //     // });
            // }


            // $jobs = DB::query()->select(['j.*', 'jd.*', 'comp.*', 'compde.*'])
            // ->from('jobs as j')
            // ->where('j.title', 'LIKE', '%' . $key . '%')
            // ->leftJoin('job_details as jd', 'j.id', '=', 'jd.job_id')
            // ->join('companies as comp', function($query) use ($key) {
            //      $query->on('comp.id', '=', 'j.company_id')
            //      ->orWhere('comp.name', 'LIKE', '%' . $key . '%');
            // })
            
            // ->leftJoin('company_details as compde', 'compde.company_id', '=', 'comp.id')
            // ->get();


            // $jobs = Job::query()->with(['company', 'applications']);
            // $jobs = $jobs->where('open', 0);

            // if($key) {
            //     // $jobs = $jobs->where('title', 'like', '%' . $key . '%');

            //     $jobs = $jobs->whereHas('company',  function($query) use ($key) {
            //             return $query->when(function($q) use($key) {
            //                 return $q->where('name', 'like', '%' . $key . '%');
            //             });
            //     });

            //     $jobs = $jobs->orWhere('title', 'LIKE', '%' . $key . '%');
            // }



            // $jobs = $jobs->when($key, function($query) use ($key) {
            //     return $query->orWhere('title', 'LIKE', '%' . $key . '%')
            //         ->orWhereHas('company',  function($query) use ($key) {
            //             return $query->orWhere('name', 'LIKE', '%' . $key);
            //         }); 
            // });

            // first code success
        //     if($key) {
        //         // $jobs = $jobs
        //         // ->whereHas('company', function($q) use($key) {
        //         //     return $q->orWhere('name', 'LIKE', '%' . $key . '%');
        //         // }); 
        //         // $jobs = $jobs->orWhere('title', 'LIKE', '%'.$key.'%');

        //         $jobs1 = Job::with(['company', 'applications'])
        //         ->where('open', 0)
        //         ->where('title', 'LIKE', '%'.$key.'%')->get();
        //         $jobs2 = Job::with(['company', 'applications'])
        //         ->where('open', 0)
        //             ->whereHas('company', function($q) use ($key) {
        //                 $q->where('name', 'LIKE', '%'.$key.'%');
        //         })->get();
        //     }
        //     if($location != '' || $location != null) {
        //         $jobs3 = Job::with(['company', 'applications'])
        //         ->where('open', 0)
        //             ->whereHas('company', function($q) use ($location) {
        //                 $q->where('address', 'LIKE', '%' . $location . '%');
        //         })->get(); 
        //     }
        //     if($request->specialization != '' || $request->specialization != null) {
        //         $jobs4 = Job::with(['company', 'applications'])
        //         ->where('open', 0)
        //         ->where('specialization', 'LIKE', '%'.$request->specialization.'%')
        //         ->get();
        //    }
           

            
        //     $myCollection = collect([...$jobs1, ...$jobs2, ...$jobs3, ...$jobs4]);
        //     $uniqueCollection = $myCollection->unique('id');
        //     $uniqueCollection = $myCollection->chunk(10);
        //     $jobs = $uniqueCollection->all();
        // first code success

            //$pages = Input::get('page') ? Input::get('page') : null;
            // $jobs = Job::newQuery()->with(['company', 'applications'])
            $jobs = (new Job)->newQuery();
            $jobs = $jobs->with(['company', 'applications'])
            ->where('open', 0);

            if($key) {
                $tempJobs = $jobs;
                $tempJobs = $tempJobs->where('title', 'LIKE', '%'.$key.'%')->get();
                if(count($tempJobs) > 0) {
                    $jobs = $jobs->where('title', 'LIKE', '%'.$key.'%');
                    $jobs = $jobs->whereHas('company', function($q) use ($key) {
                        $q->orWhere('name', 'LIKE', '%'.$key.'%');
                    });
                } else {
                    $jobs = $jobs->whereHas('company', function($q) use ($key) {
                        $q->where('name', 'LIKE', '%'.$key.'%');
                    });
                }
            }

            if($location) {
                $jobs = $jobs->whereHas('company', function($q) use ($location) {
                    $q->where('address', 'LIKE', '%' . $location . '%');
                });
            }

            
            $ids = $request->specialization != null ? $request->specialization : [];
            if(!empty($ids)) {
                if(str_contains($ids, '&')) {
                    $ids = explode("&",$ids);
                } else {
                    $ids = explode("-",$ids);
                }
            } else {
                $ids = null;
            }

            // if($request->specialization != '' || $request->specialization != null) {
            if($ids) {
                // $jobs = $jobs->where('specialization', 'LIKE', '%'.$request->specialization.'%');
                $jobs = $jobs->where(function($query)use($ids) {
                    foreach($ids as $id) {
                        // $query->orWhereJsonContains('positions', ['name' => $position]);
                        $query->orWhereJsonContains('specialization',  ['id' => $id]);
                    }
                });
            }
            $jobs = $jobs->orderBy('created_at', 'desc');
            // if(request('page')) {
            //    $jobs = $jobs->paginate(10,['*'],'page',request('page')); 
            // } else {
            $jobs = $jobs->paginate(10); 

            //    if($pages) {
            //     $jobs = $jobs->appends ( array (
            //         'q' => Input::get ( 'q' ) 
            //       ));
            //    }
            //}
            // 
            

            return response()->json([
                'jobs' => $jobs,
                $ids,
                $request->page,
                $request->specialization
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
        
    }

    public function publicVancancyJobs(Request $request)
    {
        // Links
        // https://askto.pro/question/how-to-search-on-multiple-multidimensional-json-field-in-eloquent-laravel
        // https://laracasts.com/discuss/channels/laravel/search-multidimensional-jsonb-data-in-laravel-postgres
        // https://laracasts.com/discuss/channels/laravel/using-wherejsoncontains-with-an-array
        // https://askto.pro/question/how-to-search-on-multiple-multidimensional-json-field-in-eloquent-laravel
        // https://mattstauffer.com/blog/new-json-column-where-and-update-syntax-in-laravel-5-3/
        // https://www.tldevtech.com/how-to-search-in-json-field-laravel-eloquent/
        // https://github.com/laravel/framework/issues/26415


        try {
            $ids = $request->specialisation != null ? $request->specialisation : [];
            // $ids = !empty($ids) ? explode("-",$ids) : null;
            if(!empty($ids)) {
                if(str_contains($ids, '&')) {
                    $ids = explode("&",$ids);
                } else {
                    $ids = explode("-",$ids);
                }
            } else {
                $ids = null;
            }

            $jobs = Job::with(['company','detail'])
            ->where('open', 0);
            //->whereJsonContains('specialization->id', $ids[0])
            //->whereRaw('JSON_CONTAINS(specialization[0]->id,"'.$ids[0].'")')
            // ->when($ids, function ($query, $ids) {
            //     for ($i = 0; $i < count($ids); $i++) {
            //         $query->whereIn("specialization->[".$i."]id", '=', $ids);
            //     }
            //     return $query;
            //     // foreach($ids as $id){
            //     //     $query->where('specialization->id', '=', $id);
            //     // }
            //     // return $query;
            // })
            if($ids) {
                // cars->*->list->*->id
                // $phones = Market::whereRaw('json_contains(phones, \'["' . $term . '"]\')')->get();
                // $jobs = $jobs->where("specialization", '@>', '[' . json_encode(['id' => $ids[2]]) . ']');

               // $jobs = $jobs->whereJsonContains('specialization->*->id', $ids);

                // $tempJobs = [];
                //foreach($ids as $id) {
                   // $jobs = $jobs->whereJsonContains('specialization',  ['id' => $ids[2]]);

                   $jobs = $jobs->where(function($query)use($ids) {
                        foreach($ids as $id) {
                            // $query->orWhereJsonContains('positions', ['name' => $position]);
                            $query->orWhereJsonContains('specialization',  ['id' => $id]);
                        }
                    });
                //    if($response) {
                //        array_push($tempJobs, $response);
                //    }
               // }
                // $jobs = collect($tempJobs);

                
                // ->where('specialization', function($query) use ($ids) {
                //     $query->whereJsonContains('specialization->*->id', $ids);
                // });
                // ->map(function($job) use ($ids) {
                //     $result = array_intersect($job->specialize_ids, $ids);
                //     if($result != null || !empty($result)) {
                //         return $job;
                //     }
                // });
            }

            $jobs = $jobs->orderBy('created_at', 'desc');
            $jobs = $jobs->paginate(5);

            // if($ids) {
            //     $jobs = collect($jobs->data)->map(function($job) use ($ids) {
            //         $result = array_intersect($job->specialize_ids, $ids);
            //         if($result != null || !empty($result)) {
            //             return $job;
            //         }
            //     });
            // }
            return response()->json([
                'jobs' => $jobs,
                $ids
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                $e->getMessage(),
                'error' => 'Unable to Connect in Server'
            ],500);
        }
    }


    public function show(Request $request, $company_id)
    {
        try {
            $jobs = Job::with(['company','detail'])->where("company_id", $company_id)->orderBy('created_at', 'desc')->paginate(5);
            return response()->json([
                'jobs' => $jobs
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to Connect in Server'
            ],500);
        }
    }

    public function fetchJob(Request $request, $id)
    {
        try {
            $job = Job::with(['company','detail'])->where("id", $id)->first();
            return response()->json([
                'job' => $job
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to Connect in Server'
            ],500);
        }
    }

    public function showAllApplications(Request $request, $job_id)
    {
        try {
            // $application = JobApplication::with(['job','user'])->where("job_id", $job_id)->orderBy('created_at', 'desc')->get();
            $application = JobApplication::with(['job', 'job.detail', 'user', 'job.company'])->where("job_id", $job_id)->orderBy('created_at', 'desc')->paginate(10);
            return response()->json([
                'applications' => $application
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to Connect in Server'
            ],500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'position'  => 'required',
            // 'specialization' => 'required',
            'specialization' => 'required',
            'salary' => 'required',
            'job_details' => 'required',
            'additional_details'  => 'required',
        ]);

        $company = Company::find($request->company_id);

        DB::beginTransaction();
        try {
            $job = $company->jobs()->create([
                'title' => $request->title,
                'position'  => $request->position,
                // 'specialization' => $request->specialization,
                'specialization' => json_encode($request->specialization),
                'open' => $request->open
            ]);

            $response = $job->detail()->create([
                'salary' => $request->salary,
                'job_details' => $request->job_details,
                'additional_details' => json_encode($request->additional_details)
            ]);
            // 'job_details' => json_encode($request->job_details),
            // 'additional_details' => json_encode($request->additional_details)

            if($response) {
                DB::commit();
                return response()->json([
                    'message' => 'Add New Job Opening Success',
                    'job' => Job::with('detail')->find($job->id)
                ],200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Add New Job Opening Failed'
                ],400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
                return response()->json([
                    'error' => $e->getMessage()
                ],500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'position'  => 'required',
            'specialization' => 'required',
            'salary' => 'required',
            'job_details' => 'required',
            'additional_details'  => 'required',
        ]);

        DB::beginTransaction();
        try {
            $job = Job::find($id);

            if(!$job) {
                return response()->json([
                    'error' => 'Job cannot update'
                ],400);
            }

            $job->update([
                'title' => $request->title,
                'position'  => $request->position,
                // 'specialization' => $request->specialization,
                'specialization' => json_encode($request->specialization),
            ]);

            $response = $job->detail()->update([
                'salary' => $request->salary,
                'job_details' => $request->job_details,
                'additional_details' => json_encode($request->additional_details)
            ]);

            if($response) {
                DB::commit();
                return response()->json([
                    'message' => 'Updating Job Success',
                    'job' => Job::with(['detail', 'company'])->find($id)
                ],200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Updating Job Failed'
                ],400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function closeJob(Request $request, $id)
    {
        try {
            $job = Job::find($request->id);

            if(!$job) {
                return response()->json([
                    'error' => 'Job cannot find'
                ],400);
            }

            $response = $job->update([
                'open' => 0
            ]);

            if($response) {
                return response()->json([
                    'message' => 'Updating Job Success'
                ],200);
            } else {
                return response()->json([
                    'error' => 'Updating Job Failed'
                ],400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function publicJob(Request $request, $id)
    {
        try {
            $job = Job::with(['company'])->find($id);

            if(!$job) {
                return response()->json([
                    'error' => 'Job cannot find'
                ],400);
            }

            return response()->json([
                'job' => $job
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function publicCompanyJobs(Request $request, $company)
    {
        try {
            $jobs = Job::with(['company'])->where('company_id',$company)->where('open', 0)->paginate(10);

            return response()->json([
                'jobs' => $jobs
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function topJobs(Request $request)
    {
        try {
            $jobs = Job::with(['company'])
                ->withCount('applications')
                ->orderBy('applications_count', 'desc')
                ->limit(6)->get();
            return response()->json([
                'jobs' => $jobs
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function jobsActive(Request $request, $id)
    {
        try {
            $jobs_count = Job::where('company_id', $id)->where('open', 0)->count();
            return response()->json([
                'jobs_count' => $jobs_count
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function jobsTotal(Request $request, $id)
    {
        try {
            $jobs_count = Job::where('company_id', $id)->count();
            return response()->json([
                'jobs_count' => $jobs_count
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

}
