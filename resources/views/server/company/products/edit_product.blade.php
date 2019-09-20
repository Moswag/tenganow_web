@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Edit Product</h4>
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


                    <form class="m-b-30"  method="post" action="{{route('update_product')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input class="form-control" value="{{$product->id}}" type="hidden" name="id" required>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Product Name <span class="text-danger">*</span></label>
                                    <input class="form-control" value="{{$product->name}}" type="text" name="name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input class="form-control" type="number" value="{{$product->price}}" name="price" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Picture <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="picture">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Code <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" value="{{$product->code}}" name="code" required>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control"  name="description" placeholder="{{$product->description}}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Discount</label>
                                    <input class="form-control" type="number" value="{{$product->discount}}" name="discount" required>
                                </div>
                            </div>
                            </tbody>
                            </table>
                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Update Product</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection