<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>查看周报</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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


<!--右边	-->
<div class="right-part">

    <div class="title-bar">
        <h4>周报详情<?php echo $url; ?></h4>
    </div>

    <div class="container-fluid  myweekly">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">

                <table class="table table-striped  table-bordered  text-center">
                    <thead>
                    <tr>
                        <th>所属组</th>
                        <th>当前周数</th>
                        <th>周报</th>
                        <th>周报状态</th>
                        <th>提交时间</th>
                    </tr>
                    </thead>
                    <tbody id="idData">
                    <!--sql数据库数据查询-->
                    </tbody>
                    <table>

                        <nav aria-label="...">
                            <div class="pager" id="pagination" name="pagination">
                                <!--js创建分页-->
                            </div>
                        </nav>

                        <p id="warning"></p>

            </div>

            <div class="col-md-1"></div>

        </div>
    </div>


</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script>
    window.onload = function () {

        var session_id = "<?php echo $session_id; ?>";
        var num = "<?php echo $num;?>";
        var group = "<?php
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
            } ?>";

        var pageSize = 5;	   //每页显示行数
        var page_num = Math.ceil(num / pageSize);   //   总页数 : 99行/5页 = 19.8 = 20页
        var page_now = page_num - (page_num - 1);   //   等于第一页


        page({

            id: "pagination",   //当前id
            nowNum: page_now,//当前页
            allNum: page_num, //显示总页妈

            callBack: function (pno) {
                //回调函数，在这里写相关显示传参数

                var itable = document.getElementById("idData");

                $.ajax({
                    type: "get",
                    url: "/api/pc_weekly.php?page=" + page_now + "&session=" + session_id,
                    dataType: 'json',
                    success: function (json) {


                        $("#idData").html("");

                        for (var i = 0; i <= num; i++) {
                            // 得到表格某一页数据
                            if (json["data"][i].status == "已请假") {
                                itable.innerHTML += "<tr><td>" + group + "</td>" +
                                    "<td>" + json["data"][i].week + "</td>" +
                                    "<td>" + json["data"][i].reason + "</td>" +
                                    "<td>" + json["data"][i].status + "</td>" +
                                    "<td>" + json["data"][i].time + "</td></tr>";
                            }
                            else if (json["data"][i].status == "未提交") {
                                itable.innerHTML += "<tr><td>" + group + "</td>" +
                                    "<td>" + json["data"][i].week + "</td>" +
                                    "<td>" + json["data"][i].reason + "</td>" +
                                    "<td>" + json["data"][i].status + "</td>" +
                                    "<td>" + json["data"][i].time + "</td></tr>";
                            }
                            else {


                                if (json["data"][i].url == "无") {

                                    itable.innerHTML += "<tr><td>" + group + "</td>" +
                                        "<td>" + json["data"][i].week + "</td>" +
                                        "<td>本周完成：" + json["data"][i].finished +
                                        "<br/>所遇问题：" + json["data"][i].problem + "<br/>下周计划：" + json["data"][i].plan + "</td>" +
                                        "<td>" + json["data"][i].status + "</td>" +
                                        "<td>" + json["data"][i].time + "</td></tr>";


                                }
                                else {

                                    itable.innerHTML += "<tr><td>" + group + "</td>" +
                                        "<td>" + json["data"][i].week + "</td>" +
                                        "<td>本周完成：" + json["data"][i].finished +
                                        "<br/>所遇问题：" + json["data"][i].problem + "<br/>下周计划：" + json["data"][i].plan +
                                        "<br/>作品链接：" + json["data"][i].url + "</td>" +
                                        "<td>" + json["data"][i].status + "</td>" +
                                        "<td>" + json["data"][i].time + "</td></tr>";

                                }

                            }

                        }
                        ;


                    },

                    error: function (json) {
                        if (json.error != null) {
                            alert(json.error);
                        }
                        else {
                            alert("缺少必要的参数或参数为非数字");
                        }
                    }
                });
            }

        });

        function page(opt) {


            if (!opt.id) {
                return false;
            }

            var obj = document.getElementById(opt.id);

            var nowNum = opt.nowNum || 1;
            var allNum = opt.allNum || 5;

            var callBack = opt.callBack || function () {
            };


            //显示    首页btn
            if (nowNum >= 4 && allNum >= 6) {
                var oA = document.createElement("a");
                oA.href = "#1";
                oA.innerHTML = "首&nbsp;&nbsp;页"
                obj.appendChild(oA);
            }

            //显示    上一页btn
            if (nowNum >= 2) {
                var oA = document.createElement("a");
                oA.href = "#" + (nowNum - 1);
                oA.innerHTML = "上一页";
                obj.appendChild(oA);
            }

            //当总页数等于0的时候
            if (num == 0) {

                var oB = document.getElementById("warning");
                oB.innerHTML = "当前您还未提交过周报";

            }
            //当总页数小于等于5的时候
            else if (allNum <= 5 && num != 0) {

                for (var i = 1; i <= allNum; i++) {
                    //创建a标签
                    var oA = document.createElement("a");
                    oA.href = "#" + i;

                    //当前页码效果
                    if (nowNum == i) {
                        oA.className = "active";
                        oA.innerHTML = i;
                    }

                    //其他页码效果
                    else {
                        oA.innerHTML = i;
                    }

                    obj.appendChild(oA);
                }
            }
            //当总页数大于5的时候
            else {
                for (var i = 1; i <= 5; i++) {
                    var oA = document.createElement("a");

                    if (nowNum == 1 || nowNum == 2) {

                        oA.href = "#" + i;

                        if (nowNum == i) {
                            oA.className = "active";
                            oA.innerHTML = i;
                        }
                        else {
                            oA.innerHTML = i;
                        }
                    }


                    else if ((allNum - nowNum) == 0 || (allNum - nowNum) == 1) {

                        oA.href = "#" + (allNum - 5 + i);


                        if ((allNum - nowNum) == 0 && i == 5) {
                            oA.className = "active";
                            oA.innerHTML = (allNum - 5 + i);
                        }
                        else if ((allNum - nowNum) == 1 && i == 4) {
                            oA.className = "active";
                            oA.innerHTML = (allNum - 5 + i);
                        }
                        else {
                            oA.innerHTML = (allNum - 5 + i);
                        }

                    }

                    else {
                        oA.href = "#" + (nowNum - 3 + i);

                        if (i == 3) {
                            oA.className = "active";
                            oA.innerHTML = (nowNum - 3 + i);
                        }
                        else {
                            oA.innerHTML = (nowNum - 3 + i);
                        }
                    }
                    obj.appendChild(oA);

                }
            }


            //显示    下一页btn
            if ((allNum - nowNum) >= 1 && num != 0) {
                var oA = document.createElement("a");
                oA.href = "#" + (nowNum + 1);
                oA.innerHTML = "下一页"
                obj.appendChild(oA);
            }

            //显示    尾页btn
            if ((allNum - nowNum) >= 3 && allNum >= 6) {
                var oA = document.createElement("a");
                oA.href = "#" + allNum;
                oA.innerHTML = "尾&nbsp;&nbsp;页";
                obj.appendChild(oA);
            }

            //callBack函数执行
            callBack(nowNum, allNum);

            //给a添加点击事件
            var aA = obj.getElementsByTagName("a");
//			var j = 
            for (var i = 0; i < aA.length; i++) {
                aA[i].onclick = function () {

                    var nowNum = parseInt(this.getAttribute("href").substring(1));
                    page_now = nowNum;
                    obj.innerHTML = "";

                    page({
                        id: opt.id,
                        nowNum: nowNum,
                        allNum: allNum,
                        callBack: callBack

                    });

                    return false;

                };
            }

        };

    };


</script>


</body>
</html>
