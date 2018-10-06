<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>撰写周报</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/public/User/computer/css/base.css"/>
    <link rel="stylesheet" href="/public/User/computer/css/public.css">
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
                    case 8:
                        echo 'Python组';
                        break;
                    case 9:
                        echo 'IOS组';
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


<!-- 右边 -->
<div class="right-part">
    <div class="title-bar">
        <h4>周报撰写</h4>
    </div>
    <div class="box writeweekly">
        <form action="/user/write_weekly" method="post">
            <div class="column-leave-1">
                <div class="user-info">
                    <span class="user-group">
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
                             case 8:
                                 echo 'Python组';
                                 break;
                             case 9:
                                 echo 'IOS组';
                                 break;
                         } ?>
                    </span>
                    <span class="user-id">
                  	      <?php echo $username; ?>
                    </span>
                </div>
                <div class="user-holiday">
                    <span class="holiday-state">请假状态</span>
                    <span class="holiday-flag">
                        <?php switch ($status) {
                            case 1:
                                echo '未提交';
                                break;
                            case 2:
                                echo '已提交';
                                break;
                            case 3:
                                echo '已请假';
                                break;
                        }; ?>
                    </span>
                </div>
            </div>
            <div class="column-weekly-2">
                <span class="weekly-content">本周完成内容（必填）</span>
                <textarea rows="2" cols="30" placeholder="请在此处输入本周你做了什么" name="done"></textarea>
                <span class="weekly-problem">本周遇到问题（必填）</span>
                <textarea rows="3" cols="30" placeholder="遇到了坑那么肯定是要学会解决掉它的" name="problem"></textarea>
                <span class="next-plan">下周计划（必填）</span>
                <textarea rows="3" cols="30" placeholder="合理的计划能够带来更好的学习效果" name="todo"></textarea>
                <span class="homework">作品链接</span>
                <textarea rows="1" cols="30" placeholder="记得把作品链接放在这里，特别是UI组的伙伴们" name="url"></textarea>
            </div>

            <div class="btn-leave">
                <button class="btn btn-primary" type="submit">提交周报</button>
            </div>

        </form>
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