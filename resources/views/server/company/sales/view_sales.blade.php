@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">View Sales</h4>
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
                                <th style="width:20%;">Outlet</th>
                                <th>TDate</th>
                                <th>Total Amount</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{$sale->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        {{$sale->created_at->toFormattedDateString()}}
                                    </td>
                                    <td>{{$sale->amount}}</td>
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
