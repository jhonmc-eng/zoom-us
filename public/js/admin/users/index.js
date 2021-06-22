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
        'pageLength': 10,
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
        'order': [[1, 'asc']],
        'bFilter': true,
       
    })

    let buttons = `
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNewUser"><i class="far fa-edit"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-user-edit"></i> Editar</button>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdatePassword"><i class="fas fa-key"></i> Password</button>
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
    
    $('#formRegisterUser').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        var form = $(this);
        if (form[0].checkValidity()) {
            $.ajax({
                url : '/admin/users/create-user',
                type : 'POST',
                data : $('#formRegisterUser').serialize(),
                success: function(data){
                    $('#modalNewUser').modal('hide')
                    $('#modalSuccess .modal-body').empty().append(data.message)
                    $('#modalSuccess').modal('show')
                    form[0].reset()
                    form[0].classList.remove('was-validated')
                    table.ajax.reload();
                },
                error:function(e){
                    console.log(e)
                }
            });
        }
        
    });
    /*$('#datable tbody').on( 'click', 'tr', function () {
        let data = table.row(this).data();
        console.log(data)
        //$("#formEditUser input['name']").val(data.names)
        
    } );*/
    $('#button-edit').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({selected:true}).data();
        if(data !== undefined){
            $('#formUpdateUser input[name="inputUpdateNames"]').val(data.names)
            $('#formUpdateUser select[name="inputUpdateType"]').val(data.nivel)
            $('#formUpdateUser input[name="inputUpdateDni"]').val(data.dni)
            $('#formUpdateUser input[name="inputUpdateLastnamePatern"]').val(data.lastnamePatern)
            $('#formUpdateUser input[name="inputUpdateLastnameMatern"]').val(data.lastnameMatern)
            $('#formUpdateUser input[name="inputUpdateDate"]').val(data.date_start)
            $('#formUpdateUser input[name="inputUpdateUsername"]').val(data.username)
            $('#formUpdateUser input[name="inputUpdateState"]').val(data.state_delete)
            $('#modalEditUser').modal('show')
        }else{
            console.log('selecciona un registro')
        }
        

    })

    $('#formUpdateUser').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let data = table.row({selected:true}).data();
        if(data !== undefined){
            let form = $(this)
            if (form[0].checkValidity()) {
                $.ajax({
                    url : `/admin/users/update-user/${data.id}`,
                    type : 'POST',
                    data : form.serialize(),
                    success: function(data){
                        $('#modalEditUser').modal('hide')
                        $('#modalSuccess .modal-body').empty().append(data.message)
                        $('#modalSuccess').modal('show')
                        form[0].reset()
                        form[0].classList.remove('was-validated')
                        table.ajax.reload();
                    },
                    error:function(e){
                        console.log(e)
                    }
                });
            }
        }else{
            console.log('debe seleccionar un registro')
        }
        
    })  
  })