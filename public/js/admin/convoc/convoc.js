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
                            button = `<button type="button" class="btn btn-success" disabled data-toggle="modal">ABIERTA</button>`
                            break;
                        case 'CERRADA':
                            button = `<button type="button" class="btn btn-success" disabled data-toggle="modal"><i class="far fa-edit">ABIERTA</i></button>`
                            
                            break;
                        case 'EN PROCESO':
                            button = `<button type="button" class="btn btn-success" disabled data-toggle="modal"><i class="far fa-edit">ABIERTA</i></button>`
                            break;
                        case 'CONCLUIDA':
                            button = `<button type="button" class="btn btn-success" disabled data-toggle="modal"><i class="far fa-edit">ABIERTA</i></button>`
                            break;
                        default:
                            button = `<button type="button" class="btn btn-success" disabled data-toggle="modal"><i class="far fa-edit">ABIERTA</i></button>`

                            break;
                    }
                    return button;
                }
            },
            { data: "date_publication"},
            { data: "date_postulation"},
            { data: "bases"},
            { data: "schedule" },
            { data: "profile"},
            { data: "state_delete"}
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
        <button type="button" class="btn btn-success" id="button-register" data-toggle="modal"><i class="far fa-edit"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-user-edit"></i> Editar</button>
        <button type="button" class="btn btn-warning" id="button-password" data-toggle="modal"><i class="fas fa-key"></i> Password</button>
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

})