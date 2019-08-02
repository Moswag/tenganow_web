<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            @if(auth()->user()->role==\App\MyConstants::USER_RELIER_ADMIN)
                <ul>

                    <li class="submenu">
                        <a href="#" class="noti-dot"><span> Admin</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_admins')}}">View Admins</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" ><span> Company</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_companies')}}">View Companies</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" ><span> Sales</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_products')}}">View Sales</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" ><span> Token</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_tokens')}}">View Tokens</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" ><span> Outlets</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_outlets')}}">View Outlets</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" ><span> Customers</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_customers')}}">View Customers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('view_cities')}}">Cities</a>
                    </li>


                </ul>
                @elseif(auth()->user()->role=='company_admin')
                <ul>
                    <li class="submenu">
                        <a href="#" ><span> Product</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_products')}}">View Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('order_placed')}}">Admin</a>
                    </li>
                    <li>
                        <a href="{{route('view_company_outlets')}}">Outlet</a>
                    </li>
                    <li>
                        <a href="{{route('pending_order')}}">Outlet Admin</a>
                    </li>
                    <li>
                        <a href="#">Sales</a>
                    </li>

                </ul>
                @elseif(auth()->user()->role=='outlet_admin')
                    <ul>

                        <li class="submenu">
                            <a href="#" ><span> Product</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a  href="{{route('view_products')}}">View Products</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('order_placed')}}">Processed Order</a>
                        </li>
                        <li>
                            <a href="{{route('pending_order')}}">Pending Order</a>
                        </li>
                        <li>
                            <a href="#">Sales</a>
                        </li>

                    </ul>
                    @elseif(auth()->user()->role=='outlet_operator')
                        <ul>

                            <li class="submenu">
                                <a href="#" ><span> Product</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled" style="display: none;">
                                    <li><a  href="{{route('view_products')}}">View Products</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('order_placed')}}">Processed Order</a>
                            </li>
                            <li>
                                <a href="{{route('pending_order')}}">Pending Order</a>
                            </li>
                            <li>
                                <a href="#">Sales</a>
                            </li>

                        </ul>
                @endif
        </div>
    </div>
</div>
