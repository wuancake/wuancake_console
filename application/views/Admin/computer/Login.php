<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Login</title>
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/public/User/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/public/Admin/css/public.css" />
		

	</head>
	<body>
		<div class="login container-fluid">
			<div class="floor"></div>
 			<div class="main">
 				<h1 class="text-center">午安煎饼计划考勤系统管理后台</h1>
 				<form class="form-horizontal" action="/index.php/admin/login" method="post">
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
  						<div class="col-md-offset-3 col-md-10">
     				 		<button type="submit" class="btn btn-default btn-register text-center">登 录</button>
  						</div>
  					</div>
 				</form>
 			</div>
		</div>
	</body>
</html>
