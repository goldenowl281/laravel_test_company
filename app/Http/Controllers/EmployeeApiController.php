<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\CreateRequest;
use App\Http\Requests\Employee\EditRequest;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeApiController extends Controller
{
//     * Display a listing of the resource.
    public function index( EmployeeRepository $employeeRepository )
    {
        return $employeeRepository->getAllEmployees();
    }

//     * Store a newly created resource in storage.
    public function store(CreateRequest $request, EmployeeRepository $employeeRepository)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'company_id' => $request->company_id,
            ];
            $employeeRepository->createEmployee($data);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Employee created successfully',
            ]);

        } catch (QueryException $e) {
            DB::rollBack();

            return response()->json([
               'success' => false,
               'message' => 'Error in employee create',
               'error'   => $e->getMessage(),
            ],400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, EmployeeRepository $employeeRepository)
    {
        $employee_data = $employeeRepository->getEmployeeById($employee->id);
        return response()->json($employee_data);
    }

//     * Update the specified resource in storage.
    public function update(EditRequest $request, Employee $employee, EmployeeRepository $employeeRepository)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();

            $data = [
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'company_id' => $request->company_id,
            ];

            $employeeRepository->updateEmployee($employee->id, $data);
            DB::commit();

            return response()->json([
               'success' => true,
               'message' => "Employee updated successfully",
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json([
               'success' => false,
               'message' => "Employee updated error",
               'error'   => $e->getMessage(),
            ]);
        }
    }

//     * Remove the specified resource from storage.
    public function destroy(Employee $employee, EmployeeRepository $employeeRepository)
    {
        try {
            $employeeRepository->deleteEmployee($employee->id);
            return response()->json([
               'success' => true,
               'message' => "Employee deleted success",
            ]);
        } catch (\Exception $e) {
            return response()->json([
               'success' => false,
               'message' => "Employee delete error",
               'error'   => $e->getMessage(),
            ]);
        }
    }
}
