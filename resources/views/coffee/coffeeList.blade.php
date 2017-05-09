@extends('admin.template')

@section('title')
    Coffee | IT Coffee.
@stop
@include('admin.sideBar')


@section('adminContent')

@section('pageTitle')
    <a href="{{route('coffee-list')}}"><i class="fa fa-coffee"></i> Coffee </a>
    <span class="pull-right col-sm-2">
        <div class="btn-group">
            <a href="#" class="btn btn-sm " data-toggle="dropdown" >Action <i class="fa fa-cog"></i></a>
            <ul class="dropdown-menu" id="dropdown-menu">
                <li><a href="{{route('new-coffee')}}"><i class="fa fa-plus-circle"></i> New Coffee</a></li>
                <li><a href="#" data-toggle="modal" data-target="#newCat"><i class="fa fa-plus-circle"></i> New Category</a></li>
            </ul>
        </div>
    </span>
@stop

    <div class="row">
        <div class="col-lg-8">
            @if(!Session::has('newCoffee'))
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-list fa-fw"></i> Coffee List
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a>
                                </li>
                                <li><a href="#">Another action</a>
                                </li>
                                <li><a href="#">Something else here</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="font-size: 12px">
                            <thead>
                            <tr class="alert-success">
                                <td>Images</td>
                                <td>Name</td>
                                <td>Prices</td>
                                <td>Summary</td>
                                <td>Categories</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cfs as $cf)
                                <tr>
                                    <td><img id="adminCoffeeImg" src="{{route('get-coffee-image',['file_name'=>$cf->coffee_photo])}}" width="50px" class="img-rounded"></td>
                                    <td>{{$cf->coffee_name}}</td>
                                    <td>{{$cf->coffee_price}} Ks</td>
                                    <td>{{$cf->coffee_summary}}</td>
                                    <td>{{$cf->cat->category_name}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        {{$cfs->links()}}
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>

                @else
            <div class="panel panel-default">
                    <div class="panel-heading">New Coffee <a href="{{route('close-new-coffee')}}" class="pull-right"><small><span class="glyphicon glyphicon-remove-circle"></span> Close</small></a></div>
                <div class="panel-body">
                    <div class="col-sm-6 col-sm-offset-3">
                    <form role="form" method="post" enctype="multipart/form-data" action="{{route('add-new-coffee')}}">
                        <div class="form-group @if($errors->has('coffee_photo')) has-error @endif">
                            @if($errors->has('coffee_photo')) <span class="help-block">{{$errors->first('coffee_photo')}}</span> @endif
                            <label for="coffee_photo" class="control-label">Coffee Photo</label>
                            <input type="file" class="btn btn-default btn-xs form-control" name="coffee_photo" id="coffee_photo">
                        </div>
                        <div class="form-group @if($errors->has('coffee_name')) has-error @endif">
                            @if($errors->has('coffee_name')) <span class="help-block">{{$errors->first('coffee_name')}}</span> @endif

                            <label for="coffee_name" class="control-label">Coffee Name</label>
                            <input type="text" name="coffee_name" id="coffee_name" class="form-control" value="{{old('coffee_name')}}">
                        </div>
                        <div class="form-group @if($errors->has('coffee_summary')) has-error @endif">
                            @if($errors->has('coffee_summary')) <span class="help-block">{{$errors->first('coffee_summary')}}</span> @endif

                            <label for="coffee_summary" class="control-label">About Coffee</label>
                            <textarea name="coffee_summary" id="coffee_summary" class="form-control">{{old('coffee_summary')}}</textarea>
                        </div>
                        <div class="form-group @if($errors->has('coffee_price')) has-error @endif">
                            @if($errors->has('coffee_price')) <span class="help-block">{{$errors->first('coffee_price')}}</span> @endif

                            <label for="coffee_price" class="control-label">Coffee Prices</label>
                            <input type="number" name="coffee_price" id="coffee_price" class="form-control" {{old('coffee_price')}}>
                        </div>
                        <div class="form-group">
                            <select name="category" id="category" class="form-control">
                                @foreach($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                        {{csrf_field()}}
                    </form>
                    </div>

                </div>
            </div>

            @endif


        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default ">


                <div class="panel-heading clearfix">
                    <i class="fa fa-cogs fa-fw"></i> Categories
                    <form role="form" method="post" action="{{route('delete-category')}}">
                        {{csrf_field()}}
                    <span class="pull-right"><button type="submit" class="btn btn-danger btn-xs">Delete</button></span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @foreach($cats as $cat)
                    <ul class="list-group ">
                        <li class="list-group-item">
                            {{$cat->category_name}}
                            <span class="pull-right">
                            <input type="checkbox" class="checkbox" name="delCat[]" value="{{$cat->category_name}}">
                            </span>

                        </li>

                    </ul>
                        @endforeach

                        </form>
                </div>
                <!-- /.panel-body -->

            </div>


        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

    @stop


<!-- Modal -->
<div class="modal fade" id="newCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Category</h4>
            </div>
                <div id="newCatInfo"></div>
            <div class="modal-body">
                <label for="category_name" class="control-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control">
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveCat">Save </button>
            </div>
            </form>
        </div>
    </div>
</div>