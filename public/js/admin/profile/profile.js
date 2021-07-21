$(function() {
    $('#formProfile').on('submit', function(e) {
        e.stopPropagation()
        e.preventDefault()
        var form = $(this)

        //console.log($("#formJob input[name=inputBaseFile]")[0].files[0])
        //form[0].trigger('reset')
        if (form[0].checkValidity()) {
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
                        //form[0].reset()
                        form[0].classList.remove('was-validated')
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
})