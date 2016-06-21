@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>销售计划</h4>

                <p>由月销量、月利润、类别占比等确定的销售计划.</p>

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
                        <div class="row-fluid">
                            <div class="col-md-2">
                                销售计划
                            </div>
                            {{--<div class="col-md-10">--}}
                            {{--<form method="get" action="/mis/saleplan/create" accept-charset="UTF-8"--}}
                            {{--class="form-horizontal">--}}
                            {{--<button type="submit" class="btn btn-default btn-xs">创建进货计划</button>--}}
                            {{--</form>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>商品名称</th>
                            <th>商品分类</th>
                            <th>类型</th>
                            <th>操作</th>
                            <th>创建时间</th>
                        </tr>
                        </thead>
                        @foreach($planList as $plan)
                            <tbody>
                            <tr>
                                <td>{{ $plan->commodity_name }}</td>
                                <td>{{ $plan->commodity_parent }}</td>
                                <td>{{ $plan->commodity_classification }}</td>
                                @if($plan->sale_plan == 0)
                                    <td>设置赠送</td>
                                @elseif($plan->sale_plan == 1)
                                    <td>保持不变</td>
                                @elseif($plan->sale_plan == 2)
                                    <td>设置主推</td>
                                @endif
                                <td>{{ $plan->created_at }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

                <div class="col-md-2"></div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
    </div>

@stop

@section('js-file')
    <script src="{{ asset('js/mis/comparison.js') }}"></script>
@stop