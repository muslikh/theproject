@extends('adminlte::page')

@section('title','Employees List')
@section('content_header')
    <h1>Employees List</h1>
@stop

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                               <strong>{{  session('success') }}</strong>
                                
                              </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{  session('error')}} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif

                            <div class="float-right">
                                <a href="{{ route('employees.create')}}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Create</a>

                            </div>
                            <table class="table table-striped" id="company-table">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col" width="350px">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                    
                                 
                                </tbody>
                              </table>

                              
                                 
                                </tbody>
                              </table>

                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('js')

<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    $(function() {
        $('#company-table').DataTable({
            processing: true,
            serverSide: true,
             orderable: false,
              searchable: false,
            ajax: '{!! route('employees.index') !!}',
            columns: [{ 
                    data: 'id',
                    render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                },
                {
                    data: 'first_nm',
                    name: 'first_nm'
                },
                {
                    data: 'last_nm',
                    name: 'last_nm'
                },
                {
                    data: 'company.name',
                    name: 'company.name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    });
    
</script>
@stop