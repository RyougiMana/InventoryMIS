@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品走势</h4>

                <p>展示商品的分类、名称、进货计划、销售计划、评分.</p>

                <p>可以进入查看进货计划、销售计划、评分的详细情况.</p>
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
                            <th>名称</th>
                            <th>分类</th>
                            <th>类型</th>
                            <th>进货计划</th>
                            <th>销售计划</th>
                            <th>评分</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($misCommodityList as $commodity)
                            <tr>
                                <td>{{ $commodity->name }}</td>
                            </tr>
                            @for($i=0; $i<count($misCommodityList); $i++)
                                <tr>
                                    <td>{{ $commodityList[$i]->id }}</td>
                                    <td>{{ $commodityList[$i]->name }}</td>
                                    <td>{{ $commodityParentList[$i]->name }}</td>
                                    <td>{{ $commodityList[$i]->classification }}</td>
                                    <td>{{ $commodityList[$i]->count }}</td>
                                    <td>{{ $commodityList[$i]->purchase_price }}</td>
                                    <td>{{ $commodityList[$i]->retail_price }}</td>
                                    <td>{{ $commodityList[$i]->recent_purchase_price }}</td>
                                    <td>{{ $commodityList[$i]->recent_retail_price }}</td>
                                    <td>
                                        <a href="/miscommodity/tendency/commodity/y/{{ $commodityList[$i]->id }}">查看</a>
                                    </td>
                                </tr>
                            @endfor
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
    <script src="{{ asset('js/receipt.js') }}"></script>
@stop