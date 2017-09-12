<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CheckWeekly</title>
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/public/Admin/css/public.css" />
		
		
		
	</head>
	<body>
		<div class="checkweekly container-fluid">
			<div class="row title">
				<div class="col-md-12">
					<h1 class="col-md-7 text-left">考勤系统管理后台</h1>
					<div class="col-md-5 post text-right">  <?php
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
			</div>
			<div class="row">
     			<div class="col-md-3 sidebar">
     				<ul class="nav nav-pills nav-stacked">
     					<li role="presentation">
     						<a href="/index.php/viewerb/addAdmin">新增管理员</a>
     					</li>
     					<li role="presentation">
     						<a href="/index.php/viewerb/addMentor">新增导师</a>
     					</li>
     					<li role="presentation">
     						<a href="/index.php/viewerb/checkWeekly">查看周报</a>
     					</li>
     					<li role="presentation">
     						<a href="/index.php/viewerb/gatherAttendance">考勤汇总</a>
     					</li>
     					<li role="presentation">
     						<a href="/index.php/viewerb/gatherClear">清人汇总</a>
     					</li>
     				</ul>
     			</div>
 				<div class="col-md-9">
 					<div class="main">
 						<form class="form-horizontal">
 							<div class="selectbox">
 							<div class="form-group  pull-left">
 								<label for="" class="control-label pull-left">分组：</label>
 								<select for="" class="textbox">
   										<option>全部</option>
   										<option>PHP组</option>
 									 	<option>Web前端组</option>
 										<option>UI设计组</option>
   										<option>Android组</option>
 									 	<option>产品经理组</option>
 										<option>软件测试组</option>
 										<option>JAVA组</option>
								</select>
 							</div>
 							<div class="form-group pull-left">
 								<label for="" class="control-label pull-left">截止周数：</label>
 								<select for="" class="textbox">
   										<option>第100周</option>
 									 	<option>第99周</option>
 									 	<option>第98周</option>
 									 	<option>第97周</option>
 									 	<option>第96周</option>
								</select>
 							</div>
 							
 								<button type="submit" class="btn btn-default btn-select">确定</button>
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
 								<div class="pager"   id="pagination" name="pagination">
   				 			 	<!--js创建分页-->
 								</div>
					  		</nav>
 						</form>	
 					</div>
 				</div>
  			</div>
		</div>
		
		
		
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="../../../../bootstrap/bootstrap/js/bootstrap.min.js" ></script>

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
	var itable = document.getElementById("idData");
	
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


//
//	    $(document).ready(function(){
//		var rmval = ;
//      $(".btn-rm").bind("click", function () {
//          $.ajax({
//				type:"post",
//      		url:"/api/admin/kick_sum.php?session=" +session_id+ "&user_id=" ,
//         		dataType:'json',   		
//    			success:function(json){
//    				alert("!!!!");
//    				
//    				
//    		}
//      });
//     
//  });

function weeknum(){
//	var nw = document.getElementById("nw");
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

		var session_id = "<?php echo $session_id; ?>";  //获取动态id
		var identity = "<?php echo $_SESSION['admin']['auth'];?>";  //访问身份
		var mentor_group = "<?php echo $_SESSION['admin']['group']; ?>";
		var user_group=  "<?php switch ($group) {
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
                         } ?>";
		var week_num = weeknum();
//		var ithead = document.getElementById("ithead");
//        			ithead.innerHTML ="<tr><th>分组</th><th>昵称</th><th>QQ号</th><th>第"+
//        			 week_num+"周</th><th>第"+(week_num-1)+"周</th><th>第"+(week_num-2)+"周</th><th>第"+(week_num-3)+"周</th><th>操作</th></tr>" ;

		var allnumb =0;
				
		if (identity =="3" || identity =="2") {
				$.ajax({
				type:"get",
        		url:"/api/admin/show_weekly.php?session="+session_id,
           		dataType:'json',   		
      			success:function(json){
      				var num = json["data"].length;
      				var pageSize = 5;	   //每页显示行数  
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
          			 	            	"<td>"+ json["data"][i].name + "</td>" +
          			 	             	"<td>"+ json["data"][i].week_num + "</td>" +
          			 	            	"<td>"+ status(json["data"][i].status) + "</td>" +
          			 	            	"<td>"+ json["data"][i].text+ "</td></tr>"; 
          			 	            	
	};
						//回调函数，在这里写相关显示传参数

							var numb = itable.rows.length;   //表格所有行数(所有记录数)
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
        		url:"/api/admin/show_weekly.php?week=" +week_num+ "&group=" +mentor_group+ "&session="+session_id,
           		dataType:'json',   		
      			success:function(json){
      				var num = json["data"].length;
      				var pageSize = 5;	   //每页显示行数  
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
          			 	            	"<td>"+ json["data"][i].name + "</td>" +
          			 	             	"<td>"+ json["data"][i].week_num + "</td>" +
          			 	            	"<td>"+ status(json["data"][i].status) + "</td>" +
          			 	            	"<td>"+ json["data"][i].text+ "</td></tr>"; 
          			 	            	
					};
						//回调函数，在这里写相关显示传参数

							var numb = itable.rows.length;   //表格所有行数(所有记录数)
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
			};

      };
					
		

			
</script>
	</body>
</html>
