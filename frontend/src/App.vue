<template>
  <div id="app" class="app">
    <router-view/>
  </div>
</template>

<script>
  import auth from './components/auth/auth.js'
  window.auth = auth

  export default {
    name: 'app',
    data () {
      return {
        authenticated: auth.check(),
        user: auth.user
      }
    },

    mounted () {
      Event.$on('userLoggedIn', () => {
        this.authenticated = true
        this.user = auth.user
      })
    },
  }
</script>

<style lang="scss">
  @import "sass/main";

  body {
    height: 100%;
    #app {
      height: 100%;
    }
  }
</style>
