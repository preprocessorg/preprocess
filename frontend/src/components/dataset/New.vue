<template>
  <div class="form-elements">
    <div class="row">
      <div class="col-md-12">
        <vuestic-widget :headerText="'menu.dataset' | translate">
          <form enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-12 align-items-center justify-content-center">
                <fieldset>
                  <div class="form-group">
                    <div class="input-group">
                      <input id="name" name="name"  v-model="name"  data-vv-name="name" v-validate="'required'"/>
                      <label class="control-label" for="simple-input">{{'forms.inputs.dataset.name' | translate}}</label><i class="bar"></i>
                      <i class="fa fa-exclamation-triangle icon-right input-icon" v-show="errors.has('name')"></i>
                      <small v-show="errors.has('name')"
                             class="help text-danger">{{
                        errors.first('name')
                        }}
                      </small>
                    </div>
                  </div>
                  <div class="form-group">
                    <vuestic-file-upload type="single" v-model="single" id="single" name="single" data-vv-name="single" v-validate="'required'" />
                      <small v-show="errors.has('single')"
                             class="help text-danger">{{
                        errors.first('single')
                        }}
                      </small>
                  </div>
                  <div class="form-group">
                    <vuestic-simple-select
                    id="delimiter"
                    name="delimiter"
                    autocomplete="off"
                    :label="'forms.selects.delimiter' | translate"
                    v-model="delimiter"
                    option-key="description"
                    v-validate="'required'"
                    v-bind:options="delimiterOptions"
                    />
                      <small v-show="errors.has('delimiter')"
                             class="help text-danger">{{
                        errors.first('delimiter')
                        }}
                      </small>
                  </div>
                </fieldset>
                <div>
                  <button class="btn btn-primary btn-sm" @click.prevent="newDataset">
                    {{'cards.button.confirm' | translate}}
                  </button>
                  <router-link :to="{ name: 'dataset' }">
                    <button class="btn btn-secondary btn-sm">
                      {{'cards.button.cancel' | translate}}
                    </button>
                  </router-link>
                </div>
                <div class="">
                  <br>
                  <keep-alive v-if="notification === true">
                    <vuestic-alert :type=type >
                      <span class="badge badge-pill badge-warning">{{field}}</span>
                      {{message}}
                    </vuestic-alert>
                  </keep-alive>
                </div>
              </div>
            </div>
          </form>
        </vuestic-widget>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'new',
    computed: {
      datePickerDisabled: () => [date => !(date.getDate() % 5)],
      isSuccessfulEmailValid () {
        let isValid = false
        if (this.formFields.successfulEmail) {
          isValid = this.formFields.successfulEmail.validated && this.formFields.successfulEmail.valid
        }
        return isValid
      },
    },
    data () {
      return {
        userid: '',
        name: '',
        single: [],
        field: '',
        message: '',
        notification: '',
        type: '',
        delimiter: '',
        delimiterOptions: [
          {
            id: 1,
            description: ',',
          },
          {
            id: 2,
            description: ';',
          },
          {
            id: 3,
            description: 'TAB',
          },
        ]
      }
    },
    methods: {
      clear (field) {
        this[field] = ''
      },
      newDataset () {
        this.$validator.validateAll().then((result) => {
          if (result) {
            let formData = new FormData()
            formData.append('file', this.single[0])
            formData.append('name', this.name)
            formData.append('delimiter', this.delimiter)
            formData.append('user_id', this.userid)
            axios.post('http://127.0.0.1:8000/api/dataset',
              formData,
              {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
              })
              .then(({data}) => {
                console.log('ok')
              })
              .catch(({response}) => {
                console.log(response.data.message)
                this.field = response.data.field[0]
                this.message = response.data.message[this.field][0]
                this.notification = true
                this.type = 'warning'
              })
          }
        })
      }
    },
    created () {
      this.$nextTick(() => {
        this.$validator.validateAll()
      })
      var user = JSON.parse(window.localStorage.getItem('user'))
      this.userid = user._id
    }
  }
</script>

<style lang="scss">
  input[type=checkbox]:disabled + label,
  input[type=radio]:disabled + label,
  input[type=checkbox]:disabled,
  input[type=radio]:disabled {
    cursor: not-allowed;
  }
  input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>
