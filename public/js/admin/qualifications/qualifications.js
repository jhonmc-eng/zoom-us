$(document).ready(function() {
    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: "/candidate/qualifications/get-data-qualifications",
            dataSrc: 'data',
            type: "GET"
        },

        columns: [{
                data: "type_qualification",
                render: function(data) {
                    return data.name
                }
            },
            {
                data: 'cant_hours'
            },
            {
                data: 'name_institution'
            },
            {
                data: 'title_course'
            },
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

    })

    let buttons = `
        <button type="button" class="btn btn-success" id="button-register" data-toggle="modal"><i class="fas fa-laptop"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-edit"></i> Editar</button>
        <button type="button" class="btn btn-danger" id="button-delete" data-toggle="modal"><i class="fas fa-trash-alt"></i> Eliminar</button>
        
    `
    $('#datable_wrapper .col-md-6:eq(0)').append(buttons)

    $('#button-register').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('#formQualification').trigger('reset')
        $('#modalRegisterQualification').modal('show')


    });
    $('#formQualification').on('submit', function(e) {
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
            data.append('certificate', $("#formQualification input[name=certificate]")[0].files[0])
            $.ajax({
                url: '/candidate/qualifications/register-qualification',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('#modalRegisterQualification').modal('hide')
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
            $('#formEditQualification input[name="cant_hours"]').val(data.cant_hours)
            $('#formEditQualification select[name="type_academic"]').val(data.type_qualifications_id)
            $('#formEditQualification input[name="name_institution"]').val(data.name_institution)
            $('#formEditQualification input[name="name_course"]').val(data.title_course)
            $('#formEditQualification input[name="date_start"]').val(data.date_start)
            $('#formEditQualification input[name="date_end"]').val(data.date_end)
            $('#file_path_certificate').prop('href', `/candidate/qualifications/view-document?id=${data.certificate_file_path}`)
            $('#modalEditQualification').modal('show')
        } else {
            error('Debe seleccionar un registro')
        }

    })
    $('#formEditQualification').on('submit', function(e) {
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
            data.append('certificate', $("#formEditQualification input[name=certificate]")[0].files[0])
            data.append('id', datos.id)
            $.ajax({
                url: '/candidate/qualifications/update-qualification',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('#modalEditQualification').modal('hide')
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
                        url: '/candidate/qualifications/delete-qualification',
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