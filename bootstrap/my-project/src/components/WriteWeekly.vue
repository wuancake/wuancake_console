<template>
<div class="writeweekly">
  <form role="form"  class="info-box wri-weekly-box">
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">产品经理组：</label>
    					<span class="la-horizontal-right">二马</span>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">当前周数：</label>
    					<time class="la-horizontal-right">82周</time>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">报告状态：</label>
    					<time class="la-horizontal-right la-danger">未提交</time>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">本周完成（必填）：</label>
    					<textarea class="form-control" rows="3"></textarea>
  				</div>
					<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">所遇到问题（必填）：</label>
    					<textarea class="form-control" rows="3"></textarea>
  				</div>
					<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">下周计划：</label>
    					<textarea class="form-control" rows="3"></textarea>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">作品链接：</label>
    					<textarea class="form-control" rows="1"></textarea>
  				</div>
		</form>
		<router-link v-bind:to="toSubmitted"><button id="pushweekly" class="center-block" type="submit">提交周报</button></router-link>
</div>
</template>

<script>
export default {
  name: 'writeweekly',
  data () {
    return {
      title: '午安煎饼计划',
      toSubmitted:'/submitted'
    }
  }
}
</script>

<style scoped>
@import url("../../static/css/base.css");
@import url("../../static/css/public.css");
.writeweekly{
	padding-top: 3.25rem;
	width: 100%;height: 100%;
}
.form-group{
	overflow: hidden;
}
#pushweekly{
	width: 77%;
	font-size: 1.125rem;
	background-color: #adccff;
	border: none;
	color: white;
	height: 2.5625rem;
	border-radius: 1.28125rem;
}
</style>