@extends('layout.template')

@section('title')
    Login | IT Coffee
@stop

@section('content')


    <div class="container" id="authForm">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div id="authInfo"></div>
                <div id="pageHeader">
                    Sign In
                </div>
                <div class="panel-body">
                    <form role="form" method="get">
                        <div class="form-group">
                            <label for="userName" class="control-label">User Name</label>
                            <input type="text" name="userName" id="userName" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <button type="button" id="btnLogin" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop