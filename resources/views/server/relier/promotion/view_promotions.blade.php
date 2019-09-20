@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Company Promotions</h4>
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
                                <th>Company</th>
                                <th>Promotion</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($promotions as $promotion)
                                <tr>
                                    <td>
                                        <a href="#" class="avatar">{{$promotion->id}}</a>
                                    </td>
                                    <td>{{$promotion->company}}</td>
                                    <td>{{$promotion->promotion}}</td>
                                    <td><a class="btn btn-xs btn-primary">{{$promotion->status}}</a></td>
                                    <td>
                                        {{ $promotion->created_at->toFormattedDateString() }}
                                        {{ $promotion->created_at->toTimeString() }}
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{route('delete_company_promotion',['id'=>$promotion->id])}}"   title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
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
                    <h4 class="modal-title">Add City</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('save_city')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>City Name</label>
                                    <input type="text" class="form-control"  name="city"  required>

                                </div>
                            </div>

                        </div>


                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Save City</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
