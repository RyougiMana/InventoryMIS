@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品走势</h4>

                <p>展示商品分类、商品名称、利润趋势、口碑.</p>

                <p>利润趋势：按利润转换：评判是朝阳还是夕阳产业.</p>

                <p>口碑：按退货：查看退货数量、退货与销售比例，停止对某些商品的进货.</p>
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        商品
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 20%">名称</th>
                            <th>分类</th>
                            <th>利润趋势</th>
                            <th>进货退货数量</th>
                            <th>销售退货数量</th>
                            <th>进货退货比例</th>
                            <th>销售退货比例</th>
                            <th>口碑</th>
                            <th>评分</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($commodityList as $commodity)
                            <tr>
                                <td>{{ $commodity->name }}</td>
                                <td>{{ $commodity->parent_name }}</td>
                                <td>{{ $commodity->classification }}</td>
                                <td>{{ $commodity->purchase_back_count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>

@stop

@section('js-file')
    <script src="{{ asset('js/commodity.js') }}"></script>
@stop