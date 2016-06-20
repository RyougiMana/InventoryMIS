@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品走势</h4>

                <p>展示商品分类、商品名称、利润空间趋势、口碑.</p>

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
                            <th style="width: 15%">名称</th>
                            <th style="width: 8%">分类</th>
                            <th style="width: 8%">类型</th>
                            <th style="width: 8%">利润空间趋势</th>
                            <th style="width: 8%">进货退货数量</th>
                            <th style="width: 8%">销售退货数量</th>
                            <th style="width: 8%">进货退货比例</th>
                            <th style="width: 8%">销售退货比例</th>
                            <th>口碑</th>
                            <th>评分</th>
                            <th>建议操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($commodityList as $commodity)
                            <tr>
                                <td>{{ $commodity->name }}</td>
                                <td>{{ $commodity->parent_name }}</td>
                                <td>{{ $commodity->classification }}</td>
                                <td>{{ $commodity->profit_tendency }}</td>
                                <td>{{ $commodity->purchase_back_count }}</td>
                                <td>{{ $commodity->sale_back_count }}</td>
                                <td>{{ $commodity->purchase_proportion }}</td>
                                <td>{{ $commodity->sale_proportion }}</td>
                                <td>{{ $commodity->reputation }}</td>
                                <td>{{ $commodity->star }}</td>
                                <td>
                                    <form method="post" action="/mis/purchaseplan" accept-charset="UTF-8"
                                          class="form-horizontal">
                                        {{ csrf_field() }}

                                        <input type="hidden" class="form-control" name="commodity_id"
                                               value="{{ $commodity->id }}"/>

                                        <input type="hidden" class="form-control" name="commodity_name"
                                               value="{{ $commodity->name }}"/>

                                        <input type="hidden" class="form-control" name="commodity_parent"
                                               value="{{ $commodity->parent_name }}"/>

                                        <input type="hidden" class="form-control" name="commodity_classification"
                                               value="{{ $commodity->classification }}"/>

                                        @if(strlen($commodity->star) <= 2 * 3)
                                            <input type="hidden" class="form-control" name="purchase_plan"
                                                   value="0"/>
                                            <button type="submit" class="btn btn-default btn-xs">减少进货</button>
                                        @elseif(strlen($commodity->star) == 5 * 3)
                                            <input type="hidden" class="form-control" name="purchase_plan"
                                                   value="3"/>
                                            <button type="submit" class="btn btn-default btn-xs">增加进货</button>
                                        @endif

                                    </form>
                                </td>
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