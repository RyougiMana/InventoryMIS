@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品比较</h4>

                <p>商品可以显示折线图的属性：销售件数、总营业额、总利润额、利润占比.</p>

                <input type="hidden" class="form-control" id="id"
                       value="{{ $idStr }}"/>
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div>
                    <canvas id="canvas"></canvas>
                </div>
                <br/>
                <br/>

                <div>
                    <canvas id="profitCanvas"></canvas>
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
    <script src="{{ asset('chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/mis/comparison_make.js') }}"></script>
@stop