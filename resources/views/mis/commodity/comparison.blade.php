@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品比较</h4>

                <p>可以选择查看某个商品或某几个商品的折线图对比</p>

            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <form method="post" action="/mis/commodity/comparison/make" accept-charset="UTF-8"
                      class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <div class="row-fluid">
                                <div class="col-md-1">
                                    商品
                                </div>
                                <div class="col-md-11">
                                    <button type="submit" class="btn btn-default btn-xs">
                                        查看趋势对比
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Table -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th>编号</th>
                                <th>商品名称</th>
                                <th>商品分类</th>
                                <th>类型</th>
                                <th>总销量</th>
                                <th>总销售额</th>
                                <th>总利润</th>
                                <th>利润转换</th>
                                <th>加入对比</th>
                            </tr>
                            </thead>
                            @foreach($commodityList as $commodity)
                                <tbody>
                                    <tr>
                                        <td>{{ $commodity->id }}</td>
                                        <td>{{ $commodity->name }}</td>
                                        <td>{{ $commodity->parent_name }}</td>
                                        <td>{{ $commodity->classification }}</td>
                                        <td>{{ $commodity->sale_count }}</td>
                                        <td>{{ $commodity->sale_sum }}</td>
                                        <td>{{ $commodity->profit }}</td>
                                        <td>{{ $commodity->profit_quota }}</td>
                                        <td>
                                            <input type="checkbox" id="check_commodity{{ $commodity->id }}"
                                                   name="check_commodity[]" value={{ $commodity->id }}>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </form>
            <div class="col-md-2"></div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>

@stop

@section('js-file')
    <script src="{{ asset('js/mis/comparison.js') }}"></script>
@stop