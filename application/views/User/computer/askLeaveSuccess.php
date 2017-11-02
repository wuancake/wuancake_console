<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>首页</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/User/computer/css/base.css"/>
    <link rel="stylesheet" href="/public/User/computer/css/public.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="/public/Admin/img/wuanico.ico"/>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>


<body>
<!--左边-->
<div class="sidebar">

    <!--导航上层-->
    <div class="sidebar-top">
        <!--午安icon-->
        <div class="media logo">
        </div>

        <!--我的信息-->
        <div class="media myinfo">
            <div class="media-left">
                <a href="#"><img class="media-object portrait" src="/public/User/computer/img/logo.png" alt="我的头像"></a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $username; ?></h4>
                <?php
                switch ($group) {
                    case 1:
                        echo 'PHP组';
                        break;
                    case 2:
                        echo 'Web前端组';
                        break;
                    case 3:
                        echo 'UI设计组';
                        break;
                    case 4:
                        echo 'Android组';
                        break;
                    case 5:
                        echo '产品经理组';
                        break;
                    case 6:
                        echo '软件测试组';
                        break;
                    case 7:
                        echo 'Java组';
                        break;
                } ?>
            </div>
            <div class="media-right">
                <a href="/user/quit">
                    <span class="glyphicon iconfont icon-fenxiang"></span>
                </a>
            </div>
        </div>

        <!--导航-->
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active">
                <a href="/viewer/index" class="text-center"><span class="glyphicon iconfont icon-shouye"></span>首页</a>
            </li>
            <li role="presentation">
                <a href="/viewer/show_weekly" class="text-center"><span
                            class="glyphicon iconfont icon-wo"></span>我的周报</a>
            </li>
            <li role="presentation">
                <a href="/viewer/change_psd" class="text-center"><span class="glyphicon iconfont icon-icon28"></span>修改密码</a>
            </li>
        </ul>
    </div>


    <!--导航底层-->
    <div class="sidebar-bottom"></div>
</div>


<!--右边	-->
<div class="right-part">
    <div class="title-bar">
        <h4 class="week">
            本周第<i id="nw"></i>周
            <span>已请假 <span class="glyphicon iconfont icon-quanyes"></span></span>
            <h4 class="week">本周当前状态</h4>
        </h4>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 text-center">
                <time id="time">本周已请假</time>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-11">
								 <span class=" iconfont icon-quandian">
								 <span class="remind">开始为下周计划做准备吧！</span>
            </div>
        </div>

    </div>


    <div class="pager">
        <a class="btn btn-default active" href="/viewer/show_weekly" role="button">我的周报</a>
        <a class="btn btn-default" href="/user/vacate_off">取消请假</a>
    </div>


</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="/public/User/computer/js/ball-weeknum.js"></script>

</body>
</html>
