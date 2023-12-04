@extends('adminlte::page')

@section('title', 'New Employees')
@section('content_header')
    <h1>Create a New Employees</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('employees.store') }}" method="post">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="first_nm" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="first_nm" id="first_nm">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="last_nm" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="last_nm" id="last_nm"></textarea>
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label for="company_id" class="col-sm-2 col-form-label">Company</label>
                                <div class="col-sm-10">
                                    <select  class="form-control" name="company_id" id="company_id">
                                        <option value="">== Pilih Company ==</option>
                                        @foreach($company as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                           
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                     Save</button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop