function weeknum(){
	var nw = document.getElementById("nw");
	// 获取当前时间
	var currentTime = new Date();
	// 这里写的是2015年11月2日0时0分0秒   Javascript中月份是实际数字减1，故指定日期月份减一，另获取到毫秒。
	var targetTime = (new Date(2015, 10, 2, 0, 0, 0)).getTime();
	var offsetTime =currentTime - targetTime;
 
	// 将时间转位天数
	var offsetDays =Math.floor((offsetTime / (3600 * 24 * 1000))/7);
	nw.innerHTML=offsetDays+1;
}
weeknum();

