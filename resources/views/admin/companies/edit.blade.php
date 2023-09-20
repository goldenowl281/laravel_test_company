@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Company</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('companies.update', ['company' => $company->id]) }}" method="POST" id="companyForm" name="companyForm"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="md-6">
                                <label for="logo" class="form-label">
                                    Insert your company Logo
                                </label>
                                <input class="form-control" type="file" name="logo" id="logo" value="{{  $company->logo }}">
                                @error('logo')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                @if ($company->logo)
                                    <p>Current Logo:</p>
                                    <img src="{{ asset('storage/company-logo/' . $company->logo) }}" alt="Current Company Logo" width="100">
                                @else
                                    <p>No logo available for this company.</p>
                                @endif
                            </div>
                            <div class="col-md-6 "></div>
                            <div class="col-md-6 mt-4">
                                <div class="mb-3">
                                    <label for="name">Company Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $company->name }}" placeholder="Name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="email" value="{{ $company->email }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="mb-3">
                                    <label for="website">Company Website</label>
                                    <input type="text" name="website" id="website" class="form-control"
                                        value="{{ $company->website }}" placeholder="http://...">
                                    @error('website')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- <input type="hidden" name="id" value="{{ $company->id }}"> --}}
                <div class="pb-5 pt-3">
                    <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection
