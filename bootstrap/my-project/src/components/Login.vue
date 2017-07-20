<template>
<div class="login">
  <img src="../assets/logo.png"/>
  <form>
    <div class="from-group center-block">
      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="输入电子邮箱" v-model="userEmail">
    </div>
    <div id="inputPassWord" class="from-group center-block">
      <input type="password" class="form-control" id="exampleInputEmail1" placeholder="请输入密码" v-model="userPassWord">
    </div>
    <router-link v-bind:to="path"><button id="logBtn" type="submit" class="btn btn-default" v-on:click="login">登录</button></router-link>
  </form>
  <router-link id="LoginOfSignupBtn" v-bind:to="loginToSignup" type="submit" class="btn btn-link">注册</router-link>
  <router-link id="forgetPassword" v-bind:to="loginToChangePassWord" class="btn btn-default forgetPassword">忘记密码？</router-link>
</div>
</template>

<script>
export default {
  name: 'login',
  data () {
    return {
      userEmail: '',
      userPassWord: '',
      path: '',
      loginToSignup: '/Signup',
      loginToChangePassWord: '/ChangePassWord'
    }
  },
  methods: {
    //将用户信息存储到本地
    setLocalStorage: function () {
    	localStorage.userEmail = this.userEmail
    	localStorage.userPassWord = this.userPassWord
    },
    //登录验证
    login: function () {
  	  if (this.userEmail === '') {
  	  	alert('email不能为空')
  	  }
  	  if (this.userPassWord === '') {
  	  	alert('登录密码不能为空')
  	  }
  	  if (this.userEmail !== '' && this.userPassWord !== '') {
  	  	this.setLocalStorage()
  	  }
    }
  },
  watch: {
    userEmail: {
      handler: function (val, oldVal) {
        if (this.userEmail !== '' && this.userPassWord !== '') {
        	this.path = '/user/' + this.userEmail + '/PassWord/' + this.userPassWord
        }
      },
      deep: true
    },
    userPassWord: {
      handler: function (val, oldVal) {
        if (this.userEmail !== '' && this.userPassWord !== '') {
        	this.path = '/user/' + this.userEmail + '/PassWord/' + this.userPassWord
        }
      },
      deep: true
    }
  }
}
</script>

<style scoped>
  .login{
  	padding-top: 3.25rem;
  	width: 100%;height: 100%;
  }
  .login img{
  	width: 6.25rem;
  	height: 6.25rem;
  	margin-top: 1.875rem;
  	margin-bottom: 2.5rem;
  }
  .from-group{
  	width: 77%;
  }
  #inputPassWord{
  	margin-top: 1.5625rem;
  	margin-bottom: 0.9375rem;
  }
  .form-control{
  	border-radius: 1.375rem;
  	border-color: #adccff;
  	height: 2.75rem;
  	font-size: 1rem;
  	box-sizing: border-box;
  }
  #logBtn{
  	width: 69%;
  	font-size: 1.125rem;
  	color: white;
  	background-color: #adccff;
  	height: 2.5rem;
  	border-radius: 1.25rem;
  	box-sizing: border-box;
  	border: none;
  }
  .btn-link{
  	color: #828282;
  }
  .btn{
  	font-size: 1.0625rem;
  }
  #LoginOfSignupBtn{
  	border: none;
  	padding: 0;
  	margin-top: 1.625rem;
  	margin-bottom: 4.78125rem;
  }
  .btn-default{
  	width: 27%;
  }
  .forgetPassword{
  	display: block;
  	height: 1.875rem;
  	border-radius: 0.9375rem;
  	line-height: 1rem;
  	font-size: 1rem;
  	color: #22ac38;
  	border: 1px solid #22ac38;
  	padding: 0.46875rem 0.90625rem;
  	margin-left: 16.4375rem;
  }
</style>