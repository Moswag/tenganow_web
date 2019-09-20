@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">{{$company->name}} Outlets</h4>
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
                                <th style="width:5%;">Id</th>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Tel</th>
                                <th>Working Hour</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($outlets as $outlet)
                                <tr>
                                    <td>
                                        <a href="#" class="avatar">{{$outlet->id}}</a>
                                    </td>
                                    <td>{{$outlet->company}}</td>
                                    <td>{{$outlet->address}}</td>
                                    <td>{{$outlet->city}}</td>
                                    <td>{{$outlet->tel}}</td>
                                    <td><a class="btn btn-xs btn-primary">{{$outlet->working_hours}}</a></td>
                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection