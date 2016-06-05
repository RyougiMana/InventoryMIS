@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/stock.css') }}"/>
@stop

@section('navbar')
    <ul class="nav navbar-nav">
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
        <div id="login-div" class="login-success alert alert-success" role="alert">
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
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol>
                <div class="row-fluid">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="row-fluid">
                            <div class="col-md-8">
                                <input type="text classification-input" class="form-control" placeholder="商品分类名称">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-default">添加</button>
                                <button class="btn btn-default reset">重置</button>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <br/>

                        <div class="row-fluid">
                            <div class="col-md-10">
                                <ul class="list-group">
                                    <li class="list-group-item classification">
                                        <div class="row-fluid">
                                            <div class="col-md-9">水果</div>
                                            <div class="col-md-3">
                                                <a class="modify">添加商品</a>
                                                <a class="modify">修改</a>
                                                <a class="delete">删除</a>
                                            </div>
                                        </div>
                                        <div class="row-fluid modify-panel">
                                            <br/>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="新分类名称">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-default">确认</button>
                                            </div>
                                            <div class="col-md-5">
                                                <button class="btn btn-default cancel-button">取消</button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item commodity">
                                        <div class="row-fluid">
                                            <div class="col-md-10">&nbsp&nbsp&nbsp&nbsp&nbsp苹果</div>
                                            <div class="col-md-2">
                                                <a class="modify">修改</a>
                                                <a class="delete">删除</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item commodity">
                                        <div class="row-fluid">
                                            <div class="col-md-10">&nbsp&nbsp&nbsp&nbsp&nbsp香蕉</div>
                                            <div class="col-md-2">
                                                <a class="modify">修改</a>
                                                <a class="delete">删除</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-1">
            </div>
        </div>
    </div>
@stop

@section('js-file')
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/stock.js') }}"></script>
@stop