<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\SendingEmail;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class JobApplicationController extends Controller
{
    use SendingEmail;
    
    public function index(Request $request, $id)  // Try this instead the JobController showAllApplications
    {
        try {
            $applications = JobApplication::with(['user', 'job'])->all();

            $applications = $applications->where(function($q) use ($id) {
                return $q->job->company_id == $id;
            })->get(); 

            return response()->json([
                'applications' => $applications
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
        
    }

    public function downloadCSV(Request $request)
    {
        Log::info($request->application_id);
        $application = JobApplication::where('id',$request->application_id)->first();

        $headers = ['Content-Type: application/pdf'];
     
        $filename = explode('/',$application->cv);
        $filename = end($filename);
        $path  = storage_path().'/'.'app'.'/csv/'.$filename;
        $file = Storage::disk('public')->get('/csv/'.$filename);
        
        // return response([$path, $filename],200);
        // return Storage::download($path, 'csv.pdf', $headers); 
        return (new Response($file, 200))->header('Content-Type', 'application/pdf');

        // return response()->download($file, $filename, $headers);
    }

    public function submitApplication(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'csv' => 'required|file|mimes:docx,pdf'
        ]);

        DB::beginTransaction();
        try {
            $user = $request->user();

            $extension = $request->csv->getClientOriginalExtension();

            $path = Storage::put('public/csv', $request->csv);
            
            // $path = $request->csv->storeAs('csv', Str::random(30).'.'.$extension);

            if(!$path) {
                return response()->json(['error' => 'uploading csv is failed'], 400);
            }

            $request->csv = $path;

            $application = JobApplication::create([
                'user_id' => $user->id,
                'job_id' => $request->job_id,
                'message' => $request->message,
                'cv' => $request->csv,
            ]);

            if($application) {
                DB::commit();
                return response()->json([
                    'message' => 'Application Submition Success',
                    'application' => $application
                ],200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Application Submition Failed',
                ],400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return  response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function updateApplicationStatus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $application = JobApplication::where('id',$id)->first();

            $user = User::where('email', $request->email)->first();

            $job = Job::with(['company'])->where('id', $request->job_id)->first();

            if(!$user || !$job) {
                return response()->json([
                    'error' => 'Cannot Update this Application Status for this time.',
                ],400);
            }

            $response = $application->update([
                'status' => $request->status
            ]);

            
            if($response) {
                $res = $this->sendEmail($request->email, $request->status, $job, $user);
                if($res) {
                    DB::commit();
                    return response()->json([
                        'message' => 'Application Update Status Success'
                    ],200);
                } else {
                    DB::rollBack();
                    return response()->json([
                        'error' => 'Application Did Not Update Status.Error Email Sending Notification',
                    ],400);
                }
                
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Application Did Not Update Status',
                ],400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
            ],500);
        }
    }


    // public function checkApplication(Request $request)
    // {
    //     try {
    //         $user = $request->user();
    //         $response = JobApplication::where([
    //             ['user_id', '=', $user->id],
    //             ['job_id', '=', $request->job_id],
    //         ])->first();
    //         if($response || $response != null) {
    //             return response()->json([
    //                 true
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 false
    //             ], 200);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => $e->getMessage(),
    //         ],500);
    //     }
    // }


    public function userListApplication(Request $request)
    {
        try {
            $user = $request->user();

            $applications = JobApplication::with(['job', 'job.company'])->where([
                ['user_id', '=', $user->id]
            ])
            ->orderByRaw("FIELD(status, \"review\", \"select\", \"accept\", \"reject\")")
            ->paginate(7);

            return response()->json([
                'applications' => $applications
            ], 200);
     
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ],500);
        }
    }

    public function topApplicants(Request $request)
    {
        try {
            
            $applicants = DB::table('user_details')
            ->select('course', DB::raw('count(*) as total'))
            ->groupBy('course')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

            return response(['applicants' => $applicants], 200);
     
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ],500);
        }
    }

    public function newApplications(Request $request,$id)
    {
        try {

            $ids = Job::select('id')->where('company_id', $id)->get();

            $ids = $ids->map(function($query) {
                return $query['id'];
            });

            $applications = JobApplication::where('status',  null)->whereIn('job_id', $ids)->count();

            return response()->json([
                'applications_count' => $applications
            ], 200);
     
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ],500);
        }
    }
}
