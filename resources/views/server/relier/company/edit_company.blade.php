@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Edit Company</h4>
                </div>
                <a type="button" class="close" href="{{route('view_companies')}}" >&times;</a>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif

            <div class="row">
                <div class="col-md-10">


                    <form class="m-b-30"  method="post" action="{{route('update_company')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <input class="form-control" type="hidden" name="id" value="{{$company->id}}" required>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Company Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{$company->name}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Mission</label>
                                    <textarea class="form-control"  name="mission" placeholder="{{$company->mission}}"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Company Logo <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="logo">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control"  name="status" required>
                                        <option>Enabled</option>
                                        <option>Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Has Delivery <span class="text-danger">*</span></label>
                                    <select class="form-control"  name="delivery" required>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>

                            </tbody>
                            </table>
                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Update Company</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection