import axios from 'axios'
import auth from './components/auth/auth.js'
axios.defaults.baseURL = 'http://127.0.0.1:8000'

class Api {
  constructor () {}

  call (requestType, url, data = null) {
    return new Promise((resolve, reject) => {
      axios[requestType](url, data)
            .then(response => {
              resolve(response)
            })
            .catch(({response}) => {
              if (response.status === 401) {
                auth.logout()
              }

              reject(response)
            })
    })
  }
}

export default Api
