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
                        <th>Nombre</th>
                        <th>Proceso</th>
                        <th>Fecha de publicacion</th>
                        <th>Fecha de postulacion</th>
                        <th>Candidatos</th>
                    </tr>
                  </thead>
                  <tbody>
                        
                        </tr>
                  
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Proceso</th>
                        <th>Fecha de publicacion</th>
                        <th>Fecha de postulacion</th>
                        <th>Candidatos</th>
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
    <!--FORMULARO DE REGISTRAR-->
    <form id="formJob" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="modalJob" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalNewJob" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Publicar Convocatoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-12 col-form-label">Titulo de la convocatoria</label>
                                <div class="col-sm-12">
                                    <input type="text" name="inputName" class="form-control" placeholder="Titulo" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputOficine" class="col-sm-12 col-form-label">Oficina responsable</label>
                                <div class="col-sm-12">
                                    <select name="inputOficine" required class="form-control select2bs4" id="pruebita" multiple="multiple" data-placeholder="Select a State">
                                        @foreach($oficines as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputDatePublication" class="col-sm-6 col-form-label">Fecha de publicación</label>
                                <label for="inputDatePostulation" class="col-sm-6 col-form-label">Fecha de postulación</label>
                                
                                <div class="col-sm-6">
                                    <input type="date" name="inputDatePublication" class="form-control" required>
                                </div>                     
                                <div class="col-sm-6">
                                    <input type="date" name="inputDatePostulation" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputState" class="col-sm-6 col-form-label">Estado</label>
                                <label for="inputNumber" class="col-sm-6 col-form-label">Número de convocatoria</label>
                                <div class="col-sm-6">
                                    <select name="inputState" class="form-control" required>
                                        @foreach($states as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>      
                                </div>                     
                                <div class="col-sm-6">
                                    <input type="number" name="inputNumber" class="form-control" placeholder="Número" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputBaseFile" class="col-sm-4 col-form-label">Bases</label>
                                <label for="inputScheduleFile" class="col-sm-4 col-form-label">Cronograma</label>
                                <label for="inputProfileFile" class="col-sm-4 col-form-label">Perfil</label>
                                
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input type="file" name="inputBaseFile" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                        <label class="custom-file-label" for="inputBaseFile">Escoge un archivo</label>
                                    </div>
                                </div>    
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input type="file" name="inputScheduleFile" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                        <label class="custom-file-label" for="inputScheduleFile">Escoge un archivo</label>
                                    </div>
                                </div>                     
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input type="file" name="inputProfileFile" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                        <label class="custom-file-label" for="inputProfileFile">Escoge un archivo</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputDescription" class="col-sm-12 col-form-label">Descripcion de Convocatoria</label>
                                <div class="col-sm-12">
                                    <textarea class="summernote form-control txtarea_description" name="inputDescription" form="formJob" required>

                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputFunction" class="col-sm-12 col-form-label">Funciones y responsabilidades</label>
                                <div class="col-sm-12">
                                    <textarea class="summernote form-control txt_function"  name="inputFunction" form="formJob" required>

                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputProfile" class="col-sm-12 col-form-label">Perfil de Convocatoria</label>
                                <div class="col-sm-12">
                                    <textarea class="summernote form-control txtarea_profile" name="inputProfile" form="formJob" required>

                                    </textarea>
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
    <!--FORMULARO DE EDITAR-->
    <form id="formEditJob" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="modalEditJob" tabindex="-1" role="dialog" aria-labelledby="modalNewJob" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Editar Convocatoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-12 col-form-label">Titulo de la convocatoria</label>
                                <div class="col-sm-12">
                                    <input type="text" name="inputName" class="form-control" placeholder="Titulo" required>
                                </div>
                            </div>
                            
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mb-0"></h5>
                                </div>
                                <img class="align-self-start" src="" alt="">
                            </div>
                            <div class="form-group row">
                                <label for="inputDatePublication" class="col-sm-6 col-form-label">Fecha de publicación</label>
                                <label for="inputDatePostulation" class="col-sm-6 col-form-label">Fecha de postulación</label>
                                
                                <div class="col-sm-6">
                                    <input type="date" name="inputDatePublication" class="form-control" required>
                                </div>                     
                                <div class="col-sm-6">
                                    <input type="date" name="inputDatePostulation" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputState" class="col-sm-6 col-form-label">Estado</label>
                                <label for="inputNumber" class="col-sm-6 col-form-label">Número de convocatoria</label>
                                <div class="col-sm-6">
                                    <select name="inputState" class="form-control" required>
                                        @foreach($states as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>      
                                </div>                     
                                <div class="col-sm-6">
                                    <input type="number" name="inputNumber" class="form-control" placeholder="Número" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputBaseFile" class="col-sm-4 col-form-label">Bases</label>
                                <label for="inputScheduleFile" class="col-sm-4 col-form-label">Cronograma</label>
                                <label for="inputProfileFile" class="col-sm-4 col-form-label">Perfil</label>
                                
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input type="file" name="inputBaseFile" accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                        <label class="custom-file-label" for="inputBaseFile">Escoge un archivo</label>
                                    </div>
                                </div>    
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input type="file" name="inputScheduleFile" accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                        <label class="custom-file-label" for="inputScheduleFile">Escoge un archivo</label>
                                    </div>
                                </div>                     
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input type="file" name="inputProfileFile" accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                        <label class="custom-file-label" for="inputProfileFile">Escoge un archivo</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputDescription" class="col-sm-12 col-form-label">Descripcion de Convocatoria</label>
                                <div class="col-sm-12">
                                    <textarea class="summernote form-control txtarea_description" name="inputDescription" >

                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputFunction" class="col-sm-12 col-form-label">Funciones y responsabilidades</label>
                                <div class="col-sm-12">
                                    <textarea class="summernote form-control txt_function"  name="inputFunction" >

                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputProfile" class="col-sm-12 col-form-label">Perfil de Convocatoria</label>
                                <div class="col-sm-12">
                                    <textarea class="summernote form-control txtarea_profile" name="inputProfile" >

                                    </textarea>
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
                                                        
                                                        <th>Nombre</th>
                                                        <th>Accion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Accion</th>
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
<script src="{{asset('js/admin/practices/practices.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
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

    $('.summernote').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
        placeholder: 'Escribe algo aqui...',
        tabsize: 2,
        height: 150,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true 
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