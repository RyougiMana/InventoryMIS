@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品趋势分析</h4>

                <p>展示商品 {{ $commodity->name }} 在一段时间内的进货及销售情况</p>

                <input type="hidden" class="form-control" id="id" name="id"
                       value="{{ $id }}"/>

                {{--<div id="myDiv"></div>--}}
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-1"></div>
            <div class="col-md-1">

                <div class="btn-group" role="group">

                    <form method="get" action="/miscommodity/tendency/commodity/y/{{ $id }}" accept-charset="UTF-8"
                          class="form-horizontal">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">年</button>
                    </form>

                    <form method="get" action="/miscommodity/tendency/commodity/m/{{ $id }}" accept-charset="UTF-8"
                          class="form-horizontal">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">月</button>
                    </form>

                    <form method="get" action="/miscommodity/tendency/commodity/d/{{ $id }}" accept-charset="UTF-8"
                          class="form-horizontal">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">日</button>
                    </form>

                </div>

            </div>
            <div class="col-md-8">


                <canvas id="canvasYear" width="400" height="200"></canvas>

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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/chart/tendency_commodity_year.js') }}"></script>
@stop