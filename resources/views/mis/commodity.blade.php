@extends('admin-mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}"/>
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
                    <li><a href="#present" tabindex="-1" data-toggle="tab">
                            赠送单</a>
                    </li>
                    <li><a href="#overflow" tabindex="-1" data-toggle="tab">
                            报溢单</a>
                    </li>
                    <li><a href="#loss" tabindex="-1" data-toggle="tab">
                            报损单</a>
                    </li>
                    <li><a href="#alert" tabindex="-1" data-toggle="tab">
                            报警单</a>
                    </li>
                </ul>
                <br/>

                <div class="row-fluid">
                    <div class="col-md-3">
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
                    </div>
                    <div class="col-md-9">
                        {{--<form method="get" action="receipt/create" accept-charset="UTF-8" class="form-horizontal">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<div class="btn-group" role="group" aria-label="...">--}}
                        {{--<button type="button" class="btn btn-default">创建赠送单</button>--}}
                        {{--<button type="button" class="btn btn-default">创建报溢单</button>--}}
                        {{--<button type="button" class="btn btn-default">创建报损单</button>--}}
                        {{--<button type="button" class="btn btn-default">创建报警单</button>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        <div class="row-fluid">
                            <div class="col-md-2">
                                <form method="get" action="/receipt/createpresent" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">创建赠送单</button>
                                </form>
                            </div>
                            <div class="col-md-2">
                                <form method="get" action="receipt/createoverflow" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">创建报溢单</button>
                                </form>
                            </div>
                            <div class="col-md-2">
                                <form method="get" action="receipt/createloss" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">创建报损单</button>
                                </form>
                            </div>
                            <div class="col-md-2">
                                <form method="get" action="receipt/createalert" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default">创建报警单</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($presentReceiptList as $presentReceipt)
                                    <tr>
                                        <th scope="row">{{ $presentReceipt->id }}</th>
                                        <td>{{ $presentReceipt->created_at }}</td>
                                        <td>{{ $presentReceipt->is_approved }}</td>
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

@stop

@section('js-file')
    <script src="{{ asset('js/receipt.js') }}"></script>
@stop