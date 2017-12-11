function AddColumnSearch(table,selected_columns,table_id) {

  $.each(selected_columns, function (key, value) {
    $(table_id+' tfoot th:eq('+key+')').html( '<input  type="text" id="'+value+'" />' );
  });

  table.columns().every( function () {
      var that = this;

      $( 'input', this.footer() ).on( 'keyup change', function () {
          if ( that.search() !== this.value ) {
              that.search( this.value ).draw();
          }
      } );
  } );
}
