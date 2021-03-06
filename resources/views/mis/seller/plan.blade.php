@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>客户计划</h4>

                <p>显示所有客户计划.</p>

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
                        <div class="row-fluid">
                            <div class="col-md-2">
                                客户计划
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>操作</th>
                            <th>创建时间</th>
                        </tr>
                        </thead>
                        @foreach($planList as $plan)
                            <tbody>
                            <tr>
                                <td>{{ $plan->seller_name }}</td>
                                @if($plan->seller_plan == 0)
                                    <td>赠送/折扣</td>
                                @elseif($plan->seller_plan == 1)
                                    <td>保持不变</td>
                                @endif
                                <td>{{ $plan->created_at }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

                <div class="col-md-2"></div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
    </div>

@stop

@section('js-file')
    <script src="{{ asset('js/mis/comparison.js') }}"></script>
@stop