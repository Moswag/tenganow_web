@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div id="add_salary">
                <div class="modal-dialog">

                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Outlet Paynow</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('update_outlet_paynow')}}">
                                {{csrf_field()}}
                                <input class="form-control" type="hidden" name="outlet_id" required value="{{$outletPaynow->outlet_id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Outlet Address</label>
                                            <input class="form-control" type="text" name="address" required value="{{$outletPaynow->address}}" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Integration Id</label>
                                            <input class="form-control" type="number" name="integrationId" placeholder="Enter integration Id" required value="{{$outletPaynow->integrationId}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Integration Key</label>
                                        <input class="form-control" type="text" name="integrationKey" placeholder="Enter integration Key" required value="{{$outletPaynow->integrationKey}}">
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
                                    <button class="btn btn-primary">Update Outlet Token</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection