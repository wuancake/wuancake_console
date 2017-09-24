<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>注册</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous"/>
    <link rel="stylesheet" href="/public/User/computer/css/base.css" />
    <link rel="stylesheet" href="/public/User/computer/css/public.css"/>
	<link rel="shortcut icon" type="image/x-icon"  href="/public/Admin/img/wuanico.ico" />

</head>


<body>

    <div class="column-sign signup">
        <form class="sign-up-box" action="/user/register" method="post">
            <div class="sign-user-id sign-user">
                <input type="text" name="username" placeholder="用户名" style="-webkit-box-shadow: 0px 0px 0px 50px white inset;">
            </div>
            <div class="sign-user-email sign-user">
                <input type="text" name="email" placeholder="电子邮箱" style="-webkit-box-shadow: 0px 0px 0px 50px white inset;">
            </div>
            <div class="sign-user-name sign-user">
                <input type="text" name="nickname" placeholder="午安网昵称" style="-webkit-box-shadow: 0px 0px 0px 50px white inset;">
            </div>
            <div class="sign-user-qq sign-user">
                <input type="text" name="qq" placeholder="QQ" style="-webkit-box-shadow: 0px 0px 0px 50px white inset;">
            </div>
            <div class="sign-user-password sign-user">
                <input type="password" id="pswd" name="password" placeholder="密码">
                <span class="glyphicon iconfont icon-yanjing"></span>
            </div>
            <div class="sign-user-confirm-password sign-user">
                <input type="password" name="repassword" placeholder="确认密码" >
            </div>
            <div class="sign-up-btn">
                <button class="btn btn-primary" type="submit"><span>注册</span></button>
            </div>
            <div class="sign-in-href ">
                -><a href="/viewer/index" class="sign-up-a">登陆</a>
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