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

        Swal.fire({
            title: '¿Esta seguro?',
            text: "¿Va a eliminar esta información?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Eliminado!',
                    'Se ha eliminado.',
                    'success'
                )
            }
        })
    });
});