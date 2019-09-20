@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Admins</h4>
                </div>
                <div class="col-xs-8 text-right m-b-30">
                    <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Company Admin</a>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
            <div class="row filter-row">

                <div class="col-sm-3 col-md-2 col-xs-6">

                </div>
                <div class="col-sm-3 col-md-2 col-xs-6">

                </div>
                <div class="col-sm-3 col-md-2 col-xs-6">

                </div>
                <div class="col-sm-3 col-md-2 col-xs-6">

                </div>
                <div class="col-sm-3 col-md-2 col-xs-6">

                </div>

                <div class="col-sm-3 col-md-2 col-xs-6">
                    <div class="form-group form-focus">
                        <label class="control-label">Search</label>
                        <input type="text" id="myInput" class="form-control floating" />
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th style="width:20%;">Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Phonenumber</th>
                                <th>Role</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($admins as $admin)
                                <tr>
                                    <td>
                                        <a href="#" class="avatar">{{$admin->name}}</a>
                                        <h2><a href="#">{{$admin->name}} <span>Company Admin</span></a></h2>
                                    </td>
                                    <td>{{$admin->surname}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->phonenumber}}</td>
                                    <td><a class="btn btn-xs btn-primary">Company Admin</a></td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{route('edit_company_admin',['id'=>$admin->id])}}"  title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                <li><a href="{{route('delete_company_admin',['id'=>$admin->id])}}"   title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="add_salary" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Add Admin</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('save_company_admin')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Surname</label>
                                <input class="form-control" type="text" name="surname" placeholder="Enter surname" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Phonenumber</label>
                                <input class="form-control" type="number" name="phonenumber" placeholder="Enter phonenumber" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Enter password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="confirm_password" placeholder="Confirm password" required>
                            </div>
                        </div>

                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Create Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
