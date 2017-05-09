<nav class="navbar navbar-default navbar-fixed-top" id="navBar">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><i class="fa fa-coffee"></i> IT Coffee</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">


            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::User())
                    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-user"></i> {{Auth::User()->userName}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="btnLogout"><i class="fa fa-sign-out"></i> Logout</a></li>

                        </ul>
                    </li>
                @else


                    <li><a href="{{route('login')}}"><i class="fa fa-sign-in"></i> Login</a></li>
                    <li><a href="{{route('register')}}"><i class="fa fa-user-plus"></i> Register</a></li>


                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>