@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/purchase-sale.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>步骤1 : 选择需要退货的进货单</h4>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="row-fluid">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    进货单
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
                        <th>退货</th>
                    </tr>
                    </thead>
                    @if(count($receiptList) != 0)
                        <tbody>
                        @foreach($receiptList as $receipt)
                            <tr>
                                <td>
                                    JHD-{{ $receipt->created_at }}-{{ $receipt->daily_index }}
                                </td>
                                <td>
                                    <a href="/customer/{{ $receipt->supplier_id }}">{{ $receipt->customer_name }}</a>
                                </td>
                                <td>{{ $receipt->stock_id }}</td>
                                <td>{{ $receipt->user_id }}</td>
                                <td>{{ $receipt->comment }}</td>
                                <td>{{ $receipt->sum }}</td>
                                <td>
                                    <a href="/purchaseback/listreceipt/{{ $receipt->id }}">退货</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/>
    <br/>
    <br/>


@stop