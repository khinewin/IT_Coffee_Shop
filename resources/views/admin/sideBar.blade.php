<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" name="searchByID" id="searchByID" class="form-control" placeholder="Search Invoice ID">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="btnInvoiceSearch">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>

            <li>
                <a href="{{route('dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                <a href="{{route('coffee-list')}}"><i class="fa fa-coffee fa-fw"></i> Coffee</a>
                <a href="{{route('orders')}}"><i class="fa fa-first-order"></i> Orders</a>
                <a href="{{route('profit')}}"><i class="fa fa-product-hunt"></i> Profit</a>
            </li>



        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
