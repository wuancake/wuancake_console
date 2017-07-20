<template>
<div class="changepassword">
	<form role="form" class="info-box">
			<div class="form-group">
				<input type="password" class="form-control" placeholder="旧密码">
			</div>
			<div class="form-group has-success has-feedback">
   				<input type="password" class="form-control" placeholder="新密码" >
   				<span class="glyphicon glyphicon-ok form-control-feedback iconfont icon-icon-successful-1"></span>
  			</div>
			<div class="form-group has-error has-feedback">
   				<input type="password" class="form-control" placeholder="确认新密码">
    			<span class="glyphicon glyphicon-remove form-control-feedback iconfont icon-icon-dangerous-1"></span>  
  			</div>
		</form>
		<router-link v-bind:to="toLogin"><button id="pushPsaaWord" class="center-block" type="submit">提交</button></router-link>
</div>
</template>

<script>
export default {
  name: 'changepassword',
  data () {
    return {
      title: '午安煎饼计划',
      toLogin: '/Login'
    }
  }
}
</script>

<style scoped>
@import url("../../static/css/base.css");
@import url("../../static/css/public.css");
.changepassword{
	padding-top: 3.25rem;
	width: 100%;height: 100%;
}
#pushPsaaWord{
	width: 77%;
	font-size: 1.125rem;
	background-color: #adccff;
	border: none;
	color: white;
	height: 2.5625rem;
	border-radius: 1.28125rem;
	margin-top: 3.8125rem;
}
.form-group{
	margin-bottom: 2.5rem;
}
.info-box{
	padding-top: 3.625rem;
}
</style>