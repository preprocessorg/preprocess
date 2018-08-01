<template>
  <div class="login">
    <h2>{{'auth.welcome' | translate}}</h2>
    <form method="post" @submit.prevent="login" name="login">
      <div class="form-group">
        <div class="input-group">
          <input type="text" id="email" required="required" v-model="auth.email"/>
          <label class="control-label" for="email">{{'auth.email' | translate}}</label><i class="bar"></i>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <input type="password" id="password" required="required" v-model="auth.password"/>
          <label class="control-label" for="password">{{'auth.password' | translate}}</label><i class="bar"></i>
        </div>
      </div>
      <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between down-container">
        <button class="btn btn-primary" type="submit" >
          {{'auth.login' | translate}}
        </button>
        <router-link class='link' :to="{name: 'signup'}">{{'auth.createAccount' | translate}}</router-link>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'login',
  data () {
    return {
      auth: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    login () {
      let uri = 'http://localhost:8000/auth/login'
      this.axios.post(uri, this.auth).then(response => {
        this.$router.push({ name: 'Dashboard' })
      })
    },
    currentLanguage () {
        return Vue.i18n.locale() === 'en' ? 'gb' : Vue.i18n.locale()
    },
  }
}
</script>

<style lang="scss">
.login {
  @include media-breakpoint-down(md) {
    width: 100%;
    padding-right: 2rem;
    padding-left: 2rem;
    .down-container {
      .link {
        margin-top: 2rem;
      }
    }
  }

  h2 {
    text-align: center;
  }
  width: 21.375rem;

  .down-container {
    margin-top: 3.125rem;
  }
}
</style>
