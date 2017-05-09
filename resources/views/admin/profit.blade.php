@extends('admin.template')

@section('title')
    Profit | IT Coffee.
@stop
@include('admin.sideBar')

@section('adminContent')

@section('pageTitle')
    <a href="{{route('profit')}}"><i class="fa fa-product-hunt"></i> Profit</a>
    <div class="navbar-form pull-right">
        <form role="form" method="get" action="{{route('profit-by-month')}}">
            <div class="input-group">
            <input type="text" name="findMonth" id="findMonth" class="form-control" placeholder="Search By Date">
                <span class="input-group-addon">
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search"></span>

            </button>
                </span>
            </div>
        </form>
    </div>
@stop

<!-- /.row -->
<div class="row">

    <div class="panel panel-primary">
        <div class="panel-heading"><button class="btn btn-default btn-sm">Total Incomes</button> <button class="btn btn-sm btn-success">{{$thisMonth}}</button> <span class="pull-right badge" >{{$total}} Ks</span></div>
        <div class="panel-body">

            @foreach($orders as $order)
                <ul class="list-group">
                    <li class="list-group-item clearfix"><button class="btn btn-primary btn-sm">{{date('d/m/Y | h:i A', strtotime($order->created_at))}}</button> <button class="btn btn-success btn-sm"> Invoice ID {{$order->id}}</button> <button class="btn btn-warning btn-sm">Waiter : {{$order->user->userName}}</button> <span class="badge pull-right">{{$order->cart->totalPrices}} Ks</span></li>
                </ul>
                @endforeach
        </div>
    </div>

    </div>
    <!-- /.row -->

@stop
