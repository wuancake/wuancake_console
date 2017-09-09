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
		<div class="addadmin container-fluid">
			<div class="row title">
				<div class="col-md-12">
					<h1 class="col-md-7 text-left">考勤系统管理后台</h1>
					<div class="col-md-5 post text-right">管理员:陶陶
						 <a href="#" class="glyphicon glyphicon-arrow-right">登出</a>
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
 							<div class="textframe">
 								<label for="" class="col-md-3 control-label">昵称：</label>
 								<div class="col-md-9">
 									<input type="text" class="form-control textbox" placeholder="">
 								</div>
 							</div>
 							<div class="textframe">
 								<label for="" class="col-md-3 control-label">邮箱：</label>
 								<div class="col-md-9">
 									<input type="email" class="form-control textbox" placeholder="">
 								</div>
 							</div>
   							<div class="textframe">
   								<label for="" class="col-md-3 control-label">密码：</label>
   								<div class="col-md-9">
   									<input type="password" class="form-control textbox" placeholder="">
   								</div>
   							</div>
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

