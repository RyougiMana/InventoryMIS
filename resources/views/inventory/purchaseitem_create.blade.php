@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/purchase-sale.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>进货单项目添加</h4>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="row-fluid">
        <div class="col-md-2"></div>
        <div class="col-md-3">
            <a id="open">展开分类</a>
            <ul class="list-group">
                @foreach($commodityList as $parent_id=>$tmpList)
                    <li class="list-group-item classification">
                        <p>{{ $parentList[$parent_id] }}</p>
                    </li>
                    @foreach($tmpList as $commodity)
                        <li class="list-group-item commodity">
                            <p>&nbsp&nbsp&nbsp&nbsp&nbsp{{ $commodity->name }}</p>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        <div class="col-md-2">
            <p class="word">商品名称</p>

            <p class="word">商品数量</p>

            <p class="word">商品价格</p>
        </div>
        <div class="col-md-3">
            <form method="post" action="/purchaseitem/create/{{$id}}" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input type="text" class="form-control" id="commodity_name" name="commodity_name"
                       placeholder="商品名称">
                <br/>
                <input type="text" class="form-control" name="commodity_count"
                       placeholder="商品数量">
                <br/>
                <input type="text" class="form-control" name="commodity_price"
                       placeholder="商品价格">
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
                <button type="submit" class="btn btn-default btn-block">
                    添加商品
                </button>
            </form>
            <br/>

            <form method="get" action="/purchase" accept-charset="UTF-8" class="form-horizontal">
                <button type="submit" class="btn btn-primary btn-block">
                    完成创建
                </button>
            </form>
            <br/>
            <br/>
        </div>
        <div class="col-md-2"></div>
    </div>


@stop
@section('js-file')
    <script src="{{ asset('js/purchase-sale-item.js') }}"></script>
@stop