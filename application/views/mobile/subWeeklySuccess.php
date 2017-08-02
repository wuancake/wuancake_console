<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>subLeaveSuccess</title>

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
<div class="homepage subLeaveSuccess">
<div class="timeboxout">
    	
    		<div class="timeboxin">
    			<div class="box">
					<div class="percent">
      <p>第<span id="nw"><?php echo $week_num;?></span>周</p>
	  <p><?php echo $status;?></p>
    </div>
					<!--<div id="water" class="water">
						<svg viewBox="0 0 560 20" class="water_wave water_wave_back">
						    <use xlink:href="#wave"></use>
						</svg>
						<svg viewBox="0 0 560 20" class="water_wave water_wave_front">
						    <use xlink:href="#wave"></use>
						</svg>
					</div>-->
				</div>
	    	</div>
    
    </div>
    <p class="userMessage"><span><?php
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
            } ?></span>：<span><?php echo $username;?></span></p>
    <router-link v-bind:to="writeWeekly"><button id="myweeklybtn" class="center-block" type="submit">我的周报</button></router-link>
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
	
  	
  	<script type="text/javascript">
			var days = document.getElementById("days"),
			hour = document.getElementById("hours"),
			minutes = document.getElementById("minutes"),
			seconds = document.getElementById("seconds");
			var water = document.getElementById("water");
			var timeRate;
			var interval;
			interval = setInterval(function () {
				timeRate = residueTime();
				water.style.transform = 'translate(0' + ',' + (100 - timeRate) + '%)';
				if (timeRate == 0) {
			      document.getElementsByTagName("svg")[0].innerHTML = "";
			      document.getElementsByTagName("svg")[1].innerHTML = "";
			      clearInterval(interval);
			    }
			},500);
//			interval = setInterval(function() {
//			    percent--;
//			    cnt.innerHTML = percent;
//			    water.style.transform = 'translate(0' + ',' + (100 - percent) + '%)';
//			    if (percent == 0) {
//			        clearInterval(interval);
//			      document.getElementsByTagName("svg")[0].innerHTML = "";
//			      document.getElementsByTagName("svg")[1].innerHTML = "";
//			    }
//			}, 60);
			
			//计算剩余的时间并更新
			function residueTime () {
				var newtime = new Date();
				var day = newtime.getDay(); //得到今天周几
				var hours = newtime.getHours(); //得到现在时间的小时
				var minuter = newtime.getMinutes(); //得到现在时间的分数
				var second = newtime.getSeconds(); //得到现在时间的秒数
				day = 7 - (day ? day : 7);
				hours = 23 - hours;
				minuter = 59 - minuter;
				second = 59 - second;
				days.innerHTML = day;
				hour.innerHTML = hours;
				minutes.innerHTML = minuter;
				seconds.innerHTML = second;
				return (day * 24 * 60 * 60 + hours * 60 * 60 + minuter * 60 + second) / 604800 * 100;
			}
			
		</script>
  	</body>
</html>
