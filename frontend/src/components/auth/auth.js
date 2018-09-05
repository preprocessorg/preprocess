import axios from './../../../node_modules/axios'
/* import api from '../../api' */
axios.defaults.baseURL = 'http://127.0.0.1:8000'
class Auth {
  constructor () {
    this.token = window.localStorage.getItem('token')

    let userData = window.localStorage.getItem('user')
    this.user = userData ? JSON.parse(userData) : null

    if (this.token) {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token
      this.getUser()
    }
  }

  login (token, user) {
    window.localStorage.setItem('token', token)
    window.localStorage.setItem('user', JSON.stringify(user))

    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

    this.token = token
    this.user = user

    Event.$emit('userLoggedIn')
  }

  check () {
    return !!this.token
  }

  getUser () {
    axios.get('/api/auth/get-user')
        .then(({data}) => {
          this.user = data
        })
        .catch(({response}) => {
          if (response.status === 401) {
            this.logout()
          }
        })
  }

  logout (token, user) {
    window.localStorage.removeItem('token')
    window.localStorage.removeItem('user')
    this.token = ''
    this.user = ''
  }
}

export default new Auth()
