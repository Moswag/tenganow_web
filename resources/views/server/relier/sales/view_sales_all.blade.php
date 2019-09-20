@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Sales</h4>
                </div>
                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @else
                    <div class="alert alert-error">{{Session::get('error')}}</div>
                @endif
            </div>

            <div class="row staff-grid-row" id="myTable">
                    <div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
                        <div class="profile-widget">
                            <div class="profile-img">
                                <a href="#"><img class="avatar" src="" alt=""></a>
                            </div>

                            <h4 class="user-name m-t-10 m-b-0 text-ellipsis">All Company Sales</h4>

                            <br/>
                            <div class="small text-muted">

                                <a  class="badge bg-success pull-left">
                                    $8000
                                </a></div>
                        </div>
                    </div>

                <div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
                    <div class="profile-widget">
                        <div class="profile-img">
                            <a href="#"><img class="avatar" src="{{URL::to('assets/img/relier_round.png')}}" alt=""></a>
                        </div>

                        <h4 class="user-name m-t-10 m-b-0 text-ellipsis">Relier Stack</h4>

                        <br/>
                        <div class="small text-muted">

                            <a  class="badge bg-success pull-left">
                                $80
                            </a></div>
                    </div>
                </div>



            </div>
        </div>

    </div>



@endsection
