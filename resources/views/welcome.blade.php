@extends('layout.template')

@section('title')
    Welcome to IT Coffee.
    @stop

@section('content')

<div class="container" id="MainContainer">
    @include('partials.coffeeBar')
    <div class="row">

        @foreach($cfs as $cf)
            <div class="col-sm-4">
                <div class="thumbnail clearfix">
                    <img id="coffeeImage" src="{{route('coffeeImage',['file_name'=>$cf->coffee_photo])}}" class="img-rounded" alt="...">
                    <div class="caption">
                        <h3>{{$cf->coffee_name}}</h3>
                        <p>{{$cf->coffee_summary}}</p>
                        <small>{{$cf->cat->category_name}}</small>
                        <p><small class="pull-right">{{$cf->coffee_price}} Ks</small></p>
                        <p><button type="button" id="btnAddToCart" idd="{{$cf->id}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-shopping-cart"></i> Add To Cart</button> </p>
                    </div>
                </div>
            </div>

            @endforeach
        <div id="pagination">{{$cfs->links()}}</div>

    </div>
</div>

    @stop