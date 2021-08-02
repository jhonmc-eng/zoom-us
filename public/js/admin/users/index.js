$(function () {
   
    var table = $('#datable').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false, 
        "autoWidth": false,
        "ajax": {
            "url": "/admin/users/list-users",
            'dataSrc': 'data',
            "type": "GET"
        },
        "columns": [
            //{ "data": "id"},
            { "data": "username"},
            { "data": "names"},
            { "data": "lastnamePatern"},
            { "data": "lastnameMatern"},
            { "data": "dni"},
            { "data": "cargo"},
            { "data": "date_start" },
            { "data": "state"},
            { "data": "nivel" }
        ],
        'lengthChange': false,
        'pageLength': 5,
        "language": {
            "emptyTable":     "No hay datos disponibles",
            "info":           "Mostrando _START_ de _END_ de un total de _TOTAL_ entradas",
            "infoEmpty":      "Mostrando 0 de 0 de un total de 0 entradas",
            "infoFiltered":   "(filtrado de un total de _MAX_ total entradas)",
            "infoPostFix":    "",
            "thousands":      ".",
            "lengthMenu":     "Mostrar _MENU_ entradas",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron datos",
            "paginate": {
                "first":      "Primera",
                "last":       "ÚLtima",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            'select': {
                'rows': {
                    '_': ""
                }
            }
        },
        
        'select': {
            'style':    'single'
        },
        order: [],
        'bFilter': true,
       
    })

    let buttons = `
    <div class="dt-buttons flex-wrap">
        <button type="button" class="btn btn-success" id="button-register" data-toggle="modal"><i class="far fa-edit"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-user-edit"></i> Editar</button>
        <button type="button" class="btn btn-primary" id="button-password" data-toggle="modal"><i class="fas fa-key"></i> Password</button>
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
    
    $('#formRegisterUser').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        var form = $(this)
        //form[0].trigger('reset')
        if (form[0].checkValidity()) {
            showLoading('Ingresando datos');
            $.ajax({
                url : '/admin/users/create-user',
                type : 'POST',
                data : $('#formRegisterUser').serialize(),
                success: function(data){
                    Swal.close()
                    $('#modalNewUser').modal('hide')
                    success(data.message)
                    form[0].reset()
                    form[0].classList.remove('was-validated')
                    table.ajax.reload();
                },
                error:function(e){
                    Swal.close()
                    error(e.responseJSON.message)
                }
            });
        }
    
    });
    $('#button-register').on('click', function (e) {
        e.preventDefault()
        e.stopPropagation()
        $('#formRegisterUser').trigger('reset')
        $('#modalNewUser').modal('show')
        
    });
    $('#button-edit').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({selected:true}).data();
        if(data !== undefined){
            console.log(data)
            $('#formUpdateUser input[name="inputUpdateNames"]').val(data.names)
            $('#formUpdateUser select[name="inputUpdateType"]').val(data.nivel)
            $('#formUpdateUser input[name="inputUpdateDni"]').val(data.dni)
            $('#formUpdateUser input[name="inputUpdateLastnamePatern"]').val(data.lastnamePatern)
            $('#formUpdateUser input[name="inputUpdateLastnameMatern"]').val(data.lastnameMatern)
            $('#formUpdateUser input[name="inputUpdateDate"]').val(data.date_start)
            $('#formUpdateUser input[name="inputUpdateUsername"]').val(data.username)
            $('#formUpdateUser input[name="inputUpdateState"]').val(data.state_delete)
            $('#formUpdateUser input[name="inputUpdateCharge"]').val(data.cargo)
            if(data.permission_practices == '1' && data.permission_cas == '1'){
                $('#formUpdateUser select[name="inputUpdatePermission"]').val(3)
            }else if(data.permission_practices == 1){
                $('#formUpdateUser select[name="inputUpdatePermission"]').val(2)
            }else{
                $('#formUpdateUser select[name="inputUpdatePermission"]').val(1)
            }
            //$('#formUpdateUser select[name="inputUpdatePermission"]').val(data.nivel)
            $('#modalEditUser').modal('show')
        }else{
            error('¡Debe seleccionar un registro!')
        }
        

    })

    $('#formUpdateUser').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({selected:true}).data();
        if(data !== undefined){
            let form = $(this)
            if (form[0].checkValidity()) {
                showLoading('Actualizando Datos')
                $.ajax({
                    url : `/admin/users/update-user/${data.id}`,
                    type : 'POST',
                    data : form.serialize(),
                    success: function(data){
                        Swal.close()
                        $('#modalEditUser').modal('hide')
                        success(data.message)
                        form[0].reset()
                        form[0].classList.remove('was-validated')
                        table.ajax.reload();
                    },
                    error:function(e){
                        Swal.close()
                        error(e)
                    }
                });
            }
        }else{
            error('¡Debe seleccionar un registro!')
        }
        
    })  
    $('#button-password').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        $('#formUpdatePassword').trigger('reset')
        let data = table.row({selected:true}).data()
        if(data !== undefined){
            $('#formUpdatePassword input[name="inputUserUpdatePassword"]').empty().val(data.username)
            $('#modalUpdatePassword').modal('show')
        }else{
            error('¡Debe seleccionar un registro!')
        }
        
    })
    $('#formUpdatePassword').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let form = $(this)
        let data = table.row({select:true}).data()
        console.log(data)
        if(data != undefined){
            showLoading('Actualizando Password')
            $.ajax({
                url : `/admin/users/resetPassword`,
                type : 'POST',
                data : form.serialize(),
                success:function(data){
                    $('#modalUpdatePassword').modal('hide')
                    Swal.close()
                    success(data.message)
                    form[0].reset()
                    form[0].classList.remove('was-validated')
                    table.ajax.reload();
                },
                error:function(e){
                    Swal.close()
                    error(e)
                }
            })
        }else{
            errorSelect()
        }
    })
    $('.fa-search').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        $('#modal-loading').modal('show')
        let parent = $(this).parent().parent().parent();
        let dni = parent.find('input').val()
        showLoading('Obteniendo datos de la RENIEC')
        $.ajax({
            url : `/admin/users/get-data-dni/${dni}`,
            type : 'GET',
            success: function(data){
                Swal.close()
                parent.parents('form').find('.names input').val(data.data.nombres)
                parent.parents('form').find('.lastnamePatern input').val(data.data.apellido_paterno)
                parent.parents('form').find('.lastnameMatern input').val(data.data.apellido_materno)
                parent.parents('form').find('.username input').val(data.username)
            },
            error: function(e){
                Swal.close()
                error(e.responseJSON.error)
            }
        })
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