<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>jQuery控制Hover</title>

    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap-responsive.min.css') }}"/>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".list-group-item").hover(function () {
                $(this).addClass("blue");
            }, function () {
                $(this).removeClass("blue");
            });
        });
    </script>
    <style>

        .blue {
            background: #bcd4ec;
        }

    </style>
</head>
<body>
<ul class="list-group">
    <li class="list-group-item">a</li>
    <li class="list-group-item">b</li>
    <li class="list-group-item">d</li>
    <li class="list-group-item">e</li>
    <li>f</li>
    <li>g</li>
    <li>h</li>
</ul>
<ul id="ordered">
    <li>a</li>
    <li>b</li>
    <li>d</li>
    <li>e</li>
    <li>f</li>
    <li>g</li>
    <li>h</li>
</ul>
</body>
</html>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/respond.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>