<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Geosantara</title>

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('css/bootstrap.min.css'); }}
    <!-- BOOTSTRAP DIALOG STYLES-->
    {{ HTML::style('css/bootstrap-dialog.min.css'); }}
    <!-- Custom CSS -->
    {{ HTML::style('css/shop-item.css'); }}
    
    <!-- TABLE STYLES-->
    {{ HTML::style('js/dataTables/dataTables.bootstrap.css'); }}
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

@yield('javascriptGIS')

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/') }}">
                    Geosantara
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ URL::to('/') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('aboutUs') }}">About Us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            @yield('content')
        </div>

    </div>
    <!-- /.container -->

    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Geosantara 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    {{ HTML::script('js/jquery.js'); }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('js/bootstrap.min.js'); }}
    <!-- BOOTSTRAP SCRIPTS -->
    {{ HTML::script('js/bootstrap-dialog.min.js'); }}

    {{ HTML::script('js/dataTables/jquery.dataTables.js'); }}
    {{ HTML::script('js/dataTables/dataTables.bootstrap.js'); }}
    @yield('javascript')
</body>

</html>
