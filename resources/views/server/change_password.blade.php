@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Change Password</h4>
                </div>

            </div>

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif

            <div class="row">
                <div class="col-md-10">
                    <form method="post" action="{{route('update_password')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="New Password" required>

                                </div>
                                <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>

                                    </div>
                            </div>
                        </div>

                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Change Password</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection
