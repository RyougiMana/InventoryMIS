@extends('admin')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/inventory.css') }}"/>
@stop

@section('navbar')
    <ul class="nav navbar-nav">
        <li><a href="#">商品管理</a></li>
        <li class="receipt-manage">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">库存管理 <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">库存查看</a></li>
                <li><a href="#">库存盘点</a></li>
            </ul>
        </li>
        <li class="receipt-manage">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">库存单据 <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">赠送单</a></li>
                <li><a href="#">报溢单</a></li>
                <li><a href="#">报溢单</a></li>
                <li><a href="#">报警单</a></li>
            </ul>
        </li>
    </ul>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>商品分类管理</h4>
                <p>已有商品分类 xx 个,上周新增 xx 个.</p>
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
                    @foreach($commodityParents as $commodityParent)
                        <li class="list-group-item classification">
                            <p>{{ $commodityParent->name }}</p>
                        </li>
                        @foreach($commodityList as $commodity)
                            @if($commodity->parent_id === $commodityParent->id)
                                <li class="list-group-item commodity">
                                    <p>&nbsp&nbsp&nbsp&nbsp&nbsp{{ $commodity->name }}</p>
                                </li>
                            @endif
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
                            <div class="col-md-3 direction-word">
                                <p>商品分类名称</p>
                                <br/>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="商品分类名称">
                                    <br>
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
                        </div>
                        {{--End add commodity classification--}}
                    </div>
                    <div class="tab-pane fade" id="add-commodity">
                        {{--Add commodity--}}
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
                                    <input type="text" class="form-control" placeholder="商品分类">
                                    <br>
                                    <input type="text" class="form-control" placeholder="商品名称">
                                    <br>
                                    <input type="text" class="form-control" placeholder="型号">
                                    <br>
                                    <input type="text" class="form-control" placeholder="进价">
                                    <br>
                                    <input type="text" class="form-control" placeholder="零售价">
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
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="商品分类名称">
                                <br>
                                <input type="text" class="form-control" placeholder="商品分类新名称">
                                <br>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <br/>

                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary btn-block btn-danger">删除</button>
                            </div>
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary btn-block">确定</button>
                            </div>
                            <div class="col-md-1"></div>

                            <br/>
                            <br/>
                            <br/>

                        </div>
                        {{--End modify and delete commodity classification--}}
                    </div>
                    <div class="tab-pane fade" id="modify-delete-commodity">
                        {{--Modify and delete commodity--}}
                        <div class="row-fluid">
                            <div class="bs-example bs-example-standalone" data-example-id="dismissible-alert-js">
                                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
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
                                    <input type="text" class="form-control" placeholder="商品原分类">
                                    <br>
                                    <input type="text" class="form-control" placeholder="商品原名称">
                                    <br>
                                    <input type="text" class="form-control" placeholder="商品分类">
                                    <br>
                                    <input type="text" class="form-control" placeholder="商品名称">
                                    <br>
                                    <input type="text" class="form-control" placeholder="型号">
                                    <br>
                                    <input type="text" class="form-control" placeholder="进价">
                                    <br>
                                    <input type="text" class="form-control" placeholder="零售价">
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <br/>

                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary btn-block btn-danger">删除</button>
                            </div>
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary btn-block">确定</button>
                            </div>
                            <div class="col-md-1"></div>

                            <br/>
                            <br/>
                            <br/>

                        </div>
                        {{--End modify and delete commodity--}}
                    </div>
                </div>


            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@stop

@section('js-file')
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/inventory.js') }}"></script>
@stop