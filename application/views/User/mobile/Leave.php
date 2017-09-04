<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Leave</title>

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
    <a href="javascript:history.go(-1)" id="showSideBar"><span id="returnbtn" class="iconfont icon-fanhui"></span></a>
    <h2>我要请假</h2>
</div>

<div class="leave">

    <form role="form" class="info-box wri-vacation-box" action="/index.php/user/vacate" method="post">
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left"><?php
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
                } ?>：</label>
            <span class="la-horizontal-right"><?php echo $username; ?></span>
        </div>
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">当前周数：</label>
            <time class="la-horizontal-right"><?php echo $week_num; ?></time>
        </div>
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">请假状态：</label>
            <time class="la-horizontal-right la-danger"><?php
                switch ($status) {
                    case 3:
                        echo '已请假';
                        break;
                    default:
                        echo '未请假';
                        break;
                }
                ?></time>
        </div>
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">请假周数：</label>
            <!--<select class="la-horizontal-right">
                          <option>请假一周</option>
                          <option>请假二周</option>
                          <option>请假三周</option>
                </select>-->
            <div class="la-horizontal-right">
                <button type="button" class="btn" value="1" id="one">一周</button>
                <button type="button" class="btn" value="2" id="two">二周</button>
                <button type="button" class="btn" value="3" id="three">三周</button>
                <input type="hidden" name="num" id="num"  value="1"/>
            </div>

        </div>
        <div class="form-group la-horizontal clearfix">
            <label class="la-horizontal-left">请假理由（必填）：</label>
            <textarea class="form-control" rows="6" name="reason"></textarea>
        </div>
        <button id="pushLeave" class="center-block" type="submit">提交请假申请</button>
    </form>

</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        $("#one").bind("click", function () {
            $("#num").val("1");
            $("#one,#two,#three").removeClass("active");
            $("#one").addClass("active");
        });
        $("#two").bind("click", function () {
            $("#num").val("2");
            $("#one,#two,#three").removeClass("active");
            $("#two").addClass("active");
        });
        $("#three").bind("click", function () {
            $("#num").val("3");
            $("#one,#two,#three").removeClass("active");
            $("#three").addClass("active");
        });
</script>

</body>
</html>
