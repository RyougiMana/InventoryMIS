@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/purchase-sale.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>销售单创建</h4>
            </div>
        </div>
    </div>
    <br/>
    <form method="post" action="/sale" accept-charset="UTF-8" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row-fluid">
            <div class="col-md-3"></div>
            <div class="col-md-2">
                <p class="word">销售商姓名(必填)</p>

                <p class="word">仓库编号(必填)</p>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="saler_name"
                       placeholder="销售商姓名(必填)">
                <br/>
                <input type="text" class="form-control" name="stock_id"
                       placeholder="仓库编号(必填)">
                <br/>
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