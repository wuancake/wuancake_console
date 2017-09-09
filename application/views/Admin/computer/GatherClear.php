<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GatherClear</title>
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/public/Admin/css/public.css" />
		
		
		
	</head>
	<body>
		<div class="gatherclear container-fluid">
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
 							<table class="table table-striped  table-bordered  text-center">
				 				<thead>
				 					<tr>
				 						<th>分组</th>
        		     					<th>昵称</th>
        		     					<th>QQ号</th>
        		    					<th>操作人</th>
        		    	 				<th>操作数时间</th>
     			     				</tr>
				 				</thead>
				 				<tbody id="idData">
  			    				  	<!--sql数据库数据查询-->
  			    				  	<tr>
  			    				  		<td>产品经理组</td>
        		    	  				<td>88</td>
        		    	 			 	<td>表格单元格表格单元格表格单元格</td>
        		    					<td>已提交</td>
        		    					<td>表格单元格</td>
      		    	 				</tr>
      		    					<tr>
      		      						<td>表格单元格表格单元格表格</td>
       		      						<td>表格单元格</td>
       		     						<td>表格单元格</td>
       		      						<td>周报状态</td>
        		    					<td>提交时间</td>
     		     	    			</tr>
     		     	    			<tr>
      		     	   					<td>表格单元格</td>
      		     	 					<td>表格单元格</td>
       		     						<td>表格单元格表格单元格表格单元格表</td>
       		     						<td>周报状态</td>
        		    					<td>提交时间</td>
    		      					</tr>
    		      					<tr>
    		        	 		        <td>表格单元格</td>
       		     	            		<td>表格单元格</td>
       		     		 		       	<td>表格单元格</td>
       		     		 		       	<td>周报状态</td>
        	    		 		       	<td>提交时间</td>
     		     		 		    </tr>
     		     		 		    <tr>
    				        			<td>表格单元格</td>
       		     	    				<td>表格单元格</td>
       		     	       		     	<td>表格单元格</td>
       		     	       		     	<td>周报状态</td>
        	    	       		     	<td>提交时间</td>
     		     	    			</tr>
  			    	  			</tbody>
    	    	 			</table>
 						</form>	
 					</div>
 				</div>
  			</div>
		</div>
	</body>
</html>
