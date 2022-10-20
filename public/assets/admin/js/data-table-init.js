$('#basic-datatable').DataTable({});

  $('#scroll-vertical-datatable').DataTable( {
    "scrollY": "300px",
    "scrollCollapse": true,
    "paging":         false
  });

  $('#buttons-datatable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
} );