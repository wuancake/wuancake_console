<template>
<div class="leave">
	<form role="form"  class="info-box wri-vacation-box">
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">产品经理组：</label>
    					<span class="la-horizontal-right">二马</span>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">当前周数：</label>
    					<time class="la-horizontal-right">83周</time>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">请假状态：</label>
    					<time class="la-horizontal-right la-danger">未请假</time>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">请假周数：</label>
    					<select class="la-horizontal-right hori">
 									 <option>请假一周</option>
 									 <option>请假二周</option>
 									 <option>请假三周</option>
							</select>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">请假理由（必填）：</label>
    					<textarea class="form-control" rows="15"></textarea>
  				</div>
		</form>
		<router-link v-bind:to="backHome"><button id="pushLeave" class="center-block" type="submit">提交请假申请</button></router-link>
</div>
</template>

<script>
export default {
  name: 'leave',
  data () {
    return {
      title: '午安煎饼计划',
      backHome:'/'
    }
  }
}
</script>

<style scoped>
@import url("../../static/css/base.css");
@import url("../../static/css/public.css");
.leave{
	padding-top: 3.25rem;
	width: 100%;height: 100%;
}
#pushLeave{
	width: 77%;
	font-size: 1.125rem;
	background-color: #adccff;
	border: none;
	color: white;
	height: 2.5625rem;
	border-radius: 1.28125rem;
}
.form-group{
	overflow: hidden;
}
.hori{padding-bottom: 0.3rem;}
</style>