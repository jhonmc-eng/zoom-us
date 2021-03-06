@extends('admin.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Formación Académica</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/candidate/profile">Inicio</a></li>
                <li class="breadcrumb-item active">Formación Académica</li>
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
                            <div class="card-body">
                                <table id="datable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tipo de Estudios</th>
                                            <th>Nivel de Estudio</th>
                                            <th>Centro de Estudios</th>
                                            <th>Carrera</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha de fin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tipo de Estudios</th>
                                            <th>Nivel de Estudio</th>
                                            <th>Centro de Estudios</th>
                                            <th>Carrera</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha de fin</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    
                        </div>
                    
                    </div>
                
                </div>
                
            </div>
      
        </section>
        


    </div>
    
    <div class="modal fade" id="modalRegisterAcademic" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalNewJob" aria-hidden="true">
        <form id="formAcademic" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">AGREGAR FORMACIÓN ACADÉMICA</h5>
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
                            <p class="mb-0"> En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
                            <p class="mb-0">El tamaño máximo para los documentos adjuntos (.pdf) es de 10MB</p>
                        </div>
                        <div class="form-group row">
                            <label for="study_center" class="col-sm-12 col-form-label">Centro de Estudios</label>
                            <div class="col-sm-12">
                                <input type="text" name="study_center" class="form-control" placeholder="Ingrese centro de estudios" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="type_academic" class="col-sm-12 col-form-label">Tipo de Estudios</label>
                                <select name="type_academic" class="form-control col-sm-12" id="type_academic" required>
                                @foreach($typeAcademic as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="education_level" class="col-sm-12 col-form-label">Nivel de Estudios</label>
                                <select name="education_level" class="form-control col-sm-12" id="education_level" required>
                                @foreach($educationLevel as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="career" class="col-sm-12 col-form-label">Carrera</label>
                            <div class="col-sm-12">
                                <input type="text" name="career" class="form-control" placeholder="Ingrese nombre de la carrera" required>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-4">
                                <label for="" class="col-sm-12 col-form-label">Colegiatura</label>
                                <div class="col-sm-12">
                                    <div class="form-check col-sm-6 d-inline radio-css">
                                        <input class="form-check-input" type="radio" name="tuition_state" id="tuition_state_true" value="true" checked>
                                        <label class="form-check-label margin-porcen" for="tuition_state_true">SI</label>
                                    </div>
                                    <div class="form-check col-sm-6 d-inline radio-css">
                                        <input class="form-check-input" type="radio" name="tuition_state" id="tuition_state_false" value="false">
                                        <label class="form-check-label margin-porcen" for="tuition_state_false">NO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="tuition_number" class="col-sm-12 col-form-label">N° de Colegiatura</label>
                                <input type="text" name="tuition_number" class="form-control col-sm-12" id="tuition_number" placeholder="Ingrese nombre de la carrera" required>

                            </div>
                            <div class="col-sm-4">
                                <label for="inputProfileFile" class="col-sm-12 col-form-label">Adjuntar Archivo</label>
                                <div class="custom-file col-sm-12">
                                    <input type="file" name="tuition_file" accept="application/pdf" id="tuition_file" class="form-control custom-file-input validation-pdf" required>
                                    <label class="custom-file-label" for="tuition_file">Escoge un archivo</label>
                                </div>
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


    <div class="modal fade" id="modalEditAcademic" tabindex="-1" role="dialog" aria-labelledby="modalNewJob" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <form id="formEditAcademic" class="needs-validation" enctype="multipart/form-data" novalidate>
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
                            <p class="mb-0"> En el campo "FECHA" debe indicar la fecha de obtención del "NIVEL DE ESTUDIOS" que está registrando. En el caso de estudiante, debe indicar la fecha del ciclo culminado que está registrando.</p>
                            <p class="mb-0">El tamaño máximo para los documentos adjuntos (.pdf) es de 10MB</p>
                        </div>
                        <div class="form-group row">
                            <label for="study_center" class="col-sm-12 col-form-label">Centro de Estudios</label>
                            <div class="col-sm-12">
                                <input type="text" name="study_center" class="form-control" placeholder="Ingrese centro de estudios" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="type_academic" class="col-sm-12 col-form-label">Tipo de Estudios</label>
                                <select name="type_academic" class="col-sm-12 form-control" required>
                                @foreach($typeAcademic as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="education_level" class="col-sm-12 col-form-label">Nivel de Estudios</label>
                                <select name="education_level" class="col-sm-12 form-control" required>
                                @foreach($educationLevel as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="career" class="col-sm-12 col-form-label">Carrera</label>
                            <div class="col-sm-12">
                                <input type="text" name="career" class="form-control" placeholder="Ingrese nombre de la carrera" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label">Colegiatura</label>
                                    <div class="form-group">
                                        <div class="form-check col-md-6 radio-css">
                                            <input class="form-check-input" type="radio" name="tuition_state" id="tuition_state_edit_true" value="true" checked>
                                            <label class="form-check-label margin-porcen" for="tuition_state_edit_true">SI</label>
                                        </div>
                                        <div class="form-check col-md-6 radio-css">
                                            <input class="form-check-input" type="radio" name="tuition_state" id="tuition_state_edit_false" value="false">
                                            <label class="form-check-label margin-porcen" for="tuition_state_edit_false">NO</label>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="tuition_number" class="col-form-label">N° de Colegiatura</label>
                                <input type="text" name="tuition_number" class="form-control" placeholder="Ingrese nombre de la carrera" required>

                            </div>
                            <div class="col-sm-4">
                                <label for="inputProfileFile" class="col-form-label">
                                    Adjuntar Archivo
                                    <div id="button-file" class="d-inline">
                                        <a type="button" id="file_license_fa_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>                                               
                                        <br>
                                    </div>
                                </label>
                                <div class="custom-file">
                                    <input type="file" name="tuition_file" accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                    <label class="custom-file-label" for="tuition_file">Escoge un archivo</label>
                                </div>
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
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('js/admin/academic/academic.js')}}"></script>
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