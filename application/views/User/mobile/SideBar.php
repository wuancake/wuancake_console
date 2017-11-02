<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>SideBar</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
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
    <a id="showSideBar1" onclick="sideBar(1);">
        <span class="iconfont icon-tab"></span>
    </a>
    <a id="showSideBar2" onclick="sideBar(2);" style="display: none;">
        <span class="iconfont icon-tab"></span>
    </a>
    <h2>午安煎饼计划</h2>
</div>
<div class="sidebar">
    <div class="box">
        <div class="page with-sidebar">
            <div class="page-header">
                <img class="img-responsive" src="/public/User/mobile/img/logo.png" alt="用户头像">
                <div class="uid"><span>产品经理组：二马</span></div>
            </div>
            <div class="page-sidebar text-center">
                <ul class="sub-menu">
                    <li class="active"><a href="/viewer/show_weekly">我的周报</a></li>
                    <li><a href="/viewer/change_psd">修改密码</a></li>
                </ul>
            </div>
            <div class="page-region">
                <a href="/user/quit" class="btn btn-default center-block ">退出</a>
            </div>
        </div>
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
