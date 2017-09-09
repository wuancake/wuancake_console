<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>AddMentor</title>
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/public/Admin/css/public.css" />
		
		
		
	</head>
	<body>
		<div class="addmentor container-fluid">
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
 						<form class="form-horizontal" action="/index.php/admin/create_admin" method="post">
 							<div class="textframe">
 								<label for="" class="col-md-3 control-label">昵称：</label>
 								<div class="col-md-9">
 									<input type="text" class="form-control textbox" placeholder="" name="name">
 								</div>
 							</div>
 							<div class="textframe">
 								<label for="" class="col-md-3 control-label">邮箱：</label>
 								<div class="col-md-9">
 									<input type="email" class="form-control textbox" placeholder="" name="email">
 								</div>
 							</div>
   							<div class="textframe">
   								<label for="" class="col-md-3 control-label">密码：</label>
   								<div class="col-md-9">
   									<input type="password" class="form-control textbox" placeholder="" name="password">
   								</div>
   							</div>
   							<div class="textframe">
   								<label for="" class="col-md-3 control-label">分组：</label>
   								<div class="col-sm-9">
   									<select for="" class="textbox" name="group">
   										<option value="1">PHP组</option>
 									 	<option value="2">Web前端组</option>
 										<option value="3">UI设计组</option>
   										<option value="4">Android组</option>
 									 	<option value="5">产品经理组</option>
 										<option value="6">软件测试组</option>
 										<option value="7">JAVA组</option>
									</select>
   								</div>
   							</div>
                            <input type="hidden" name="auth" value="1">
   							<div class="textframe">
  								<div class="col-md-offset-3 col-md-10">
     						  		<button type="submit" class="btn btn-default btn-register text-center">登录</button>
  								</div>
  							</div>
 						</form>	
 					</div>
 				</div>
  			</div>
		</div>
	</body>
</html>
