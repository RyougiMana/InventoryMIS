@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>分类走势</h4>

                <p>分类 {{ $parent->name }} 下不同商品的上个月的销量占比情况</p>

                <input type="hidden" class="form-control" id="id" name="id"
                       value="{{ $parent->id }}"/>
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div>
                    <canvas id="canvas"></canvas>
                </div>
                <br/>
                <br/>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        {{ $parent->name }} 分类下商品
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>商品名称</th>
                            <th>类型</th>
                            <th>销量</th>
                            <th>销售额</th>
                            <th>利润</th>
                            <th>销量占比</th>
                            <th>建议操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($commodities as $commodity)
                            <tr>
                                <td>{{ $commodity->name }}</td>
                                <td>{{ $commodity->classification }}</td>
                                <td>{{ $commodity->sale_count }}</td>
                                <td>{{ $commodity->sale_sum }}</td>
                                <td>{{ $commodity->c_profit }}</td>
                                <td>{{ $commodity->sale_quota }}</td>
                                <td>
                                    <form method="post" action="/mis/saleplan" accept-charset="UTF-8"
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

                                        @if($commodity->recommend_sale_plan == 2 && ($commodity->sale_plan != 2))
                                            <input type="hidden" class="form-control" name="sale_plan"
                                                   value="2"/>
                                            <button type="submit" class="btn btn-default btn-xs">设置主推</button>
                                        @elseif($commodity->recommend_sale_plan == 0 && ($commodity->sale_plan != 0))
                                            <input type="hidden" class="form-control" name="sale_plan"
                                                   value="0"/>
                                            <button type="submit" class="btn btn-default btn-xs">设置赠送</button>
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
    <script src="{{ asset('chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/mis/classification.js') }}"></script>
@stop