<template>
  <div class="form-elements">
    <div class="row">
      <div class="col-md-12">
        <vuestic-widget :headerText="'menu.dataset' | translate">
          <form>

            <div class="row">
              <div class="col-md-10">
                <fieldset>
                  <div class="form-group">
                    <div class="input-group">
                      <input id="simple-input" required/>
                      <label class="control-label" for="simple-input">{{'forms.inputs.dataset.name'
                      | translate}}</label><i class="bar"></i>
                    </div>
                  </div>
                  <vuestic-file-upload type="single" v-model="single"/>
                </fieldset>
              </div>
            </div>
          </form>
        </vuestic-widget>
      </div>
    </div>
  </div>
</template>

<script>
  import CountriesList from 'data/CountriesList'

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
        single: [],
        isMale: true,
        value: '',
        countriesList: CountriesList,
        chosenCountry: '',
        clearableText: '',
        successfulEmail: 'andrei@dreamsupport.io',
        wrongEmail: 'andrei@dreamsupport',
        simpleOptions: [
          {
            id: 1,
            description: 'First option',
          },
          {
            id: 2,
            description: 'Second option',
          },
          {
            id: 3,
            description: 'Third option',
          },
        ],
        simpleSelectModel: '',
        multiSelectModel: [],
        multiSelectCountriesModel: [],
        radioModel: 'option1',
        radioDisabledModel: 'option4',
        checkboxOneModel: false,
        checkboxTwoModel: true,
        checkboxThreeModel: false,
        checkboxFourModel: true,
        checkboxFiveModel: false,
        checkboxSixModel: true,
        checkboxSevenModel: false,
        checkboxEightModel: true,
        datepicker: {
          simple: '2018-05-09',
          time: '2018-05-08 14:10',
          range: '2018-05-08 to 2018-05-23',
          disabled: '2018-05-09',
          multiple: '2018-04-25, 2018-04-27',
        },
      }
    },
    methods: {
      clear (field) {
        this[field] = ''
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
