<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GatherAttendance</title>
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/public/Admin/css/public.css" />
		
		
		
	</head>
	<body>
		<div class="gatherattendance">
			<div class="title  clearfix">
					<div class="pull-left">考勤系统管理后台</div>
					<div class="pull-right post">  <?php
                        switch ($_SESSION['admin']['auth']){
                            case 1:
                                echo '导师';
                                break;
                            case 2:
                                echo '管理员';
                                break;
                            case 3:
                                echo '最高管理员';
                                break;
                            default:
                                echo 'error';
                                break;
                        }
                        ?>:<?php echo $_SESSION['admin']['username']?>
						 <a href="/index.php/admin/quit" class="glyphicon glyphicon-arrow-right">登出</a>
					</div>
			</div>
     			<div class="sidebar">
     				<ul class="nav nav-stacked">
     					<li role="presentation">
     						<a href="/index.php/viewerb/addAdmin">新增管理员</a>
     					</li>
     					<li role="presentation">
     						<a href="/index.php/viewerb/addMentor">新增导师</a>
     					</li>
     					<li role="presentation">
     						<a href="/index.php/viewerb/checkWeekly">查看周报</a>
     					</li>
     					<li role="presentation"  class="active">
     						<a href="/index.php/viewerb/gatherAttendance">考勤汇总</a>
     					</li>
     					<li role="presentation">
     						<a href="/index.php/viewerb/gatherClear">清人汇总</a>
     					</li>
     				</ul>
     			</div>

 					<div class="main">
 						<form class="content">
 							<div class="selectbox clearfix">

 								<label for="" class="pull-left">分组：</label>
 								<select for="" class="textbox pull-left" id="igroup">
   										<option value="0"  selected="selected">全部</option>
   										<option value="1">PHP组</option>
 									 	<option value="2">Web前端组</option>
 										<option value="3">UI设计组</option>
   										<option value="4">Android组</option>
 									 	<option value="5">产品经理组</option>
 										<option value="6">软件测试组</option>
 										<option value="7">JAVA组</option>
								</select>


 								<label for="" class="pull-left">截止周数：</label>
 								<select for="" class="textbox pull-left" id="iweek">
   										<!--周数选项值-->
								</select>

 							
 								<button type="button" class="pull-left btn btn-default btn-select"  id="ibtnsel">确定</button>
 							</div>
 							
 							<table class="table table-striped  table-bordered  text-center">
				 				<thead id="ithead">
				 					<!--<tr>
				 						<th>分组</th>
        		     					<th>昵称</th>
        		     					<th>QQ号</th>
        		    	 				<th>第58周</th>
        		    	 				<th>第57周</th>
        		    	 				<th>第56周</th>
        		    	 				<th>第55周</th>
        		    	 				<th>操作</th>
     			     				</tr>-->
				 				</thead>
				 				<tbody id="idData">
  			    				  	<!--sql数据库数据查询-->
  			    	  			</tbody>
    	    	 			</table>
    	    	 			
    	    	 			<nav aria-label="...">
 								<div class="pager"   id="pagination" name="pagination">
   				 			 	<!--js创建分页-->
   			
 								</div>
					  		</nav>
					  		
					  		<p id="warning" ></p>
 						</form>	
 					</div>
 				</div>

		
		
		
		
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script type="text/javascript" src="/bootstrap/bootstrap/js/bootstrap.min.js" ></script>

