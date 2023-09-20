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
        $company = Company::paginate(3);
        return CompanyResource::collection($company);
    }
    public function getCompanyById($id)
    {
        return Company::findOrFail($id);
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
        dd($data);
        return Company::whereId($id)->update($data);
    }
}

?>

