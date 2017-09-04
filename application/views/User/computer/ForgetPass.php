<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>forgetpassword</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/User/computer/css/base.css" />
    <link rel="stylesheet" href="/public/User/computer/css/public.css" />
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    


	</head>
	
	
	
	
  <body> 
<!--左边-->
  	<div class="sidebar">
  		
  		<!--导航上层-->
  		<div  class="sidebar-top">
  		<!--午安icon-->
				<div class="media logo">
				</div>
				
				<!--我的信息-->
				<div class="media myinfo">
  				<div class="media-left">
  				   <a href="#"><img class="media-object portrait" src="/public/User/computer/img/logo.png" alt="我的头像"></a>
  				</div>
 					 <div class="media-body">
   				 <h4 class="media-heading"><?php echo $username; ?></h4>
                         <?php
                         switch ($group) {
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
                         } ?>
  				</div>
  				<div class="media-right">
  				   <a href="/index.php/user/quit">
  				   	<span class="glyphicon iconfont icon-fenxiang"></span>
  				   </a>
  				</div>
				</div>
				
				<!--导航-->
  			<ul class="nav nav-pills nav-stacked">
 					<li role="presentation" class="active">
 							<a href="/index.php/viewer/index" class="text-center"><span class="glyphicon iconfont icon-shouye"></span>首页</a>
 					</li>
 					<li role="presentation">
 							<a href="/index.php/viewer/show_weekly" class="text-center"><span class="glyphicon iconfont icon-wo"></span>我的周报</a>
 					</li>
 					<li role="presentation">
 							<a href="/index.php/viewer/change_psd" class="text-center"><span class="glyphicon iconfont icon-icon28"></span>修改密码</a>
 					</li>
				</ul>
				</div>
				
				
			<!--导航底层-->
			<div class="sidebar-bottom"></div>
		</div>
		
		
<!--右边	-->	
		 <div class="right-part">

			
			<div class="forgetpass">
				
				<form class="form-inline" action="/index.php/user/recover_psd" method="post">
  					<div class="form-group">
      							<input type="text" class="form-control" id="exampleInputAmount" placeholder="注册时电子邮箱" name="email">
  					</div>
 						<button type="submit" class="btn btn-primary "><span class="glyphicon iconfont icon-iconfontjiantou-copy"></span></button>
				</form>

				
				<div class="remind-box">
					 <span class=" iconfont icon-quandian"></span>
					 <span class="remind">提交后我们将修改密码的地址以电子邮件的形式发送到您的邮箱中，请注意查收！</span>
				</div>
				
		</div>
		
		
		
		</div>

		
	
		

	
	
	
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>
