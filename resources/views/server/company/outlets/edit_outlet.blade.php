@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Edit Outlet</h4>
                </div>
                <a type="button" class="close" href="{{route('view_products')}}" >&times;</a>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif

            <div class="row">
                <div class="col-md-10">


                    <form method="post" action="{{route('update_outlet_admin')}}">
                        {{csrf_field()}}
                        <input class="form-control" type="hidden" name="id" value="{{$outlet->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" type="text" name="address" placeholder="{{$outlet->address}}"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="form-control" name="city"  required>
                                        <option>{{$outlet->city}}</option>
                                        @foreach($cities as $city)
                                            @if($city->name!=$outlet->city)
                                            <option>{{$city->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Tel</label>
                                <input class="form-control" type="number" name="tel" value="{{$outlet->tel}}" placeholder="Enter Outlet Tel" required>
                            </div>
                        </div>


                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Update Outlet</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection