<template>
  <div class="login">
    <h2>{{'auth.welcome' | translate}}</h2>
    <form method="post" @submit.prevent="submit" name="login">
      <div class="form-group">
        <div class="input-group">
          <input type="text" id="email" required="required" v-model="email"/>
          <label class="control-label" for="email" >{{'auth.email' | translate}}</label><i class="bar"></i>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <input type="password" id="password" required="required" v-model="password"/>
          <label class="control-label" for="password" >{{'auth.password' | translate}}</label><i class="bar"></i>
        </div>
      </div>
      <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between down-container">
        <button class="btn btn-primary" type="button" @click="login">
          {{'auth.login' | translate}}
        </button>
        <router-link class='link' :to="{name: 'signup'}">{{'auth.createAccount' | translate}}</router-link>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import auth from '../auth.js'

window.auth = auth
export default {
  name: 'login',
  data () {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    login () {
      let data = {
        email: this.email,
        password: this.password
      }
      axios.post('http://127.0.0.1:8000/api/auth/login', data)
      .then(({data}) => {
        auth.login(data.access_token, data.user)

        this.$router.push('admin/dashboard')
      })
      .catch(({response}) => {
        alert(response.data.message)
      })
    }
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
