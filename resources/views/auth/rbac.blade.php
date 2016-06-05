<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset=“utf-8”>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory System - MIS</title>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap-responsive.min.css') }}"/>
</head>
<body>
<br/>
<br/>
<br/>
<br/>

<div class="container-fluid">
    <div class="span5"></div>
    <div class="span2">

        <!---------------------------------->

        <form method="POST" action="/login" class="form-horizontal">
            {!! csrf_field() !!}

            <div class="login-form">
                <div class="control-group">
                    <input type="email" class="form-control login-field" placeholder="Email" name="email"
                           value="{{ old('email') }}">
                    <label class="login-field-icon fui-man-16" for="login-name"></label>
                    <span class="control-feedback fui-man-16"></span>
                </div>
                <div class="control-group">
                    <input type="password" class="form-control login-field" placeholder="Password" name="password"
                           id="password">
                    <label class="login-field-icon fui-lock-16" for="login-pass"></label>
                </div>
                <button type="submit" class="btn btn-primary btn-block">登陆</button>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}">

        </form>
        @if ($errors->any())
            <br/>
            <ul class="list-group alert-danger">
                @foreach($errors->all() as $error)
                    <li class="list-group-item">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
                    <!---------------------------------->

    </div>
    <div class="span5"></div>
</div>
</body>
</html>

<script src="{{ asset('/js/activity-content.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/respond.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>