<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>更改密码</title>

    <!-- Bootstrap -->
   	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/User/computer/css/base.css" />
    <link rel="stylesheet" href="/public/User/computer/css/public.css" />
	<link rel="shortcut icon" type="image/x-icon"  href="/public/Admin/img/wuanico.ico" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="right-part-password">
        <form class="column-password" action="/user/set_new_psd" method="post">
            <div class="new-password sign-user">
                <input type="password" id="pswd" placeholder="新密码" name="password">
                <span class="glyphicon iconfont icon-yanjing"></span>
            </div>
<!--            <div class="confirm-password sign-user">
                <input type="password" name="confirm" placeholder="确认新密码">
            </div>-->
            <div class="submit-btn">
                <button class="btn btn-primary" type="submit"><span>提交</span></button>
            </div>
        </form>
    </div>











    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
        
    <script src="/public/User/computer/js/eyes.js"></script>
</body>

</html>