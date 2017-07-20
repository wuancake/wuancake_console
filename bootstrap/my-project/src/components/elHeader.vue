<template>
  <div class="header">
    <div class="title">
    	<button id="showSideBar" v-on:click="showSideBar"><span id="rotateBtn" class="glyphicon glyphicon-ok form-control-feedback iconfont icon-tab"></span></button>
      <h2>{{ title }}</h2>
    </div>
    <div class="sidebar" style="display: none;">
    	<div class="left">
    		<img />
    	  <p><span>产品经理组</span>：<span>二马</span></p>
    	  <ul>
    		  <li v-on:click="changeUI1"><router-link v-bind:to="headerToMyWeekly" class="aLink">我的周报</router-link></li>
    		  <li v-on:click="changeUI2"><router-link v-bind:to="headerToChangePassWord" class="aLink">修改密码</router-link></li>
    	  </ul>
    	<button>退出</button>
    	</div>
    	<div class="right">
    		<button></button>
    	</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'header',
  data () {
    return {
      title: '午安煎饼计划',
      headerToMyWeekly: '/MyWeekly',
      headerToChangePassWord: '/ChangePassWord'
    }
  },
  methods: {
  	showSideBar: function () {
		  var sideBarBtn = document.getElementById("rotateBtn");
		  var sideBar = document.getElementsByClassName("sidebar")[0];
		  if (sideBar.style.display == 'none') {
		  	sideBarBtn.style.transform = "rotate(90deg)";
  	    sideBar.style.display = "block";
		  } else{
		  	sideBarBtn.style.transform = "rotate(0deg)";
  	    sideBar.style.display = "none";
		  }
		  
  		
  	},
  	changeUI1: function () {
  		var alink = document.getElementsByClassName("aLink");
  		var sideBarBtn = document.getElementById("rotateBtn");
		  var sideBar = document.getElementsByClassName("sidebar")[0];
  		alink[1].style.color = "#999999";
  		alink[1].style.backgroundColor = "white";
  		alink[0].style.color = "#116bff";
  		alink[0].style.backgroundColor = "#f2f7fe";
  		sideBarBtn.style.transform = "rotate(0deg)";
  		sideBar.style.display = "none";
  	},
  	changeUI2: function () {
  		var alink = document.getElementsByClassName("aLink");
  		var sideBarBtn = document.getElementById("rotateBtn");
		  var sideBar = document.getElementsByClassName("sidebar")[0];
  		alink[0].style.color = "#999999";
  		alink[0].style.backgroundColor = "white";
  		alink[1].style.color = "#116bff";
  		alink[1].style.backgroundColor = "#f2f7fe";
  		sideBarBtn.style.transform = "rotate(0deg)";
  		sideBar.style.display = "none";
  	}
  }
}
</script>

<style scoped>
@import url("../../static/css/base.css");
@import url("../../static/css/public.css");
h2{margin: 0;padding: 0;}
.header{
	position: absolute;
	z-index: 5;
	margin-bottom: 0;
}
.title{
	position: absolute;
	width: 100vw;
	z-index: 9999;
}
.title > h2{
	color: white;
	padding: 1.03125rem;
	font-size: 1.125rem;
	background-color: #4285f4;
}
#showSideBar{
	position: absolute;
	top: 50%;left: 0.9375rem;
	transform: translateY(-50%);
	color: white;
	width: 34px;height: 34px;
	border: none;
	background-color: rgba(0,0,0,0);
	padding: 0;
}
.sidebar{
	background-color: rgba(0,0,0,0.5);
	width: 100vw;height: 100vh;
	box-sizing: border-box;
	position: relative;
}
.left{
	width: 56%;height: 100%;
	background-color: white;
	padding-top: 5.1875rem;
	box-sizing: border-box;
}
.right{
	width: 44%;height: 100%;
	box-sizing: border-box;
	position: absolute;
	top: 0;right: 0;
}
.right > button{
	padding: 0;border: none;
	height: 100%;width: 100%;
	background-color: rgba(0,0,0,0);
}
.left img{
	display: block;
	width: 5.3125rem;height: 5.3125rem;
	border-radius: 50%;
	background-color: #42B983;
	margin-left: auto;
	margin-right: auto;
	margin-bottom: 1.4375rem;
}
.left p{
	font-size: 1rem;
	color: #222222;
	margin-bottom: 1.25rem;
}
.left ul{
	list-style: none;
	padding: 0;
	color: #999999;
	font-size: 1.09375rem;
	margin-bottom: 7rem;
}
.aLink{
	background-color: white;
	height: 100%;width: 100%;
	padding-top: 0.9375rem;
	padding-bottom: 0.9375rem;
	display: block;
	color: #999999;
}
.aLink:link,.aLink:hover,.aLink:visited,.aLink:active{
	text-decoration: none;
}
.left button{
	background-color: #ADCCFF;
	color: #666666;
	border: none;
	font-size: 1.09375rem;
	padding: 0.59375rem 1.34375rem;
	border-radius: 4px;
}
</style>