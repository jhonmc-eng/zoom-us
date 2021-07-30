$(document).ready(function() {
    $('#type_document').on('change', function(e) {
        if ($(this).val() == 1) {
            $('.api').addClass('disabled').prop('readonly', true)
            $('#validate_document').prop('readonly', false)
            $('#form_register input[name="name"]').val('')
            $('#form_register input[name="lastname_patern"]').val('')
            $('#form_register input[name="lastname_matern"]').val('')
        } else {
            $('.api').removeClass('disabled').prop('readonly', false)
            $('#validate_document').prop('readonly', true)
        }
    })
    $('#validate_document').on('click', function(e) {
        e.stopPropagation()
        e.preventDefault()
        if ($('#type_document').val() == 1) {
            if($('#form_register input[name="document"]').val() != ''){
                Swal.fire({
                    title: '¡Validando datos en la RENIEC!',
                    html: 'Espere un momento',
                    allowOutsideClick: false,
                    timerProgressBar: true,
                    didOpen: () => {
                      Swal.showLoading()
                    }
                })
                $.ajax({
                    url: `/get-data-dni/${$('#form_register input[name="document"]').val()}`,
                    type: 'GET',
                    success: function(data) {
                        if (data.success) {
                            $('#form_register input[name="name"]').val(data.data.nombres)
                            $('#form_register input[name="lastname_patern"]').val(data.data.apellido_paterno)
                            $('#form_register input[name="lastname_matern"]').val(data.data.apellido_materno)
                            Swal.close()
                        }
                    },
                    error: function(e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '¡Ha ocurrido un error!',
                            footer: 'El DNI no existe, intente nuevamente',
                            confirmButtonColor: "#D40E1E"
                        })
                    }
                })
            }
        }
    })

    $('#form_register').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let form = $(this)
        
        if (form[0].checkValidity()) {
            console.log($(this).serialize())
            $.ajax({
                url : `/validate-register-candidate`,
                type : 'POST',
                data : $(this).serialize(),
                success: function(data){
                    if(data.success){
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito',
                            text: '¡Usuario creado exitosamente!',
                            footer: 'Revisa tu correo, para activar tu cuenta',
                            confirmButtonColor: "#D40E1E"
                        })
                    }else{
                        error(data.error)
                    }
                },
                error:function(e){
                    alert(e)
                }
            });
        }
    })

    function error(error){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡Ha ocurrido un error!',
            footer: error,
            confirmButtonColor: "#D40E1E"
        })
    }
    
})