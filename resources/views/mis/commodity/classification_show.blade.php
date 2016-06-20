@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>分类走势</h4>

                <p>分类 {{ $parent->name }} 下不同商品的上个月的销量占比情况</p>

                <input type="hidden" class="form-control" id="id" name="id"
                       value="{{ $parent->id }}"/>
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
    <script src="{{ asset('js/mis/classification.js') }}"></script>
@stop