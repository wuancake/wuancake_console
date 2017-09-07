<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>grouping</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/User/mobile/css/base.css"/>
    <link rel="stylesheet" href="/public/User/mobile/css/public.css"/>

    <style>


    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
		<div class="title">
     	 <h2>选择分组</h2>
    	</div>


			<div class="grouping">
			<form  class="genre" action="/index.php/user/join_group" method="post">
							<table class="table table-striped  table-bordered  text-center">
  			    	  <tbody>
  			    	  	<tr>
    		        	 <td><input type="radio" name="genre" id="PHP" value="1"></td>
       		     	   <td>PHP组</td>
     		     	    </tr>
     		     	     <tr>
      		     	   <td><input type="radio" name="genre" id="Web" value="2"></td>
      		     	   <td>Web前端组</td>
    		      	  </tr>
    		      	  <tr>
      		      	 <td><input type="radio" name="genre" id="UI" value="3"></td>
       		      	 <td>UI设计组</td>
     		     	   </tr>
     		     	   <tr>
    		        	 <td><input type="radio" name="genre" id="Android" value="4"></td>
       		     	   <td>Android组</td>
     		     	   </tr>
    	 		    	  <tr>
      	 		    	  <td><input type="radio" name="genre" id="PM" value="5"></td>
        		    	  <td>产品经理组</td>
      		    	  </tr>
      		    	  <tr>
    		        	 <td><input type="radio" name="genre" id="QA" value="6"></td>
       		     	   <td>软件测试组</td>
     		     	    </tr>
     		     	    <tr>
    		        	 <td><input type="radio" name="genre" id="Java" value="7"></td>
       		     	   <td>JAVA组</td>
     		     	    </tr>
    		     	  </tbody>
    	    	  <table>
				
				<div class="center-block">
  	  	 <button id="genreBtn" type="submit" class="btn btn-default" >提交</button>
 				</div>
			</form>
			<p>警告：只能选择一次分组，请谨慎选择</p>		
		</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
