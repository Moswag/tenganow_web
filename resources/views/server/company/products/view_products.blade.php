@extends('layouts.master')
@section('content')
<div class="page-wrapper">
<div class="content container-fluid">
    <div class="row">
        <div class="col-xs-4">
            <h4 class="page-title">Products</h4>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
        <div class="col-xs-8 text-right m-b-20">
            <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Product</a>

        </div>
    </div>
    <div class="row filter-row">
        <div class="col-sm-3 col-xs-6">
            <div class="form-group form-focus">
                <label class="control-label">Product Name</label>
                <input type="text" class="form-control floating" />
            </div>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
    </div>
    <div class="row staff-grid-row">
        @foreach($products as $product)
        <div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="#"><img class="avatar" src="{{$product->picture}}" alt=""></a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                    </ul>
                </div>
                <h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="profile.html">{{$product->name}}</a></h4>


                <br/>
                <div class="small text-muted"><span class="badge bg-primary pull-right">${{$product->price}}</span></div>
            </div>
        </div>
            @endforeach


    </div>
</div>

</div>
<div id="add_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-content modal-lg">

            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
            </div>
            <div class="modal-body">
                <form class="m-b-30"  method="post" action="{{route('save_product')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Product Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Price</label>
                                <input class="form-control" type="number" name="price" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Picture <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="picture" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Code <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="code" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Discount</label>
                                <input class="form-control" type="number" name="discount" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control"  name="description" required></textarea>
                            </div>
                        </div>

                            </tbody>
                        </table>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    @endsection
