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
                                <th>数量</th>
                                <th>进价</th>
                                <th>售价</th>
                                <th>最近进价</th>
                                <th>最近售价</th>
                                <th>加入对比</th>
                            </tr>
                            </thead>
                            @if(count($commodityList) != 0)
                                <tbody>
                                @for($i=0; $i<count($commodityList); $i++)
                                    <tr>
                                        <td>{{ $commodityList[$i]->id }}</td>
                                        <td>{{ $commodityList[$i]->name }}</td>
                                        <td>{{ $commodityParentList[$i]->name }}</td>
                                        <td>{{ $commodityList[$i]->classification }}</td>
                                        <td>{{ $commodityList[$i]->count }}</td>
                                        <td>{{ $commodityList[$i]->purchase_price }}</td>
                                        <td>{{ $commodityList[$i]->retail_price }}</td>
                                        <td>{{ $commodityList[$i]->recent_purchase_price }}</td>
                                        <td>{{ $commodityList[$i]->recent_retail_price }}</td>
                                        <td>
                                            <input type="checkbox" id="check_commodity{{ $commodityList[$i]->id }}"
                                                   name="check_commodity[]" value={{ $commodityList[$i]->id }}>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            @endif
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