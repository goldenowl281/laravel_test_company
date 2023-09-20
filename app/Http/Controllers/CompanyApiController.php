<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyEditRequest;
use App\Http\Requests\CompanyRequest;
use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;


class CompanyApiController extends Controller
{

    public function index(CompanyRepository $companyRepository)
    {
        $companies = $companyRepository->getAllCompany();
        // dd($companies);
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request, CompanyRepository $companyRepository)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name'      =>  $request->name,
                'email'     =>  $request->email,
                'website'   =>  $request->website
            ];

            //SAVE THE IMAGE TO THE STORAGE/APP/PUBLIC FOLDER
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');

                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $new_image = Image::make($image)->resize(100, 100);
                $new_image->save(storage_path('app/public/company-logo/' . $image_name));
                // $new_image->resize(100, 100, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                // $new_image->store('public', $image_name);



                $data['logo'] = $image_name;
            }
            $company = $companyRepository->createCompany($data);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Company created successfully',
                'data'    => $company,
            ]);
        } catch (QueryException $e) {
            // dd($e);
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error creating company',
                'error'   => $e->getMessage(),
            ], 400);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company could not be found',
            ], 404);
        }
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CompanyEditRequest $request,
        Company $company,
        CompanyRepository $companyRepository
    ) {
        try {
            DB::beginTransaction();

            $data = [
                'name'      =>  $request->name,
                'email'     =>  $request->email,
                'website'   =>  $request->website,
                'logo'      =>  $request->logo
            ];

            //SAVE THE IMAGE TO THE STORAGE/APP/PUBLIC FOLDER
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');

                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $new_image = Image::make($image)->resize(100, 100);
                $new_image->save(storage_path('app/public/company-logo/' . $image_name));

                $data['logo'] = $image_name;
            }
            $company_logo = $companyRepository->getCompanyById($company);

            //GET THE PATH TO THE OLD IMAGE
            $old_image_path = storage_path(
                'app/public/company-logo/' . $company_logo->logo
            );

            //DELETE THE OLD IMAGE
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
            $company_data = $companyRepository->updateCompany($company, $data);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Company updated successfully",
                'data'    => $company_data
            ]);
        } catch (QueryException $e) {
            dd($e);
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error updating company",
                'error'   => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
