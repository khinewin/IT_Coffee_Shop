<span class="glyphicon glyphicon-shopping-cart"></span> @if(Session::has('cart'))({{Session::get('cart')->totalQty}}) @else No @endif items in your cart