@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>库存单据管理</h4>

                <p>展示商品及商品分类的详细信息</p>
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <ul class="nav nav-tabs">
                    <li><a href="#commodity" tabindex="-1" data-toggle="tab">
                            商品</a>
                    </li>
                    <li><a href="#commodity-classification" tabindex="-1" data-toggle="tab">
                            商品分类</a>
                    </li>
                </ul>
                <br/>
                <br/>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="commodity">
                        <div class="row-fluid">
                            <div class="col-md-6"></div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="commodity-classification">

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
@stop