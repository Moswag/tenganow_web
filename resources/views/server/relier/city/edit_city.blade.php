@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Edit City</h4>
                </div>
                <a type="button" class="close" href="{{route('view_cities')}}" >&times;</a>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif

            <div class="row">
                <div class="col-md-10">


                        <form method="post" action="{{route('update_city')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <input type="hidden" class="form-control"  name="id" value="{{$city->id}}"  required>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>City Name</label>
                                        <input type="text" class="form-control"  name="city" value="{{$city->name}}"  required>

                                    </div>
                                </div>

                            </div>


                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary">Update City</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>

    </div>


@endsection