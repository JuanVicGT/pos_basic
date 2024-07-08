$(function () {
    $('.only-year-date').datepicker({
        minViewMode: 2,
        format: 'yyyy'
    });

    $(document).on('click', '#close-alert', function (e) {
        $(".alert").alert('close')
    })

    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        swal({
            title: '¿Esta seguro?',
            text: "¿Va a eliminar esta información?",
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Cancelar',
                    value: null,
                    visible: true,
                    className: 'btn btn-danger',
                    closeModal: true,
                },
                confirm: {
                    text: 'Sí, eliminar!',
                    value: true,
                    visible: true,
                    className: 'btn btn-primary',
                    closeModal: true
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                swal(
                    'Eliminado!',
                    'Se ha eliminado.',
                    'success'
                ).then(function () {
                    window.location.href = link;
                });
            }
        });

    });
});