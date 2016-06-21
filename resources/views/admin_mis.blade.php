<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset=“utf-8”>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory System - MIS</title>

    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap-responsive.min.css') }}"/>
    @yield('css-file')
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header"/>
        <a class="navbar-brand">进销存管理信息系统</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">商品计划 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/mis/commodity/tendency">商品走势</a></li>
                    <li><a href="/mis/commodity/comparison">商品比较</a></li>
                    <li><a href="/mis/commodity/ranking">商品评分</a></li>
                    <li><a href="/mis/commodity/classification">分类走势</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">进销计划 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/mis/purchaseplan">进货计划</a></li>
                    <li><a href="/mis/saleplan">销售计划</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">商家计划 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/mis/seller/tendency">商家走势</a></li>
                    <li><a href="/mis/seller/ranking">商家评级</a></li>
                    <li><a href="/mis/seller/plan">商家计划</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">经营情况 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/mis/management/plan">经营计划</a></li>
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