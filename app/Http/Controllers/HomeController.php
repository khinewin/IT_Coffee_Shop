<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Cat;
use App\Coffee;
use App\Cart;
use App\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function postCheckOut(Request $request){
        if(Auth::User()) {
            $orderUpdate=Session::get('OrderUpdate');
                if($orderUpdate =='update'){
                    if($request['invoice_id']) {
                        $invoice_id = $request['invoice_id'];
                        $oldCart = Session::has('cart') ? Session::get('cart') : null;
                        $cart = new Cart($oldCart);

                        $order = Order::Where('id', $invoice_id)->first();
                        $order->cart = serialize($cart);
                        $order->update();
                        Session::forget('cart');

                    }else{
                        return redirect()->back()->with('info','The table number with invoice id is select required.');
                    }

                }else {
                    if($request['table_number']) {
                        $oldCart = Session::has('cart') ? Session::get('cart') : null;
                        $cart = new Cart($oldCart);

                        $order = new Order();
                        $order->table_number = $request['table_number'];
                        $order->cart = serialize($cart);
                        $order->delivered_status = 0;
                        $order->cash_status = 0;
                        Auth::User()->order()->save($order);
                        Session::forget('cart');
                    }else{
                        return redirect()->back()->with('info', 'The table number is selected required.');
                    }
                }
                return redirect()->back()->with('status', 'Your order have been success.');
        }
        else{
            return redirect()->back()->with('err','You don\'t have permission to make order checkout.');
        }
    }
    public function getReduceOne($id){
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        $cart->reduceOne($id);
        Session::put('cart', $cart);
        if(Session::get('cart')->totalQty <1){
            Session::forget('cart');
        }
        return redirect()->back();

    }
    public function getRemoveItem($id){
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        if(Session::get('cart')->totalQty <1){
            Session::forget('cart');
        }
        return redirect()->back();

    }
    public function getClearCart(){
        Session::forget('cart');
        return redirect()->back();
    }
    public function getShowCart(){
        if(Session::has('cart')){
            $orders=Order::OrderBy('id','desc')->get();
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            return view ('showCart')->with(['carts'=>$cart->items])->with(['totalPrices'=>$cart->totalPrices])->with(['orders'=>$orders]);

        }else{
            return view ('showCart')->with(['carts'=>null]);
        }

    }
    public function getCart(){
        return view ('getCart');
    }
    public function getAddToCart(Request $request){
        $id=$request['id'];
        $pd=Coffee::where('id', $id)->first();
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        $cart->add($pd, $pd->id);
        $result=Session::put('cart', $cart);
        return $result;

    }
    public function getByCategory(Request $request){
        $category=$request['category'];
        Session::forget('noResult');
        $cats=Cat::all();
        $cfs=Coffee::where('cat_id', $category)->OrderBy('id','desc')->paginate('6');
        return view ('welcome')->with(['cfs'=>$cfs])->with(['cats'=>$cats]);

    }
    public function showSearch(Request $request){
        if($request['coffee_name']){
            $cats=Cat::all();
            $coffee=$request['coffee_name'];
            $cfs=Coffee::where('coffee_name', 'LIKE', '%'.$coffee.'%')->paginate('6');
            if($cfs) {
                return view('welcome')->with(['cfs' => $cfs])->with(['cats' => $cats]);
            }else{
                Session::put('noResult', 'noResult');
                return view('welcome')->with(['cfs' => $cfs])->with(['cats' => $cats]);
            }

        }else{
            Session::put('noResult', 'noResult');
            $cats=Cat::all();
            return view ('welcome')->with(['cats'=>$cats]);
        }
    }
    public function getWelcome(){
        Session::forget('noResult');
        $cats=Cat::all();
        $cfs=Coffee::OrderBy('id', 'desc')->paginate('6');
        return view ('welcome')->with(['cfs'=>$cfs])->with(['cats'=>$cats]);
    }
    public function showImage($file_name){
        $file=Storage::disk('local')->get($file_name);
        return new Response($file, 200);
    }
    public function getDashboard(){
        $orders_list=Order::all();
        $cfs=Coffee::all();
        $cfl=Coffee::OrderBy('id','desc')->paginate('10');
        return view ('admin/home')->with(['cfs'=>$cfs])->with(['cfl'=>$cfl])->with(['orders_list'=>$orders_list]);
    }
}
