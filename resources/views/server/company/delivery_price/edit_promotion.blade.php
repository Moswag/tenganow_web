@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Edit Promotion</h4>
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
                    <form method="post" action="{{route('update_promotion')}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$promotion->id}}" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Promotion</label>
                                    <textarea class="form-control" type="text" name="promotion" placeholder="{{$promotion->promotion}}" required>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" type="text" name="status" required>
                                        <option>Enabled</option>
                                        <option>Disabled</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Update Promotion</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection