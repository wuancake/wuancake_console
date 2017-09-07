<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>WriteWeekly</title>

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


    <style scoped>

    </style>

</head>
<body>
<div class="title">
    <a href="/index.php/viewer/index" id="showSideBar"><span id="returnbtn" class="iconfont icon-fanhui"></span></a>
    <h2>撰写周报</h2>
</div>
<div class="writeweekly">
    <form role="form" class="info-box wri-weekly-box" action="/index.php/user/write_weekly" method="post">
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
        <div class="form-group la-horizontal  clearfix">
            <label class="la-horizontal-left">当前周数：</label>
            <time class="la-horizontal-right"><?php echo $week_num; ?>周</time>
        </div>
        <div class="form-group la-horizontal  clearfix">
            <label class="la-horizontal-left">报告状态：</label>
            <time class="la-horizontal-right la-danger"><?php switch ($status) {
                    case 1:
                        echo '未提交';
                        break;
                    case 2:
                        echo '已提交';
                        break;
                    case 3:
                        echo '已请假';
                        break;
                }; ?></time>
        </div>
        <div class="form-group la-horizontal  clearfix">
            <label class="la-horizontal-left">本周完成（必填）：</label>
            <textarea class="form-control" rows="3" name="done"></textarea>
        </div>
        <div class="form-group la-horizontal  clearfix">
            <label class="la-horizontal-left">所遇到问题（必填）：</label>
            <textarea class="form-control" rows="3" name="problem"></textarea>
        </div>
        <div class="form-group la-horizontal  clearfix">
            <label class="la-horizontal-left">下周计划(必填)：</label>
            <textarea class="form-control" rows="3" name="todo"></textarea>
        </div>
        <div class="form-group la-horizontal  clearfix">
            <label class="la-horizontal-left">作品链接：</label>
            <textarea class="form-control" rows="1" name="url"></textarea>
        </div>
        <button id="pushweekly" class="center-block" type="submit">提交周报</button>
    </form>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="/public/User/bootstrap/js/bootstrap.min.js"></script>
</div>
</body>
</html>
