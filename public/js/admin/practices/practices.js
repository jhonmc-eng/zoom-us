$(document).ready(function() {

    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: "/admin/practices/list-practices",
            dataSrc: 'data',
            type: "GET"
        },
        columns: [
            //{ "data": "id"},
            {
                data: "number_jobs",
                render: function(data) {
                    return pad(data, 3)
                }
            },
            { data: "title" },
            {
                data: "state_job",
                render: function(data) {
                    let button
                    switch (data.name) {
                        case "ABIERTA":
                            button = `<span class="badge badge-success">ABIERTA</span>`
                            break;
                        case 'CERRADA':
                            button = `<span class="badge badge-danger">CERRADA</span>`
                            break;
                        case 'EN PROCESO':
                            button = `<span class="badge badge-primary">EN PROCESO</span>`
                            break;
                        case 'CANCELADA':
                            button = `<span class="badge badge-info">CANCELADA</span>`
                            break;
                        default:
                            button = `<button type="button" class="btn btn-secundary">${data.name}</button>`
                            break;
                    }
                    return button;
                }
            },
            { data: "date_publication" },
            { data: "date_postulation" },
            /*{ 
                data: "bases",
                render: function (data) {
                    return `<a target="_blank" href="${data}" type="button" class="btn btn-info">BASES</a>`
                }
            },
            { 
                data: "schedule",
                render: function (data) {
                    return `<a target="_blank" href="${data}" type="button" class="btn btn-info">ESQUEMA</a>`                }
            },
            { 
                data: "profile",
                render: function (data) {
                    return `<a target="_blank" href="${data}" type="button" class="btn btn-info">PERFIL</a>`                }
            },*/
            {
                data: "state_delete",
                render: function(data) {
                    return `<a target="_blank" href="#"" type="button" class="btn btn-primary"><i class="fas fa-user-tie"></i></a>`
                }
            }
        ],
        lengthChange: false,
        pageLength: 10,
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
        order: [
            [1, 'asc']
        ],
        bFilter: true,
        order: []

    })

    function pad(str, max) {
        str = str.toString();
        return str.length < max ? pad("0" + str, max) : str;
    }
    let buttons = `
    <div class="dt-buttons flex-wrap">
        <button type="button" class="btn btn-success" id="button-register" data-toggle="modal"><i class="fas fa-briefcase"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-edit"></i> Editar</button>
        <button type="button" class="btn btn-warning" id="button-oficine" data-toggle="modal"><i class="fas fa-sitemap"></i> Oficinas</button>
        <button type="button" class="btn btn-primary" id="button-view" data-toggle="modal"><i class="far fa-eye"></i> Ver</button>
        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-print"></i> Reporte
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <button class="dropdown-item" id="reportCsv">CSV</button>
                <button class="dropdown-item" id="reportExcel">Excel</button>
                <button class="dropdown-item" id="reportPDF">PDF</button>
                <button class="dropdown-item" id="reportPrint">Imprmir</button>
            </div>
        </div>
        
    </div>
    `
    $('#datable_wrapper .col-md-6:eq(0)').append(buttons)

    let oficinas = $('#datable_oficine').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        /*ajax: {
            url: "/admin/practices/list-oficine",
            data: {
                id: 10
            },
            dataSrc: 'data',
            type: "GET"
        },*/
        columns: [
            //{ "data": "id"},
            {
                data: "name",
                render: function(data) {
                    return data.name
                }
            },
            {
                data: "id",
                render: function(data) {
                    return `<button type="button" class="btn-oficine-state btn btn-danger " data-id="${data}"><i class="fas fa-trash-alt"></i></button>`
                }
            }
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

        order: [

        ],
        bFilter: true,

    })
    setOptions()
    $('#formJob').on('submit', function(e) {
        e.preventDefault()
        e.stopPropagation()
        var form = $(this)
        if (form[0].checkValidity()) {
            showLoading('Ingresando datos')
            var data = new FormData();
            var form_data = $(this).serializeArray();
            $.each(form_data, function(key, input) {
                data.append(input.name, input.value)
            });
            data.append('inputModality', 2)
            data.append('inputOficine', JSON.stringify($('#pruebita').select2('data')))
            data.append('inputBaseFile', $("#formJob input[name=inputBaseFile]")[0].files[0])
            data.append('inputScheduleFile', $("#formJob input[name=inputScheduleFile]")[0].files[0])
            data.append('inputProfileFile', $("#formJob input[name=inputProfileFile]")[0].files[0])
            $.ajax({
                url: '/admin/jobs/register-job',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.close()
                    $('#modalJob').modal('hide')
                    success(data.message)
                    form[0].reset()
                    form[0].classList.remove('was-validated')
                    table.ajax.reload();
                },
                error: function(e) {
                    Swal.close()
                    error(e.responseJSON.message)
                }
            });
        }

    });
    $('#button-register').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('#formJob').trigger('reset')
        $('#formJob .txtarea_description').summernote('reset')
        $('#formJob .txt_function').summernote('reset');
        $('#formJob .txtarea_profile').summernote('reset');
        $('#modalJob').modal('show')
    });

    function setDataSelect(data) {
        let html = []
        let i = 0
        data.forEach((element) => {
            html[i] = `<option value="${element.id}">${(element.name).toUpperCase()}</option>`
            i++;
        });
        $('#oficine_restantes').empty().append(html)
    }
    $('#button-oficine').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let data_ = table.row({ selected: true }).data();
        if (data_ !== undefined) {
            $.ajax({
                url: "/admin/practices/list-oficine",
                data: {
                    id: data_.id
                },
                type: 'GET',
                success: function(data) {
                    setDataSelect(data.oficinas)
                    $("#button-add-oficine").attr('job-id', data_.id)
                    oficinas.clear();
                    oficinas.rows.add(data.data).draw();
                    setDataSelect(data.oficinas)

                    $('#modalOficine').modal('show')
                },
                error: function(e) {
                    console.log(e)
                    alert(e)
                }
            })
        } else {
            error('Debe seleccionar un registro')
        }

    });

    $("#datable_oficine").on('click', '.btn-oficine-state', function() {
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
                showLoading('Subiendo archivos');
                $.ajax({
                    url: '/admin/practices/delete-oficine',
                    type: 'POST',
                    data: { job_oficine_id: $(this).attr('data-id') },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.success) {
                            Swal.close()
                            setDataSelect(data.oficinas)
                            oficinas.clear();
                            oficinas.rows.add(data.new).draw();
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
    })

    $("#datable_oficine_wrapper").on('click', '#button-add-oficine', function() {

        showLoading('Agregando registro');
        $.ajax({
            url: '/admin/practices/add-oficine',
            type: 'POST',
            data: {
                oficine_id: $('#oficine_restantes').val(),
                job_id: $(this).attr('job-id')
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data)
                if (data.success) {
                    Swal.close()
                    setDataSelect(data.oficinas)
                    oficinas.clear();
                    oficinas.rows.add(data.new).draw();
                    success(data.message)
                } else {
                    error(data.error)
                }
            },
            error: function(e) {
                alert(e)
            }
        })
    })

    function setOptions() {
        let select = `
        <div class="dt-buttons flex-wrap">
            <div class="row">
                <select class="col-sm-11 form-control" id="oficine_restantes">

                </select>                 
                <div class="col-sm-1">
                    <button type="button" class="btn btn-success" id="button-add-oficine" data-toggle="modal"><i class="fas fa-plus-square"></i></button>
                </div>
            </div>
        </div>
        `
        $('#datable_oficine_wrapper .col-md-6:eq(0)').append(select)
    }
    $('#button-edit').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({ selected: true }).data();
        if (data !== undefined) {
            console.log(data)
            $('#formEditJob input[name="inputName"]').val(data.title)
            $('#formEditJob input[name="inputDatePublication"]').val(data.date_publication)
            $('#formEditJob input[name="inputDatePostulation"]').val(data.date_postulation)
            $('#formEditJob select[name="inputModality"]').val(data.modality_id)
            $('#formEditJob select[name="inputState"]').val(data.state_job_id)
            $('#formEditJob input[name="inputNumber"]').val(data.number_jobs)
            $('#formEditJob .txtarea_description').summernote("code", data.description);
            $('#formEditJob .txt_function').summernote("code", data.functions);
            $('#formEditJob .txtarea_profile').summernote("code", data.requirements);
            $('#modalEditJob').modal('show')
        } else {
            error('Debe seleccionar un registro')
        }


    })

    $('#formEditJob').on('submit', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({ selected: true }).data();
        if (data !== undefined) {
            let form = $(this)
            if (form[0].checkValidity()) {
                showLoading('Actualizando datos')
                var data_ = new FormData();
                var form_data = $(this).serializeArray();
                $.each(form_data, function(key, input) {
                    data_.append(input.name, input.value)
                });
                data_.append('inputModality', 2)
                data_.append('inputBaseFile', $("#formEditJob input[name=inputBaseFile]")[0].files[0])
                data_.append('inputScheduleFile', $("#formEditJob input[name=inputScheduleFile]")[0].files[0])
                data_.append('inputProfileFile', $("#formEditJob input[name=inputProfileFile]")[0].files[0])

                $.ajax({
                    url: `/admin/jobs/update-job/${data.id}`,
                    type: 'POST',
                    data: data_,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.close()
                        $('#modalEditJob').modal('hide')
                        success(data.message)
                        form[0].reset()
                        form[0].classList.remove('was-validated')
                        table.ajax.reload();

                    },
                    error: function(e) {
                        Swal.close()
                        error(e.responseJSON.message)
                    }
                });
            }
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
    $('#button-view').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({ selected: true }).data()
        if (data !== undefined) {
            $(location).attr('href', `/admin/practices/view-practice?job_id=${data.token}`)
        } else {
            error('Debe seleccionar un registro')
        }

    })


    function showLoading(message) {
        Swal.fire({
            title: `¡${message}!`,
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