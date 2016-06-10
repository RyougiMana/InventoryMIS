@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/receipt.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>库存单据创建</h4>
            </div>
        </div>
    </div>
    <br/>
    <div class="row-fluid">

        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="post" action="storeitem" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row-fluid">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="commodity_name"
                               placeholder="商品名称">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="commodity_count"
                               placeholder="数量">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            添加商品
                        </button>
                    </div>
                </div>
            </form>

            <br/>

            <div class="panel panel-default">
                <div class="panel-heading">单据信息</div>
                <table class="table" id="receipt_table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>商品名称</th>
                        <th>数量</th>
                        <th>查看</th>
                        <th>删除</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@if(count($items) != 0)--}}
                    {{--@foreach($items as $item_name=>$item_count)--}}
                    {{--<tr>--}}
                    {{--<th>{{ $item_name }}</th>--}}
                    {{--<th>{{ $item_count }}</th>--}}
                    {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--@endif--}}
                    </tbody>
                </table>
            </div>

            <div class="row-fluid">
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default">赠送单</button>
                        <button type="button" class="btn btn-default">报溢单</button>
                        <button type="button" class="btn btn-default">报损单</button>
                        <button type="button" class="btn btn-default">报警单</button>
                    </div>
                </div>
                <div class="col-md-5">
                    <form method="post" action="/receipt" accept-charset="UTF-8" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" name="type"
                               value="0"/>
                        <button class="btn btn-primary" type="submit" value="present_receipt">创建赠送单</button>
                    </form>
                </div>
            </div>


        </div>
        <div class="col-md-2"></div>
    </div>


@stop

@section('js-file')
    <script src="{{ asset('js/receipt.js') }}"></script>
@stop