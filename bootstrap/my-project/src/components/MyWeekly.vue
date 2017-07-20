<template>
<div class="myweekly">
	<div class="btn-pull">下拉显示上一周</div>
	<form role="form"  class="info-box my-weekly-box">
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">周数：</label>
    					<span class="la-horizontal-right">82周</span>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">提交时间：</label>
    					<time class="la-horizontal-right">2017/6/20日 11:15:20分</time>
  				</div>
  				<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">本周完成：</label>
    					<textarea class="form-control" rows="6"></textarea>
  				</div>
					<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">所遇到问题：</label>
    					<textarea class="form-control" rows="6"></textarea>
  				</div>
					<div class="form-group la-horizontal">
    					<label class="la-horizontal-left">下周计划：</label>
    					<textarea class="form-control" rows="6"></textarea>
  				</div>
  				
		</form>
		<div class="btn-pull next">上拉显示下一周</div>
</div>
</template>

<script>
export default {
  name: 'myweekly',
  data () {
    return {
      title: '午安煎饼计划'
    }
  }
}
</script>

<style scoped>
@import url("../../static/css/base.css");
@import url("../../static/css/public.css");
.myweekly{
	padding-top: 3.25rem;
	width: 100%;height: 100%;
	position: relative;
}
.form-group{
	overflow: hidden;
}
.btn-pull{
	color: #cfcfcf;
}
.next{
	position: absolute;
	bottom: 0.5rem;
	left: 50%;
	transform: translateX(-50%);
}
</style>