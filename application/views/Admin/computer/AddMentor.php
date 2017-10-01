<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>新增导师</title>
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/public/Admin/css/public.css" />
		<link rel="shortcut icon" type="image/x-icon"  href="/public/Admin/img/wuanico.ico" />
		
		
	</head>
	<body>
		<div class="addmentor">
			<div class="title">
					<div class="pull-left">考勤系统管理后台</div>
					<div class="post pull-right">  <?php
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
						 <a href="/admin/quit" class="glyphicon glyphicon-arrow-right">登出</a>
					</div>
			</div>

     			<div class="sidebar">
     				<ul class="nav nav-stacked">
                        <?php
                        if ($_SESSION['admin']['auth'] == 3){
                            ?>
                            <li role="presentation">
                                <a href="/viewerb/addAdmin" >新增管理员</a>
                            </li><?php }?>
                        <?php
                        if ($_SESSION['admin']['auth'] != 1){
                            ?>
                            <li role="presentation" class="active">
                                <a href="/viewerb/addMentor">新增导师</a>
                            </li><?php }?>
     					<li role="presentation">
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
 						<form class="content"  action="/admin/create_admin" method="post">
 							<div class="textframe clearfix">
 								<label for="" class="pull-left">昵称：</label>
 								<input type="text" class="textbox pull-left" placeholder="" name="name" style="-webkit-box-shadow: 0px 0px 0px 50px #ffffff inset;">
 									
 								<label for="" class="pull-left">邮箱：</label>
 								<input type="email" class=" pull-left textbox" placeholder="" name="email" style="-webkit-box-shadow: 0px 0px 0px 50px #ffffff inset;">
 									
 								<label for="" class="pull-left">密码：</label>
 								<input type="password" class="pull-left textbox" placeholder="" name="password">

   								<label for="" class="pull-left">分组：</label>
   								<select for="" class="textbox" name="group">
   										<option value="1">PHP组</option>
 									 	<option value="2">Web前端组</option>
 										<option value="3">UI设计组</option>
   										<option value="4">Android组</option>
 									 	<option value="5">产品经理组</option>
 										<option value="6">软件测试组</option>
 										<option value="7">JAVA组</option>
								</select>
   				

                            <input type="hidden" name="auth" value="1">
                            	
                            <button type="submit" class="btn btn-default btn-register text-center">创建</button>

  							</div>
 						</form>	
 					</div>
		</div>
	</body>
</html>
