			var days = document.getElementById("days"),
			hour = document.getElementById("hours"),
			minutes = document.getElementById("minutes"),
			seconds = document.getElementById("seconds");
			var countdown = document.getElementById("time");
			var timeRate;
			var interval;
			
	
			//计算剩余的时间并更新

		 
		 
			 function startCount() {
			 	
			 	var newtime = new Date();
				var day = newtime.getDay(); //得到今天周几
				var hours = newtime.getHours(); //得到现在时间的小时
				var minuter = newtime.getMinutes(); //得到现在时间的分数
				var second = newtime.getSeconds(); //得到现在时间的秒数

				day = 7 - (day ? day : 7);
				hours = 23 - hours;
				minuter = 59 - minuter;
				second = 59 - second;
				countdown.innerHTML =  day + "天&nbsp;&nbsp;"+  + hours  + ":" + minuter + ":" + second  ;
			 	
   				interval = countdown;
    			setTimeout("startCount()",1000);
    			
    			timeRate =  (day * 24 * 60 * 60 + hours * 60 * 60 + minuter * 60 + second) / 604800 * 100;
    			
    				if (timeRate == 0) {
			      		clearInterval(interval);
			  		  	}
    			
  				}
			 
			window.onload = function(){
 				 startCount()
				};