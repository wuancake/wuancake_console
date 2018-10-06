<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/User/mobile/css/base.css"/>
    <link rel="stylesheet" href="/public/User/mobile/css/public.css"/>

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
    <form role="form" class="info-box registered-box" action="/user/register" method="post">
        <div class="form-group">
            <input type="text" class="form-control text-center" placeholder="用户名" name="username">
        </div>
        <div class="form-group">
            <input type="email" class="form-control text-center" placeholder="电子邮箱" name="email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control text-center" placeholder="午安网昵称" name="nickname">
        </div>
        <div class="form-group">
            <input type="text" class="form-control text-center" placeholder="QQ" name="qq">
        </div>
        <div class="form-group">
            <input type="password" class="form-control text-center" placeholder="密码" name="password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control text-center" placeholder="确认密码" name="repassword">
        </div>
        <button id="signup" class="center-block" type="submit">注册</button>
    </form>

    <div class="box clearfix">
        已有帐号？</span><a href="/viewer/index">点击登录</a>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
