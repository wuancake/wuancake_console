<template>
<div class="askLeaveSuccess">
  <div class="timeboxout">
    <div class="percent">
      <p>第<span id="nw">51</span>周</p>
	  <p>本周已请假</p>
    </div>
  </div>
  <p class="userMessage"><span>产品经理组</span>：<span>二马</span></p>
  <router-link v-bind:to="toMyWeekly"><button id="myweekly" class="center-block" type="submit">我的周报</button></router-link>
  <router-link v-bind:to="removeLeave"><button id="removeleave" class="center-block" type="submit">取消请假</button></router-link>
</div>
</template>

<script>
export default {
  name: 'askLeaveSuccess',
  data () {
  	return {
  	  toMyWeekly: '/myWeekly',
  	  removeLeave: '/'
  	}
  }
}
</script>

<style scoped>
.askLeaveSuccess{
	padding-top: 5.25rem;
	height: 100%;width: 100%;
}
.timeboxout{
	width: 11.5625rem;
	height: 11.5625rem;
	box-sizing: border-box;
	border: 1px solid #abb9da;
	border-radius: 50%;
	position: relative;
	margin-left: auto;margin-right: auto;
	margin-bottom: 1rem;
}
.percent{
	font-size: 1.1875rem;
	color: #abb9da;
	width: 100%;
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
}
.userMessage{
    font-size: 0.84375rem;
    color: #b6b6b6;
    margin-bottom: 2.4375rem;
}
#myweekly{
    width: 77%;
    font-size: 1.1875rem;
    color: white;
    background-color: #4285f4;
    height: 2.625rem;
    border: none;
    border-radius: 1.3125rem;
    margin-bottom: 1.75rem;
}
#removeleave{
    width: 77%;
    font-size: 1.1875rem;
    color: #4285f4;
    background-color: rgba(0,0,0,0);
    height: 2.625rem;
    border: 1px solid #4285f4;
    border-radius: 1.3125rem;
    box-sizing: border-box;
}
</style>