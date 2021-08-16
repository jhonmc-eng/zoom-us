@extends('admin.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de Practicas Publicadas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active">Practicas</li>
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
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Año</th>
                        <th>Nombre</th>
                        <th>Proceso</th>
                        <th>Fecha de publicacion</th>
                        <th>Fecha de postulacion</th>
                        <th>Oficinas</th>
                        <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                        
                        </tr>
                  
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Codigo</th>
                        <th>Año</th>
                        <th>Nombre</th>
                        <th>Proceso</th>
                        <th>Fecha de publicacion</th>
                        <th>Fecha de postulacion</th>
                        <th>Oficinas</th>
                        <th>Accion</th>
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
        <div class="modal fade" id="modalOficine" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalNewJob" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">OFICINAS RESPONSABLES DE LA CONVOCATORIA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            
                            
                            <div class="form-group row">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                            
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="datable_oficine" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th>OFICINA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>OFICINA</th>
                                                    </tr>
                                                </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
    <!--FORMULARO DE REGISTRAR-->

<!-- Modal -->

        <!-- /.content -->
    </div>
    
@endsection

@section('after-scripts')
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="{{asset('plugins/datatables-select/js/dataTables.select.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/datatables-select/css/select.dataTables.min.css')}}">
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>

<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/admin/practices/practicesCandidate.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">

<style>
    #datable td, th{
        text-align: center; 
        vertical-align: middle;
    }
    #datable thead th {
        vertical-align: middle;
    }
    #datable tr {
    cursor: pointer !important;
    }
    #datable_oficine td, th{
        text-align: center; 
        vertical-align: middle;
    }
    #datable_oficine thead th {
        vertical-align: middle;
    }
    #datable_oficine tr {
    cursor: pointer !important;
    }
    .btn-primary {
        color: #fff;
        background-color: #007bff !important;
        border-color: #007bff !important;
        box-shadow: none !important;
    }
    .fa-search{
        cursor: pointer !important;
    }
    .modal-dialog .overlay {
        
        background-color: rgba(0,0,0,0) !important;
        color: #666f76;
        
    }
    .custom-file-label::after {
        content: "Examinar";
    }
</style>
@endsection