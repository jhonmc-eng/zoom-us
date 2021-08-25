@extends('admin.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Experiencia Laboral</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/candidate/profile">Inicio</a></li>
                <li class="breadcrumb-item active">Experiencia Laboral</li>
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
                        <th>Cargo</th>
                        <th>Institución</th>
                        <th>Área</th>
                        <th>Sector</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                    </tr>
                  </thead>
                  <tbody>
                        
                        </tr>
                  
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Cargo</th>
                        <th>Institución</th>
                        <th>Área</th>
                        <th>Sector</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
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
        

<!-- Modal -->

        <!-- /.content -->
    </div>
    <form id="formExperiencie" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="modalRegisterExperiencie" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalNewJob" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">AGREGAR EXPERIENCIA LABORAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                                <p class="mb-0">El tamaño máximo para los documentos adjuntos (.pdf) es de 10MB</p>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="institution" class="col-form-label">Nombre de la Institucion</label>
                                    <input type="text" name="institution" class="form-control" placeholder="Ingrese institución" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="boss" class="col-form-label">Jefe Inmediato</label>
                                    <input type="text" name="boss" class="form-control" placeholder="Ingrese nombre del jefe inmediato" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="phone" class="col-form-label">Teléfono</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Telefono y/o celular" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="charge" class="col-form-label">Cargo Ocupado</label>
                                    <input type="text" name="charge" class="form-control" placeholder="Ingrese cargo ocupado" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="area" class="col-form-label">Área de Labores</label>
                                    <input type="text" name="area" class="form-control" placeholder="Ingrese area de labores" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="sector" class="col-form-label">Sector</label>
                                    <select name="sector" class="form-control">
                                        <option value="1">Publico</option>
                                        <option value="2">Privado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="date_start" class="col-form-label">Fecha de inicio</label>
                                    <input type="date" name="date_start" class="form-control" required>
                                </div>                     
                                <div class="col-sm-6">
                                    <label for="date_end" class="col-form-label">Fecha de fin</label>
                                    <input type="date" name="date_end" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="functions" class="col-sm-12 col-form-label">Funciones</label>
                                <div class="col-sm-12">
                                    <textarea name="functions" class="form-control" required></textarea>
                                </div>     
                            </div>
                            <div class="form-group row">
                                <label for="certificate" class="col-sm-12 col-form-label">Adjuntar certificado</label>
                                
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" name="certificate" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                        <label class="custom-file-label" for="certificate">Escoge un archivo</label>
                                    </div>
                                </div>  
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
                </div>
            </div>
        </div>
    </form>
    <form id="formEditExperiencie" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="modalEditExperiencie" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalNewJob" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">EDITAR EXPERIENCIA LABORAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                                <p class="mb-0">El tamaño máximo para los documentos adjuntos (.pdf) es de 10MB</p>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="institution" class="col-form-label">Nombre de la Institucion</label>
                                    <input type="text" name="institution" class="form-control" placeholder="Ingrese institución" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="boss" class="col-form-label">Jefe Inmediato</label>
                                    <input type="text" name="boss" class="form-control" placeholder="Ingrese nombre del jefe inmediato" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="phone" class="col-form-label">Teléfono</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Telefono y/o celular" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="charge" class="col-form-label">Cargo Ocupado</label>
                                    <input type="text" name="charge" class="form-control" placeholder="Ingrese cargo ocupado" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="area" class="col-form-label">Área de Labores</label>
                                    <input type="text" name="area" class="form-control" placeholder="Ingrese area de labores" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="sector" class="col-form-label">Sector</label>
                                    <select name="sector" class="form-control">
                                        <option value="1">Publico</option>
                                        <option value="2">Privado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="date_start" class="col-form-label">Fecha de inicio</label>
                                    <input type="date" name="date_start" class="form-control" required>
                                </div>                     
                                <div class="col-sm-6">
                                    <label for="date_end" class="col-form-label">Fecha de fin</label>
                                    <input type="date" name="date_end" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="functions" class="col-sm-12 col-form-label">Funciones</label>
                                
                                <div class="col-sm-12">
                                    <textarea name="functions" class="form-control" required></textarea>
                                </div>     
                            </div>
                            <div class="form-group row">
                                <label for="certificate" class="col-sm-12 col-form-label">
                                        Adjuntar certificado
                                        <div id="button-file" class="d-inline">
                                            <a target="_blank" type="button" id="file_path_certificate" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>                                               
                                            <br>
                                        </div>
                                    </label>
                                <div class="col-sm-12">
                                    <div class="custom-file">
                                        <input type="file" name="certificate" accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                        <label class="custom-file-label" for="certificate">Escoge un archivo</label>
                                    </div>
                                </div>  
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
                </div>
            </div>
            
        </div>
    </form>

@endsection

@section('after-scripts')

<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="{{asset('plugins/datatables-select/js/dataTables.select.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/datatables-select/css/select.dataTables.min.css')}}">
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
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/admin/experiencie/experiencie.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    bsCustomFileInput.init();
    var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })
  
</script>
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
    .radio-css{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .margin-porcen{
        margin-left: 10%;
    }
    .view-file{
        padding: .075rem .375rem !important;
        margin-left: 3px !important;
    }
</style>
@endsection