<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset=“utf-8”>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory System - MIS</title>

    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap-responsive.min.css') }}"/>
    @yield('css-field')
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header"/>
        <a class="navbar-brand">进销存信息系统</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        @yield('navbar')
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@yield('content')
</body>
</html>

<script src="{{ asset('/js/activity-content.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/respond.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
@yield('js-file')