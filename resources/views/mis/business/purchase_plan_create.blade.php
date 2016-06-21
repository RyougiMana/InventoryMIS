@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/purchase-sale.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>进货计划创建</h4>
            </div>
        </div>
    </div>
    <br/>
    <form method="post" action="/mis/purchaseplan/create" accept-charset="UTF-8" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row-fluid">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group" id="commodity_parent">
                    <label for="commodity_parent">商品分类</label>
                    <select class="form-control" id="commodity_parent" name="commodity_parent">
                        @for($i=0; $i<count($parentList); $i++)
                            <option>{{ $parentList[$i]->name }}</option>
                        @endfor
                    </select>

                    <label for="commodity_name">商品名称</label>
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>

                    <label for="purchase_plan">进货计划</label>
                    <select class="form-control">
                        <option>减少进货</option>
                        <option>保持不变</option>
                        <option>增加进货</option>
                    </select>
                </div>

                <br/>
                <button type="submit" class="btn btn-primary btn-block">
                    确定
                </button>
                <br/>
                <br/>
            </div>
            <div class="col-md-4"></div>
        </div>
    </form>

@stop

@section('js-file')
    <script src="{{ asset('js/mis/plan.js') }}"></script>
@stop