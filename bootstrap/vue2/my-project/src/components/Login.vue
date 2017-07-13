<template>
  <div class="login">
  	<img src="../assets/logo.png">
  	<login-input></login-input>
  	<p>{{ log }}</p>
  	<button class="btn btn-success">test bootstrap</button>
  </div>
</template>

<script>
import loginInput from './loginInput'

export default {
  name: 'login',
  data () {
    return {
      log: 'zhuce'
    }
  },
  components: {
    loginInput
  }
}
</script>

<style scoped>
  .login img{
  	width: 100px;
  }
</style>