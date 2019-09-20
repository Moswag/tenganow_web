@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Transactions</h4>
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
                                <th>Phonenumber</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-right">Date</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>
                                        <a href="#" class="avatar">{{$transaction->id}}</a>
                                    </td>
                                    <td>{{$transaction->instrument}}</td>
                                    <td>{{$transaction->amount}}</td>
                                    <td>
                                        @if($transaction->paid==1)
                                        <a class="btn btn-xs btn-primary">
                                            Paid</a>
                                            @else
                                            <a class="btn btn-xs btn-danger">
                                                    UnPaid</a>
                                                    @endif
                                        </td>

                                    <td class="text-right">
                                        {{ $transaction->created_at }}
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


@endsection
