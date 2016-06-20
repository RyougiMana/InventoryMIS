@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>分类走势</h4>

                <p>分类名称、分类利润月走势、分类下不同商品的占比情况</p>

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
                            商品分类
                        </div>
                        <!-- Table -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th>商品分类</th>
                                <th>商品种类数</th>
                                <th>最高销量商品</th>
                                <th>最高销量</th>
                                <th>查看详情</th>
                            </tr>
                            </thead>
                            @for($i=0; $i<count($parentList); $i++)
                                <tbody>
                                <tr>
                                    <td>{{ $parentList[$i]->name }}</td>
                                    <td>{{ $parentList[$i]->commodity_count }}</td>
                                    @if(count($parentList[$i]->max_commodity) != 0)
                                        @for($j=0; $j<count($parentList[$i]->max_commodity); $j++)
                                            <td>{{ $parentList[$i]->max_commodity[$j]['name'] }}</td>
                                        @endfor
                                    @else
                                        <td>暂时没有售出商品</td>
                                    @endif
                                    <td>{{ $parentList[$i]->max_count }}</td>
                                    <td>
                                        <a href="/mis/commodity/classification/{{ $parentList[$i]->id }}">查看详情</a></td>
                                </tr>
                                </tbody>
                            @endfor
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