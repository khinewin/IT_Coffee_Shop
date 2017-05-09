
<div class="col-lg-12">
    @foreach($orders as $order)
        <div class="panel panel-primary">
            <div class="panel-heading"><button class="btn btn-default btn-sm">{{$order->table_number}}</button> <button type="button" class="btn btn-default btn-sm">Invoice ID : {{$order->id}}</button> <button class="btn btn-default btn-sm">Waiter : {{$order->user->userName}} </button><span class="badge pull-right">{{date('d-m-Y / h:i A', strtotime($order->created_at))}}</span></div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="font-size: 12px">
                    <thead>
                    <tr class="alert-success">
                        <td>Name</td>
                        <td>Unit Prices</td>
                        <td>Qty</td>
                        <td>Prices</td>
                    </tr>
                    </thead>
                    @foreach($order->cart->items as $item)
                        <tr class="alert-warning">
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
                </table>
                </div>
            </div>
            <div class="panel-footer clearfix">
                @if($order->delivered_status=='0')
                    <button type="button" class="btn btn-warning btn-sm" id="btnDelivered" idd="{{$order->id}}" u_t="Delivered"><span class="glyphicon glyphicon-alert"></span> Waiting for Delivered</button>
                @else
                    <button type="button" class="btn btn-primary btn-sm" id="btnDelivered" idd="{{$order->id}}" u_t="Delivered" > <span class="glyphicon glyphicon-ok-circle"></span> Delivered</button>
                @endif
                @if($order->cash_status=='0')
                        <button id="btnCashed" idd="{{$order->id}}" u_t="Cashed" type="button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-alert"></span> Waiting for Cashed</button>
                    @else
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> Cashed</button>
                    @endif
                <span class="pull-right"><a  class="btn btn-primary btn-sm" href="{{route('print-order',['id'=>$order->id])}}"> <i class="fa fa-print"></i> Print</a></span></div>
        </div>
    @endforeach
</div>