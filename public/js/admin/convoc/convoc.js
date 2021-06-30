$(document).ready(function(){

    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false, 
        autoWidth: false,
        ajax: {
            url: "/admin/jobs/list-jobs",
            dataSrc: 'data',
            type: "GET"
        },
        columns: [
            //{ "data": "id"},
            { data: "number_jobs"},
            { 
                data: "modality",
                render: function (data) {
                    return data.name;
                }
            },
            { data: "title"},
            { 
                data: "state_job",
                render: function(data){
                    let button
                    switch(data.name){
                        case "ABIERTA":
                            button = `<button type="button" class="btn btn-success">ABIERTA</button>`
                            break;
                        case 'CERRADA':
                            button = `<button type="button" class="btn btn-danger">CERRADA</button>`
                            
                            break;
                        case 'PROCESO':
                            button = `<button type="button" class="btn btn-primary">PROCESO</button>`
                            break;
                        case 'CANCELADA':
                            button = `<button type="button" class="btn btn-info">CANCELADA</button>`
                            break;
                        default:
                            button = `<button type="button" class="btn btn-secundary">${data.name}</button>`

                            break;
                    }
                    return button;
                } 
            },
            { data: "date_publication"},
            { data: "date_postulation"},
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
                render: function (data) {
                    return data ? `INACTIVO`:`ACTIVO`
                }
            }
        ],
        lengthChange: false,
        pageLength: 10,
        language: {
            emptyTable:     "No hay datos disponibles",
            info:           "Mostrando _START_ de _END_ de un total de _TOTAL_ entradas",
            infoEmpty:      "Mostrando 0 de 0 de un total de 0 entradas",
            infoFiltered:   "(filtrado de un total de _MAX_ total entradas)",
            infoPostFix:    "",
            thousands:      ".",
            lengthMenu:     "Mostrar _MENU_ entradas",
            loadingRecords: "Cargando...",
            processing:     "Procesando...",
            search:         "Buscar:",
            zeroRecords:    "No se encontraron datos",
            paginate: {
                first:      "Primera",
                last:       "ÚLtima",
                next:       "Siguiente",
                previous:   "Anterior"
            },
            aria: {
                sortAscending:  ": activate to sort column ascending",
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
        order: [[1, 'asc']],
        bFilter: true,
       
    })

    let buttons = `
        <button type="button" class="btn btn-success" id="button-register" data-toggle="modal"><i class="fas fa-briefcase"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-edit"></i> Editar</button>
        <button type="button" class="btn btn-primary" id="button-check" data-toggle="modal"><i class="fas fa-check-square"></i> Upload</button>
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
    `
    $('#datable_wrapper .col-md-6:eq(0)').append(buttons)

    $('#formJob').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        var form = $(this)
        
        //console.log($("#formJob input[name=inputBaseFile]")[0].files[0])
        //form[0].trigger('reset')
        if (form[0].checkValidity()) {
            $('#modal-loading').modal('show')
            var data = new FormData();
            var form_data = $(this).serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value)
            });
            data.append('inputBaseFile',$("#formJob input[name=inputBaseFile]")[0].files[0])
            data.append('inputScheduleFile',$("#formJob input[name=inputScheduleFile]")[0].files[0])
            data.append('inputProfileFile',$("#formJob input[name=inputProfileFile]")[0].files[0])
            $.ajax({
                url : '/admin/jobs/register-job',
                type : 'POST',
                data : data,
                processData: false,
                contentType: false,
                success: function(data){
                    $('#modal-loading').modal('hide')
                    $('#modalJob').modal('hide')
                    $('#modalSuccess .modal-body').empty().append(data.message)
                    $('#modalSuccess').modal('show')
                    form[0].reset()
                    form[0].classList.remove('was-validated')
                    table.ajax.reload();
                },
                error:function(e){
                    $('#modal-loading').modal('hide')
                    error(e)
                }
            });
        }
        
    });
    $('#button-register').on('click', function (e) {
        e.preventDefault()
        e.stopPropagation()
        $('#formJob').trigger('reset')
        $('#formJob .txtarea_description').summernote('reset')
        $('#formJob .txt_function').summernote('reset');
        $('#formJob .txtarea_profile').summernote('reset');
        $('#modalJob').modal('show')
    });
    
    $('#button-edit').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({selected:true}).data();
        if(data !== undefined){
            console.log(data)
            /$('#formEditJob input[name="inputName"]').val(data.title)
            $('#formEditJob input[name="inputDatePublication"]').val(data.date_publication)
            $('#formEditJob input[name="inputDatePostulation"]').val(data.date_postulation)
            $('#formEditJob select[name="inputModality"]').val(data.modality_id)
            $('#formEditJob select[name="inputState"]').val(data.state_job_id)
            $('#formEditJob input[name="inputNumber"]').val(data.number_jobs)
            $('#formEditJob .txtarea_description').summernote("code", data.description);
            $('#formEditJob .txt_function').summernote("code", data.functions);
            $('#formEditJob .txtarea_profile').summernote("code", data.requirements);
            $('#modalEditJob').modal('show')
        }else{
            errorSelect()
        }
        

    })

    $('#formEditJob').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({selected:true}).data();
        if(data !== undefined){
            let form = $(this)
            if (form[0].checkValidity()) {
                $('#modal-loading').modal('show')
                var data_ = new FormData();
                var form_data = $(this).serializeArray();
                $.each(form_data, function (key, input) {
                    data_.append(input.name, input.value)
                });
                data_.append('inputBaseFile',$("#formEditJob input[name=inputBaseFile]")[0].files[0])
                data_.append('inputScheduleFile',$("#formEditJob input[name=inputScheduleFile]")[0].files[0])
                data_.append('inputProfileFile',$("#formEditJob input[name=inputProfileFile]")[0].files[0])
                
                $.ajax({
                    url : `/admin/jobs/update-job/${data.id}`,
                    type : 'POST',
                    data : data_,
                    processData: false,
                    contentType: false,
                    success: async function(data){
                        $('#modal-loading').modal('hide')
                        $('#modalEditJob').modal('hide')
                        $('#modalSuccess .modal-body').empty().append(data.message)
                        $('#modalSuccess').modal('show')
                        form[0].reset()
                        form[0].classList.remove('was-validated')
                        table.ajax.reload();
                    },
                    error:function(e){
                        $('#modal-loading').modal('hide')
                        error(e)
                    }
                });
            }
        }else{
            errorSelect()
        }
        
    })  

    $('.validation-pdf').on('change', function(e){
        e.preventDefault()
        e.stopPropagation()
        let file = $(this)[0].files[0]
        let size = file.size
        let type = file.type
        console.log(file,size,type)
        //if(type != "application/pdf" || size <= 1e+7)
    })
    /*$('#button-password').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        $('#formUpdatePassword').trigger('reset')
        let data = table.row({selected:true}).data()
        if(data !== undefined){
            $('#formUpdatePassword input[name="inputUserUpdatePassword"]').empty().val(data.username)
            $('#modalUpdatePassword').modal('show')
        }else{
            errorSelect()
        }
        
    })
    $('#formUpdatePassword').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let form = $(this)
        let data = table.row({select:true}).data()
        console.log(data)
        if(data != undefined){
            $.ajax({
                url : `/admin/users/resetPassword`,
                type : 'POST',
                data : form.serialize(),
                success:function(data){
                    $('#modalUpdatePassword').modal('hide')
                    $('#modalSuccess .moda-header').empty().append('¡Exito!')
                    $('#modalSuccess .modal-body').empty().append(data.message)
                    $('#modalSuccess').modal('show')
                    form[0].reset()
                    form[0].classList.remove('was-validated')
                    table.ajax.reload();
                },
                error:function(){
                    console.log(e)
                }
            })
        }else{
            errorSelect()
        }
    })*/
    
    function errorSelect(){
        $('#modalSuccess .modal-header').empty().append('Error')
        $('#modalSuccess .modal-body').empty().append('¡Debe seleccionar un registro!')
        $('#modalSuccess').modal('show')
    }
    
    function error(e){
        $('#modalSuccess .modal-header').empty().append('Error')
        $('#modalSuccess .modal-body').empty().append(e.responseJSON.message)
        $('#modalSuccess').modal('show')
    }
})