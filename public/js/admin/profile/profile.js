$(document).ready(function() {
    $('#formProfile').on('submit', function(e) {
        e.stopPropagation()
        e.preventDefault()
        var form = $(this)

        //console.log($("#formJob input[name=inputBaseFile]")[0].files[0])
        //form[0].trigger('reset')
        if (form[0].checkValidity()) {
            showLoading();
            var data = new FormData();
            var form_data = $(this).serializeArray();
            $.each(form_data, function(key, input) {
                data.append(input.name, input.value)
            });
            data.append('file_dni', $("#formProfile input[name=file_dni]")[0].files[0])
            data.append('file_fa', $("#formProfile input[name=file_fa]")[0].files[0])
            data.append('file_discapacity', $("#formProfile input[name=file_discapacity]")[0].files[0])
            data.append('file_license_driver', $('#formProfile input[name=file_license_driver]')[0].files[0])
            data.append('file_profile', $('#formProfile input[name=file_perfil]')[0].files[0])
                //file_perfil
            $.ajax({
                url: '/candidate/profile/update-profile',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        Swal.close()
                        form[0].classList.remove('was-validated')
                        data.data.file_dni_path != '' ? $('#file_dni_path').removeClass('btn-danger').addClass('btn-success').prop('href', `/candidate/profile/view-document?id=${data.data.file_dni_path}`).empty().append('<i class="fas fa-eye"></i>').prop('target', '_blank') : $('#file_dni_path').removeClass('btn-success').addClass('btn-danger').removeAttr("href").empty().append('<i class="fas fa-eye-slash"></i>').removeAttr("target");
                        data.data.discapacity_file_path != '' ? $('#file_discapacity_path').removeClass('btn-danger').addClass('btn-success').prop('href', `/candidate/profile/view-document?id=${data.data.discapacity_file_path}`).empty().append('<i class="fas fa-eye"></i>').prop('target', '_blank') : $('#file_discapacity_path').removeClass('btn-success').addClass('btn-danger').removeAttr("href").empty().append('<i class="fas fa-eye-slash"></i>').removeAttr("target")
                        data.data.license_driver_path != '' ? $('#file_license_driver_path').removeClass('btn-danger').addClass('btn-success').prop('href', `/candidate/profile/view-document?id=${data.data.license_driver_path}`).empty().append('<i class="fas fa-eye"></i>').prop('target', '_blank') : $('#file_license_driver_path').removeClass('btn-success').addClass('btn-danger').removeAttr("href").empty().append('<i class="fas fa-eye-slash"></i>').removeAttr("target")
                        data.data.license_path != '' ? $('#file_license_fa_path').removeClass('btn-danger').addClass('btn-success').prop('href', `/candidate/profile/view-document?id=${data.data.license_path}`).empty().append('<i class="fas fa-eye"></i>').prop('target', '_blank') : $('#file_license_fa_path').removeClass('btn-success').addClass('btn-danger').removeAttr("href").empty().append('<i class="fas fa-eye-slash"></i>').removeAttr("target")
                        data.data.photo_perfil_path != '' ? $('#file_perfil_path').removeClass('btn-danger').addClass('btn-success').prop('href', `/candidate/profile/view-document?id=${data.data.photo_perfil_path}`).empty().append('<i class="fas fa-eye"></i>').prop('target', '_blank') : $('#file_perfil_path').removeClass('btn-success').addClass('btn-danger').removeAttr("href").empty().append('<i class="fas fa-eye-slash"></i>').removeAttr("target")

                        success(data.message)
                    } else {
                        error(data.error)
                    }

                },
                error: function(e) {
                    error(e)
                }
            });
        }
    })
    $('#departament_birth').on('change', function(e) {
        $.ajax({
            url: '/candidate/profile/get-province',
            type: 'GET',
            data: { departament_id: $(this).val() },
            success: function(data) {
                if (data.success) {
                    $('#province_birth').empty().append(`<option value="">Seleccionar</option>`)
                    data.data.forEach(element => {
                        $('#province_birth').append(`<option value="${element.id}">${element.name}</option>`)
                    });

                } else {
                    error(data.error)
                }
            }
        })
    })
    $('#departament_address').on('change', function(e) {
        $.ajax({
            url: '/candidate/profile/get-province',
            type: 'GET',
            data: { departament_id: $(this).val() },
            success: function(data) {
                if (data.success) {
                    $('#province_address').empty().append(`<option value="">Seleccionar</option>`)
                    data.data.forEach(element => {
                        $('#province_address').append(`<option value="${element.id}">${element.name}</option>`)
                    });

                } else {
                    error(data.error)
                }
            }
        })
    })
    $('#province_birth').on('change', function(e) {
        $.ajax({
            url: '/candidate/profile/get-district',
            type: 'GET',
            data: { province_id: $(this).val() },
            success: function(data) {
                if (data.success) {
                    $('#district_birth').empty().append(`<option value="">Seleccionar</option>`)
                    data.data.forEach(element => {
                        $('#district_birth').append(`<option value="${element.id}">${element.name}</option>`)
                    });

                } else {
                    error(data.error)
                }
            }
        })
    })
    $('#province_address').on('change', function(e) {
        $.ajax({
            url: '/candidate/profile/get-district',
            type: 'GET',
            data: { province_id: $(this).val() },
            success: function(data) {
                if (data.success) {
                    $('#district_address').empty().append(`<option value="">Seleccionar</option>`)
                    data.data.forEach(element => {
                        $('#district_address').append(`<option value="${element.id}">${element.name}</option>`)
                    });
                } else {
                    error(data.error)
                }
            }
        })
    })
    $('#pension_state_afp').on('change', function(e) {
        if ($(this).is(':checked')) {

            $('#type_afp').prop("disabled", false).prop("required", true)
        }
    })
    $('#pension_state_onp').on('change', function(e) {
        if ($(this).is(':checked')) {
            $
            $('#type_afp').val('').prop("disabled", true).prop("required", false)
        }
    })
    $('#fa_state_y').on('change', function(e) {
        if ($(this).is(':checked')) {

            $('#file_fa').prop("disabled", false).prop("required", true)
        }
    })
    $('#fa_state_n').on('change', function(e) {
        if ($(this).is(':checked')) {
            $('#file_fa').val('').prop("disabled", true).prop("required", false)
        }
    })
    $('#discapacity_state_y').on('change', function(e) {
        if ($(this).is(':checked')) {
            $('#type_discapacity').prop("disabled", false).prop("required", true)
            $('#file_discapacity').val('').prop("disabled", false).prop("required", true)
        }
    })
    $('#discapacity_state_n').on('change', function(e) {
        if ($(this).is(':checked')) {
            $('#type_discapacity').val('').prop("disabled", true).prop("required", false)
            $('#file_discapacity').val('').prop("disabled", true).prop("required", false)
        }
    })
    $('#license_driver_y').on('change', function(e) {
        if ($(this).is(':checked')) {

            $('#file_license_driver').prop("disabled", false).prop("required", true)
        }
    })
    $('#license_driver_n').on('change', function(e) {
        if ($(this).is(':checked')) {
            $('#file_license_driver').val('').prop("disabled", true).prop("required", false)
        }
    })

    function error(e) {
        $('#modalSuccess .modal-header').empty().append('Error')
        $('#modalSuccess .modal-body').empty().append(e)
        $('#modalSuccess').modal('show')
    }

    function success(e) {
        $('#modalSuccess .modal-header').empty().append('Exito')
        $('#modalSuccess .modal-body').empty().append(e)
        $('#modalSuccess').modal('show')
    }
    $('.validation-pdf').on('change', function(e) {
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
            confirmButtonColor: "#28a745"
        })
    }
})