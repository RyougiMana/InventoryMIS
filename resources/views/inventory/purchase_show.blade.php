@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/purchase-sale.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>进货单详细信息</h4>
            </div>
        </div>
    </div>
    <br/>
    <div class="row-fluid">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    进货单信息
                </div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <tr>
                        <th>单号</th>
                        <th>供应商姓名</th>
                        <th>仓库编号</th>
                        <th>操作员姓名</th>
                        <th>备注</th>
                        <th>总金额</th>
                    </tr>
                    </thead>
                    <tr>
                        <td>
                            JHD-{{ $receipt->created_at }}-{{ $receipt->daily_index }}
                        </td>
                        <td>
                            <a href="/customer/{{ $receipt->supplier_id }}">{{ $customer->name }}</a>
                        </td>
                        <td>{{ $receipt->stock_id }}</td>
                        <td>{{ $receipt->user_id }}</td>
                        <td>{{ $receipt->comment }}</td>
                        <td>{{ $receipt->sum }}</td>
                    </tr>
                </table>
            </div>

            <br/>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    单据项目
                </div>
                <!-- Table -->
                <table class="table">
                    <thead>
                    <tr>
                        <th>商品分类</th>
                        <th>商品名称</th>
                        <th>商品价格</th>
                        <th>商品数量</th>
                        <th>商品总价</th>
                        <th>是否退货</th>
                        <th>添加时间</th>
                        <th>更新时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=0; $i<count($items); $i++)
                        <tr>
                            <td>{{ $parentList[$i]->name }}</td>
                            <td>{{ $commodityList[$i]->name }}</td>
                            <td>{{ $items[$i]->commodity_price }}</td>
                            <td>{{ $items[$i]->commodity_count }}</td>
                            <td>{{ $items[$i]->commodity_sum }}</td>
                            @if($items[$i]->is_back == 0)
                                <td>否</td>
                            @else
                                <td>是</td>
                            @endif
                            <td>{{ $items[$i]->created_at }}</td>
                            <td>{{ $items[$i]->updated_at }}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>


@stop