$(document).ready(function() {
    let params = new window.URLSearchParams(window.location.search);
    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: `/admin/candidates/get-academic-postulate/postulation_id=${params.get('postulation_id')}`,
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
})