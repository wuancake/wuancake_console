<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title></title>

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
    <h2>午安煎饼计划</h2>
</div>
<div class="signup">
    <form role="form" class="info-box registered-box" action="/index.php/user/register" method="post">
        <div class="form-group has-success has-feedback">
            <input type="text" class="form-control" placeholder="用户名" name="username">
            <span class="glyphicon glyphicon-ok form-control-feedback iconfont icon-icon-successful-1"></span>
        </div>
        <div class="form-group has-error has-feedback">
            <input type="email" class="form-control" placeholder="电子邮箱" name="email">
            <span class="glyphicon glyphicon-remove form-control-feedback iconfont icon-icon-dangerous-1"></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="午安网昵称" name="nickname">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="QQ" name="qq">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="密码" name="password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="确认密码" name="repassword">
        </div>
        <button id="signup" class="center-block" type="submit">注册</button>
    </form>

    <div class="box clearfix">
        <span>已有帐号？</span><a href="/index.php/viewer/index" class="btn btn-default">点击登录</a>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
