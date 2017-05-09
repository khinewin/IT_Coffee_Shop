@extends('admin.template')

@section('title')
    Orders | IT Coffee.
@stop
@include('admin.sideBar')

@section('adminContent')

@section('pageTitle')
    <a href="{{route('orders')}}"><i class="fa fa-first-order"></i> Orders </a>

@stop

<div class="row" id="showOrders">


</div>
<!-- /.row -->

@stop

