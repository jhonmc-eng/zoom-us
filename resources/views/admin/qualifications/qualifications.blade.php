@extends('admin.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cursos y Programas de Especialización</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active">Cursos y Programas de Especialización</li>
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
                        <th>Tipo de Estudios</th>
                        <th>Cantidad de Horas</th>
                        <th>Nombre de la institucion</th>
                        <th>Titulo del curso</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                    </tr>
                  </thead>
                  <tbody>
                        
                        </tr>
                  
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Tipo de Estudios</th>
                        <th>Cantidad de Horas</th>
                        <th>Nombre de la institucion</th>
                        <th>Titulo del curso</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
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
    
    <div class="modal fade" id="modalRegisterQualification" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalNewJob" aria-hidden="true">
        <form id="formQualification" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">AGREGAR CURSO O PROGRAMA DE ESPECIALIZACIÓN</h5>
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
                            <label for="type_academic" class="col-sm-6 col-form-label">Tipo de Estudios</label>
                            <label for="cant_hours" class="col-sm-6 col-form-label">Cantidad de Horas</label>
                            <div class="col-sm-6">
                                <select name="type_academic" class="form-control" id="type_academic" required>
                                @foreach($type_qualification as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" name="cant_hours" class="form-control" placeholder="Ingrese cantidad de horas" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name_institution" class="col-sm-12 col-form-label">Nombre de la Institución</label>
                            <div class="col-sm-12">
                                <input type="text" name="name_institution" class="form-control" placeholder="Ingrese nombre de la institucion" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name_course" class="col-sm-12 col-form-label">Titulo del curso y/o programa de especialización</label>
                            <div class="col-sm-12">
                                <input type="text" name="name_course" class="form-control" placeholder="Ingrese nombre del curso o programa" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_start" class="col-sm-6 col-form-label">Fecha de inicio</label>
                            <label for="date_end" class="col-sm-6 col-form-label">Fecha de fin</label>
                              
                            <div class="col-sm-6">
                                <input type="date" name="date_start" class="form-control" required>
                            </div>                     
                            <div class="col-sm-6">
                                <input type="date" name="date_end" class="form-control" required>
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
        </form>
    </div>
    <div class="modal fade" id="modalEditQualification" tabindex="-1" role="dialog" aria-labelledby="modalNewJob" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <form id="formEditQualification" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">EDITAR FORMACIÓN ACADÉMICA</h5>
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
                                <label for="type_academic" class="col-sm-6 col-form-label">Tipo de Estudios</label>
                                <label for="cant_hours" class="col-sm-6 col-form-label">Cantidad de Horas</label>
                                <div class="col-sm-6">
                                    <select name="type_academic" class="form-control" id="type_academic" required>
                                    @foreach($type_qualification as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" name="cant_hours" class="form-control" placeholder="Ingrese cantidad de horas" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_institution" class="col-sm-12 col-form-label">Nombre de la Institución</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name_institution" class="form-control" placeholder="Ingrese nombre de la institucion" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_course" class="col-sm-12 col-form-label">Titulo del curso y/o programa de especialización</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name_course" class="form-control" placeholder="Ingrese nombre del curso o programa" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date_start" class="col-sm-6 col-form-label">Fecha de inicio</label>
                                <label for="date_end" class="col-sm-6 col-form-label">Fecha de fin</label>
                                
                                <div class="col-sm-6">
                                    <input type="date" name="date_start" class="form-control" required>
                                </div>                     
                                <div class="col-sm-6">
                                    <input type="date" name="date_end" class="form-control" required>
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
        </form>
    </div>

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
<!-- AdminLTE App -->
<script src="{{asset('js/admin/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('js/admin/demo.js')}}"></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/admin/qualifications/qualifications.js')}}"></script>
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