<?php

namespace App\Repositories;

use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAllCompany()
    {
        return Company::paginate(3);
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
        return Company::whereId($id)->update($data);
    }
}

?>

