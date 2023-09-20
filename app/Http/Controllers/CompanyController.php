<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyEditRequest;
use App\Http\Requests\CompanyRequest;
use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;


class CompanyController extends Controller
{

    private CompanyRepositoryInterface $company;

    public function __construct(CompanyRepositoryInterface $company)
    {
        $this->company = $company;
    }


    public function index()
    {
        $companies = $this->company->getAllCompany();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        // dd($request->all());

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
                $new_image-> save(storage_path('app/public/company-logo/'. $image_name));
                // $new_image->resize(100, 100, function ($constraint) {
                //     $constraint->aspectRatio();
                // });
                // $new_image->store('public', $image_name);



                $data['logo'] = $image_name;
            }
            $this->company->createCompany($data);
            DB::commit();
            return redirect()->route('companies.index')
                ->with('success', 'Company Created Successfully');
        } catch (QueryException $e) {
            // dd($e);
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = $this->company->getCompanyById($id);
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyEditRequest $request, string $id)
    {
        // dd($request->all());
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
                $new_image-> save(storage_path('app/public/company-logo/'. $image_name));

                $data['logo'] = $image_name;
            }
            $company = $this->company->getCompanyById($id);

             //GET THE PATH TO THE OLD IMAGE
            $old_image_path = storage_path('app/public/company-logo/' . $company->logo);

            //DELETE THE OLD IMAGE
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }

            $this->company->updateCompany($id, $data);
            DB::commit();
            return redirect()->route('companies.index')
                ->with('success', 'Company Updated Successfully');
        } catch (QueryException $e) {
            dd($e);
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    try {
        DB::beginTransaction();

        $company = $this->company->getCompanyById($id);

        // Get the path to the old image
        $old_image_path = storage_path('app/public/company-logo/' . $company->logo);

        // Delete the old image
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }

        // Delete the company
        $this->company->deleteCompany($id);

        DB::commit();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('companies.index')->with('error', 'Error deleting company: ' . $e->getMessage());
    }
}

}
