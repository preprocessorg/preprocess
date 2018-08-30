<template>
  <div class="form-elements">
    <div class="row">
      <div class="col-md-12">
        <vuestic-widget :headerText="'menu.dataset' | translate">
          <form>

            <div class="row">
              <div class="col-md-12 align-items-center justify-content-center">
                <fieldset>
                  <div class="form-group">
                    <div class="input-group">
                      <input id="name" required v-model="name"/>
                      <label class="control-label" for="simple-input">{{'forms.inputs.dataset.name'
                      | translate}}</label><i class="bar"></i>
                    </div>
                  </div>
                  <div class="form-group">
                    <vuestic-file-upload type="single" v-model="single" />
                  </div>
                </fieldset>
                <div>
                  <button class="btn btn-primary btn-sm" @click="newDataset">
                    {{'cards.button.confirm' | translate}}
                  </button>
                  <button class="btn btn-secondary btn-sm">
                    {{'cards.button.cancel' | translate}}
                  </button>
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
  import Papa from 'papaparse'

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
        name: '',
        single: []
      }
    },
    methods: {
      clear (field) {
        this[field] = ''
      },
      newDataset () {
        var e = this.single[0]
        Papa.parse(e, {
          complete: function (results) {
            console.log('Finished:', results.data)
            this.file = results.data
          }
        })
        let data = {
          file: this.file,
          name: this.name
        }
        axios.post('http://127.0.0.1:8000/api/dataset', data)
        .then(({data}) => {
          alert('OK')
        })
        .catch(({response}) => {
          alert(response.data.message)
        })
      }
    },
    created () {
      this.$nextTick(() => {
        this.$validator.validateAll()
      })
    },
  }
</script>

<style lang="scss">
  input[type=checkbox]:disabled + label,
  input[type=radio]:disabled + label,
  input[type=checkbox]:disabled,
  input[type=file]{
    /* display: none; */
  }
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
