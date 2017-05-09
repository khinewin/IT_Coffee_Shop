@extends('admin.template')

@section('title')
    Dashboard | IT Coffee.
    @stop
@include('admin.sideBar')

@section('adminContent')

    @section('pageTitle')
        <a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        @stop

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-coffee fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{count($cfs)}}</div>
                            <div>Coffees </div>
                        </div>
                    </div>
                </div>
                <a href="{{route('coffee-list')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-first-order fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{count($orders_list)}}</div>
                            <div>Orders</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('orders')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-coffee fa-fw"></i> Coffee List

                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" style="font-size: 12px">
                                <thead>
                                <tr class="alert-success">
                                    <td>Images</td>
                                    <td>Name</td>
                                    <td>Prices</td>
                                    <td>Summary</td>
                                    <td>Categories</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cfl as $cf)
                                    <tr>
                                        <td><img id="adminCoffeeImg" src="{{route('get-coffee-image',['file_name'=>$cf->coffee_photo])}}" width="50px" class="img-rounded"></td>
                                        <td>{{$cf->coffee_name}}</td>
                                        <td>{{$cf->coffee_price}} Ks</td>
                                        <td>{{$cf->coffee_summary}}</td>
                                        <td>{{$cf->cat->category_name}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$cfl->links()}}
                        </div>

                    </div>
                    <!-- /.panel-body -->
                </div>


            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-first-order"></i> Orders
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="showOrders"></div>
                    </div>
                </div>


            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->

    @stop
