@extends('admin.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de Usuarios Registrados</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <!--
                <div class="card-header">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                -->
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Cargo</th>
                                <th>Fecha de Inicio</th>
                                <th>Nivel</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>Trident</td>
                                <td>Internet
                                Explorer 4.0
                                </td>
                                <td>Win 95+</td>
                                <td> 4</td>
                                <td>X</td>
                                <td> 4</td>
                                <td>X</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Cargo</th>
                                <th>Fecha de Inicio</th>
                                <th>Nivel</th>
                                <th>Estado</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@section('after-scripts')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables2021/css/jquery.dataTables.css')}}">
<script type="text/javascript" src="{{asset('plugins/datatables2021/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/datatables2021/js/dataTables.select.min.js')}}"></script>


<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>

<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $('#example1').DataTable({
        'lengthChange': false,
        'pageLength': 15,
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
        'columnDefs': [
            {
            'targets': 0,
            'checkboxes': {
                'selectRow': true
                }
            }
        ],
        'select': {
            'style': 'single'
        },
        'order': [[1, 'asc']],
        'dom': 'Bfrtip',
        'buttons': [
            {
                'text': '<i class="far fa-edit"></i> Nuevo',
                'className': 'btn btn-success'
            },
            {
                'text': '<i class="fas fa-user-edit"></i> Editar',
                'className': 'btn btn-info'
            },
            {
                'text': '<i class="fas fa-key"></i> Password',
                'className': 'btn btn-warning'
            },
            /*
            {
                'text' : '<i class="far fa-copy"></i>      Copiar',
                'className': 'btn btn-info',
                'extend': 'copy'
            },
            {
                'text' : '<i class="fas fa-file-csv"></i> CSV',
                'className': 'btn btn-info',
                'extend': 'csv'
            },
            {
                'text' : '<i class="far fa-file-excel"></i> Excel',
                'className': 'btn btn-info',
                'extend': 'excel'
            },
            {
                'text' : '<i class="far fa-file-pdf"></i> PDF',
                'className': 'btn btn-info',
                'extend': 'pdf'
            },
            {
                'text' : '<i class="fas fa-print"></i> Imprimir',
                'className': 'btn btn-info',
                'extend': 'print'
            }*/
            {
                'text': '<i class="fas fa-print"></i> Reporte',
                'className': 'btn btn-warning'
            }
        ]
   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
    
  });
</script>
@endsection

<style>
#example1 tr {
cursor: pointer !important;
}
.btn-primary {
    color: #fff;
    background-color: #007bff !important;
    border-color: #007bff !important;
    box-shadow: none !important;
}
</style>
