@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}"/>
@stop

@section('content')
    <div class="row-fluid">
        <h4>创建单据</h4>

        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="post" action="receipt/pending" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
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
                        <button type="submit" class="btn btn-primary" id="receipt_add">
                            添加商品
                        </button>
                    </div>
                </div>
            </form>

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
            <hr/>
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
        <div class="col-md-2"></div>
    </div>


@stop

@section('js-file')
    <script src="{{ asset('js/receipt.js') }}"></script>
@stop