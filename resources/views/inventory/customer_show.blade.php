@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>客户创建</h4>
            </div>
        </div>
    </div>
    <br/>
    <div class="row-fluid">
        <div class="col-md-4"></div>
        <div class="col-md-2">
            <p>姓名</p>

            <p>类型</p>

            <p>等级(0-5)</p>

            <p>电话</p>

            <p>地址</p>

            <p>邮编</p>

            <p>邮箱</p>

            <p>应收额度(默认为2000)</p>

            <p>应收(默认为0)</p>

            <p>应付(默认为0)</p>
        </div>
        <div class="col-md-3">
            <p>{{ $customer->name }}</p>
            @if($customer->is_saler == 1)
                <p>销售商</p>
            @else
                <p>进货商</p>
            @endif
            <p>{{ $customer->level }}</p>

            <p>{{ $customer->telephone }}</p>

            <p>{{ $customer->address }}</p>

            <p>{{ $customer->zipcode }}</p>

            <p>{{ $customer->email }}</p>

            <p>{{ $customer->should_receive_quota }}</p>

            <p>{{ $customer->should_receive }}</p>

            <p>{{ $customer->should_pay }}</p>
        </div>
        <div class="col-md-3"></div>
    </div>


@stop