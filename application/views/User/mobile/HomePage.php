<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>HomePage</title>

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


<!--侧边栏-->
<div class="sidebar-box" id="sid-box" style="display: none;">
    <div class="sidebar">
        <div class="box">
            <div class="page with-sidebar">
                <div class="page-header">
                    <img class="img-responsive" src="/public/User/mobile/img/logo.png" alt="用户头像">
                    <div class="uid"><span><?php
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
                            } ?>：<?php echo $username; ?></span></div>
                </div>
                <div class="page-sidebar text-center">
                    <ul class="sub-menu">
                        <li class="active"><a href="/index.php/viewer/show_weekly">我的周报</a></li>
                        <li><a href="/index.php/viewer/change_psd">修改密码</a></li>
                    </ul>
                </div>
                <div class="page-region">
                    <a href="/index.php/user/quit" class="btn btn-default center-block ">退出</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="homepage">
    <div class="timeboxout  ball">
        <div class="timeboxmiddle ball">
            <div class="timeboxin">
                <div class="box">
                    <div class="percent">
                        <p id="prompt1">第<span id="nw"><?php echo $week_num; ?></span>周</p>
                        <p id="prompt2">本周剩余时间</p>
                        <p id="prompt3"><span id="days"></span><span id="hours"></span><span id="minutes"></span><span
                                    id="seconds"></span></p>
                    </div>
                    <div id="water" class="water ball">
                        <svg viewBox="0 0 560 20" class="water_wave water_wave_back ball">
                            <use xlink:href="#wave"></use>
                        </svg>
                        <svg viewBox="0 0 560 20" class="water_wave water_wave_front ball">
                            <use xlink:href="#wave"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="userMessage"><span><?php
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
            } ?></span>：<span><?php echo $username; ?></span></p>
    <a href="/index.php/viewer/write_weekly" id="myweeklybtn" class="center-block btn">提交周报</a>
    <a href="/index.php/viewer/vacate" id="askleave" class="center-block btn">我要请假</a>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         style="display: none;">
        <symbol id="wave">
            <path d="M420,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C514,6.5,518,4.7,528.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H420z"></path>
            <path d="M420,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C326,6.5,322,4.7,311.5,2.7C304.3,1.4,293.6-0.1,280,0c0,0,0,0,0,0v20H420z"></path>
            <path d="M140,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C234,6.5,238,4.7,248.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H140z"></path>
            <path d="M140,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C46,6.5,42,4.7,31.5,2.7C24.3,1.4,13.6-0.1,0,0c0,0,0,0,0,0l0,20H140z"></path>
        </symbol>
    </svg>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="/public/User/mobile/js/ball.js"></script>
<script type="text/javascript" src="/public/User/mobile/js/other.js"></script>
<script type="text/javascript" src="/public/User/mobile/js/ball-weeknum.js"></script>

</body>
</html>