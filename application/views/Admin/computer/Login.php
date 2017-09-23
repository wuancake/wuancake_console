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
		<div class="login">
			<div class="floor"></div>
 			<div class="main">
 				<h1 class="text-center">午安煎饼计划考勤系统管理后台</h1>
 				<form  action="/admin/login" method="post">
 					<div class="textframe clearfix">
 						<label for="" class="pull-left" >邮箱：</label>
 						<input type="email"  class="pull-left textbox" placeholder="" name="email" style="-webkit-box-shadow: 0px 0px 0px 50px #f5f9ff inset;">
 							
 						<label for="" class="pull-left">密码：</label>
 						<input type="password" class="textbox" placeholder="" name="password">
 							
 						<button type="submit" class="btn btn-default btn-register">登 录</button>
  					</div>
 				</form>
 			</div>
		</div>
	</body>
</html>
