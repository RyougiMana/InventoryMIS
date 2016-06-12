@extends('admin')

@section('navbar')
    <ul class="nav navbar-nav">
        <li><a href="commodity">商品管理</a></li>
        <li><a href="receipt">库存单据</a></li>
        <li><a href="stock">仓库管理</a></li>
    </ul>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>仓库查看</h4>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        仓库
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>仓库编号</th>
                            <th>查看详情</th>
                        </tr>
                        </thead>
                        @if(count($stockList) != 0)
                            <tbody>
                            @foreach($stockList as $stock)
                                <tr>
                                    <td>
                                        {{ $stock->id }}
                                    </td>
                                    <td>
                                        <a href="/stock/{{ $stock->id }}">查看详情</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
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