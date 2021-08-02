@extends('admin.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Conocimientos para el puesto</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active">Conocimientos</li>
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
                        <th>Conocimiento</th>
                        <th>Detalle del Conocimiento</th>
                        <th>Dominio</th>
                    </tr>
                  </thead>
                  <tbody>
                        
                        </tr>
                  
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Conocimiento</th>
                        <th>Detalle del Conocimiento</th>
                        <th>Dominio</th>
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
    <form id="formKnowledge" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="modalRegisterKnowledge" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalNewJob" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">AGREGAR CONOCIMIENTO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="type_academic" class="col-sm-12 col-form-label">Conocimiento</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="knowledge" class="form-control" placeholder="Ejm. Herramientas Office" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name_institution" class="col-sm-12 col-form-label">Detalle del Conocimiento</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="detail" class="form-control" placeholder="Ejm. Microsoft Excel" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name_course" class="col-sm-12 col-form-label">Dominio</label>
                                        <div class="col-sm-12">
                                            <select name="knowledge_level" class="form-control" id="knowledge_level">
                                            @foreach($typeKnowledge as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                            </select>
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
    <form id="formEditKnowledge" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="modalEditKnowledge" tabindex="-1" role="dialog" aria-labelledby="modalNewJob" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">EDITAR CONOCIMIENTO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="type_academic" class="col-sm-12 col-form-label">Conocimiento</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="knowledge" class="form-control" placeholder="Ejm. Herramientas Office" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name_institution" class="col-sm-12 col-form-label">Detalle del Conocimiento</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="detail" class="form-control" placeholder="Ejm. Microsoft Excel" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name_course" class="col-sm-12 col-form-label">Dominio</label>
                                    <div class="col-sm-12">
                                        <select name="knowledge_level" class="form-control" id="knowledge_level">
                                        @foreach($typeKnowledge as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" value="Guardar">
                    </div>
                    </form>
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
<script src="{{asset('js/admin/knowledge/knowledge.js')}}"></script>
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