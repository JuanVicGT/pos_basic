$(document).ready(function () {
    console.log("SAPO");
    $('#report-datatable').dataTable( {
        retrieve: true,
        paging: false,
        searching: false,
        info: false
    } );
});