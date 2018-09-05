// Polyfills
import 'es6-promise/auto'
import 'babel-polyfill'

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VeeValidate from 'vee-validate'
import App from './App'
import store from './store'
import router from './router'
import VuesticPlugin from 'vuestic-theme/vuestic-plugin'
import './i18n'
import YmapPlugin from 'vue-yandex-maps'
import Api from './api.js'
import auth from './components/auth/auth.js'


window.api = new Api()

window.Event = new Vue()

Vue.use(VuesticPlugin)
Vue.use(YmapPlugin)

// NOTE: workaround for VeeValidate + vuetable-2
Vue.use(VeeValidate, {fieldsBagName: 'formFields'})

let mediaHandler = () => {
  if (window.matchMedia(store.getters.config.windowMatchSizeLg).matches) {
    store.dispatch('toggleSidebar', true)
  } else {
    store.dispatch('toggleSidebar', false)
  }
}

router.beforeEach((to, from, next) => {
  store.commit('setLoading', true)
  if (to.matched.some(record => record.meta.middlewareAuth)) {
    if (!auth.check()) {
      next({
        path: '/auth/login',
        query: { redirect: to.fullPath }
      })
      if (window.localStorage.getItem('token')) {
        next({
          path: '/auth/login',
          query: { redirect: to.fullPath }
        })
      }

      return
    }
  }

  next()
})

router.afterEach((to, from) => {
  mediaHandler()
  store.commit('setLoading', false)
})

/* eslint-disable no-new */

window.auth = auth

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})
