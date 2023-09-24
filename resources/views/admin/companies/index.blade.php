@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Company</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('companies.create') }}" class="btn btn-primary">New Company</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">

        <div class="card">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            {{-- @include('admin.message') --}}
            <form action="" method="GET">
                <div class="card-header">
                    <div class="card-title">
                        <button type="button"
                            class="btn btn-primary btn-sm">
                            Reset
                        </button>
                    </div>
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="text" value="" name="table_search"
                                class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Logo</th>
                            <th>CompanyName</th>
                            <th>Company Mail</th>
                            <th>Website</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if ($companies != Null)
                            @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->id  }}</td>
                                    <td>
                                        @if($company->logo)
                                            <img src="{{ asset('storage/company-logo/' . $company->logo) }}" alt="Company Logo">
                                        @else
                                            <span>No logo available</span>
                                        @endif
                                    </td>

                                    <td>{{ $company->name }}</td>
{{--                                    <td>{{ $company->email }} </td>--}}
                                    <td>
                                        <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                                    </td>

                                    <td>
                                        <a href="{{ route('companies.edit', ['company' => $company->id]) }}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('companies.destroy', ['company' => $company->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger w-4 h-4" onclick="return confirm('Are you sure you want to delete this resource?')">
                                                <svg wire:loading.remove.delay="" wire:target=""
                                                class="filament-link-icon w-4 h-4 mr-1"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path ath fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            </button>
                                        </form>
{{--
                                        <a href=""
                                            class="text-danger w-4 h-4 mr-1">
                                            <svg wire:loading.remove.delay="" wire:target=""
                                                class="filament-link-icon w-4 h-4 mr-1"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path ath fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">Db data record not found</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
{{--                 {{ $companies->links() }}--}}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>

@endsection


