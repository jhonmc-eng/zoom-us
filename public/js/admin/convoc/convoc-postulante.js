$(document).ready(function() {

    $('#postulate').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('#formPostulation').trigger('reset')
        $('#modalMessageDate').modal('show')
    })
    $('#next-modal').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('#modalMessageDate').modal('hide')
        $('#modalPostulation').modal('show')
    })
    $('#formPostulation').on('submit', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let form = $(this)
        if (form[0].checkValidity()) {
            showLoading()
            var params = new window.URLSearchParams(window.location.search);
            var data_ = new FormData();
            data_.append('file_format_1', $("#formPostulation input[name=file_format_1]")[0].files[0])
            data_.append('file_cv', $("#formPostulation input[name=file_cv]")[0].files[0])
            data_.append('file_format_2', $("#formPostulation input[name=file_format_2]")[0].files[0])
            data_.append('file_rnscc', $("#formPostulation input[name=file_rnscc]")[0].files[0])
            $.ajax({
                url: `/candidate/jobs/postulate/${params.get('job_id')}`,
                type: 'POST',
                data: data_,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(data) {
                    Swal.close()
                    if (data.success) {
                        $('#modalPostulation').modal('hide')
                        success(data.message)
                        window.location = '/candidate/postulations'
                    } else {
                        error(data.error)
                    }
                },
                error: function(e) {
                    Swal.close()
                    error(e.responseJson.error)
                }
            });
        }
    })

    $('.validation-pdf').on('change', function(e) {
        //Toasts.reset()
        //toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        e.preventDefault()
        e.stopPropagation()
        let file = $(this)[0].files[0]
        let size = file.size
        let type = file.type
        console.log(file, size, type)
        if (type != "application/pdf") {
            $(this).val('')
            toastr.error('El tipo de archivo que quiere subir, no esta permitido', {
                "closeButton": true,
            })
        }
        if (size >= 10000000) {
            $(this).val('')
            toastr.error('El tamaño de archivo que quiere subir, no esta permitido', {
                "closeButton": true,
            })
        }
    })

    function showLoading() {
        Swal.fire({
            title: '¡Subiendo archivos!',
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
            confirmButtonColor: "#D40E1E"
        })
    }
})