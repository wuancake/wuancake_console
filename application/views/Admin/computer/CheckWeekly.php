<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>查看周报</title>
    <link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/public/Admin/css/public.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="/public/Admin/img/wuanico.ico"/>


</head>
<body>
<div class="checkweekly">
    <div class="title clearfix">
        <div class="pull-left">考勤系统管理后台</div>
        <div class="pull-right post">
            <?php
            switch ($_SESSION['admin']['auth']) {
                case 1:
                    echo '导师:', $_SESSION['admin']['username'];
                    break;
                case 2:
                    echo '管理员:', $_SESSION['admin']['username'];
                    break;
                case 3:
                    echo '最高管理员:', $_SESSION['admin']['username'];
                    break;
                default:
                    echo 'error';
                    break;
            } ?>
            <a href="/admin/quit" class="glyphicon glyphicon-arrow-right">登出</a>
        </div>
    </div>
    <div class="sidebar">
        <ul class="nav nav-stacked">
            <?php if ($_SESSION['admin']['auth'] == 3): ?>
                <li role="presentation">
                    <a href="/viewerb/addAdmin">新增管理员</a>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['admin']['auth'] != 1): ?>
                <li role="presentation">
                    <a href="/viewerb/addMentor">新增导师</a>
                </li>
            <?php endif; ?>
            <li role="presentation" class="active">
                <a href="/viewerb/checkWeekly">查看周报</a>
            </li>
            <li role="presentation">
                <a href="/viewerb/gatherAttendance">考勤汇总</a>
            </li>
            <li role="presentation">
                <a href="/viewerb/gatherClear">清人汇总</a>
            </li>
            <li role="presentation">
                <a href="/viewerb/check">学员检索</a>
            </li>
            <li role="presentation">
                <a href="/viewerb/change_psd">修改密码</a>
            </li>
        </ul>
    </div>
    <div class="main">
        <form class="content">
            <div class="selectbox clearfix">

                <label for="" class="pull-left">分组：</label>
                <select for="" class="textbox  pull-left" id="igroup">
                    <option value="0" selected="selected">全部</option>
                    <option value="1">PHP组</option>
                    <option value="2">Web前端组</option>
                    <option value="3">UI设计组</option>
                    <option value="4">Android组</option>
                    <option value="5">产品经理组</option>
                    <option value="6">软件测试组</option>
                    <option value="7">JAVA组</option>
                    <option value="8">Python组</option>
                    <option value="9">IOS组</option>
                </select>

                <label for="" class="pull-left">截止周数：</label>
                <select for="" class="textbox pull-left" id="iweek">
                    <!--周数选项值-->
                </select>

                <button type="button" class="btn btn-default btn-select" class="iselect" id="ibtnsel">确定</button>
            </div>

            <table class="table table-striped  table-bordered  text-center">
                <thead>
                <tr>
                    <th>分组</th>
                    <th>昵称</th>
                    <th>周数</th>
                    <th>考勤情况</th>
                    <th>考勤内容</th>
                </tr>
                </thead>
                <tbody id="idData">
                <!--sql数据库数据查询-->

                </tbody>
            </table>

            <nav aria-label="...">
                <div class="pager" id="pagination" name="pagination">
                    <!--js创建分页-->
                </div>
            </nav>

            <p id="warning"></p>
        </form>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="../../../../bootstrap/bootstrap/js/bootstrap.min.js"></script>

<script>
    function group(group_id) {
        var grouping;
//	var group_id;
        switch (group_id) {
            case '1':
                grouping = "PHP组";
                break;
            case '2':
                grouping = 'Web前端组';
                break;
            case '3':
                grouping = 'UI设计组';
                break;
            case '4':
                grouping = 'Android组';
                break;
            case '5':
                grouping = '产品经理组';
                break;
            case '6':
                grouping = '软件测试组';
                break;
            case '7':
                grouping = 'Java组';
                break;
            case '8':
                grouping = 'Python组';
                break;
            case '9':
                grouping = 'IOS组';
                break;
        }

        return grouping;
    }


    function status(week) {
        var itable = document.getElementById("idData");

        var cn;
        switch (week) {
            case '1':
                cn = '未提交';
                break;
            case '2':
                cn = '已提交';
                break;
            case '3':
                cn = '已请假';
                break;
        }

        return cn;
    }


    function weeknum() {
//	var nw = document.getElementById("nw");
        // 获取当前时间
        var currentTime = new Date();
        // 这里写的是2015年11月2日0时0分0秒   Javascript中月份是实际数字减1，故指定日期月份减一，另获取到毫秒。
        var targetTime = (new Date(2015, 10, 2, 0, 0, 0)).getTime();
        var offsetTime = currentTime - targetTime;

        // 将时间转位天数
        var offsetDays = Math.floor((offsetTime / (3600 * 24 * 1000)) / 7);
//	nw.innerHTML=offsetDays+1;
        return offsetDays;
    }

    var session_id = "<?php echo $session_id; ?>";  //获取动态id
    var identity = "<?php echo $_SESSION['admin']['auth'];?>";  //访问身份
    var mentor_group = "<?php echo $_SESSION['admin']['group']; ?>";

    window.onload = function () {

        var week_num = weeknum();

        if (identity == "3" || identity == "2") {  //如果登录账户为 超级管理员或管理员
            $.ajax({
                type: "get",
                url: "/api/admin/show_weekly.php?session=" + session_id,
                dataType: 'json',
                success: function (json) {
                    var num = json["data"].length;
                    var itable = document.getElementById("idData");
                    for (var i = 0; i < num; i++) {
                        if (json["data"][i].status == "1") {

                        } else {

                            itable.innerHTML += "<tr><td></td><td></td><td></td><td></td><td></td></tr>";
                        }

                    }
                    ;


                    num = itable.rows.length;

                    var pageSize = 20;	   //每页显示行数
                    var page_num = Math.ceil(num / pageSize);   //   总页数 :
                    var page_now = page_num - (page_num - 1);   //   等于第一页


                    page({

                        id: "pagination",   //当前id
                        nowNum: page_now,//当前页
                        allNum: page_num, //显示总页
                        callBack: function (pno) {

                            $("#idData").html("");
                            $("#warning").html("");
                            var num = json["data"].length;

                            for (var i = 0; i < num; i++) {
                                if (json["data"][i].status == "1") {

                                } else {
                                    itable.innerHTML += "<tr><td>" + group(json["data"][i].group_id) + "</td>" +
                                        "<td>" + json["data"][i].name + "</td>" +
                                        "<td>" + json["data"][i].week_num + "</td>" +
                                        "<td>" + status(json["data"][i].status) + "</td>" +
                                        "<td>" + json["data"][i].text + "</td></tr>";

                                }

                            }
                            ;
                            //回调函数，在这里写相关显示传参数

                            num = itable.rows.length;   //表格所有行数(所有记录数)
                            var totalPage = 0;   //   总页数

                            //总共分几页
                            if (num / pageSize > parseInt(num / pageSize)) {
                                totalPage = parseInt(num / pageSize) + 1;
                            } else {
                                totalPage = parseInt(num / pageSize);
                            }

                            var currentPage = pno;//当前页数
                            var startRow = (currentPage - 1) * pageSize + 1;
                            var endRow = currentPage * pageSize;
                            endRow = (endRow > num) ? num : endRow;

                            for (var i = 1; i < (num + 1); i++) {
                                var irow = itable.rows[i - 1];
                                if (i >= startRow && i <= endRow) {
                                    irow.style.display = "table-row";
                                } else {
                                    irow.style.display = "none";
                                }
                            }
                        }
                    });

                },

                error: function (json) {
                    if (json.error != null) {
                        alert(json.error)
                    }

                    else {
                        alert("缺少必要的参数或参数为非数字");
                    }
                }
            });

        }
        else if (identity == "1") {  //如果登录账户为 导师
            $.ajax({
                type: "get",
                url: "/api/admin/show_weekly.php?week=" + week_num + "&group=" + mentor_group + "&session=" + session_id,
                dataType: 'json',
                success: function (json) {
                    var sel_dis = document.getElementById("igroup");
                    sel_dis.selectedIndex = mentor_group;
                    sel_dis.disabled = true;

                    var num = json["data"].length;
                    var itable = document.getElementById("idData");
                    for (var i = 0; i < num; i++) {
                        if (json["data"][i].status == "1") {

                        } else {

                            itable.innerHTML += "<tr><td></td><td></td><td></td><td></td><td></td></tr>";
                        }

                    }
                    ;


                    num = itable.rows.length;

                    var pageSize = 20;	   //每页显示行数
                    var page_num = Math.ceil(num / pageSize);   //   总页数
                    var page_now = page_num - (page_num - 1);   //   等于第一页

                    page({

                        id: "pagination",   //当前id
                        nowNum: page_now,//当前页
                        allNum: page_num, //显示总页妈
                        callBack: function (pno) {

                            $("#idData").html("");
                            $("#warning").html("");

                            var num = json["data"].length;

                            for (var i = 0; i < num; i++) {
                                if (json["data"][i].status == "1") {


                                } else {
                                    itable.innerHTML += "<tr><td>" + group(json["data"][i].group_id) + "</td>" +
                                        "<td>" + json["data"][i].name + "</td>" +
                                        "<td>" + json["data"][i].week_num + "</td>" +
                                        "<td>" + status(json["data"][i].status) + "</td>" +
                                        "<td>" + json["data"][i].text + "</td></tr>";

                                }

                            }
                            ;
                            //回调函数，在这里写相关显示传参数

                            num = itable.rows.length;   //表格所有行数(所有记录数)
                            var totalPage = 0;   //   总页数

                            //总共分几页
                            if (num / pageSize > parseInt(num / pageSize)) {
                                totalPage = parseInt(num / pageSize) + 1;
                            } else {
                                totalPage = parseInt(num / pageSize);
                            }

                            var currentPage = pno;//当前页数
                            var startRow = (currentPage - 1) * pageSize + 1;
                            var endRow = currentPage * pageSize;
                            endRow = (endRow > num) ? num : endRow;

                            for (var i = 1; i < (num + 1); i++) {
                                var irow = itable.rows[i - 1];
                                if (i >= startRow && i <= endRow) {
                                    irow.style.display = "table-row";
                                } else {
                                    irow.style.display = "none";
                                }
                            }
                        }
                    });

                },

                error: function (json) {
                    if (json.error != null) {
                        alert(json.error)
                    }

                    else {
                        alert("缺少必要的参数或参数为非数字");
                    }
                }
            });
        }

        else {
            alert("出错")
        }

    };


    $(document).ready(function () {
        var week_num = weeknum();
        var iweek = document.getElementById("iweek");
        for (var i = week_num; i > 82; i--) {
            iweek.innerHTML += "<option value=" + i + ">第" + i + "周</option>";
        }

    });


    $(document).ready(function () {
        $("#ibtnsel").click(function () {
            $("#pagination").html("");	  //清空之前的分页按钮

            //获取分组select的值
            var igroupval = document.getElementById("igroup");
            var index = igroupval.selectedIndex;
            sel_igroup = igroupval.options[index].value;

            //获取周数select的值
            var iweekval = document.getElementById("iweek");
            var index = iweekval.selectedIndex;
            sel_iweek = iweekval.options[index].value;

            if (sel_igroup == "0") {
                $.ajax({
                    type: "get",
                    url: "/api/admin/show_weekly.php?week=" + sel_iweek + "&session=" + session_id,
                    dataType: 'json',
                    success: function (json) {
                        var itable = document.getElementById("idData");
                        $("#idData").html("");
                        var num = json["data"].length;

                        for (var i = 0; i < num; i++) {
                            if (json["data"][i].status == "1") {

                            } else {

                                itable.innerHTML += "<tr><td></td><td></td><td></td><td></td><td></td></tr>";
                            }

                        }
                        ;


                        num = itable.rows.length;
                        var pageSize = 20;	   //每页显示行数
                        var page_num = Math.ceil(num / pageSize);   //   总页数 :
                        var page_now = page_num - (page_num - 1);   //   等于第一页

                        page({

                            id: "pagination",   //当前id
                            nowNum: page_now,//当前页
                            allNum: page_num, //显示总页妈
                            callBack: function (pno) {

                                $("#idData").html("");
                                $("#warning").html("");

                                var num = json["data"].length;

                                for (var i = 0; i < num; i++) {
                                    if (json["data"][i].status == "1") {

                                    } else {
                                        itable.innerHTML += "<tr><td>" + group(json["data"][i].group_id) + "</td>" +
                                            "<td>" + json["data"][i].name + "</td>" +
                                            "<td>" + json["data"][i].week_num + "</td>" +
                                            "<td>" + status(json["data"][i].status) + "</td>" +
                                            "<td>" + json["data"][i].text + "</td></tr>";

                                    }
                                }
                                ;
                                //回调函数，在这里写相关显示传参数

                                num = itable.rows.length;   //表格所有行数(所有记录数)
                                var totalPage = 0;   //   总页数

                                //总共分几页
                                if (num / pageSize > parseInt(num / pageSize)) {
                                    totalPage = parseInt(num / pageSize) + 1;
                                } else {
                                    totalPage = parseInt(num / pageSize);
                                }

                                var currentPage = pno;//当前页数
                                var startRow = (currentPage - 1) * pageSize + 1;
                                var endRow = currentPage * pageSize;
                                endRow = (endRow > num) ? num : endRow;

                                for (var i = 1; i < (num + 1); i++) {
                                    var irow = itable.rows[i - 1];
                                    if (i >= startRow && i <= endRow) {
                                        irow.style.display = "table-row";
                                    } else {
                                        irow.style.display = "none";
                                    }
                                }
                            }
                        });

                    },

                    error: function (json) {
                        if (json.error != null) {
                            alert("报错");
                        }

                        else {
                            alert("缺少必要的参数或参数为非数字");
                        }
                    }
                });


            } else {
                $.ajax({
                    type: "get",
                    url: "/api/admin/show_weekly.php?week=" + sel_iweek + "&group=" + sel_igroup + "&session=" + session_id,
                    dataType: 'json',
                    success: function (json) {
                        var itable = document.getElementById("idData");
                        $("#idData").html("");
                        var num = json["data"].length;

                        for (var i = 0; i < num; i++) {
                            if (json["data"][i].status == "1") {

                            } else {

                                itable.innerHTML += "<tr><td></td><td></td><td></td><td></td><td></td></tr>";
                            }

                        }
                        ;


                        num = itable.rows.length;
                        var pageSize = 20;	   //每页显示行数
                        var page_num = Math.ceil(num / pageSize);   //   总页数 :
                        var page_now = page_num - (page_num - 1);   //   等于第一页

                        page({

                            id: "pagination",   //当前id
                            nowNum: page_now,//当前页
                            allNum: page_num, //显示总页妈
                            callBack: function (pno) {

                                $("#idData").html("");
                                $("#warning").html("");

                                var num = json["data"].length;

                                for (var i = 0; i < num; i++) {
                                    if (json["data"][i].status == "1") {

                                    } else {
                                        itable.innerHTML += "<tr><td>" + group(json["data"][i].group_id) + "</td>" +
                                            "<td>" + json["data"][i].name + "</td>" +
                                            "<td>" + json["data"][i].week_num + "</td>" +
                                            "<td>" + status(json["data"][i].status) + "</td>" +
                                            "<td>" + json["data"][i].text + "</td></tr>";

                                    }
                                }
                                ;
                                //回调函数，在这里写相关显示传参数

                                num = itable.rows.length;   //表格所有行数(所有记录数)
                                var totalPage = 0;   //   总页数

                                //总共分几页
                                if (num / pageSize > parseInt(num / pageSize)) {
                                    totalPage = parseInt(num / pageSize) + 1;
                                } else {
                                    totalPage = parseInt(num / pageSize);
                                }

                                var currentPage = pno;//当前页数
                                var startRow = (currentPage - 1) * pageSize + 1;
                                var endRow = currentPage * pageSize;
                                endRow = (endRow > num) ? num : endRow;

                                for (var i = 1; i < (num + 1); i++) {
                                    var irow = itable.rows[i - 1];
                                    if (i >= startRow && i <= endRow) {
                                        irow.style.display = "table-row";
                                    } else {
                                        irow.style.display = "none";
                                    }
                                }
                            }
                        });

                    },

                    error: function (json) {
                        if (json.error != null) {
                            alert(json.error)
                        }

                        else {
                            alert("缺少必要的参数或参数为非数字");
                        }
                    }
                });
            }

        });
    });





// 分页按钮
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
            obj.style.display = "block";
            var oA = document.createElement("a");
            oA.href = "#1";
            oA.innerHTML = "首页"
            obj.appendChild(oA);
        }
        //显示    上一页btn
        if (nowNum >= 2) {
            obj.style.display = "block";
            var oA = document.createElement("a");
            oA.href = "#" + (nowNum - 1);
            oA.innerHTML = "上一页"
            obj.appendChild(oA);
        }

        //当总页数小于等于5的时候
        if (allNum <= 5) {
            obj.style.display = "block";
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
            obj.style.display = "block";
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
                    obj.style.display = "block";
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
                    obj.style.display = "block";
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


        //显示    尾页btn
        if ((allNum - nowNum) >= 3 && allNum >= 6) {
            obj.style.display = "block";
            var oA = document.createElement("a");
            oA.href = "#" + allNum;
            oA.innerHTML = "尾页"
            obj.appendChild(oA);
        }
        //显示    下一页btn
        if ((allNum - nowNum) >= 1) {
            obj.style.display = "block";
            var oA = document.createElement("a");
            oA.href = "#" + (nowNum + 1);
            oA.innerHTML = "下一页"
            obj.appendChild(oA);
        }

        //callBack函数执行
        callBack(nowNum, allNum);

        var ithead = document.getElementById("idData");
        var num = idData.childNodes.length;
        //无数据
        if (num == 0) {
            obj.style.display = "none";
            var oB = document.getElementById("warning");
            oB.innerHTML = "当前无成员周报数据";
        }
        else {
            //给a添加点击事件
            obj.style.display = "block";
            var aA = obj.getElementsByTagName("a");
            for (var i = 0; i < aA.length; i++) {
                aA[i].onclick = function () {
                    var nowNum = parseInt(this.getAttribute("href").substring(1));
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
        }

    }


</script>
</body>
</html>
