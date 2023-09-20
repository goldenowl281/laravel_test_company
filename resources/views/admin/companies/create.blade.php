    @extends('admin.layouts.app')
    @section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Company</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('companies.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('companies.store') }}" method="POST"
                    id="companyForm"
                    name="companyForm"
                    enctype="multipart/form-data" >
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-6">
                                    <label for="logo" class="form-label">
                                        Insert your company Logo
                                    </label>
                                    <input class="form-control" type="file" name="logo" id="logo">
                                    @error('logo')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 "></div>
                            <div class="col-md-6 mt-4">
                                <div class="mb-3">
                                    <label for="name">Company Name</label>
                                    <input type="text" name="name" id="name"
                                            class="form-control"
                                            value="{{ old('name') }}"
                                            placeholder="Name">
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
                                        placeholder="email" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="mb-3">
                                    <label for="website">Company Website</label>
                                    <input type="text"
                                            name="website"
                                            id="website"
                                            class="form-control"
                                            value="{{ old('website') }}"
                                            placeholder="http://...">
                                    @error('website')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <a href="{{ route('companies.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    @endsection

