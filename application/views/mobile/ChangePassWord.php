<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>ChangePassWord</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/base.css"/>
    <link rel="stylesheet" href="/public/css/public.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>
<div class="title">
    <a href="javascript:history.go(-1)" id="showSideBar"><span id="returnbtn" class="iconfont icon-fanhui"></span></a>
    <h2>修改密码</h2>
</div>
<div class="changepassword">
    <form role="form" class="info-box" action="/index.php/user/reset_psd" method="post">
        <div class="form-group">
            <input type="password" class="form-control" placeholder="旧密码" name="password">
        </div>
        <div class="form-group has-success has-feedback">
            <input type="password" class="form-control" placeholder="新密码" name="newpsd">
            <span class="glyphicon glyphicon-ok form-control-feedback iconfont icon-icon-successful-1"></span>
        </div>
        <div class="form-group has-error has-feedback">
            <input type="password" class="form-control" placeholder="确认新密码" name="repassword">
            <span class="glyphicon glyphicon-remove form-control-feedback iconfont icon-icon-dangerous-1"></span>
        </div>
        <button id="pushPsaaWord" class="center-block" type="submit">提交</button>
    </form>

</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
