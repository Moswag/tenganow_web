@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-8">
                    <h4 class="page-title">Receipt</h4>
                </div>

            </div>
            <div class="row" id="receipt">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="payslip-title">Receipt for order 43</h4>
                        <div class="row">
                            <div class="col-md-6 m-b-20">
                                <img src="{{URL::to("assets/img/logo2.png")}}" class="m-b-20" alt="" style="width: 100px;">
                                <ul class="list-unstyled m-b-0">
                                    <li>{{auth()->user()->company_name}}</li>
                                    <li>{{auth()->user()->company_address}}</li>
                                    <li>Tel: {{auth()->user()->tel}}</li>
                                </ul>
                            </div>
                            <div class="col-md-6 m-b-20">
                                <div class="invoice-details">
                                    <h3 class="text-uppercase">Order #43</h3>
                                    <ul class="list-unstyled">
                                        <li>Date: <span>12/12/19</span></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <h4 class="m-b-10"><strong>Order</strong></h4>
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td><strong>Basic Salary</strong> <span class="pull-right">$6500</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>House Rent Allowance (H.R.A.)</strong> <span class="pull-right">$55</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Conveyance</strong> <span class="pull-right">$55</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Other Allowance</strong> <span class="pull-right">$55</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Earnings</strong> <span class="pull-right"><strong>$55</strong></span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <i>Thank you for doing business with us.</i>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" onclick="printData()">Print Receipt</button>
                <script>
                    function printData() {
                        var divToPrint=document.getElementById("receipt");
                        newWin=window.open("");
                        newWin.document.write(divToPrint.outerHTML);
                        newWin.print();
                        newWin.close();

                    }
                </script>

            </div>
        </div>

    </div>
@endsection
