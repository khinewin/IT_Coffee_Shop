@extends('layout.template')

@section('title')
    Shopping Cart Detail | IT Coffee.
@stop

@section('content')

    <div class="container" id="MainContainer">

        <div class="row">
            <div class="col-sm-8">
                @if(Session('err')) <li class="alert alert-danger"> <span class="glyphicon glyphicon-alert"></span> {{Session('err')}}</li> @endif
                @if(Session('status')) <li class="alert alert-success"><span class="glyphicon glyphicon-ok-circle"></span> {{Session('status')}}</li> @endif
                <div class="panel panel-primary">
                    <div class="panel-heading">Cart Details <a href="{{route('clear-cart')}}" class="pull-right" id="clearCart"><span class="glyphicon glyphicon-remove-circle"></span> Clear Cart</a></div>
                    <div class="panel-body">
                        @if($carts)
                            <div class="table-responsive">
                        <table class="table table-bordered table-hover" >
                            <thead>
                            <tr class="alert-success">
                                <td>Name</td>
                                <td>Unit Prices</td>
                                <td>Qty</td>
                                <td>Prices</td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($carts as $cart)
                                <tr class="alert-warning">
                                    <td>{{$cart['item']['coffee_name']}}</td>
                                    <td>{{$cart['item']['coffee_price']}} Ks</td>
                                    <td>{{$cart['qty']}}
                                    <div class="btn-group" id="reduceItem">
                                        <a href="#" data-toggle="dropdown" class="btn btn-default btn-sm"><i class="fa fa-caret-down"></i></a>
                                        <ul class="dropdown-menu">
                                            @if($cart['qty'] >1)
                                            <li><a href="{{route('reduce-one',['id'=>$cart['item']['id']])}}">Reduce 1</a></li>
                                                <li><a href="{{route('remove-item',['id'=>$cart['item']['id']])}}">Remove Item</a></li>
                                            @else
                                            <li><a href="{{route('remove-item',['id'=>$cart['item']['id']])}}">Remove Item</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    </td>
                                    <td>{{$cart['price']}} Ks</td>
                                </tr>

                            @endforeach
                            <tr class="alert-info">
                                <td colspan="3">Total Prices</td>
                                <td>{{$totalPrices}} Ks</td>
                            </tr>

                            </tbody>

                        </table>
                            </div>
                                @else

                                <li class="alert alert-danger"><span class="glyphicon glyphicon-alert"></span> No items available in your cart.</li>

                                @endif
                            <a href="{{route('/')}}" ><i class="fa fa-backward"></i> Continued Shopping</a>


                    </div>
                </div>



        </div>
            <div class="col-sm-4">

            @if(Session::has('cart'))
                    <div class="form-group">
                    <a href="{{route('change-order',['ch'=>'new'])}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> New Order</a>
                <a href="{{route('change-order',['ch'=>null])}}" class="btn btn-primary"><i class="fa fa-edit"></i> Update Order</a>
                    </div>
                    @if(Session('info')) <li class="alert alert-danger"><span class="glyphicon glyphicon-alert"></span> {{Session('info')}}</li> @endif

                    @if(Session::has('OrderNew'))
                    <div class="form-group">
                    <button class="btn btn-warning btn-block">New Order</button>
                    </div>

                <form role="form" method="post" action="{{route('check-out')}}">
                    <div class="form-group">
                        <label for="table_number" class="control-label">Table Number</label>
                        <select name="table_number" id="table_number" class="form-control">
                            <option value="0">--Select Table--</option>
                           <option value="Table-1">Table-1</option>

                            <option value="Table-2">Table-2</option>

                            <option value="Table-3">Table-3</option>

                            <option value="Table-4">Table-4</option>
                            <option value="Table-5">Table-5</option>

                            <option value="Table-6">Table-6</option>
                            <option value="Table-7">Table-7</option>

                            <option value="Table-8">Table-8</option>

                            <option value="Table-9">Table-9</option>
                            <option value="Table-10">Table-10</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Check Out</button>
                    </div>
                    {{csrf_field()}}
                </form>

                    @else
                        <div class="form-group">
                            <button class="btn btn-warning btn-block">Update Order</button>
                        </div>
                        <form role="form" method="post" action="{{route('check-out')}}">
                            <div class="form-group">
                                <label for="invoice_id" class="control-label">Table Number & Invoice ID</label>
                                <select name="invoice_id" id="invoice_id" class="form-control">
                                    <option value="0">--Select Table--</option>
                                    @foreach($orders as $order)
                                        <option value="{{$order->id}}">{{$order->table_number}} | Invoice ID {{$order->id}}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Check Out</button>
                            </div>
                            {{csrf_field()}}
                        </form>

                    @endif

                @endif
            </div>
        </div>
    </div>

@stop