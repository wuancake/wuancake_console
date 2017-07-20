<template>
<div class="homepage">
<div class="timeboxout">
    	<div class="timeboxmiddle">
    		<div class="timeboxin">
    			<div class="box">
					<div class="percent">
						<p id="prompt1">第<span id="nw">51</span>周</p>
						<p id="prompt2">本周剩余时间</p>
						<p id="prompt3"><span id="days">1</span>天<span id="hours">4</span>小时<span id="minutes">20</span>分<span id="seconds">15</span>秒</p>
					</div>
					<div id="water" class="water">
						<svg viewBox="0 0 560 20" class="water_wave water_wave_back">
						    <use xlink:href="#wave"></use>
						</svg>
						<svg viewBox="0 0 560 20" class="water_wave water_wave_front">
						    <use xlink:href="#wave"></use>
						</svg>
					</div>
				</div>
	    	</div>
    	</div>
    </div>
    <p class="userMessage"><span>产品经理组</span>：<span>二马</span></p>
    <router-link v-bind:to="writeWeekly"><button id="pushweekly" class="center-block" type="submit">提交周报</button></router-link>
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
</template>

<script>
export default {
  name: 'homepage',
  data () {
    return {
      userEmail: '',
      userPassWord: '',
      path: '',
      writeWeekly: '/writeWeekly',
      Leave: '/Leave'
    }
  },
  methods: {
  	init () {
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
  	},
  	//获取本地用户信息
    getLocalStorage: function () {
    	if (typeof(Storage) !== 'undefined') {
    		if (localStorage.getItem("userEmail") !== null) {
    			this.userEmail = localStorage.getItem("userEmail")
    			this.userPassWord = localStorage.getItem("userPassWord")
    		} else{
    			this.$router.push({
    				path: '/Login'
    			})
    		}
    	}
    }
  },
  mounted () {
  	this.getLocalStorage(),
  	this.init()
  }
}
</script>

<style scoped>
.homepage{
	padding-top: 5.25rem;
}
.box{width: 56%; background-color: white;height: 100%;}
.timeboxout{
	width: 11.5625rem;
	height: 11.5625rem;
	box-sizing: border-box;
	border: 1px solid #f8cd51;
	border-radius: 50%;
	position: relative;
	margin-left: auto;margin-right: auto;
	margin-bottom: 1rem;
}
.timeboxmiddle{
	width: 10.9375rem;height: 10.9375rem;
	box-sizing: border-box;
	background: -webkit-linear-gradient(top,white,#f8cd51);
	border-radius: 50%;
	position: absolute;
	top: 50%;left: 50%;
	transform: translate(-50%, -50%);
	overflow: hidden;
}
.timeboxin{
	background-color: white;
	width: 10.875rem;height: 10.875rem;
	box-sizing: border-box;
	border-radius: 50%;
	position: absolute;
	top: 50%;left: 50%;
	transform: translate(-50%, -50%);
	overflow: hidden;
}
    	
.box {
    height: 10.875rem;
    width: 10.875rem;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 100%;
    overflow: hidden;
}
.box .percent {
   text-align: center;
   color: black;
   margin-top: 2.03125rem;
   z-index: 3;
   position: absolute;
   left: 50%;
   transform: translateX(-50%);
   height: 100%;width: 100%;
}
p{margin-bottom: 0.5625rem;}
#prompt1{
	font-size: 1.1875rem;
}
#prompt2{
	font-size: 0.8125rem;
}
#prompt3{
	font-size: 1.125rem;
}
.box .water {
	position: absolute;
	left: 0;
	top: 0;
	z-index: 2;
	width: 100%;
	height: 100%;
	-webkit-transform: translate(0, 100%);
	transform: translate(0, 100%);
	background: #fbbc05;
}
.box .water_wave {
	width: 200%;
	position: absolute;
	bottom: 100%;
}
.box .water_wave_back {               /*后面的波纹*/
	right: 0;
	fill: #ffc762;
	-webkit-animation: wave-back 1.4s infinite linear;
	animation: wave-back 1.4s infinite linear;
}
.box .water_wave_front {              /*前面的波纹*/
	left: 0;
	fill: #fbbc05;
	margin-bottom: -1px;
	-webkit-animation: wave-front .7s infinite linear;
	animation: wave-front .7s infinite linear;
}
@-webkit-keyframes wave-front {
	100% {
		-webkit-transform: translate(-50%, 0);
		transform: translate(-50%, 0);
	}
}
@keyframes wave-front {
	100% {
		-webkit-transform: translate(-50%, 0);
		transform: translate(-50%, 0);
	}
}
@-webkit-keyframes wave-back {
	100% {
		-webkit-transform: translate(50%, 0);
		transform: translate(50%, 0);
	}
}
@keyframes wave-back {
	100% {
		-webkit-transform: translate(50%, 0);
		transform: translate(50%, 0);
	}
}
#pushweekly{
    width: 77%;
    font-size: 1.1875rem;
    color: white;
    background-color: #adccff;
    height: 2.625rem;
    border: none;
    border-radius: 1.3125rem;
    margin-bottom: 1.75rem;
}
#askleave{
    width: 77%;
    font-size: 1.1875rem;
    color: #4285f4;
    background-color: rgba(0,0,0,0);
    height: 2.625rem;
    border: 1px solid #4285f4;
    border-radius: 1.3125rem;
    box-sizing: border-box;
}
#myweekly{
    width: 77%;
    font-size: 1.1875rem;
    color: white;
    background-color: #4285f4;
    height: 2.625rem;
    border: none;
    border-radius: 1.3125rem;
}
#noleave{
    width: 77%;
    font-size: 1.1875rem;
    color: #4285f4;
    background-color: white;
    height: 2.625rem;
    border: 1px solid #4285f4;
    border-radius: 1.3125rem;
    box-sizing: border-box;
}
.userMessage{
    font-size: 0.84375rem;
    color: #b6b6b6;
    margin-bottom: 2.4375rem;
}
</style>