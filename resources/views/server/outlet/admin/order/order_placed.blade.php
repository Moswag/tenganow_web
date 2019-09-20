@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Processed Orders</h4>
                </div>

            </div>
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
                                <th style="width:30%;">Order</th>
                                <th>Order Number</th>
                                <th>Order Type</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Order Status</th>
                                <th class="text-right">By</th>

                            </tr>
                            </thead>
                            <tbody id="myTable">

                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="#" class="avatar">{{$order->order}}</a>
                                    <h2><a href="#">{{$order->order}}</a></h2>
                                </td>
                                <td>{{$order->id}}</td>
                                <td>
                                    @if($order->with_delivery=='true')
                                    Delivery
                                    @else
                                    Pickup
                                    @endif
                                </td>
                                <td>{{$order->customer_name}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->amount}}</td>
                                <td>{{$order->status}}</td>
                                <td class="text-right">
                                    @if($order->processed_by==\auth()->user()->id)
                                    You
                                    @else


                                    @endif

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
