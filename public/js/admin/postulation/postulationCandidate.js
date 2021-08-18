$(document).ready(function() {

    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: "/candidate/postulations/get-data-postulations",
            dataSrc: 'data',
            type: "GET"
        },

        columns: [
            //{ "data": "id"},
            {
                data: "job",
                render: function(data) {
                    return `${pad(data.number_jobs, 3)}-${(new Date(data.date_publication)).getFullYear()}`
                }
            },
            {
                data: "job",
                render: function(data) {
                    return data.title;
                }
            },
            {
                data: "oficine",
                render: function(data) {
                    return data.name;
                }
            },
            {
                data: "job",
                render: function(data) {
                    return data.modality.name;
                }
            },
            {
                data: "job",
                render: function(data) {
                    let button
                    switch (data.state_job.name) {
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
            {
                data: "job",
                render: function(data) {
                    return data.date_publication;
                }
            },
            {
                data: "job",
                render: function(data) {
                    return data.date_postulation;
                }
            },
            {
                data: "job",
                render: function(data) {
                    if (data.modality_id == 2) {
                        return `<a target="_blank" href="/candidate/practices/view-practice?practice_id=${data.token}" type="button" class="btn btn-primary"><i class="fas fa-eye"></i></a>`
                    } else {
                        return `<a target="_blank" href="/candidate/jobs/view-job?job_id=${data.token}" type="button" class="btn btn-primary"><i class="fas fa-eye"></i></a>`
                    }

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
        order: [],
        bFilter: true,
        order: []

    })

    function pad(str, max) {
        str = str.toString();
        return str.length < max ? pad("0" + str, max) : str;
    }
})