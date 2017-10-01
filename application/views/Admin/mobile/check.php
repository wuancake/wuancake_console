<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>学员检索</title>
		<!--<link rel="stylesheet" href="/public/User/mobile/css/base.css" />-->
    	<link rel="stylesheet" href="/public/User/mobile/css/base.css" />


	</head>
	
	<style>
        .check_sel{
            border: 1px solid #47acff;margin-top: 100px;padding: 20px;text-align: center;
        }
		.title{
			width: 100%;
			background-color: #418afe;
			left: 0;
			
		}
		
		.models_check{
			padding-top: 4rem;
		}
		
		.models_check h4{
			text-align: center;
		}
		
		.models_check .from-group {text-align: center;}
		
		.models_check .qq-text{
			text-align: center;
			width: 80%;
   			border-color: #bfbfbf;
    		height: 2.75rem;
    		font-size: 1rem;
    		box-sizing: border-box;
    		background-color: rgba(0,0,0,0);
    		border: 1px solid #adccff;
   		 	box-shadow: 0px 0px 1px rgba(129, 190, 255, 0.84);
		}
		
		.models_check .center-block{
			padding-top: 2rem;
			text-align: center;
		}
		
		
		.models_check .btn{
			border: 1px solid #47acff ;
			background-color:  #418afe;
			color: #ffffff;
			border-radius: 0;
			letter-spacing:2px;
			padding:0.5rem 2.6rem;
		}	

	</style>
	
	<body>
		<div class="title">
      		<h2>午安考勤管理系统</h2>
    	</div>
		<div class="models_check">
  			<form action="/admin/check" method="post">
 				<h4>学员检索</h4>
				<div class="from-group ">
 					<input type="text" class="qq-text form-control text-center" placeholder="输入QQ信息" name="qq">
 				</div>
 				<div class="center-block">
   					<button type="submit" class="btn">检索</button>
				</div>
                <?php
                if (!empty($info)){
                    foreach ($info as $key=>$value) {
                        echo
                        "<div class=\"check_sel\">
                                    <p>QQ：{$value['qq']}</p>
   									<p>学员：{$value['name']}</p>
   									<p>组别：{$value['group']}</p>
   									</div>";
                    }
                }
                if (!empty($message)){
                    echo "
                                        <div class=\"check_sel\">
                                        <p>$message</p>
                                        </div>";
                }
                ?>
 			</form>	
		</div>
	</body>
</html>
