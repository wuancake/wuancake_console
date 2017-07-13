<template>
    <div class="loginInput">
      <input v-model="msg" placeholder="输入电子邮箱" style="width: 300px"></input>
      <p>{{ msg }}</p>
    </div>
</template>

<script>
export default {
  name: 'login-input',
  data () {
    return {
      msg: ''
    }
  }
}
</script>

<style scoped>
</style>