@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <h4 class="page-title">Companies</h4>
                </div>
                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                    @else
                        <div class="alert alert-error">{{Session::get('error')}}</div>
                @endif
                <div class="col-xs-8 text-right m-b-20">
                    <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Company</a>
                </div>
            </div>
            <div class="row filter-row">
                <div class="col-sm-3 col-xs-6">
                    <div class="form-group form-focus">
                        <label class="control-label">Search</label>
                        <input type="text" id="myInput" class="form-control floating" />
                    </div>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
            <div class="row staff-grid-row" id="myTable">
                @foreach($companies as $company)
                    <div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
                        <div class="profile-widget">
                            <div class="profile-img">
                                <a href="#"><img class="avatar" src="{{$company->imageUrl}}" alt=""></a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{route('edit_company',['id'=>$company->id])}}"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                </ul>
                            </div>
                            <h4 class="user-name m-t-10 m-b-0 text-ellipsis">{{$company->name}}</h4>
                            <p>{{$company->mission}}</p>

                            <br/>
                            <div class="small text-muted">

                                <span
                                        @if($company->status=='Enabled')
                                        class="badge bg-primary pull-right"
                                        @else
                                        class="badge bg-danger pull-right"
                                        @endif
                                >
                                    {{$company->status}}
                                </span>
                                <a href="{{route('view_outlets',['id'=>$company->id])}}" class="badge bg-success pull-left">
                                    {{$out=\App\Outlet::where('company_id',$company->id)->count()}}
                                    Outlets >View
                                </a></div>
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
                    <form class="m-b-30"  method="post" action="{{route('save_company')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Company Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Mission</label>
                                    <textarea class="form-control"  name="mission" required></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Company Logo <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="logo" required>
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
                            <button class="btn btn-primary">Save Company</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
