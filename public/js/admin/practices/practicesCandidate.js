$(document).ready(function() {

    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: "/candidate/practices/list-practices",
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
            {
                data: "date_publication",
                render: function(data) {
                    return (new Date(data)).getFullYear()
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
            {
                data: "token",
                render: function(data) {
                    return `<button class="btn btn-primary btn-oficine-state" data-token="${data}"><i class="fas fa-sitemap"></i></button>`
                }
            },
            {
                data: "token",
                render: function(data) {
                    return `<a target="_blank" href="/candidate/practices/view-practice?practice_id=${data}" type="button" class="btn btn-primary"><i class="fas fa-eye"></i></a>`
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

    $("#datable_wrapper").on('click', '.btn-oficine-state', function() {

        showLoading('Agregando registro');
        $.ajax({
            url: '/candidate/practices/list-oficine',
            type: 'GET',
            data: {
                job_id: $(this).attr('data-token')
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    Swal.close()
                    oficinas.clear();
                    oficinas.rows.add(data.data).draw();
                    $('#modalOficine').modal('show')
                } else {
                    error(data.error)
                }
            },
            error: function(e) {
                alert(e)
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