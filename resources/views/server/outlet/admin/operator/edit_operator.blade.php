@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Edit Operator</h4>
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


                    <form method="post" action="{{route('update_outlet_operator')}}">
                        {{csrf_field()}}
                        <input class="form-control" type="hidden" name="id" value="{{$operator->id}}"  required>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$operator->name}}" placeholder="Enter name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Surname</label>
                                <input class="form-control" type="text" name="surname" value="{{$operator->surname}}" placeholder="Enter surname" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" value="{{$operator->email}}" placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Phonenumber</label>
                                <input class="form-control" type="number" name="phonenumber" value="{{$operator->phonenumber}}" placeholder="Enter phonenumber" required>
                            </div>
                        </div>


                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Update Operator</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection