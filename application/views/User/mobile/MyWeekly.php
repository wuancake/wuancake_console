<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    
    <title>MyWeekly</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/User/mobile/css/base.css" />
    <link rel="stylesheet" href="/public/User/mobile/css/public.css" />
    
    <link rel="shortcut" href="/favicon.ico" />
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	</head>
  	<body> 
  		<div class="title">
    	<a href="/viewer/index"  id="showSideBar"><span id="returnbtn" class="iconfont icon-fanhui"></span></a>
      <h2>我的周报</h2>
    	</div>
<div class="myweekly">
	<!--刷新图标，当有新内容加载时，显示该图标，加载完成后图标隐藏-->
		<div id="refreshTop"></div>
	<div id="pullup">下拉显示上一周</div>
	
		<form role="form"  class="info-box my-weekly-box"  id="show">
		</form>
	
		<div id="pulldown">上拉显示下一周</div>
		<!--刷新图标，当有新内容加载时，显示该图标，加载完成后图标隐藏-->
		<div id="refreshbottom"></div>
</div>
	
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/public/User/mobile/js/other.js" ></script>
  	
  	<script>
	
$(document).ready(function(){

	var nw = document.getElementById("nw");
	// 获取当前时间
	var currentTime = new Date();
	// 这里写的是2015年11月2日0时0分0秒   Javascript中月份是实际数字减1，故指定日期月份减一，另获取到毫秒。
	var targetTime = (new Date(2015, 10, 2, 0, 0, 0)).getTime();
	var offsetTime =currentTime - targetTime;
	// 将时间转位天数
	var offsetDays =Math.floor((offsetTime / (3600 * 24 * 1000))/7);
//	nw =Math.floor(offsetDays-92);
	nw = offsetDays+1;

	var session_id = "<?php echo $session_id; ?>"; 
	
	$.ajax({
            type:"get",
            url:"/api/weekly.php?week="+ nw +"&session="+session_id,
            dataType:'json',
            cache:false,
            success:function(json){
            	
              if(json.status=="已提交" && json.url!="无"){
            		 $("#show").html("");
           		   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                + json.week + '周</span></div>' +
            		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                + json.time + '</time></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content" id="finished">' 
                + json.finished + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content" id="problem">' 
                + json.problem + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content" id="plan">' 
                + json.plan + '</div></div>'  +
                 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">作品链接：</label><div class="la-content" id="plan">' 
                + json.url + '</div></div>' 
                
                );	
            		}
            		
              else if(json.status=="已提交" && json.url =="无"){
            		 $("#show").html("");
           		   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                + json.week + '周</span></div>' +
            		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                + json.time + '</time></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content" id="finished">' 
                + json.finished + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content" id="problem">' 
                + json.problem + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content" id="plan">' 
                + json.plan + '</div></div>'  
                
                );	
            		}
            		
            	else if(json.status=="未提交"){
							    $("#show").html("");
           		   $("#show").html(
           		   	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">状态：</label><span class="la-horizontal-right" id="nw">'
                  + json.status + '</span></div>' +
              	  '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                 + json.week + '周</span></div>' );	
            		}
            	
            	else if(json.status=="本周已请假"){
							   $("#show").html("");
							   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">状态：</label><span class="la-horizontal-right" id="nw">'
                 + json.status + '</span></div>' +
                 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                 + json.week + '周</span></div>' +
              	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                 + json.time + '</time></div>' );	
            		}
            		
            		else{
            			$("#show").html("");
            			alert("加载出错");
            		}
	
            },
            error:function(json){
            	if (json.error=="缺少必要的参数:id") {
            		alert("用户尚未登录");
            	}
            	else if(json.error=="用户未加入分组"){
            		alert("用户尚未加入分组");
            	}
            	 else{
            		alert("缺少必要的参数或参数为非数字");
            	}
		   }
            });
           

