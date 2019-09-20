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
                            <h4 class="user-name m-t-10 m-b-0 text-ellipsis"><a href="">{{$product->name}}</a></h4>
                            <br/>
                            @if($prod=\App\OutletPoductAvailability::where('product_id',$product->id)->exists())
                            <div class="small text-muted"><span class="badge bg-danger pull-left">Not Available</span>
                                @else
                                    <div class="small text-muted"><span class="badge bg-success pull-left">Available</span>
                                    @endif
                            </div>
                            <div class="small text-muted"><span class="badge bg-primary pull-right">${{$product->price}}</span></div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>

    </div>



@endsection
