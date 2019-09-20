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
                            <li><a  href="{{route('view_all_sales')}}">View All Sales</a></li>
                            <li><a  href="{{route('view_all_sales')}}">View Sales By Outlet</a></li>
                        </ul>

                    </li>
                    <li class="submenu">
                        <a href="#" ><span> Token</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_tokens')}}">View Tokens</a></li>
                        </ul>
                    </li>
                    {{--<li class="submenu">--}}
                        {{--<a href="#" ><span> Outlets</span> <span class="menu-arrow"></span></a>--}}
                        {{--<ul class="list-unstyled" style="display: none;">--}}
                            {{--<li><a  href="{{route('view_outlets')}}">View Outlets</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <li class="submenu">
                        <a href="#" ><span> Customers</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_customers')}}">View Customers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('view_cities')}}">Cities</a>
                    </li>
                    <li>
                        <a href="{{route('view_company_promotions')}}">Promotions</a>
                    </li>

                    <li>
                        <a href="{{route('view_all_tractions')}}">Transactions</a>
                    </li>

                    <li>
                        <a href="{{route('view_outlet_paynows')}}">Outlet Paynow Tokens</a>
                    </li>


                </ul>
                @elseif(auth()->user()->role==\App\MyConstants::USER_COMPANY_ADMIN)
                <ul>
                    <li class="submenu">
                        <a href="#" ><span> Product</span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled" style="display: none;">
                            <li><a  href="{{route('view_products')}}">View Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('view_company_admins')}}">Admin</a>
                    </li>
                    <li>
                        <a href="{{route('view_company_outlets')}}">Outlet</a>
                    </li>
                    <li>
                        <a href="{{route('view_outlet_admins')}}">Outlet Admin</a>
                    </li>
                    <li>
                        <a href="#">Sales</a>
                    </li>
                    <li>
                        <a href="{{route('view_promotions')}}">Promotions</a>
                    </li>

                    <li>
                            <a href="{{route('view_delivery_price')}}">Delivery Price</a>
                        </li>

                </ul>
                @elseif(auth()->user()->role==\App\MyConstants::USER_OUTLET_ADMIN)
                    <ul>

                        <li class="submenu">
                            <a href="#" ><span> Product</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a  href="{{route('view_outlet_products')}}">View Products</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('order_placed')}}">Processed Order</a>
                        </li>
                        <li>
                            <a href="{{route('pending_order')}}">Pending Order</a>
                        </li>
                        <li>
                            <a href="{{route('order_to_be_delivered')}}">Orders To Be Delivered</a>
                        </li>
                        <li>
                            <a href="{{ route('outlet_view_sales') }}">Sales</a>
                        </li>
                        <li>
                            <a href="{{route('view_operators')}}">Operators</a>
                        </li>

                    </ul>
                    @elseif(auth()->user()->role=='outlet_operator')
                        <ul>

                            <li class="submenu">
                                <a href="#" ><span> Product</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled" style="display: none;">
                                    <li><a  href="{{route('view_operator_products')}}">View Products</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('order_placed')}}">Processed Order</a>
                            </li>
                            <li>
                                <a href="{{route('pending_order')}}">Pending Order</a>
                            </li>
                            <li>
                                    <a href="{{route('order_to_be_delivered')}}">Orders To Be Delivered</a>
                                </li>
                                <li>
                                    <a href="{{ route('outlet_view_sales') }}">Sales</a>
                                </li>

                        </ul>
                @endif
        </div>
    </div>
</div>
