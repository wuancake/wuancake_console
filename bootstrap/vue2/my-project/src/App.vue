<template>
  <div id="app">
    <header>{{ message }}</header>
    <login></login>
  </div>
</template>

<script>
import Hello from './components/Hello'
import Login from './components/Login'

export default {
  name: 'app',
  data () {
    return {
    	message: '午安煎饼计划'
    }
  },
  components: {
    Hello,
    Login
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
#app header{
	background-color: #42B983;
	padding: 10px;
	color: white;
	font-size: 20px;
	font-weight: bolder;
}
</style>