////touch事件实现左右上下触摸滑动事件
var mytouch = (function() {
	    var x, y,
        doc = document,
        imgWidth=doc.getElementById("show").clientWidth,
        pullup = doc.getElementById("pullup"),
        pulldown = doc.getElementById("pulldown"),
        isMoved = true;  

    return{ //返回对象
        tStart: function(event) { //获取触摸到屏幕时的坐标
            if (isMoved) {
                var touches = event.targetTouches;
                if (touches.length == 1) {
                    x = touches[0].pageX;
                    y = touches[0].pageY;
                }
                isMoved = false;
            }
        },
        tMove: function(event) { //手指在屏幕上移动时触发左/右/上/下滑事件
            if (!isMoved) { //只有手指第一次在屏幕上滑动时，并且满足响应条件，才触发左/右/上/下滑事件
                var touches = event.targetTouches;
                if (touches.length == 1) { //一个手指在屏幕上
                    var x1 = touches[0].pageX, //移动到的坐标
                        y1 = touches[0].pageY;

                    if ((y1 - 80) > y ) //下滑
                    {
                        isMoved = true; //不设置该变量，会导致多个touchmove事件
                        //下拉刷新加载页面，显示顶部刷新图标
                        doc.getElementById("refreshTop").style.display = "block";
                        doc.getElementById("pullup").style.display = "none";
                        //提交ajax请求，并进行更新数据，更新完成后，隐藏“刷新图标”
                         
                        //3s后隐藏“刷新图标”(测试用的)
                        setTimeout(function() {
                            doc.getElementById("refreshTop").style.display = "none";
                            doc.getElementById("pullup").style.display = "block";
                          	nw --;
							$.getJSON("/api/weekly.php?week="+ nw +"&session="+session_id,function(json){
							if(nw<1){
//								alert("已经翻到顶端了！");
								$("#show").html('<div class="skip"><div class="hint">已经翻到第一页了！</div></div>');
								nw = 0;
							}
							else{

                	if(json.status=="已提交" && json.url!="无"){
            		 $("#show").html("");
           		   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                + json.week + '周</span></div>' +
            		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                + json.time + '</time></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content" id="finished">' 
                + json.finished + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content" id="problem">' 
                + json.problem + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content" id="plan">' 
                + json.plan + '</div></div>'  +
                 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">作品链接：</label><div class="la-content" id="plan">' 
                + json.url + '</div></div>' 
                
                );	
            		}
            		
              else if(json.status=="已提交" && json.url =="无"){
            		 $("#show").html("");
           		   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                + json.week + '周</span></div>' +
            		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                + json.time + '</time></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content" id="finished">' 
                + json.finished + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content" id="problem">' 
                + json.problem + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content" id="plan">' 
                + json.plan + '</div></div>'  
                
                );	
            		}
            		
            	else if(json.status=="未提交"){
							    $("#show").html("");
           		   $("#show").html(
           		   	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">状态：</label><span class="la-horizontal-right" id="nw">'
                  + json.status + '</span></div>' +
              	  '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                 + json.week + '周</span></div>' );	
            		}
            	
            	else if(json.status=="本周已请假"){
							   $("#show").html("");
							   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">状态：</label><span class="la-horizontal-right" id="nw">'
                 + json.status + '</span></div>' +
                 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                 + json.week + '周</span></div>' +
              	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                 + json.time + '</time></div>' );	
            		}
            		
            		else{
            			$("#show").html("");
            			alert("加载出错");
            		}
				    			}
						 return false; 
						 }); 
						 
             }, 500);
            }
            if ((y1 + 80) < y ) //上滑
            {
            isMoved = true;
            //上拉刷新加载页面，显示底部刷新图标
            doc.getElementById("refreshbottom").style.display = "block";
            doc.getElementById("pulldown").style.display = "none";
            //提交ajax请求，并进行更新数据，更新完成后，隐藏“刷新图标”
                         
            //3s后隐藏“刷新图标”(测试用的)
            setTimeout(function() {
            doc.getElementById("refreshbottom").style.display = "none";
            doc.getElementById("pulldown").style.display = "block";
            nw ++;
            $.getJSON("/api/weekly.php?week="+ nw +"&session="+session_id,function(json){
            	
							if(nw>offsetDays+1 && json.status =="未提交"){
//								if()
								
//								alert("已经翻到最后一页了！");
								nw=offsetDays+2;
								$("#show").html('<div class="skip"><div class="hint">已经翻到最后一页了！</div></div>');
							}
							
							else{

                	 if(json.status=="已提交" && json.url!="无"){
            		 $("#show").html("");
           		   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                + json.week + '周</span></div>' +
            		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                + json.time + '</time></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content" id="finished">' 
                + json.finished + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content" id="problem">' 
                + json.problem + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content" id="plan">' 
                + json.plan + '</div></div>'  +
                 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">作品链接：</label><div class="la-content" id="plan">' 
                + json.url + '</div></div>' 
                
                );	
            		}
            		
              else if(json.status=="已提交" && json.url =="无"){
            		 $("#show").html("");
           		   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                + json.week + '周</span></div>' +
            		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                + json.time + '</time></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content" id="finished">' 
                + json.finished + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content" id="problem">' 
                + json.problem + '</div></div>' +
    	       		 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content" id="plan">' 
                + json.plan + '</div></div>'  
                
                );	
            		}
            		
            	else if(json.status=="未提交"){
							    $("#show").html("");
           		   $("#show").html(
           		   	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">状态：</label><span class="la-horizontal-right" id="nw">'
                  + json.status + '</span></div>' +
              	  '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                 + json.week + '周</span></div>' );	
            		}
            	
            	else if(json.status=="本周已请假"){
							   $("#show").html("");
							   $("#show").html(
              	 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">状态：</label><span class="la-horizontal-right" id="nw">'
                 + json.status + '</span></div>' +
                 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-horizontal-right" id="nw">'
                 + json.week + '周</span></div>' +
              	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-horizontal-right" id="time">' 
                 + json.time + '</time></div>' );	
            		}
            		
            		else{
            			$("#show").html("");
            			alert("加载出错");
            		}
				    			}
						 return false; 
						 }); 
                            
                }, 500);
               }
             }
          }
       },
    };
})();

document.addEventListener("touchstart", mytouch.tStart, false);
document.addEventListener("touchmove", mytouch.tMove, false);
return false; 

}); 
</script>
  	
  	
  	</body>
</html>
