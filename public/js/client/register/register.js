$(document).ready(function() {
    $('#type_document').on('change', function(e) {
        if ($(this).val() == 1) {
            $('.api').addClass('disabled').prop('disabled', true)
            $('#validate_document').prop('disabled', false)
            $('#form_register input[name="name"]').val('')
            $('#form_register input[name="lastname_patern"]').val('')
            $('#form_register input[name="lastname_matern"]').val('')
        } else {
            $('.api').removeClass('disabled').prop('disabled', false)
            $('#validate_document').prop('disabled', true)
        }
    })
    $('#validate_document').on('click', function(e) {
        e.stopPropagation()
        e.preventDefault()
        if ($('#type_document').val() == 1) {
            $.ajax({
                url: `/get-data-dni/${$('#form_register input[name="document"]').val()}`,
                type: 'GET',
                success: function(data) {
                    if (data.success) {
                        $('#form_register input[name="name"]').val(data.data.nombres)
                        $('#form_register input[name="lastname_patern"]').val(data.data.apellido_paterno)
                        $('#form_register input[name="lastname_matern"]').val(data.data.apellido_materno)
                    }
                },
                error: function(e) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '¡Ha ocurrido un error!',
                        footer: 'El DNI no existe, intente nuevamente'
                    })
                }
            })
        }
    })
})