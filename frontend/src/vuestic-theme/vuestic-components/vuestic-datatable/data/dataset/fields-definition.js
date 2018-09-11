export default {
  tableFields: [
    {
      name: '__component:badge-column',
      title: '',
      dataClass: 'text-center'
    },
    {
      name: 'name',
      sortField: 'name'
    },
    {
      name: 'file',
      sortField: 'file'
    },
    {
      name: 'created_at',
      title: 'created_at'
    },
    {
      name: 'delimiter',
      title: 'delimiter'
    }
  ],
  sortFunctions: {
    'name': function (item1, item2) {
      return item1 >= item2 ? 1 : -1
    },
    'email': function (item1, item2) {
      return item1 >= item2 ? 1 : -1
    }
  }
}
