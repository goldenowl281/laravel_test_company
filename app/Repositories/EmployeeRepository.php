<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Company;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployees()
    {
        return Employee::with('company')->paginate(3);
    }
    public function getEmployeeById($id)
    {
        return Employee::findOrFail($id);
    }
    public function deleteEmployee($id)
    {
        Employee::destroy($id);
    }
    public function createEmployee(array $data)
    {
        try {
            // dd($data['company_id']);
            Employee::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'company_id' => intval($data['company_id']),
            ]);
        } catch (\Exception $e) {
            dd($e); // Add this line
        }
    }
    public function updateEmployee($id, array $data)
    {
        return Employee::whereId($id)->update($data);
    }
}

?>

