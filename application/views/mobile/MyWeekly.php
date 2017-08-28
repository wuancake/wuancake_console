<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>MyWeekly</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/mobile/css/base.css"/>
    <link rel="stylesheet" href="/public/mobile/css/public.css"/>

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
    <h2>我的周报<?php echo $session_id;?></h2>
</div>
<div class="myweekly">
    <!--刷新图标，当有新内容加载时，显示该图标，加载完成后图标隐藏-->
    <div id="refreshTop"></div>
    <div id="pullup">下拉显示上一周</div>

    <form role="form" class="info-box my-weekly-box" id="show">
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">周数：</label>
            <span class="la-horizontal-right" id="nw"></span>
        </div>
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">提交时间：</label>
            <time class="la-horizontal-right">2017/6/20日 11:15:20分</time>
        </div>
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">本周完成：</label>
            <div class="la-content"></div>
        </div>
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">所遇到问题：</label>
            <div class="la-content"></div>
        </div>
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">下周计划：</label>
            <div class="la-content"></div>
        </div>

    </form>
    <div id="pulldown">上拉显示下一周</div>
    <!--刷新图标，当有新内容加载时，显示该图标，加载完成后图标隐藏-->
    <div id="refreshbottom"></div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="/public/mobile/js/other.js"></script>
<script type="text/javascript" src="/public/mobile/js/pullup.js"></script>


</body>
</html>
