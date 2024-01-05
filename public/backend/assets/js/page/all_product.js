$(document).ready(function () {

    // Cargar el id al modal
    $("#barcode-modal").on("show.bs.modal", function (e) {
        var id = $(e.relatedTarget).data('target-id');
        $('#pass_id').val(id);
    });
});