$(document).ready(function() {
    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: "/candidate/academic/get-data",
            dataSrc: 'data',
            type: "GET"
        },
        columns: [{
                data: "type_academic",
                render: function(data) {
                    return data.name
                }
            },
            {
                data: "education_level",
                render: function(data) {
                    return data.name;
                }
            },
            { data: "study_center" },
            { data: "career" },
            { data: "date_start" },
            { data: "date_end" }
        ],
        lengthChange: false,
        pageLength: 5,
        language: {
            emptyTable: "No hay datos disponibles",
            info: "Mostrando _START_ de _END_ de un total de _TOTAL_ entradas",
            infoEmpty: "Mostrando 0 de 0 de un total de 0 entradas",
            infoFiltered: "(filtrado de un total de _MAX_ total entradas)",
            infoPostFix: "",
            thousands: ".",
            lengthMenu: "Mostrar _MENU_ entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "No se encontraron datos",
            paginate: {
                first: "Primera",
                last: "ÚLtima",
                next: "Siguiente",
                previous: "Anterior"
            },
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
            },
            select: {
                rows: {
                    '_': ""
                }
            }
        },

        select: {
            style: 'single'
        },
        bFilter: true,
        order: []
    })

    let buttons = `
    <div class="dt-buttons flex-wrap">
        <button type="button" class="btn btn-success" id="button-register" data-toggle="modal"><i class="fas fas fa-graduation-cap"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-edit"></i> Editar</button>
        <button type="button" class="btn btn-danger" id="button-delete" data-toggle="modal"><i class="fas fa-trash-alt"></i> Eliminar</button>
    </div> 
    `
    $('#datable_wrapper .col-md-6:eq(0)').append(buttons)

    $('#button-register').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('#formAcademic').trigger('reset')
        $('#modalRegisterAcademic').modal('show')


    });
    $('#formAcademic').on('submit', function(e) {
        e.preventDefault()
        e.stopPropagation()
        var form = $(this)

        if (form[0].checkValidity()) {
            showLoading();
            var data = new FormData();
            var form_data = $(this).serializeArray();
            $.each(form_data, function(key, input) {
                data.append(input.name, input.value)
            });
            data.append('tuition_file', $("#formAcademic input[name=tuition_file]")[0].files[0])
            data.append('certificate', $("#formAcademic input[name=certificate]")[0].files[0])
            $.ajax({
                url: '/candidate/academic/register-academic',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('#modalRegisterAcademic').modal('hide')
                        Swal.close();
                        form[0].reset()
                        form[0].classList.remove('was-validated')
                        table.ajax.reload();
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

    });
    $('#button-edit').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({ selected: true }).data();
        if (data !== undefined) {
            console.log(data)
            $('#formEditAcademic input[name="study_center"]').val(data.study_center)
            $('#formEditAcademic select[name="type_academic"]').val(data.type_academic_id)
            $('#formEditAcademic select[name="education_level"]').val(data.education_level_id)
            $('#formEditAcademic input[name="career"]').val(data.career)

            if (data.tuition_state) {
                $('#tuition_state_edit_true').prop('checked', true)
                $('#tuition_state_edit_false').prop('checked', false)
                $('#formEditAcademic input[name="tuition_number"]').empty().prop('disabled', false)
                $('#formEditAcademic input[name="tuition_file"]').empty().prop('disabled', false)
                $('#file_license_fa_path').removeClass('btn-danger').addClass('btn-success').prop('href', `/candidate/academic/view-document?id=${data.tuition_file_path}`).empty().append('<i class="fas fa-eye"></i>').prop('target', '_blank')
            } else {
                $('#tuition_state_edit_true').prop('checked', false)
                $('#tuition_state_edit_false').prop('checked', true)
                $('#formEditAcademic input[name="tuition_number"]').empty().prop('disabled', true)
                $('#formEditAcademic input[name="tuition_file"]').empty().prop('disabled', true)
                $('#file_license_fa_path').removeClass('btn-success').addClass('btn-danger').removeAttr("href").empty().append('<i class="fas fa-eye-slash"></i>').removeAttr("target")

            }
            //$('#formEditAcademic input[name="tuition_state"]').val(data.tuition_state)
            $('#formEditAcademic input[name="tuition_number"]').val(data.tuition_number)
            $('#formEditAcademic input[name="date_start"]').val(data.date_start)
            $('#formEditAcademic input[name="date_end"]').val(data.date_end)
            $('#file_path_certificate').prop('href', `/candidate/academic/view-document?id=${data.certificate_file_path}`)

            /*$('#formEditAcademic input[name="inputDatePostulation"]').val(data.date_postulation)
            $('#formEditAcademic select[name="inputModality"]').val(data.modality_id)
            $('#formEditAcademic select[name="inputState"]').val(data.state_job_id)
            $('#formEditAcademic input[name="inputNumber"]').val(data.number_jobs)*/
            $('#modalEditAcademic').modal('show')
        } else {
            error('Debe seleccionar un registro')
        }

    })
    $('#formEditAcademic').on('submit', function(e) {
        e.preventDefault()
        e.stopPropagation()
        var form = $(this)
        if (form[0].checkValidity()) {
            showLoading();
            let datos = table.row({ selected: true }).data();
            var data = new FormData();
            var form_data = $(this).serializeArray();
            $.each(form_data, function(key, input) {
                data.append(input.name, input.value)
            });
            data.append('tuition_file', $("#formEditAcademic input[name=tuition_file]")[0].files[0])
            data.append('certificate', $("#formEditAcademic input[name=certificate]")[0].files[0])
            data.append('id', datos.id)
            $.ajax({
                url: '/candidate/academic/update-academic',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('#modalEditAcademic').modal('hide')
                        Swal.close();
                        form[0].reset()
                        form[0].classList.remove('was-validated')
                        table.ajax.reload();
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

    });
    $('#button-delete').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({ selected: true }).data();
        if (data !== undefined) {
            Swal.fire({
                title: '¿Estas seguro de eliminar este registro?',
                text: "Se eliminara permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#D40E1E',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    $.ajax({
                        url: '/candidate/academic/delete-academic',
                        type: 'POST',
                        data: { id: data.id },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.close()
                                table.ajax.reload()
                                success(data.message)
                            } else {
                                error(data.error)
                            }
                        },
                        error: function(e) {
                            alert(e)
                        }
                    })
                }
            })
        } else {
            error('Debe seleccionar un registro')
        }
    })
    $('#tuition_state_true').on('change', function(e) {
        if ($(this).is(':checked')) {
            $('#tuition_file').val('').prop("disabled", false).prop("required", true)
            $('#tuition_number').val('').prop("disabled", false).prop("required", true)
        }
    })
    $('#tuition_state_false').on('change', function(e) {
        if ($(this).is(':checked')) {
            $('#tuition_file').val('').prop("disabled", true).prop("required", false)
            $('#tuition_number').val('').prop("disabled", true).prop("required", false)
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