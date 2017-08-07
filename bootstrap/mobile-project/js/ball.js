			var days = document.getElementById("days"),
			hour = document.getElementById("hours"),
			minutes = document.getElementById("minutes"),
			seconds = document.getElementById("seconds");
			var nwweek = document.getElementById("prompt1");
			var countdown = document.getElementById("prompt3");
			var water = document.getElementById("water");
			var ballchange = document.getElementsByClassName("ball");
			var timeRate;
			var interval;
			
			var showSideBar1 = document.getElementById("showSideBar1");
			var showSideBar2 = document.getElementById("showSideBar2");
			var sidbox = document.getElementById("sid-box");

			
			
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
				countdown.innerHTML =  day + "天" + hours  + "时" + minuter + "分" + second + "秒" ;
				
				
				return (day * 24 * 60 * 60 + hours * 60 * 60 + minuter * 60 + second) / 604800 * 100;
			
			}	
				



			//球面颜色变化

			interval = setInterval(function () {
				timeRate = residueTime();
				water.style.transform = 'translate(0' + ',' + (100 - timeRate) + '%)';
				if (timeRate == 0) {
			      document.getElementsByTagName("svg")[0].innerHTML = "";
			      document.getElementsByTagName("svg")[1].innerHTML = "";
			      clearInterval(interval);
			    }
				else if(timeRate >50) {
   				  ballchange[0].style.border = "1px solid #2edb75";
   				  ballchange[1].style.background = "-webkit-linear-gradient(top,#ffffff,#2edb75)";
   				  ballchange[2].style.background = "#2edb75";
   				  ballchange[3].style.fill = "#7befaa";
   				  ballchange[4].style.fill = "#2edb75";
			   }
				else if(timeRate <= 50 && timeRate > 20) {
   				  ballchange[0].style.border = "1px solid #fbbc05";
   				  ballchange[1].style.background = "-webkit-linear-gradient(top,#ffffff,#fbbc05)";
   				  ballchange[2].style.background = "#fbbc05";
   				  ballchange[3].style.fill = "#ffd762";
   				  ballchange[4].style.fill = "#fbbc05";
			   }
				else{
   				  ballchange[0].style.border = "1px solid #fe6c0d";
   				  ballchange[1].style.background = "-webkit-linear-gradient(top,#ffffff,#fe6c0d)";
   				  ballchange[2].style.background = "#fe6c0d";
   				  ballchange[3].style.fill = "#ff9753";
   				  ballchange[4].style.fill = "#fe6c0d";
			   }
			},500);
			

		
//title
    