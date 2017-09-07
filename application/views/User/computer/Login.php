<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>登录界面</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/public/User/computer/css/base.css" />
    <link rel="stylesheet" href="/public/User/computer/css/public.css">


</head>

<body>

    <div class="column-sign">
        <form class="sign-in-box" action="/index.php/user/login" method="post">
            <div class="sign-user-id sign-user">
                <input type="text" name="email" placeholder="邮箱" >
            </div>
            <div class="sign-user-password sign-user">
                <input type="password" id="pswd" name="password" placeholder="密码">
                <span class="glyphicon iconfont icon-yanjing"></span>
            </div>
            <div class="sign-in-btn">
                <button class="btn btn-primary" type="submit"><span>登陆</span></button>
            </div>
            <div class="sign-up-href">
                -><a href="/index.php/viewer/signup" class="sign-up-a">注册</a>
                <br>
                -><a href="/index.php/viewer/ChangePassWord" class="sign-up-a">找回密码</a>

            </div>
        </form>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../../../public/User/computer/js/eyes.js" ></script>
</body>

</html>