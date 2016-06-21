@extends('admin_mis')

@section('css-file')
    <link rel="stylesheet" href="{{ asset('css/commodity.css') }}"/>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8">
                <h4>经营计划</h4>

                <p>显示所有经营情况,并创建计划.</p>

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

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="row-fluid">
                            <div class="col-md-2">
                                经营计划
                            </div>
                            <div class="col-md-10">
                                <form method="get" action="/mis/management/plan/create" accept-charset="UTF-8"
                                      class="form-horizontal">
                                    <button type="submit" class="btn btn-default btn-xs">创建经营计划</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>销售额</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>创建时间</th>
                        </tr>
                        </thead>
                        @foreach($planList as $plan)
                            <tbody>
                            <tr>
                                <td>{{ $plan->sum }}</td>
                                <td>{{ $plan->start_time }}</td>
                                <td>{{ $plan->end_time }}</td>
                                <td>{{ $plan->created_at }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

                <div class="col-md-2"></div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
    </div>

@stop

@section('js-file')
    <script src="{{ asset('chartjs/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/mis/management_plan.js') }}"></script>
@stop