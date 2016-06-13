@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品列表</h4>

                <p>展示商品及商品分类的详细信息,选择商品及商品分类查看趋势.</p>
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <ul class="nav nav-tabs">
                    <li><a href="#commodity" tabindex="-1" data-toggle="tab">
                            商品</a>
                    </li>
                    <li><a href="#commodity-classification" tabindex="-1" data-toggle="tab">
                            商品分类</a>
                    </li>
                </ul>
                <br/>
                <br/>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="commodity">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                商品
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
                                    <th>查看趋势</th>
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
                                                <a href="/miscommoditytendency/commodity/{{ $commodityList[$i]->id }}">查看趋势</a>
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="commodity-classification">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                商品分类
                            </div>
                            <!-- Table -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>分类名称</th>
                                    <th>包含商品数</th>
                                </tr>
                                </thead>
                                @if(count($parentList) != 0)
                                    <tbody>
                                    @for($i=0; $i<count($parentList); $i++)
                                        <tr>
                                            <td>{{ $parentList[$i]->id }}</td>
                                            <td>{{ $parentList[$i]->name }}</td>
                                            <td>{{ $parentList[$i]->child_count }}</td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                @endif
                            </table>
                        </div>
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
    <script src="{{ asset('js/commodity.js') }}"></script>
@stop