<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>AddAdmin</title>
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/public/Admin/css/public.css" />
		
	</head>
	<body>
		<div class="addadmin">
			<div class="title">
					<div class="pull-left">考勤系统管理后台</div>
					<div class="post pull-right">
                        <?php
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
     				<ul class="nav  nav-stacked">
     					<li role="presentation"  class="active">
     						<a href="/index.php/viewerb/addAdmin" >新增管理员</a>
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
 
 					<div class="main">
 						<form class="content" action="/index.php/admin/create_admin" method="post">
 							<div class="textframe  clearfix">
 								<label for="" class="pull-left">昵称：</label>
 								<input type="text" class="textbox" placeholder="" name="name" style="-webkit-box-shadow: 0px 0px 0px 50px #ffffff inset;">
 									
 								<label for="" class="pull-left">邮箱：</label>
 								<input type="email" class="textbox" placeholder="" name="email" style="-webkit-box-shadow: 0px 0px 0px 50px #ffffff inset;">

   								<label for="" class="pull-left">密码：</label>
   								<input type="password" class="textbox" placeholder="" name="password">

                         	    <input type="hidden" name="auth" value="2">
     						  	<button type="submit" class="btn btn-default btn-register text-center">创建</button>
  							</div>
 						</form>	
 					</div>
 				</div>
	</body>
</html>

