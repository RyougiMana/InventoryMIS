<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset=“utf-8”>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                    <li><a href="/miscommoditydisplay">商品列表</a></li>
                    <li><a href="/miscommoditytendency">商品走势</a></li>
                    <li><a href="#">分类走势</a></li>
                    <li><a href="#">品牌走势</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">库存计划 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">库存情况</a></li>
                    <li><a href="#">商品进出</a></li>
                    <li><a href="#">采购计划</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">进销计划 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">进销趋势</a></li>
                    <li><a href="#">商家偏好</a></li>
                    <li><a href="#">商品评分</a></li>
                    <li><a href="#">进销计划</a></li>
                    <li><a href="#">折扣影响</a></li>
                    <li><a href="#">趋势预测</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">商家计划 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">商家排名</a></li>
                    <li><a href="#">商家评分</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">操作员计划 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">业绩情况</a></li>
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