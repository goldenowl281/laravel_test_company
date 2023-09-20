<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\CreateRequest;
use App\Http\Requests\Employee\EditRequest;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Company;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employee;

    public function __construct(EmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }


    public function index()
    {

        // dd($companies);
        $employees = $this->employee->getAllEmployees();
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::pluck('name', 'id');

        return view('admin.employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            // dd($request->all());
            // dd($request->company_id);
            DB::beginTransaction();

            $data = [
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'company_id' => $request->company_id,
            ];

            $this->employee->createEmployee($data);

            DB::commit();

            return redirect()->route('employees.index')->with('success', 'Employee created successfully');
        } catch (QueryException $e) {
            dd($e);
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
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
        $companies = Company::pluck('name', 'id');
        $employee = $this->employee->getEmployeeById($id);
        return view('admin.employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( EditRequest $request, string $id)
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

            $this->employee->updateEmployee($id, $data);
            DB::commit();

            return redirect()->route('employees.index')
                             ->with('success', 'Employee updated successfully');
        } catch (QueryException $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->employee->deleteEmployee($id);
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'Error deleting Employee: ' . $e->getMessage());
        }
    }
}
