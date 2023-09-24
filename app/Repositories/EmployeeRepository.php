<?php

namespace App\Repositories;

use App\Http\Resources\EmployeeResource;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Company;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployees()
    {
        $employees = Employee::with('company')->get();
        return EmployeeResource::collection($employees);
    }
    public function getEmployeeById($id)
    {
        $employee = Employee::findOrFail($id);
        return new EmployeeResource($employee);
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

