<template>
<div class="signup">
	<form role="form" class="info-box registered-box">
			<div class="form-group has-success has-feedback">
   				<input type="text" class="form-control" placeholder="用户名" >
   				<span class="glyphicon glyphicon-ok form-control-feedback iconfont icon-icon-successful-1"></span>
  			</div>
			<div class="form-group has-error has-feedback">
   				<input type="email" class="form-control" placeholder="电子邮箱">
    			<span class="glyphicon glyphicon-remove form-control-feedback iconfont icon-icon-dangerous-1"></span>  
  			</div>
			<div class="form-group">
			    <input type="text" class="form-control" placeholder="午安网昵称">
			</div>
			<div class="form-group">
			    <input type="text" class="form-control" placeholder="QQ">
			</div>
			<div class="form-group">
			    <input type="password" class="form-control" placeholder="密码">
			</div>
			<div class="form-group">
			    <input type="password" class="form-control" placeholder="确认密码">
			</div>
		</form>
		<router-link v-bind:to="bcckHome"><button id="signup" class="center-block" type="submit">注册</button></router-link>
		<div class="box">
			<span>已有帐号？</span><router-link v-bind:to="signupToLogin"><button class="btn btn-default">点击登录</button></router-link>
		</div>
</div>
</template>

<script>
export default {
  name: 'signup',
  data () {
    return {
      title: '午安煎饼计划',
      bcckHome: '/',
      signupToLogin: '/Login'
    }
  }
}
</script>

<style scoped>
@import url("../../static/css/base.css");
@import url("../../static/css/public.css");
.signup{
	padding-top: 4rem;
	width: 100%;height: 100%;
}
.box{
	color: #22AC38;
	font-size: 0.875rem;
}
#signup{
	width: 77%;
	font-size: 1.125rem;
	border: none;
	color: white;
	background-color: #adccff;
	padding-bottom: 0.75rem;
	padding-top: 0.75rem;
	border-radius: 1.3125rem;
}
.btn{
	font-size: 0.875rem;
	color: #22AC38;
	padding: 0.4375rem 0.671875rem;
	border-radius: 0.875rem;
}
.btn-default{
	border-color: #22AC38;
}
.box{
	margin-top: 2.5625rem;
	padding-right: 1rem;
	text-align: right;
}
button{
	outline: none;
}
</style>