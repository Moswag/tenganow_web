@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Order Status</h4>
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




                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Order Status <span class="text-danger">*</span></label>
                                    <input class="form-control" value="{{ $orderStatus}}" type="text" name="name" required>
                                </div>
                            </div>


                            </tbody>
                            </table>
                        </div>
                        <div class="m-t-20 text-center">
                            <a href="" class="btn btn-primary">Back</a>
                        </div>

                </div>
            </div>
        </div>

    </div>


@endsection
