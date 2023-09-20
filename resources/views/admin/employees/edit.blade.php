@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Employee</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('employees.update', ['employee' => $employee->id])}}"
                    method="POST"
                    id="employeeForm"
                    name="employeeForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <div class="mb-3">
                                    <label for="name">Employee Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $employee->name }}" placeholder="Name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text"
                                            name="email"
                                            id="email"
                                            class="form-control"
                                            placeholder="email"
                                            value="{{ $employee->email }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text"
                                            name="phone"
                                            id="phone"
                                            class="form-control"
                                            placeholder="phone"
                                            value="{{ $employee->phone }}">
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="mb-3">
                                    <label for="company_id">Choose Companies</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value="">Select a company</option>
                                        @foreach($companies as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ $id == $employee->company_id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection
