<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>jQuery对话框-时尚漂亮</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Tahoma, sans-serif;
        }

        h1 {
            font-family: Helvetica, Arial, Verdana, sans-serif;
            color: #444;
            font-weight: bold;
            font-size: 1.7em;
            line-height: 1.2em;
        }

        h3 {
            font-family: Georgia, Helvetica, sans-serif;
            color: #898989;
            font-weight: normal;
            font-style: italic;
            font-size: 1.3em;
            line-height: 1.0em;
            margin-bottom: 10px;
        }

        h4 {
            font-size: 0.9em;
            text-transform: uppercase;
        }

        br {
            display: block;
            clear: both;
            position: relative;
        }

        .break {
            display: block;
            height: 20px;
        }

        #wrap {
            display: block;
            padding-top: 30px;
            width: 800px;
            margin: 0 auto;
        }

        #left {
            width: 160px;
            float: left;
            display: block;
            margin-right: 15px;
        }

        #right {
            width: 350px;
            float: left;
            display: block;
        }

        .usrava {
            padding: 5px;
            border: 1px solid #ddd;
        }

        input[type="text"], input[type="password"], textarea, select {
            outline: none;
        }

        #msgform {
            width: 330px;
            background: #faf7e3;
            border: 8px solid #f0ecd0;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            padding: 4px 14px;
            top: -1px;
            z-index: 9;
        }

        .mainCompose {
            display: inline;
        }

        .msgInput {
            border: 1px solid #d8d5bb;
            border-top-color: #b1ae99;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            width: 290px;
            font-size: 15px;
            color: #727167;
            padding: 4px 7px;
            font-family: Arial, Tahoma, sans-serif;
        }

        .msgField {
            border: 1px solid #d8d5bb;
            border-top-color: #b1ae99;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            width: 290px;
            color: #a4a39c;
            color: #727167;
            font-size: 15px;
            padding: 5px 9px;
            font-family: Arial, Tahoma, sans-serif;
            height: 140px;
            margin-bottom: 20px;
        }

        #composebtn img {
            cursor: pointer;
        }

        #tofield {
            margin-bottom: 1px;
        }

        .containmsg {
            margin-left: 50px;
            display: block;
            float: right;
            position: relative;
        }

        .containmsg .mainCompose {
            position: absolute;
            left: -33px;
            top: 20px;
        }

        .recipient {
            display: block;
            padding: 3px 7px;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            font-weight: bold;
            background: #eae7d1;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            color: #949286;
        }

        .recipient: hover {
            color: #75746a;
        }

        .userslist {
            display: inline;
            list-style: none;
            padding: 0;
            margin-bottom: 5px;
            position: relative;
            top: 10px;
            margin-left: 2px;
        }

        .userslist li {
            float: left;
        }

        #tofield: focus, #mymsg: focus {
            box-shadow: 0px 0px 7px #007eff;
        }

        #msgform label {
            display: inline;
            color: #827f6a;
            font-size: 14px;
            font-weight: bold;
            font-family: "Trebuchet MS", Arial, sans-serif;
            margin-bottom: 4px;
        }

        .calloutUp {
            height: 0;
            width: 0;
            border-bottom: 12px solid #f0ecd0;
            border-left: 12px dotted transparent;
            border-right: 12px dotted transparent;
            left: 0px;
            top: 0px;
            margin-left: 30px;
            z-index: 10;
        }

        .calloutUp2 {
            position: relative;
            left: -12px;
            top: 8px;
            border-bottom: 12px solid #faf7e3;
            border-left: 12px dotted transparent;
            border-right: 12px solid transparent;
            z-index: 11;
        }

        p#errortxt {
            margin-top: -15px;
            font-size: 0.7em;
            font-style: italic;
            color: #555;
            margin-bottom: 10px;
        }

        .sendbtn {
            display: inline-block;
            outline: none;
            margin-bottom: 12px;
            cursor: pointer;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 12px;
            color: #827f6a;
            padding: 7px 12px;
            border: 1px solid #cac8bb;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            border-top-color: #dddac3;
            text-shadow: 0px 0px 1px rgba(97, 97, 93, .3);
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
            -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
            background: #f6f5ea;
            background: -webkit-gradient(linear, left top, left bottom, from(#f9f9f3), to(#f5f4e6));
            background: -moz-linear-gradient(top, #f9f9f3, #f5f4e6);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f3', endColorstr='#f5f4e6');
        }

        .sendbtn: hover {
            background: #fff;
            background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#fbfbf5));
            background: -moz-linear-gradient(top, #fff, #fbfbf5);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff', endColorstr='#fbfbf5');
            color: #93928d;
        }

        .clearfix: after {
            content: ".";
            display: block;
            clear: both;
            visibility: hidden;
            line-height: 0;
            height: 0;
        }

        .clearfix {
            display: inline-block;
        }

        html[xmlns] .clearfix {
            display: block;
        }

        * html .clearfix {
            height: 1%;
        }
    </style>
    <script type="text/javascript" src="/ajaxjs/jquery-1.6.2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".mainCompose").hide();
            $('.loader').hide();
            $('#errortxt').hide();
            $('.compose').click(function () {
                $('.mainCompose').slideToggle();
            });
            $('.sendbtn').click(function (e) {
                e.preventDefault();
                $('.sendbtn').hide();
                $('.loader').show();
                if ($('#mymsg').val() == "") {
                    $('#errortxt').show();
                    $('.sendbtn').show();
                    $('.loader').hide();
                }
                else {
                    $('sendbtn').hide();
                    $('.loader').show();
                    $('#errortxt').hide();
                    var formQueryString = $('#sendprivatemsg').serialize();
                    finalSend();
                }
                function finalSend() {
                    $('.mainCompose').delay(1000).slideToggle('slow', function () {
                        $('#composeicon').addClass('sent').removeClass('compose').hide();
                        $('#composebtn').append('<img src="/jscss/demoimg/201311/check-sent.png" />');
                    });
                }
            });
        });
    </script>
</head>
<body>
<div id="wrap">
    <div class="profile clearfix">
        <section id="left">
            <img src="/jscss/demoimg/201311/avatar.png" alt="Jake's Avatar" class="usrava"/>
        </section>
        <section id="right">
            <!-- begin modal msg box -->
            <div class="containmsg">
                <p id="composebtn"><img src="/jscss/demoimg/201311/compose.gif" alt="compose" class="compose"
                                        id="composeicon"/></p>

                <div class="mainCompose">
                    <div class="calloutUp">
                        <div class="calloutUp2">
                        </div>
                    </div>
                    <div id="msgform">
                        <form name="sendprivatemsg" id="sendprivatemsg" action="#" method="post">
                            <label for="tofield" class="tofield">To</label>
                            <ul class="userslist clearfix">
                                <li><a href="#" target="_blank" class="recipient">Jake Rocheleau</a></li>
                            </ul>
                            <div class="break"></div>
                            <label for="mymsg" id="msmglabel">Message</label>
                            <textarea name="mymsg" id="mymsg" class="msgField"></textarea>

                            <p id="errortxt">**Enter some text!</p>

                            <div id="sendbtncontain"><a class="sendbtn">Send Message</a><img
                                        src="/jscss/demoimg/201311/ajax-loader.gif" class="loader"/></div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- @end modal -->
            <h1>Jake Rocheleau</h1>

            <h3>blogger and freelance web designer.</h3>
        </section>
    </div>
</div>
</body>
</html>