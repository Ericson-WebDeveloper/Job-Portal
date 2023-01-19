<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    
    public function index(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'company' => $user->company
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error'
            ], 500);
        }
    }

    public function publicCompanies(Request $request)
    {
        try {
            $companies = Company::whereHas('detail')->whereHas('user', function($query) {
               $query->where('email_verified_at', '!=', null);
            })->paginate(10);

            return response()->json([
                'companies' => $companies
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error'
            ], 500);
        }
    }

    public function topCompanies(Request $request)
    {
        try {
            $companies = Company::with('jobs')->withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->limit(10)->get();
    
            return response()->json([
                'companies' => $companies 
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                $e->getMessage()
            ], 500);
        }
        
    }

    public function publicCompany(Request $request, $id)
    {
        try {
            $company = Company::with(['jobs', 'user'])->where('id', $id)->first();

            return response()->json([
                'company' => $company
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                $e->getMessage(),
                'error' => 'Server Error'
            ], 500);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'industry' => 'required',

            // 'company_overview' => 'required',
            // 'additional_info' => 'required|array',
        ]);

        if($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|image|mimes:jpg,png'
            ]);

            try {
                $extension = $request->image->getClientOriginalExtension();
                $path = Storage::put('public/company', $request->image);
                // $path = $request->image->storeAs('company', Str::random(30).'.'.$extension);
                if(!$path) {
                    return response()->json(['error' => 'uploading image is failed'], 400);
                }
                $request->image = $path;
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        DB::beginTransaction();

        try {
            $user = $request->user();

            $company = Company::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'address' => $request->address,
                'industry' => $request->industry
            ]);

            $response = $company->detail()->create([
                'company_overview' => $request->company_overview,
                'additional_info' => json_encode($request->additional_info),
                'image' => $request->image,
            ]);

            if($response) {
                DB::commit();
                return response()->json([
                    'message' => 'Add Company Success',
                    'company' => $company
                ],200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Add Company Failed'
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
            'name' => 'required',
            'address' => 'required',
            'industry' => 'required',
        ]);

        $company = Company::find($id);

        if(!$company) {
            return response()->json([
                'error' => 'Cannot Update Company'
            ],400);
        }

        // if($request->hasFile('image')) {
        //     $request->validate([
        //         'image' => 'image|mimes:jpg,png'
        //     ]);
        //     try {
        //         $extension = $request->image->extension();
        //         $path = Storage::put('public/company', $request->image);
        //         // $path = $request->image->storeAs('company', Str::random(30).'.'.$extension);
        //         if(!$path) {
        //             return response()->json(['error' => 'uploading image is failed'], 400);
        //         }
        //         Storage::delete($company->detail->image);

        //         $request->image = $path;
        //     } catch (\Exception $e) {
        //         return response()->json(['error' => $e->getMessage()], 500);
        //     }
        // }

        DB::beginTransaction();
        try {
            
            $response = $company->update([
                'name' => $request->name,
                'address' => $request->address,
                'industry' => $request->industry
            ]);

            // $response = $company->detail()->update([
            //     'company_overview' => $request->company_overview,
            //     'additional_info' => json_encode($request->additional_info),
            //     'image' => $request->image ?? $company->detail->image,
            //     // 'details' => $request->details,
            //     // 'employee_count' => $request->employee_count
            // ]);

            if($response) {
                DB::commit();
                return response()->json([
                    'message' => 'Update Company Success',
                    'company' => Company::with('detail')->find($request->id)
                ],200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Update Company Failed'
                ],400);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function updateCompanyImage(Request $request, $id)
    {

        $request->validate([
            'company_image' => 'image|mimes:jpg,png'
        ]);

        $company = Company::find($id);

        if(!$company) {
            return response()->json([
                'error' => 'Cannot Find Company. we cannot proceed to update'
            ],400);
        }

        try {

            $response = false;

            $path = Storage::put('public/company', $request->company_image);

            // $path = Storage::put('public/users', $request->company_image);
            //$path = $request->file('image')->save(storage_path('app/public/users/' . Str::random(30).'.'.$extension));
            if(!$path) {
                return response()->json(['error' => 'uploading image is failed'], 400);
            }

            if($company->detail && $company->detail->image) {
                $images = explode('/',$company->detail->image);
                Storage::delete('public/company/'.$images[5]);
            } 

            if($company->detail){
                $response = $company->detail()->update([
                    'image' => $path
                ]);
            } else {
                $response = $company->detail()->create([
                    'image' => $path
                ]);
            }
            if($response) {
                return response()->json([
                    'message' => 'Update Company Image Success',
                    'company' => Company::with('detail')->find($id)
                ],200);
            } else {
                return response()->json([
                    'error' => 'Update Company Image Failed'
                ],400);
            }
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    
    }

    public function updateAddtionalData(Request $request, $id)
    {
        $request->validate([
            'company_overview' => 'required',
            'additional_info' => 'required|array',
        ]);

        $company = Company::find($id);

        if(!$company) {
            return response()->json([
                'error' => 'Cannot Find Company. we cannot proceed to update'
            ],400);
        }

        DB::beginTransaction();
        try {
            $response = false;
            if($company->detail) {
                $response = $company->detail()->update([
                    'company_overview' => $request->company_overview,
                    'additional_info' => json_encode($request->additional_info),
                ]);
            } else {
                $response = $company->detail()->create([
                    'company_overview' => $request->company_overview,
                    'additional_info' => json_encode($request->additional_info),
                ]);
            }
            
            if($response) {
                DB::commit();
                return response()->json([
                    'message' => 'Update Company Success',
                    'company' => Company::with('detail')->find($request->id)
                ],200);
            } else {
                DB::rollBack();
                return response()->json([
                    'error' => 'Update Company Failed'
                ],400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    // public function employeer(Request $request)
    // {
    //     try {
    //         $users =  User::with(['company', 'applications'])->whereHas('roles', function($query) {
    //             $query->where('name','=', 'employeer')->orderBy('id');
    //         })->get();
    //         return response()->json([
    //             'users' => $users 
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => $e->getMessage()
    //         ],500);
    //     }
    // }

}
