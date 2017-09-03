

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
	nw = offsetDays-1;

$.getJSON('/index.php/user/show_weekly',function(data){
	
//var strHtml = "";//存储数据的变量
	var o = nw;
    strHtml= 
        '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-content" id="nw">'
        + data[o].week + '周</span></div>' +
    	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-content">' 
        + data[o].time + '</time></div>' +
    	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content">' 
        + data[o].finished + '</div></div>' +
    	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content">' 
        + data[o].problem + '</div></div>' +
    	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content">' 
        + data[o].plan + '</div></div>' 
var $jsontip = $("#show");
$jsontip.html(strHtml);//显示处理后的数据 



//touch事件实现左右上下触摸滑动事件
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
                           /* alert("刷新完成");*/
                          
							$.getJSON('/index.php/user/show_weekly',function(data){
							o --;
							if(o<0){alert("已经翻到顶端了！");}
							else{
								strHtml= 
     						    '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-content" id="nw">'
     						    + data[o].week + '周</span></div>' +
    						 	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-content">' 
     						    + data[o].time + '</time></div>' +
    						 	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content">' 
      						   + data[o].finished + '</div></div>' +
    							 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content">' 
      						   + data[o].problem + '</div></div>' +
    						 	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content">' 
     						    + data[o].plan + '</div></div>' 
								 var $jsontip = $("#show");
								 $jsontip.html(strHtml);//显示处理后的数据 
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
                            /*alert("加载完成");*/
                          $.getJSON('/index.php/user/show_weekly',function(data){
							o ++;
							if(o>=offsetDays){
								o = offsetDays-1;
								alert("已经翻到最后一页了！");
							}
							
							else{
								strHtml= 
     						    '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">周数：</label><span class="la-content" id="nw">'
     						    + data[o].week + '周</span></div>' +
    						 	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">提交时间：</label><time class="la-content">' 
     						    + data[o].time + '</time></div>' +
    						 	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">本周完成：</label><div class="la-content">' 
      						   + data[o].finished + '</div></div>' +
    							 '<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">所遇到问题：</label><div class="la-content">' 
      						   + data[o].problem + '</div></div>' +
    						 	'<div class="form-group la-horizontal clearfix"><label class="la-horizontal-left">下周计划：</label><div class="la-content">' 
     						    + data[o].plan + '</div></div>' 
								 var $jsontip = $("#show");
								 $jsontip.html(strHtml);//显示处理后的数据 
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


}); 








