$(document).ready(function(){

    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false, 
        autoWidth: false,
        ajax: {
            url: "/admin/modalitys/list-modalitys",
            dataSrc: 'data',
            type: "GET"
        },
        columns: [
            //{ "data": "id"},
            { data: "id"},
            { 
                data: "name"
            },
            { data: "description"},
            { 
                data: "state_delete",
                render: function(data){
                    if(data == 0){
                        return 'ACTIVO'
                    }else{
                        return 'INACTIVO'
                    }
                } 
            },
            
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
        bFilter: true,
       
    })

    let buttons = `
        <button type="button" class="btn btn-success" id="button-register" data-toggle="modal"><i class="nav-icon fas fa-people-arrows"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-edit"></i> Editar</button>
        
    `
    $('#datable_wrapper .col-md-6:eq(0)').append(buttons)

    $('#formModalityNew').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        var form = $(this);
        if (form[0].checkValidity()) {
            //$('#modal-loading').modal('show')
            $.ajax({
                url : '/admin/modalitys/register-modality',
                type : 'POST',
                data : $(this).serialize(),
                success: function(data){
                    //$('#modal-loading').modal('hide')
                    if(data.success){
                        $('#modalModalityNew').modal('hide')
                        $('#modalSuccess .modal-body').empty().append(data.message)
                        $('#modalSuccess').modal('show')
                        form[0].reset()
                        form[0].classList.remove('was-validated')
                        table.ajax.reload();
                    }else{
                        error(e)
                    }
                    
                },
                error:function(e){
                    //$('#modal-loading').modal('hide')
                    error(e)
                }
            });
        }
        
    });
    $('#button-register').on('click', function (e) {
        e.preventDefault()
        e.stopPropagation()
        $('#formModalityNew').trigger('reset')
        $('#formModalityNew .txtarea_description').summernote('reset')
        $('#modalModalityNew').modal('show')
    });
    
    $('#button-edit').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({selected:true}).data();
        if(data !== undefined){
            console.log(data)
            $('#formModalityEdit input[name="name"]').val(data.name)
            $('#formModalityEdit .txtDescription').summernote("code", data.description)
            $('#modalModalityEdit').modal('show')
        }else{
            errorSelect()
        }
        

    })

    $('#formModalityEdit').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({selected:true}).data();
        if(data !== undefined){
            let form = $(this)
            if (form[0].checkValidity()) {
                //$('#modal-loading').modal('show')
                $.ajax({
                    url : `/admin/modalitys/update-modality/${data.token}`,
                    type : 'POST',
                    data : $(this).serialize(),
                    success: function(data){
                        if(data.success){
                            $('#modalModalityEdit').modal('hide')
                            $('#modalSuccess .modal-body').empty().append(data.message)
                            $('#modalSuccess').modal('show')
                            form[0].reset()
                            form[0].classList.remove('was-validated')
                            table.ajax.reload();
                        }else{
                            error(e)
                        }
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