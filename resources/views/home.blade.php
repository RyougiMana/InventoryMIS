@extends('admin')
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


@stop
@section('js-file')
@stop