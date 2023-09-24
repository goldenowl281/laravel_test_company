<?php

namespace App\Repositories;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAllCompany()
    {
        // return Company::paginate(3);
        $company = Company::get();
        return CompanyResource::collection($company);
    }
    public function getCompanyById($id)
    {
        $company = Company::findOrFail($id);
        return new CompanyResource($company);

    }
    public function deleteCompany($id)
    {
        Company::destroy($id);
    }
    public function createCompany(array $data)
    {
        return Company::create($data);
    }
    public function updateCompany($id, array $data)
    {
        return Company::whereId($id)->update($data);
    }
}

?>

