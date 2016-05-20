@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('/css/stock.css') }}"/>
@stop

@section('navbar')
    <ul class="nav navbar-nav">
        <li><a href="#">商品分类管理</a></li>
        <li><a href="#">商品管理</a></li>
        <li class="receipt-manage">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">库存管理 <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">库存查看</a></li>
                <li><a href="#">库存盘点</a></li>
            </ul>
        </li>
        <li class="receipt-manage">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">库存单据 <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">赠送单</a></li>
                <li><a href="#">报溢单</a></li>
                <li><a href="#">报溢单</a></li>
                <li><a href="#">报警单</a></li>
            </ul>
        </li>
    </ul>
@stop

@section('content')
    <div class="container-fluid">
        <div id="divL" class="login-success alert alert-success" role="alert">
            <p>库存管理员 xxx : 欢迎来到进销存信息系统!</p>
        </div>
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品分类管理</h4>

                <p>已有商品分类 xx 个,上周新增 xx 个.</p>
            </div>
            <div class="col-md-4">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="查找商品分类">
                    </div>
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">

            </div>
        </div>
        <div class="row-fluid">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol>
                <div class="span2">
                    <ul class="nav nav-pills nav-stacked">
                        <li href="#">test1</li>
                        <li href="#">test2</li>
                        <li href="#top">back</li>
                    </ul>
                </div>

            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row-fluid">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item classification">
                        <div class="row-fluid">
                            <div class="col-md-10">水果</div>
                            <div class="col-md-1">
                                <a class="modify">修改</a>
                            </div>
                            <div class="col-md-1">
                                <a class="delete">删除</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item commodity">苹果</li>
                    <li class="list-group-item commodity">香蕉</li>
                    <li class="list-group-item commodity">生梨</li>
                    <li class="list-group-item commodity">桃子</li>
                </ul>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
@stop

@section('js-file')
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/stock.js') }}"></script>
    <style>
        .blue {
            background: #bcd4ec;
        }

        .gray {
            background: #e0e0e0;
        }
    </style>
@stop