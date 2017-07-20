<template>
  <div id="app">
    <router-view name="headerBox"></router-view>
    <router-view name="contentsBox"></router-view>
    <router-view name="nav"></router-view>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      user: '',
      password: ''
    }
  },
  methods: {
    logined: function () {
      alert(1)
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  height: 100vh;width: 100vw;
}
button{outline: none;}
</style>
