@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}"/>
@stop

@section('navbar')
    <ul class="nav navbar-nav">
        <li><a href="commodity">商品管理</a></li>
        <li><a href="receipt">库存单据</a></li>
        <li class="receipt-manage">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">库存管理 <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">库存查看</a></li>
                <li><a href="#">库存盘点</a></li>
            </ul>
        </li>
    </ul>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>库存单据管理</h4>

            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">

        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <ul class="nav nav-tabs">
                    <li><a href="#add-commodity-classification" tabindex="-1" data-toggle="tab">
                            赠送单</a>
                    </li>
                    <li><a href="#add-commodity" tabindex="-1" data-toggle="tab">
                            报溢单</a>
                    </li>
                    <li><a href="#modify-delete-commodity-classification" tabindex="-1" data-toggle="tab">
                            报损单</a>
                    </li>
                    <li><a href="#modify-delete-commodity" tabindex="-1" data-toggle="tab">
                            报警单</a>
                    </li>
                </ul>
                <br/>
                <br/>

                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        按创建时间排序 <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">只显示审批通过</a></li>
                        <li><a href="#">只显示审批未通过</a></li>
                    </ul>
                </div>

                <button class="btn btn-primary" data-toggle="modal"
                        data-target="#myModal">
                    创建单据
                </button>

                <br/>
                <br/>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="present">

                        {{--Present receipt--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">赠送单</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>创建时间</th>
                                    <th>摘要</th>
                                    <th>通过审批</th>
                                    <th>..</th>
                                    <th>..</th>
                                    <th>..</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($presentReceiptList as $presentReceipt)
                                    <tr>
                                        <th scope="row">{{ $presentReceipt->id }}</th>
                                        <td>{{ $presentReceipt->created_at }}</td>
                                        <td>{{ $presentReceipt->is_approved }}</td>
                                        <td>修改</td>
                                        <td>删除</td>
                                        <td>查看详情</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--End present receipt--}}
                    </div>
                    <div class="tab-pane fade" id="overflow">
                        {{--Overflow receipt--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">报溢单</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>创建时间</th>
                                    <th>摘要</th>
                                    <th>通过审批</th>
                                    <th>..</th>
                                    <th>..</th>
                                    <th>..</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($overflowReceiptList as $overflowReceipt)
                                    <tr>
                                        <th scope="row">{{ $overflowReceipt->id }}</th>
                                        <td>{{ $overflowReceipt->created_at }}</td>
                                        <td>{{ $overflowReceipt->is_approved }}</td>
                                        <td>修改</td>
                                        <td>删除</td>
                                        <td>查看详情</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--End overflow receipt--}}
                    </div>
                    <div class="tab-pane fade" id="loss">
                        {{--Loss receipt--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">报损单</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>创建时间</th>
                                    <th>摘要</th>
                                    <th>通过审批</th>
                                    <th>..</th>
                                    <th>..</th>
                                    <th>..</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lossReceiptList as $lossReceipt)
                                    <tr>
                                        <th scope="row">{{ $lossReceipt->id }}</th>
                                        <td>{{ $lossReceipt->created_at }}</td>
                                        <td>{{ $lossReceipt->is_approved }}</td>
                                        <td>修改</td>
                                        <td>删除</td>
                                        <td>查看详情</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--End loss receipt--}}
                    </div>
                    <div class="tab-pane fade" id="alert">
                        {{--Alert receipt--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">报警单</div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>创建时间</th>
                                    <th>摘要</th>
                                    <th>通过审批</th>
                                    <th>..</th>
                                    <th>..</th>
                                    <th>..</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($alertReceiptList as $alertReceipt)
                                    <tr>
                                        <th scope="row">{{ $alertReceipt->id }}</th>
                                        <td>{{ $alertReceipt->created_at }}</td>
                                        <td>{{ $alertReceipt->is_approved }}</td>
                                        <td>修改</td>
                                        <td>删除</td>
                                        <td>查看详情</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--End alert receipt--}}
                    </div>

                </div>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        创建单据
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="commodity_name" id="commodity_name"
                                   placeholder="商品名称">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="commodity_count" id="commodity_count"
                                   placeholder="数量">
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" onclick="loadXMLDoc()" id="receipt_add">
                                添加商品
                            </button>
                        </div>
                    </div>
                    <br/>

                    <div class="panel panel-default">
                        <div class="panel-heading">单据信息</div>
                        <table class="table" id="receipt_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>商品名称</th>
                                <th>数量</th>
                                <th>删除</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>???</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">关闭
                    </button>
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            创建
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">创建赠送单</a></li>
                            <li><a href="#">创建报溢单</a></li>
                            <li><a href="#">创建报损单</a></li>
                            <li><a href="#">创建报警单</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal -->
    </div>
@stop

@section('js-file')
    <script src="{{ asset('js/receipt.js') }}"></script>
@stop