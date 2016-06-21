@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>客户评级</h4>

                <p>计算客户的销售额，升星级.</p>

                <p>计算客户的退货件数，降星级.</p>
            </div>
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
                        销售商
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>总销售件数</th>
                            <th>上月销售件数</th>
                            <th>总销售额</th>
                            <th>上月销售额</th>
                            <th>总退货件数</th>
                            <th>上月退货件数</th>
                            <th>评分</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customerList as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->total_count }}</td>
                                <td>{{ $customer->last_month_count }}</td>
                                <td>{{ $customer->total_sum }}</td>
                                <td>{{ $customer->last_month_sum }}</td>
                                <td>{{ $customer->total_back_count }}</td>
                                <td>{{ $customer->last_month_back_count }}</td>
                                <td>{{ $customer->star }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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