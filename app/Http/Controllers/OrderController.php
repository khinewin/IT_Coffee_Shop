<?php

namespace App\Http\Controllers;

use App\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function getProfitByMonth(Request $request){
        if($request['findMonth']){
            $thisMonth=$request['findMonth'];
            $total=0;
            $orders=Order::where('created_at', 'LIKE', '%'.$thisMonth.'%')->get();
            $orders->transform(function ($order, $key){
                $order->cart=unserialize($order->cart);
                return $order;
            });
            foreach ($orders as $order) {
                $total += $order->cart->totalPrices;
            }
            return view ('admin.profit')->with(['orders'=>$orders])->with(['total'=>$total])->with(['thisMonth'=>$thisMonth]);


        }else{
            return redirect()->back();
        }
    }
    public function getProfit(){
        $thisMonth=date('Y-m-d');
        $total=0;
        $orders=Order::where('created_at', 'LIKE', '%'.$thisMonth.'%')->get();
        $orders->transform(function ($order, $key){
           $order->cart=unserialize($order->cart);
           return $order;
        });
        foreach ($orders as $order) {
            $total += $order->cart->totalPrices;
        }
        return view ('admin.profit')->with(['orders'=>$orders])->with(['total'=>$total])->with(['thisMonth'=>$thisMonth]);
    }
    public function getChangeOrder(Request $request){
        $ch=$request['ch'];
        if($ch=='new'){
            Session::forget('OrderUpdate');
            Session::put('OrderNew', 'new');
            return redirect()->back();
        }else{
            Session::forget('OrderNew');
            Session::put('OrderUpdate', 'update');
            return redirect()->back();

        }
    }

    public function getOrderUpdate(Request $request){
        $id=$request['id'];
        $u_t=$request['u_t'];
        if($u_t=='Delivered'){
            $order=Order::Where('id', $id)->first();
            if($order->cash_status=='0'){
                if($order->delivered_status=='0'){
                    $order->delivered_status=1;
                }else{
                    $order->delivered_status=0;
                }
                $order->update();

            }
            echo "success";
        }else{
            $order=Order::Where('id', $id)->first();
            if($order->delivered_status=='1'){
                $order->cash_status=1;
                $order->update();
            }
            echo "success";

        }
    }
    public function getPrintOrder(Request $request){
        $id=$request['id'];
        $orders=Order::Where('id', $id)->get();
        $orders->transform(function ($order, $key){
            $order->cart=unserialize($order->cart);
            return $order;
        });
        return view ('coffee.printOrder')->with(['orders'=>$orders]);
    }
    public function getGetOrders(Request $request){
        $id=$request['id'];
        Session::put('invoiceId', $id);
        $invoiceId=Session::has('invoiceId') ? Session::get('invoiceId') : null;
        if($invoiceId){
            $orders=Order::Where('id',$invoiceId)->get();
            $orders->transform(function ($order, $key){
                $order->cart=unserialize($order->cart);
                return $order;
            });
            return view ('coffee.getOrders')->with(['orders'=>$orders]);
        }else {
            $orders = Order::OrderBy('id', 'desc')->get();
            $orders->transform(function ($order, $key) {
                $order->cart = unserialize($order->cart);
                return $order;
            });
            return view('coffee.getOrders')->with(['orders' => $orders]);
        }
    }
    public function getOrders(){

        return view ('coffee.orders');
    }
}
