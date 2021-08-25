$(document).ready(function() {
    $('#UpdatePassword').on('submit', function(e) {
        e.preventDefault()
        e.stopPropagation()
        var form = $(this)

        if (form[0].checkValidity()) {
            showLoading('Cambiando contrasena...');
            $.ajax({
                url: '/admin/password',
                type: 'POST',
                data: $(this).serializeArray(),
                success: function(data) {
                    if (data.success) {
                        $('#Password').modal('hide')
                        Swal.close();
                        form[0].reset()
                        form[0].classList.remove('was-validated')
                        success(data.message)
                    } else {
                        Swal.close();
                        error(data.error)
                    }
                },
                error: function(e) {
                    error(e)
                }
            });
        }
    })

    function showLoading(text) {
        Swal.fire({
            title: `${text}!`,
            html: 'Espere un momento',
            allowOutsideClick: false,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            }
        })
    }

    function error(error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error,
            confirmButtonColor: "#D40E1E"
        })
    }

    function success(message) {
        Swal.fire({
            icon: 'success',
            title: 'Exito',
            text: `¡${message}!`,
            confirmButtonColor: "#28a745"
        })
    }
})