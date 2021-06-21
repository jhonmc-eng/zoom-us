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
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
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
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.0
                    </td>
                    <td>Win 95+</td>
                    <td>5</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.5
                    </td>
                    <td>Win 95+</td>
                    <td>5.5</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 6
                    </td>
                    <td>Win 98+</td>
                    <td>6</td>
                    <td>A</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet Explorer 7</td>
                    <td>Win XP SP2+</td>
                    <td>7</td>
                    <td>A</td>
                  </tr>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="inputTypeUser" class="col-sm-4 col-form-label">Tipo de Usuario:</label>
                        <div class="col-sm-8">
                            
                            <select name="types" id="inputTypeUser" class="form-control">
                                <option value="1">Usuario</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDni" class="col-sm-4 col-form-label">Dni:</label>
                        <div class="col-sm-8">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="number" class="form-control datetimepicker-input" data-target="#reservationdate">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Nombres:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputName" placeholder="Nombres">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLastNamePatern" class="col-sm-4 col-form-label">Apellido Paterno:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputLastNamePatern" placeholder="Apellido Paterno">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLastNameMatern" class="col-sm-4 col-form-label">Apellido Materno:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputLastNameMatern" placeholder="Apellido Materno">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDate" class="col-sm-4 col-form-label">Fecha de Inicio:</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="inputDate" placeholder="Fecha de Inicio">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputUser" class="col-sm-4 col-form-label">Usuario:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputUser" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('after-scripts')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>


<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
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
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>--}}
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    var table = $('#datable').DataTable({
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
        
        'select': {
            'style':    'single'
        },
        //'dom': 'Bfrtip',
        'order': [[1, 'asc']],
        'bFilter': true,
        /*'buttons': [
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
            {
                'text': '<i class="fas fa-print"></i> Reporte',
                'className': 'btn btn-warning'
            }
        ]*/
    })//.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    let buttons = `
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-edit"></i> Nuevo</button>
        <button type="button" class="btn btn-info"><i class="fas fa-user-edit"></i> Editar</button>
        <button type="button" class="btn btn-warning"><i class="fas fa-key"></i> Password</button>
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
