@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/purchase-sale.css') }}"/>
@stop

@section('navbar')
    <ul class="nav navbar-nav">
        <li><a href="customer">客户管理</a></li>
        <li><a href="purchase">进货管理</a></li>
        <li><a href="sale">销售管理</a></li>
    </ul>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>进货单管理</h4>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <ul class="nav nav-tabs">
                    <li><a href="#purchase-receipt" tabindex="-1" data-toggle="tab">
                            进货单</a>
                    </li>
                    <li><a href="#purchase-back-receipt" tabindex="-1" data-toggle="tab">
                            进货退货单</a>
                    </li>
                </ul>
                <br/>
                <br/>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="purchase-receipt">
                        {{--Purchase receipt list--}}
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <div class="row-fluid">
                                    <div class="col-md-2">
                                        进货单
                                    </div>
                                    <div class="col-md-10">
                                        <form method="get" action="purchase/create" accept-charset="UTF-8"
                                              class="form-horizontal">
                                            <button type="submit" class="btn btn-default btn-xs">创建进货单</button>
                                        </form>
                                    </div>
                                </div>
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
                                    <th>查看详情</th>
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
                                                <a href="/purchase/{{ $receipt->id }}">查看详情</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        {{--Purchase receipt list--}}
                    </div>

                    <div class="tab-pane fade in" id="purchase-back-receipt">
                        {{--Purchase back receipt list--}}
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <div class="row-fluid">
                                    <div class="col-md-2">
                                        进货退货单
                                    </div>
                                    <div class="col-md-10">
                                        <form method="get" action="purchaseback/create" accept-charset="UTF-8"
                                              class="form-horizontal">
                                            <button type="submit" class="btn btn-default btn-xs">创建进货退货单</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Table -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>单号</th>
                                    <th>进货单单号</th>
                                    <th>商品名称</th>
                                    <th>创建时间</th>
                                </tr>
                                </thead>
                                @if(count($backReceiptList) != 0)
                                    <tbody>
                                    @for($i=0; $i<count($backReceiptList); $i++)
                                        <tr>
                                            <td>{{ $backReceiptList[$i]->id }}</td>
                                            <td>
                                                JHD-{{ $backReceiptPurchaseList[$i]->created_at }}
                                                -{{ $backReceiptPurchaseList[$i]->daily_index }}
                                            </td>
                                            <td>{{ $backReceiptCommodityList[$i]->name }}</td>
                                            <td>{{ $backReceiptList[$i]->created_at }}</td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        {{--Purchase back receipt list--}}
                    </div>
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
    <script src="{{ asset('js/purchase-sale.js') }}"></script>
@stop