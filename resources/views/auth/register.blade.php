@extends('layout.template')

@section('title')
    Signup | IT Coffee
    @stop

@section('content')

    <div class="container" id="authForm">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div id="authInfo"></div>
                <div id="pageHeader">
                    Sign Up
                </div>
                <div class="panel-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="userName" class="control-label">User Name</label>
                            <input type="text" name="userName" id="userName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password_confirm" class="control-label">Password Confirm</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                        </div>
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <button type="button" id="btnReg" class="btn btn-primary btn-block">Signup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @stop