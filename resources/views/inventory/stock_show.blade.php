@extends('admin')

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>仓库查看</h4>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        仓库编号 : {{ $stock->id }}
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>商品分类</th>
                            <th>商品名称</th>
                            <th>商品数量</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                        </tr>
                        </thead>
                        @if(count($stockItemList) != 0)
                            <tbody>
                            @for($i=0; $i<count($stockItemList); $i++)
                                <tr>
                                    <td>{{ $parentList[$i]->name }}</td>
                                    <td>{{ $commodityList[$i]->name }}</td>
                                    <td>{{ $stockItemList[$i]->commodity_count }}</td>
                                    <td>{{ $stockItemList[$i]->created_at }}</td>
                                    <td>{{ $stockItemList[$i]->updated_at }}</td>
                                </tr>
                            @endfor
                            </tbody>
                        @endif
                    </table>
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