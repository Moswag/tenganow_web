@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Outlet Paynow</h4>
                </div>
                <div class="col-xs-8 text-right m-b-30">
                    <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Outlet Paynow</a>
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
                                <th style="width:20%;">Id</th>
                                <th>Address</th>
                                <th>Integration Id</th>
                                <th>Integration Key</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($outlet_paynow as $paynow)
                                <tr>
                                    <td>
                                        <a href="#" class="avatar">{{$paynow->outlet_id}}</a>
                                    </td>
                                    <td>{{$paynow->address}}</td>
                                    <td>{{$paynow->integrationId}}</td>
                                    <td>{{$paynow->integrationKey}}</td>
                                    <td><a
                                    @if($paynow->status=="Live")
                                    class= "btn btn-xs btn-primary"
                                        @else
                                            class="btn btn-xs btn-danger"
                                            @endif
                                        >
                                        {{$paynow->status}}</a></td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{route('edit_outlet_paynow',['id'=>$paynow->outlet_id])}}"  title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                <li><a href="{{route('delete_outlet_paynow',['id'=>$paynow->outlet_id])}}"   title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
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
                    <h4 class="modal-title">Add Outlet Paynow</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('save_outlet_paynow')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Outlet Address</label>
                                    <select class="form-control" type="text" name="outlet_id" required>
                                        @foreach($outlets as $outlet)
                                        <option value="{{$outlet->id}}">{{\App\Company::find($outlet->company_id)->name}} | {{$outlet->address}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Integration Id</label>
                                    <input class="form-control" type="number" name="integrationId" placeholder="Enter integration Id" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Integration Key</label>
                                <input class="form-control" type="text" name="integrationKey" placeholder="Enter integration Key" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" type="text" name="status" required>
                                        <option>Live</option>
                                        <option>Disabled</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Create Outlet Token</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection