@extends('layout.template')

@section('title')
    Print Order | IT Coffee.
@stop

@section('content')
<div class="row">
    <div class="container" id="printContainer">
    @foreach($orders as $order)
        <div class="panel panel-default clearfix">
            <div class="shopHeader">
                <h3>IT Coffee</h3>
                <p>09970488345</p>
                <p>Invoice ID : {{$order->id}}</p>
                <p>{{$order->table_number}}</p>
                <p>Waiter : {{$order->user->userName}}</p>
                <p>Casher : {{Auth::User()->userName}}</p>


            </div>
            <div class="panel-heading">
                Time In : {{date('h :i : A', strtotime($order->created_at))}}
                <span class="pull-right">
                Time Out : {{date ('h :i : A')}}
                </span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Unit Prices</td>
                        <td>Qty</td>
                        <td>Prices</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->cart->items as $item)
                        <tr>
                            <td>{{$item['item']['coffee_name']}}</td>
                            <td>{{$item['item']['coffee_price']}} Ks</td>
                            <td>{{$item['qty']}}</td>
                            <td>{{$item['price']}} Ks</td>
                        </tr>
                        @endforeach
                    <tr>
                        <td colspan="3">Total Prices</td>
                        <td>{{$order->cart->totalPrices}} Ks</td>
                    </tr>
                    <tr>
                        <td colspan="3">Government Tax (5%)</td>
                        <td>{{$order->cart->totalPrices * 5 /100}} Ks</td>
                    </tr>
                    <tr>
                        <td colspan="3">Grand Total Prices</td>
                        <td>{{($order->cart->totalPrices * 5 /100) + $order->cart->totalPrices}} Ks </td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <span class="pull-right">Thank You Very Much See again.</span>
        </div>
    @endforeach


</div>
</div>
<!-- /.row -->

@stop

