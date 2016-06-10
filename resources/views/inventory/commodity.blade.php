@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('navbar')
    <ul class="nav navbar-nav">
        <li><a href="commodity">商品管理</a></li>
        <li><a href="receipt">库存单据</a></li>
        <li class="receipt-manage">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">库存管理 <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">库存查看</a></li>
                <li><a href="#">库存盘点</a></li>
            </ul>
        </li>
    </ul>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品分类管理</h4>

                <p>已有商品分类 {{ count($parentList) }} 个,上周新增 {{ count($commodityLastWeek) }} 个.</p>
            </div>
            <div class="col-md-4">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="查找商品分类">
                    </div>
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
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

            <div class="col-md-5">
                <ul class="nav nav-tabs">
                    <li><a href="#add-commodity-classification" tabindex="-1" data-toggle="tab">
                            添加商品分类</a>
                    </li>
                    <li><a href="#add-commodity" tabindex="-1" data-toggle="tab">
                            添加商品</a>
                    </li>
                    <li><a href="#modify-delete-commodity-classification" tabindex="-1" data-toggle="tab">
                            删改商品分类</a>
                    </li>
                    <li><a href="#modify-delete-commodity" tabindex="-1" data-toggle="tab">
                            删改商品</a>
                    </li>
                </ul>
                <br/>
                <br/>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="add-commodity-classification">
                        {{--Add commodity classification--}}
                        <div class="row-fluid">
                            <form method="post" action="commodity" accept-charset="UTF-8" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="col-md-3 direction-word">
                                    <p>商品分类名称</p>
                                    <br/>
                                </div>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control" name="action"
                                           value="add-commodity-classification"/>
                                    <input type="text" class="form-control" name="name" placeholder="商品分类名称">
                                    <br>
                                </div>
                                <div class="row-fluid">
                                    <br/>

                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-block">确定</button>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <br/>
                                    <br/>
                                    <br/>

                                </div>
                            </form>
                        </div>

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

                        {{--End add commodity classification--}}
                    </div>
                    <div class="tab-pane fade" id="add-commodity">
                        {{--Add commodity--}}
                        <form method="post" action="commodity" accept-charset="UTF-8" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row-fluid">
                                <div class="col-md-3 direction-word">
                                    <p>商品分类</p>
                                    <br/>

                                    <p>商品名称</p>
                                    <br/>

                                    <p>型号</p>
                                    <br/>

                                    <p>进价</p>
                                    <br/>

                                    <p>零售价</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="action" value="add-commodity"/>
                                        <input type="text" class="form-control" name="parent_name" , placeholder="商品分类">
                                        <br>
                                        <input type="text" class="form-control" name="name" placeholder="商品名称">
                                        <br>
                                        <input type="text" class="form-control" name="classification" placeholder="型号">
                                        <br>
                                        <input type="text" class="form-control" name="purchase_price" placeholder="进价">
                                        <br>
                                        <input type="text" class="form-control" name="retail_price" placeholder="零售价">
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <br/>

                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">确定</button>
                                </div>
                                <div class="col-md-2"></div>

                                <br/>
                                <br/>
                                <br/>

                            </div>
                        </form>

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

                        {{--End add commodity--}}
                    </div>
                    <div class="tab-pane fade" id="modify-delete-commodity-classification">
                        {{--Modify and delete commodity classification--}}
                        <div class="row-fluid">
                            <div class="bs-example bs-example-standalone" data-example-id="dismissible-alert-js">
                                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <strong>直接输入需要删改的商品分类名称</strong>或者<strong>在左侧选择商品分类</strong>.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 direction-word">
                            <p>分类原名称</p>
                            <br/>
                            <p>商品分类名称</p>
                            <br/>
                        </div>
                        <form method="post" action="commodity" accept-charset="UTF-8" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="action"
                                           value="modify-commodity-classification"/>
                                    <input type="text" class="form-control" id="classification-name" name="parent_name"
                                           placeholder="商品分类名称">
                                    <br>
                                    <input type="text" class="form-control" name="new_name" placeholder="商品分类新名称">
                                    <br>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <br/>

                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <button type="submit" name="action" value="delete-commodity-classification"
                                            class="btn btn-primary btn-block btn-danger">删除
                                    </button>
                                </div>
                                <div class="col-md-5">
                                    <button type="submit" name="action" value="modify-commodity-classification"
                                            class="btn btn-primary btn-block">确定
                                    </button>
                                </div>
                                <div class="col-md-1"></div>

                                <br/>
                                <br/>
                                <br/>

                            </div>

                            @if ($errors->any())
                                <br/>
                                <ul class="list-group alert-danger">
                                    <div class="bs-example bs-example-standalone"
                                         data-example-id="dismissible-alert-js">
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
                        </form>

                        {{--End modify and delete commodity classification--}}
                    </div>
                    <div class="tab-pane fade" id="modify-delete-commodity">
                        {{--Modify and delete commodity--}}
                        <form method="post" action="commodity" accept-charset="UTF-8" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row-fluid">
                                <div class="bs-example bs-example-standalone" data-example-id="dismissible-alert-js">
                                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <strong>直接输入需要删改的商品名称</strong>或者<strong>在左侧选择商品</strong>.
                                    </div>
                                </div>
                                <div class="col-md-3 direction-word">
                                    <p>商品原分类</p>
                                    <br/>

                                    <p>商品原名称</p>
                                    <br/>

                                    <p>商品分类</p>
                                    <br/>

                                    <p>商品名称</p>
                                    <br/>

                                    <p>型号</p>
                                    <br/>

                                    <p>进价</p>
                                    <br/>

                                    <p>零售价</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="action"
                                               value="modify-commodity"/>
                                        <input type="text" class="form-control" name="parent_name"
                                               id="commoditys-classification-name" placeholder="商品原分类">
                                        <br>
                                        <input type="text" class="form-control" name="name" id="commoditys-name"
                                               placeholder="商品原名称">
                                        <br>
                                        <input type="text" class="form-control" name="new_parent_name"
                                               id="new-commoditys-classification-name" placeholder="商品分类">
                                        <br>
                                        <input type="text" class="form-control" name="new_name"
                                               id="new-commoditys-name" placeholder="商品名称">
                                        <br>
                                        <input type="text" class="form-control" name="classification" placeholder="型号">
                                        <br>
                                        <input type="text" class="form-control" name="purchase_price" placeholder="进价">
                                        <br>
                                        <input type="text" class="form-control" name="retail_price" placeholder="零售价">
                                    </div>
                                </div>
                                </div>
                            <div class="row-fluid">
                                <br/>

                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <button type="submit" name="action" value="delete-commodity"
                                            class="btn btn-primary btn-block btn-danger">删除
                                    </button>
                                </div>
                                <div class="col-md-5">
                                    <button type="submit" name="action" value="modify-commodity"
                                            class="btn btn-primary btn-block">确定
                                    </button>
                                </div>
                                <div class="col-md-1"></div>

                                <br/>
                                <br/>
                                <br/>

                            </div>
                        </form>
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
                        {{--End modify and delete commodity--}}
                    </div>

                </div>


            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@stop

@section('js-file')
    <script src="{{ asset('js/commodity.js') }}"></script>
@stop