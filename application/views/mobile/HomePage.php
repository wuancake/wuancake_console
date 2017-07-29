<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>HomePage</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/base.css" />
    <link rel="stylesheet" href="/public/css/public.css" />
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


	</head>
  	<body> 
  		<div class="title">
    	<button id="showSideBar" v-on:click="showSideBar"><span id="rotateBtn" class="iconfont icon-tab"></span></button>
      <h2>午安煎饼计划</h2>
      </div>
<div class="homepage">
<div class="timeboxout  ball">
    	<div class="timeboxmiddle ball">
    		<div class="timeboxin">
    			<div class="box">
					<div class="percent">
						<p id="prompt1">第<span id="nw">51</span>周</p>
						<p id="prompt2">本周剩余时间</p>
						<p id="prompt3"><span id="days">0</span>天<span id="hours">0</span>小时<span id="minutes">0</span>分<span id="seconds">0</span>秒</p>
					</div>
					<div id="water" class="water ball">
						<svg viewBox="0 0 560 20" class="water_wave water_wave_back ball">
						    <use xlink:href="#wave"></use>
						</svg>
						<svg viewBox="0 0 560 20" class="water_wave water_wave_front ball">
						    <use xlink:href="#wave"></use>
						</svg>
					</div>
				</div>
	    	</div>
    	</div>
    </div>
    <p class="userMessage"><span>产品经理组</span>：<span>二马</span></p>
    <!--<router-link v-bind:to="writeWeekly"><button id="pushweekly" class="center-block" type="submit">提交周报</button></router-link>-->
    <router-link v-bind:to="writeWeekly"><button id="myweeklybtn" class="center-block" type="submit">我的周报</button></router-link>
    <router-link v-bind:to="Leave"><button id="askleave" class="center-block" type="submit">我要请假</button></router-link>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" style="display: none;">
		<symbol id="wave">
		    <path d="M420,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C514,6.5,518,4.7,528.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H420z"></path>
		    <path d="M420,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C326,6.5,322,4.7,311.5,2.7C304.3,1.4,293.6-0.1,280,0c0,0,0,0,0,0v20H420z"></path>
		    <path d="M140,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C234,6.5,238,4.7,248.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H140z"></path>
		    <path d="M140,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C46,6.5,42,4.7,31.5,2.7C24.3,1.4,13.6-0.1,0,0c0,0,0,0,0,0l0,20H140z"></path>
		</symbol>
	</svg>
</div>
	
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/public/js/ball.js" ></script>
  	
  
  	</body>
</html>



<!--

20 = {波浪1   		#ff9753
		      波浪2  		  #fe6c0d
	           边    框       	  #fe6c0d  
		     底    色       	  #fe6c0d}
		     
		     
50 = {波浪1   		#7befaa
		      波浪2  		  #2edb75
	           边    框       	  #2edb75  
		     底    色       	  #2edb75}
		     

40 = {波浪1 740   .water_wave_back     #ffd762
		     波浪2 746   .water_wave_front    #fbbc05
	           边框      654   timeboxout           #fbbc05     
		     底色      719   .water               #fbbc05}
-->