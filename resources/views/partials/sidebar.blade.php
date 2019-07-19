<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="submenu">
                    <a href="#" class="noti-dot"><span> Product</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a class="active" href="{{route('view_products')}}">View Products</a></li>
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
        </div>
    </div>
</div>
