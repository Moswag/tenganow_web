<div class="header">
    <div class="header-left">
        <a href="" class="logo">
            <img src="{{URl::to('assets/img/relier_round.png')}}" width="40" height="40" alt="">
        </a>
    </div>
    <div class="page-title-box pull-left">
        <h3>RELiER</h3>
    </div>
    <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
    <ul class="nav navbar-nav navbar-right user-menu pull-right">
        <li class="dropdown hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge bg-purple pull-right">0</span></a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span>Notifications</span>
                </div>
                {{--  <div class="drop-scroll">
                    <!--<ul class="media-list">
                        <li class="media notification-message">
                            <a href="#l">
                                <div class="media-left">
												<span class="avatar">
													<img alt="John Doe" src="{{URL::to('assets/img/user.jpg')}}" class="img-responsive img-circle">
												</span>
                                </div>
                                <div class="media-body">
                                    <p class="m-0 noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                    <p class="m-0"><span class="notification-time">4 mins ago</span></p>
                                </div>
                            </a>
                        </li>

                    </ul> -->
                </div>  --}}
                <div class="topnav-dropdown-footer">
                    <a href="#">View all Notifications</a>
                </div>
            </div>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
                @if(auth()->user()->image==NULL)
                    <span class="user-img"><img class="img-circle" src="{{URL::to('assets/img/user.jpg')}}" width="40" >
                    @else
                    <span class="user-img"><img class="img-circle" src="{{auth()->user()->image}}" width="40" >
                    @endif

							<span class="status online"></span></span>
                <span>{{auth()->user()->name}}</span>
                <i class="caret"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('change_password') }}">Change Password</a></li>
                <li><a href="{{route('logout')}}">Logout</a></li>
            </ul>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <ul class="dropdown-menu pull-right">
            <li><a href="{{ route('change_password') }}">Change Password</a></li>
            <li><a href="{{route('logout')}}">Logout</a></li>
        </ul>
    </div>
</div>
