@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>客户走势</h4>

                <p>通过客户（销售商）月消费额、平均消费确定是否需要维护（送券、折扣）.</p>

                <p>向客户推荐可能感兴趣的产品.</p>
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
                            <th>平均月消费额</th>
                            <th>上月消费额</th>
                            <th>建议操作</th>
                            <th>查看消费趋势</th>
                            <th>查看可能感兴趣的商品</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customerList as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->avg_sum }}</td>
                                <td>{{ $customer->last_month_sum }}</td>
                                <form method="post" action="/mis/seller/plan/create" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    {{ csrf_field() }}

                                    <input type="hidden" class="form-control" name="seller_id"
                                           value="{{ $customer->id }}"/>

                                    <input type="hidden" class="form-control" name="seller_name"
                                           value="{{ $customer->name }}"/>

                                    @if($customer['recommend_seller_plan'] == 0 && ($customer['seller_plan'] != 0))
                                        <td>
                                            <input type="hidden" class="form-control" name="seller_plan"
                                                   value="0"/>
                                            <button type="submit" class="btn btn-default btn-xs">赠送/折扣</button>
                                        </td>
                                    @elseif($customer['recommend_seller_plan'] == 1 && ($customer['seller_plan'] != 1))
                                        <td>
                                            <input type="hidden" class="form-control" name="seller_plan"
                                                   value="1"/>
                                            <button type="submit" class="btn btn-default btn-xs">保持不变</button>
                                        </td>
                                    @endif
                                </form>
                                <td>ss</td>
                            </tr>
                        </tbody>
                        @endforeach
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