<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Cat;
use App\Coffee;
use App\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class CoffeeController extends Controller
{
    public function postAddNewCoffee(Request $request){
        $this->validate($request, [
           'coffee_photo'=>'required',
            'coffee_name'=>'required',
            'coffee_summary'=>'required',
            'coffee_price'=>'required'
        ]);
        $cf=new Coffee();
        $cf->coffee_name=$request['coffee_name'];
        $cf->coffee_price=$request['coffee_price'];
        $cf->coffee_summary=$request['coffee_summary'];
        $cf->coffee_photo=$request['coffee_name'].'.jpg';
        $cf->cat_id=$request['category'];

        $coffee_file=$request->file('coffee_photo');
        $coffee_file_name=$request['coffee_name'].'.jpg';

        Storage::disk('local')->put($coffee_file_name, File::get($coffee_file));
        $cf->save();
        return redirect()->back();
    }
    public function getCloseNewCoffee(){
        Session::forget('newCoffee');
        return redirect()->back();
    }
    public function getNewCoffee(){
        Session::put('newCoffee', 'newCoffee');
        return redirect()->back();
    }
    public function getCoffeeList(){
        $cfs=Coffee::OrderBy('id', 'desc')->paginate('5');
        $cats=Cat::OrderBy('id','desc')->get();
        return view ('coffee.coffeeList')->with(['cats'=>$cats])->with(['cfs'=>$cfs]);
    }
    public function getCoffeeImage($file_name){
        $file=Storage::disk('local')->get($file_name);
        return new Response($file, 200);
    }
    public function postDeleteCategory(Request $request){
        $cat=$request['delCat'];
        if($cat){
            DB::table('cats')->WhereIn('category_name', $cat)->delete();
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    public function postNewCategory(Request $request){
        if($request['category_name']){
            $cat=new Cat();
            $cat->category_name=$request['category_name'];
            $cat->save();
            echo  "<li class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> The new category have been save.</li>";
        }else{
            echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The category name field is required.</li>";
        }
    }
}
