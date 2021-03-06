@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
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
                <h4>客户管理</h4>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="row-fluid">
                            <div class="col-md-1">
                                客户
                            </div>
                            <div class="col-md-11">
                                <form method="get" action="customer/create" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-default btn-xs">添加新客户</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>类型</th>
                            <th>应收额度</th>
                            <th>应收</th>
                            <th>应付</th>
                            <th>查看详情</th>
                        </tr>
                        </thead>
                        @if(count($customerList) != 0)
                            <tbody>
                            @foreach($customerList as $customer)
                                <tr>
                                    <td>
                                        {{ $customer->name }}
                                    </td>
                                    @if($customer->is_saler == 1)
                                        <td>销售商</td>
                                    @else
                                        <td>供货商</td>
                                    @endif
                                    <td>{{ $customer->should_receive_quota }}</td>
                                    <td>{{ $customer->should_receive }}</td>
                                    <td>{{ $customer->should_pay }}</td>
                                    <td>
                                        <a href="/customer/{{ $customer->id }}">查看详情</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
                {!! $customerList->render() !!}
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