<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <vuestic-widget :headerText="$t('menu.dataset')">
          <vuestic-data-table
            :apiUrl="apiUrl"
            :tableFields="tableFields"
            :itemsPerPage="itemsPerPage"
            :defaultPerPage="defaultTablePerPage"
            :sortFunctions="sortFunctions"
            :apiMode="apiMode"
            :paginationPath="paginationPath"
            :queryParams="queryParams"
          >
            <spring-spinner
              slot="loading"
              :animation-duration="2500"
              :size="70"
              color="#4ae387"
            />
          </vuestic-data-table>
        </vuestic-widget>
      </div>
      <div class="float">
        <router-link class='link' :to="{name: 'newDataset'}">
          <button class="btn btn-primary btn-with-icon rounded-icon" >
            <div class="btn-with-icon-content">
              <i class="ion ion-md-add"></i>
            </div>
          </button>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
  import Vue from 'vue'
  import BadgeColumn from './BadgeColumn.vue'
  import FieldsDef from 'vuestic-components/vuestic-datatable/data/dataset/fields-definition'
  import ItemsPerPageDef from 'vuestic-components/vuestic-datatable/data/dataset/items-per-page-definition'
  import QueryParams from 'vuestic-components/vuestic-datatable/data/query-params'
  import {SpringSpinner} from 'epic-spinners'

  Vue.component('badge-column', BadgeColumn)

  export default {
    name: 'Table',
    components: {
      SpringSpinner
    },
    data () {
      return {
        apiUrl: 'http://127.0.0.1:8000/api/dataset',
        apiMode: true,
        tableFields: FieldsDef.tableFields,
        itemsPerPage: ItemsPerPageDef.itemsPerPage,
        sortFunctions: FieldsDef.sortFunctions,
        paginationPath: '',
        defaultTablePerPage: 5,
        queryParams: QueryParams
      }
    }
  }

  /* <vuestic-widget /*:headerText="$t('menu.dataset')">
        <td></td>
        <td>{{'tables.headings.name' | translate}}</td>
        <td>{{'tables.headings.file' | translate}}</td>
        <td>{{'tables.headings.type' | translate}}</td>
        <td align="middle">{{'buttons.actions' | translate}}</td>
        <td align="middle">{{'tables.headings.size' | translate}}</td> */
</script>

<style lang="scss">

  .color-icon-label-table {
    td:first-child {
      width: 1rem;
    }
  }

  .float{
    position:fixed;
    width:60px;
    height:60px;
    bottom:40px;
    right:40px;
    border-radius:50px;
    text-align:center;
  }
</style>
