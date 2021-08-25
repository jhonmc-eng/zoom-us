$(document).ready(function() {
    let params = new window.URLSearchParams(window.location.search);
    var table = $('#datable').DataTable({
        processing: true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ajax: {
            url: `/admin/practices/list-candidates?job_id=${params.get('job_id')}`,
            dataSrc: 'data',
            type: "GET"
        },

        columns: [
            //asdasd
            {
                data: "candidate",
                render: function(data) {
                    return `
                        <img src="${data.photo_perfil_path}" style="width:50px !important; height:70px !important" class="brand-image img-circle elevation-3" style="opacity: .8">
                        `
                }
            },
            {
                data: function(row, type, set) {
                    return { "names": row.candidate.names, "lastnamePatern": row.candidate.lastname_patern, "lastnameMatern": row.candidate.lastname_matern }
                },
                render: function(data) {
                    return `${data.names} ${data.lastnamePatern} ${data.lastnameMatern}`
                },
            },
            {
                data: "candidate",
                render: function(data) {
                    return data.document
                }
            },
            {
                data: "candidate",
                render: function(data) {
                    return data.phone
                }
            },
            {
                data: "candidate",
                render: function(data) {
                    return data.email
                }
            },
            {
                data: "oficine",
                render: function(data) {
                    return data.name
                }
            },
            {
                data: "token",
                render: function(data) {
                    return `<a target=_blank href="/admin/practice/view-candidates/candidate?job_id=${params.get('job_id')}&candidate_id=${data}" type="button" class="btn btn-primary"><i class="far fa-eye"></i></a>`
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

    /*
        function pad(str, max) {
            str = str.toString();
            return str.length < max ? pad("0" + str, max) : str;
        }*/

})