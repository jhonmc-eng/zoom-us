$(document).ready(function() {
    let params = new window.URLSearchParams(window.location.search);
    $('#datable_academic').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: `/admin/candidates/get-academic-postulate?postulation_id=${params.get('postulation_id')}`,
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
    $('#datable_curses').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: `/admin/candidates/get-qualifications-postulate?postulation_id=${params.get('postulation_id')}`,
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
        order: []
    })
    $('#datable_experiencie').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: `/admin/candidates/get-experiencie-postulate?postulation_id=${params.get('postulation_id')}`,
            dataSrc: 'data',
            type: "GET"
        },

        columns: [{
                data: 'charge'
            },
            {
                data: 'institution'
            },
            {
                data: 'area'
            },
            {
                data: 'sector'
            },
            {
                data: 'date_start'
            },
            {
                data: 'date_end'
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
        select: {
            style: 'single'
        },
        bFilter: true,
        order: []
    })
    $('#datable_know').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: `/admin/candidates/get-knowledge-postulate?postulation_id=${params.get('postulation_id')}`,
            dataSrc: 'data',
            type: "GET"
        },

        columns: [{
                data: 'name'
            },
            {
                data: 'detail'
            },
            {
                data: "level_knowledge",
                render: function(data) {
                    return data.name
                }
            },

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
    $('#datable_references').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: `/admin/candidates/get-references-postulate?postulation_id=${params.get('postulation_id')}`,
            dataSrc: 'data',
            type: "GET"
        },

        columns: [{
                data: 'institution'
            },
            {
                data: 'names'
            },
            {
                data: 'charge'
            },
            {
                data: 'phone'
            },
            {
                data: 'email'
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
        select: {
            style: 'single'
        },
        bFilter: true,
        order: []
    })
    $('#datable_others').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: `/admin/candidates/get-training-postulate?postulation_id=${params.get('postulation_id')}`,
            dataSrc: 'data',
            type: "GET"
        },
        columns: [{
                data: 'title'
            },
            {
                data: 'institution'
            },
            {
                data: 'date_emition'
            },
            {
                data: 'certificate_file_path',
                render: function(data) {
                    return `<a target="_blank" type="button" href="/admin/candidates/view-document-candidate?token=${data}" class="btn btn-success"><i class="fas fa-eye"></i></a>`
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
        select: {
            style: 'single'
        },
        bFilter: true,
        order: []
    })
    /*let buttons = `
    <div class="dt-buttons flex-wrap">
        <button type="button" class="btn btn-success" id="button-register" data-toggle="modal"><i class="fas fas fa-graduation-cap"></i> Nuevo</button>
        <button type="button" class="btn btn-info" id="button-edit" data-toggle="modal"><i class="fas fa-edit"></i> Editar</button>
        <button type="button" class="btn btn-danger" id="button-delete" data-toggle="modal"><i class="fas fa-trash-alt"></i> Eliminar</button>
    </div> 
    `
    $('#datable_wrapper .col-md-6:eq(0)').append(buttons)*/

})