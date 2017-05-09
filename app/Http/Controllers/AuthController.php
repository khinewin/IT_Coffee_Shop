<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function getRegister(){
     return view ('auth.register');
    }
    public function getLogin(){
        return view ('auth.login');
    }
    public function getLogout(){
        Auth::logout();
        echo "logoutSuccess";
    }
    public function postLogin(Request $request){
        if($request['userName']){
            $user=User::Where('userName', $request['userName'])->first();
            if($user){
                if($request['password']){
                    if(Auth::attempt(['userName'=>$request['userName'], 'password'=>$request['password']])){
                            echo "<li class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> Authorized Successed.</li>";
                    }else{
                        echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The selected password is invalid.</li>";


                    }
                }else{
                    echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The password field is required.</li>";

                }
            }else{
                echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The selected username was not found.</li>";

            }


        }else{
            echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The username field is required.</li>";
        }
    }

    public function postRegister(Request $request){
       if($request['userName']){
           $user=User::Where('userName', $request['userName'])->first();
           if(!$user){
                if($request['email']){

                    $mail=User::Where('email', $request['email'])->first();
                    if(!$mail){
                        if($request['password']){
                            if($request['password_confirm']){
                                if($request['password']==$request['password_confirm']){
                                    $regUser=new User();
                                    $regUser->userName=$request['userName'];
                                    $regUser->email=$request['email'];
                                    $regUser->password=bcrypt($request['password']);
                                    $regUser->save();
                                    echo "<li class='alert alert-success'><span class='glyphicon glyphicon-ok-circle'></span> The user account have been created.</li>";


                                }else{
                                    echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The password and password confirmation must match.</li>";

                                }
                            }else{
                                echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The password confirmation field is required.</li>";

                            }

                        }else{
                            echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The password field is required.</li>";

                        }
                    }else{
                        echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The selected email is already exists.</li>";
                    }
                }else{
                    echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The email field is required.</li>";

                }
           }else{
               echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The selected username is already exists.</li>";

           }

       }else{
           echo "<li class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> The username field is required.</li>";
       }
    }
}