<script>
	function group(group_id){
	var grouping;
//	var group_id;
	switch(group_id){
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
	}
	
	return grouping;
}


	function status(week){
	var cn;
	switch(week){
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


var session_id = "<?php echo $session_id; ?>";  //获取动态id
var identity = "<?php echo $_SESSION['admin']['auth'];?>";  //访问身份
var mentor_group = "<?php echo $_SESSION['admin']['group']; ?>";  //该身份所在分组 





function weeknum(){
	// 获取当前时间
	var currentTime = new Date();
	// 这里写的是2015年11月2日0时0分0秒   Javascript中月份是实际数字减1，故指定日期月份减一，另获取到毫秒。
	var targetTime = (new Date(2015, 10, 2, 0, 0, 0)).getTime();
	var offsetTime =currentTime - targetTime;
 
	// 将时间转位天数
	var offsetDays =Math.floor((offsetTime / (3600 * 24 * 1000))/7);
//	nw.innerHTML=offsetDays+1;
	return offsetDays;
}



window.onload = function (){
	
	 	//表头刷新
		var week_num = weeknum();
		var ithead = document.getElementById("ithead");
        ithead.innerHTML ="<tr><th>分组</th><th>昵称</th><th>QQ号</th><th>第"+
          			 week_num+"周</th><th>第"+(week_num-1)+"周</th><th>第"+(week_num-2)+"周</th><th>第"+(week_num-3)+"周</th><th>操作</th></tr>" ;

				
		if (identity =="3" || identity =="2") {
				$.ajax({
				type:"get",
        		url:"/api/admin/weekly_sum.php?session="+session_id,
           		dataType:'json',   		
      			success:function(json){
      				var num = json["data"].length;
      				var pageSize = 10;	   //每页显示行数  
					var page_num = Math.ceil(num/pageSize);   //   总页数 : 
					var page_now = page_num -(page_num-1);   //   等于第一页  
      				
      				
      				page({
					
					id:"pagination",   //当前id
					nowNum:page_now,//当前页
					allNum:page_num, //显示总页妈
					callBack:function(pno){
						
					var itable = document.getElementById("idData");
          			$("#idData").html("");

					for (var i =0; i <num;i++) {
						
					itable.innerHTML += "<tr><td>"+ group(json["data"][i].group_id)  + "</td>" +
          			 	            	"<td>"+ json["data"][i].user_name + "</td>" +
          			 	             	"<td>"+ json["data"][i].qq + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week1+"'>"+ status(json["data"][i].week1) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week2+"'>"+ status(json["data"][i].week2) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week3+"'>"+ status(json["data"][i].week3) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week4+"'>"+ status(json["data"][i].week4) + "</td>" +
          			 	            	"<td>"+ "<button type='button'  onclick='rm(this)' class='btn-rm'  value=' "+ json["data"][i].id +" '>移出</button>" + "</td></tr>"; 
          			 	            	
					};
						//回调函数，在这里写相关显示传参数

//							var numb = itable.rows.length;   //表格所有行数(所有记录数)
							var totalPage = 0;   //   总页数       
				
						//总共分几页
						if(num/pageSize>parseInt(num/pageSize)){
							totalPage = parseInt(num/pageSize)+1;
						}else{
							totalPage = parseInt(num/pageSize);
						}

						var currentPage = pno;//当前页数
						var startRow = (currentPage - 1) * pageSize +1;
						var endRow = currentPage * pageSize;
						endRow = (endRow >num)? num:endRow;
				
						for (var i=1;i<(num+1);i++) {
							var irow = itable.rows[i-1];
							if (i>=startRow && i <=endRow) {
								irow.style.display = "table-row";
							} else{
								irow.style.display = "none";
							}
						}
					}
				});
						
            	},      			 

            error:function(json){
            	if (json.error != null) {
            		alert(json.error)
            	}

            	 else{
            		alert("缺少必要的参数或参数为非数字");
            	}
            }
        });
        
		}
		else if(identity =="1"){
				$.ajax({
				type:"get",
        		url:"/api/admin/weekly_sum.php?week=" + week_num + "&group=" +mentor_group+ "&session="+session_id,
           		dataType:'json',   		
      			success:function(json){
					var sel_dis = document.getElementById("igroup");
					sel_dis.selectedIndex = mentor_group;
					sel_dis.disabled= true;
      				
      				var num = json["data"].length;
      				var pageSize = 10;	   //每页显示行数  
					var page_num = Math.ceil(num/pageSize);   //   总页数 
					var page_now = page_num -(page_num-1);   //   等于第一页  
      				
      				page({
					
					id:"pagination",   //当前id
					nowNum:page_now,//当前页
					allNum:page_num, //显示总页妈
					callBack:function(pno){
					var itable = document.getElementById("idData");
          			$("#idData").html("");

					for (var i =0; i <num;i++) {
						
					itable.innerHTML += "<tr><td>"+ group(json["data"][i].group_id)  + "</td>" +
          			 	            	"<td>"+ json["data"][i].user_name + "</td>" +
          			 	             	"<td>"+ json["data"][i].qq + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week1+"'>"+ status(json["data"][i].week1) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week2+"'>"+ status(json["data"][i].week2) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week3+"'>"+ status(json["data"][i].week3) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week4+"'>"+ status(json["data"][i].week4) + "</td>" +
          			 	            	"<td>"+ "<button type='button'  onclick='rm(this)' class='btn-rm'  value=' "+ json["data"][i].id +" '>移出</button>" + "</td></tr>"; 
          			 	            	
					};
						//回调函数，在这里写相关显示传参数

//							var numb = itable.rows.length;   //表格所有行数(所有记录数)
							var totalPage = 0;   //   总页数       
				
						//总共分几页
						if(num/pageSize>parseInt(num/pageSize)){
							totalPage = parseInt(num/pageSize)+1;
						}else{
							totalPage = parseInt(num/pageSize);
						}

						var currentPage = pno;//当前页数
						var startRow = (currentPage - 1) * pageSize +1;
						var endRow = currentPage * pageSize;
						endRow = (endRow >num)? num:endRow;
				
						for (var i=1;i<(num+1);i++) {
							var irow = itable.rows[i-1];
							if (i>=startRow && i <=endRow) {
								irow.style.display = "table-row";
							} else{
								irow.style.display = "none";
							}
						}

					}
				});
						
            	},      			 

            error:function(json){
            	if (json.error != null) {
            		alert(json.error)
            	}

            	 else{
            		alert("缺少必要的参数或参数为非数字");
            	}
            }
        });
		}
			
		else{
			alert("出错")
		}

			};
				

function rm(val){
var user_id = val.value;

	$.ajax({
				type:"post",
        		url:"/api/admin/kick_someone.php?session=" + session_id + "&user_id=" +user_id,
           		data:{session_id:session_id,user_id:user_id},
           		async:false,
           		dataType:'json',
      			success:function(data){
      				
      				if (data.success != false) {
//    					alert(data.success);
      					var parentNode=val.parentNode.parentNode; 
							parentNode.style.display ="none";
							
      				} 
      				else{
      					alert(data.error);
      				}  				
            	},      			 

            error:function(json){
            	if (json.error != null) {
            		alert("出错")
            	}

            	 else{
            		alert("缺少必要的参数或参数为非数字");
            	}
            }
       });     
}


		
$(document).ready(function(){
	var week_num = weeknum();	
	var iweek = document.getElementById("iweek");
	for (var i = week_num ; i>85; i--) {
		iweek.innerHTML +="<option value="+ i +">第"+ i +"周</option>";
	}

});	
	
	
$(document).ready(function(){	
	$("#ibtnsel").click(function(){	
		$("#pagination").html("");	  //清空之前的分页按钮
		
		//获取分组select的值
		var igroupval=document.getElementById("igroup"); 
		var index=igroupval.selectedIndex;
		 	sel_igroup= igroupval.options[index].value; 
		
		//获取周数select的值
		var iweekval=document.getElementById("iweek"); 
		var index=iweekval.selectedIndex;
			sel_iweek= iweekval.options[index].value; 
			
			
			
		var week_num = sel_iweek;
		var ithead = document.getElementById("ithead");
        ithead.innerHTML ="<tr><th>分组</th><th>昵称</th><th>QQ号</th><th>第"+
        week_num+"周</th><th>第"+(week_num-1)+"周</th><th>第"+(week_num-2)+"周</th><th>第"+(week_num-3)+"周</th><th>操作</th></tr>" ;
		
		if (sel_igroup == "0" ) {
			$.ajax({
			type:"get",
        	url:"/api/admin/weekly_sum.php?week=" + sel_iweek +  "&session=" + session_id,
           	dataType:'json',   		
      		success:function(json){
				var num = json["data"].length;
      				var pageSize = 10;	   //每页显示行数  
					var page_num = Math.ceil(num/pageSize);   //   总页数 : 
					var page_now = page_num -(page_num-1);   //   等于第一页  
      				
      				page({
					
					id:"pagination",   //当前id
					nowNum:page_now,//当前页
					allNum:page_num, //显示总页妈
					callBack:function(pno){
					var itable = document.getElementById("idData");
          			$("#idData").html("");

					for (var i =0; i <num;i++) {
						
					itable.innerHTML += "<tr><td>"+ group(json["data"][i].group_id)  + "</td>" +
          			 	            	"<td>"+ json["data"][i].user_name + "</td>" +
          			 	             	"<td>"+ json["data"][i].qq + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week1+"'>"+ status(json["data"][i].week1) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week2+"'>"+ status(json["data"][i].week2) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week3+"'>"+ status(json["data"][i].week3) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week4+"'>"+ status(json["data"][i].week4) + "</td>" +
          			 	            	"<td>"+ "<button type='button'  onclick='rm(this)' class='btn-rm'  value=' "+ json["data"][i].id +" '>移出</button>" + "</td></tr>"; 
          			 	            	
					};
						//回调函数，在这里写相关显示传参数

//						var numb = itable.rows.length;   //表格所有行数(所有记录数)
						var totalPage = 0;   //   总页数       
				
						//总共分几页
						if(num/pageSize>parseInt(num/pageSize)){
							totalPage = parseInt(num/pageSize)+1;
						}else{
							totalPage = parseInt(num/pageSize);
						}

						var currentPage = pno;//当前页数
						var startRow = (currentPage - 1) * pageSize +1;
						var endRow = currentPage * pageSize;
						endRow = (endRow >num)? num:endRow;
				
						for (var i=1;i<(num+1);i++) {
							var irow = itable.rows[i-1];
							if (i>=startRow && i <=endRow) {
								irow.style.display = "table-row";
							} else{
								irow.style.display = "none";
							}
						}
					}
				});
				
            	},      			 

            error:function(json){
            	if (json.error != null) {
//          		alert("json.error");
            		alert("报错");
            	}

            	 else{
            		alert("缺少必要的参数或参数为非数字");
            	}  
            }
       });	
			
			
		} else{
			$.ajax({
			type:"get",
        	url:"/api/admin/weekly_sum.php?week=" + sel_iweek + "&group=" + sel_igroup + "&session="+session_id,
           	dataType:'json',   		
      		success:function(json){
				var num = json["data"].length;
      				var pageSize = 10;	   //每页显示行数  
					var page_num = Math.ceil(num/pageSize);   //   总页数 : 
					var page_now = page_num -(page_num-1);   //   等于第一页  
      				
      				page({
					
					id:"pagination",   //当前id
					nowNum:page_now,//当前页
					allNum:page_num, //显示总页妈
					callBack:function(pno){
					var itable = document.getElementById("idData");
          			$("#idData").html("");

					for (var i =0; i <num;i++) {
						
					itable.innerHTML += "<tr><td>"+ group(json["data"][i].group_id)  + "</td>" +
          			 	            	"<td>"+ json["data"][i].user_name + "</td>" +
          			 	             	"<td>"+ json["data"][i].qq + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week1+"'>"+ status(json["data"][i].week1) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week2+"'>"+ status(json["data"][i].week2) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week3+"'>"+ status(json["data"][i].week3) + "</td>" +
          			 	            	"<td class='status"+json["data"][i].week4+"'>"+ status(json["data"][i].week4) + "</td>" +
          			 	            	"<td>"+ "<button type='button'  onclick='rm(this)' class='btn-rm'  value=' "+ json["data"][i].id +" '>移出</button>" + "</td></tr>"; 
          			 	            	
					};
						//回调函数，在这里写相关显示传参数

//							var numb = itable.rows.length;   //表格所有行数(所有记录数)
							var totalPage = 0;   //   总页数       
				
						//总共分几页
						if(num/pageSize>parseInt(num/pageSize)){
							totalPage = parseInt(num/pageSize)+1;
						}else{
							totalPage = parseInt(num/pageSize);
						}

						var currentPage = pno;//当前页数
						var startRow = (currentPage - 1) * pageSize +1;
						var endRow = currentPage * pageSize;
						endRow = (endRow >num)? num:endRow;
				
						for (var i=1;i<(num+1);i++) {
							var irow = itable.rows[i-1];
							if (i>=startRow && i <=endRow) {
								irow.style.display = "table-row";
							} else{
								irow.style.display = "none";
							}
						}
					}
				});
				
            	},      			 

            error:function(json){
            	if (json.error != null) {
            		alert(json.error)
            	}

            	 else{
            		alert("缺少必要的参数或参数为非数字");
            	}  
            }
       });	
	}
	
	});
});
	
			
function page(opt){
				
				
				if (!opt.id) {return false;} 
				
				var obj = document.getElementById(opt.id);
				
				var nowNum = opt.nowNum || 1;
				var allNum = opt.allNum || 5;
				
				var callBack = opt.callBack || function(){};
				
				
				//显示    首页btn
				if(nowNum>=4 && allNum>=6){ 
					var oA = document.createElement("a");
					oA.href = "#1";
					oA.innerHTML = "首页"
					obj.appendChild(oA);
				}
				//显示    上一页btn
				if(nowNum>=2){ 
					var oA = document.createElement("a");
					oA.href = "#" + (nowNum -1);
					oA.innerHTML = "上一页"
					obj.appendChild(oA);
				}
				

				
				//当总页数小于等于5的时候
				if (allNum<=5) {	
					for (var i =1;i<=allNum;i++) {
						//创建a标签
						var oA = document.createElement("a");
						oA.href = "#"+i;
						
						//当前页码效果
						if (nowNum == i) {
							oA.className = "active";
							oA.innerHTML = i;
						} 
						
						//其他页码效果
						else{
							oA.innerHTML = i;
						}
						
						obj.appendChild(oA);
					}
				}
				//当总页数大于5的时候
				else{
					for (var i =1;i<=5;i++) {
						var oA = document.createElement("a");

						if (nowNum == 1 || nowNum == 2) {
							
							oA.href = "#" + i;
							
							if (nowNum == i) {
								oA.className = "active";
								oA.innerHTML = i;
							} 
							else{
								oA.innerHTML = i;
							}	
						}
						
						
						else if((allNum -nowNum) == 0 ||(allNum -nowNum) == 1){
							
							oA.href = "#" + (allNum - 5 + i);
							

							if ((allNum -nowNum) == 0 && i==5) {
								oA.className = "active";
								oA.innerHTML = (allNum - 5 + i);
							}
							else if((allNum -nowNum) == 1 && i==4){
								oA.className = "active";
								oA.innerHTML = (allNum - 5 + i);
							}
							else{
								oA.innerHTML =(allNum - 5 + i);
							}	
							
						}
						
						else{
							oA.href = "#" + (nowNum - 3 + i);
							
							if (i==3) {
								oA.className = "active";
								oA.innerHTML =(nowNum - 3 + i);
							}
							else{
								oA.innerHTML = (nowNum - 3 + i);
							}
						}
						obj.appendChild(oA);
					
				}
			}
				
				
			//显示    尾页btn	
			if((allNum - nowNum)>=3 && allNum >=6){
				var oA = document.createElement("a");
					oA.href = "#" + allNum;
					oA.innerHTML = "尾页"
					obj.appendChild(oA);	
			}
			//显示    下一页btn	
			if((allNum - nowNum)>=1){
				var oA = document.createElement("a");
					oA.href = "#" + (nowNum +1);
					oA.innerHTML = "下一页"
					obj.appendChild(oA);	
			}
			
			//callBack函数执行
			callBack(nowNum,allNum);
			
			
			var ithead = document.getElementById("idData");
			var num = idData.childNodes.length;
			//无数据
			if(num == 0){
				obj.style.display="none";
				var oB = document.getElementById("warning");
					oB.innerHTML = "当前无成员考勤数据";
			}
			else{
				//给a添加点击事件
				var aA = obj.getElementsByTagName("a");
				for (var i =0;i<aA.length;i++) {
					aA[i].onclick = function(){
						var nowNum = parseInt(this.getAttribute("href").substring(1));
						obj.innerHTML = "";
					
						page({
						
							id:opt.id,
							nowNum:nowNum,
							allNum:allNum,
							callBack:callBack
						
						});
					
						return false;	
					};
				}
			}
	
		}
      

		</script>
	</body>
</html>
