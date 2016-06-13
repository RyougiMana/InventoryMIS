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

                <div id="myDiv">test</div>
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <ul class="nav nav-tabs">
                    <li><a href="#year" tabindex="-1" data-toggle="tab">
                            年</a>
                    </li>
                    <li><a href="#season" tabindex="-1" data-toggle="tab">
                            季度</a>
                    </li>
                    <li><a href="#month" tabindex="-1" data-toggle="tab">
                            月</a>
                    </li>
                    <li><a href="#commodity-classification" tabindex="-1" data-toggle="tab">
                            日</a>
                    </li>
                </ul>
                <br/>
                <br/>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="year">
                        <canvas id="canvas" width="400" height="400"></canvas>
                    </div>

                    <div class="tab-pane fade in" id="season">

                    </div>

                    <div class="tab-pane fade in active" id="month">
                        <div class="row-fluid">
                            <div class="col-md-6"></div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>

                    <div class="tab-pane fade in active" id="day">
                        <div class="row-fluid">
                            <div class="col-md-6"></div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
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
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/chart/tendency.js') }}"></script>
@stop