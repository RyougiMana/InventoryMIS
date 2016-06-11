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
    <form method="post" action="/customer" accept-charset="UTF-8" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row-fluid">
            <div class="col-md-3"></div>
            <div class="col-md-2">
                <p class="word">姓名(必填)</p>

                <p class="word">等级(0-5)</p>

                <p class="word">电话</p>

                <p class="word">地址</p>

                <p class="word">邮编</p>

                <p class="word">邮箱</p>

                <p class="word">应收额度(默认为2000)</p>

                <p class="word">应收(默认为0)</p>

                <P class="word">应付(默认为0)</P>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="name"
                       placeholder="姓名">
                <br/>
                <input type="text" class="form-control" name="level" value="0"
                       placeholder="等级(0-5)">
                <br/>
                <input type="text" class="form-control" name="telephone"
                       placeholder="电话">
                <br/>
                <input type="text" class="form-control" name="address"
                       placeholder="地址">
                <br/>
                <input type="text" class="form-control" name="zipcode"
                       placeholder="邮编">
                <br/>
                <input type="text" class="form-control" name="email"
                       placeholder="邮箱">
                <br/>
                <input type="text" class="form-control" name="should_receive_quota" value="2000"
                       placeholder="应收额度(默认为2000)">
                <br/>
                <input type="text" class="form-control" name="should_receive" value="0"
                       placeholder="应收(默认为0)">
                <br/>
                <input type="text" class="form-control" name="should_pay" value="0"
                       placeholder="应付(默认为0)">
                <br/>

                <p><input type="radio" name="is_saler" value="0"/>供货商</p>

                <p><input type="radio" name="is_saler" value="1"/>销售商</p>
                @if ($errors->any())
                    <br/>
                    <ul class="list-group alert-danger">
                        <div class="bs-example bs-example-standalone" data-example-id="dismissible-alert-js">
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        </div>
                    </ul>
                @endif
                <button type="submit" class="btn btn-primary">
                    确定
                </button>
                <br/>
                <br/>
            </div>
            <div class="col-md-4"></div>
        </div>
    </form>


@stop