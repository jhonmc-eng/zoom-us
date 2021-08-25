@extends('admin.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                        
                        @if($job->modality->id != 2)
                        <li class="breadcrumb-item"><a href="/admin/jobs">CAS</a></li>
                        @else
                        <li class="breadcrumb-item"><a href="/admin/practices">Practicas</a></li>
                        @endif
                        <li class="breadcrumb-item active">Convocatoria N° {{substr(str_repeat(0, 3).$job->number_jobs, - 3)}} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $job->date_publication)->year}}</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
       
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info">
                            <div class="company-detail-header text-center">
                                <h2 class="heading mb-15">
                                    {{strtoupper($job->title)}}
                                </h2>
                            
                                <div class="meta-div clearfix mb-25">
                                    <span>de <a target="_blank" class="text-primary text-decoration-none" style="color: #2991A2 !important;font-weight: 600;" href="#">Gobierno Regional De Tacna</a> estado </span>
                                    @switch($job->stateJob->name)
                                        @case('ABIERTA')
                                            <span class="badge badge-success">{{$job->stateJob->name}}</span>
                                            @break
                                        @case('CANCELADA')
                                            <span class="badge badge-info">{{$job->stateJob->name}}</span>
                                            @break
                                        @case('PROCESO')
                                            <span class="badge badge-primary">{{$job->stateJob->name}}</span>
                                            @break
                                        @case('CERRADA')
                                            <span class="badge badge-danger">{{$job->stateJob->name}}</span>
                                            @break
                                        @deafault
                                            <span class="badge badge-warning">{{$job->stateJob->name}}</span>
                                            @break
                                    @endswitch
                                    
                                </div>
                            </div>                    
                        </div>


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                        
                            <!-- info row -->
                            <div class="row invoice-info">
                                
                                <div class="col-sm-3 invoice-col">
                                    <address>
                                        <strong>Convocatoria</strong><br>
                                        N° {{substr(str_repeat(0, 3).$job->number_jobs, - 3)}} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $job->date_publication)->year}}
                                        <br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                    <address>
                                        <strong>Tipo</strong><br>
                                        {{$job->modality->name}}<br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                    <b>Fecha de publicación</b><br>
                                    {{$job->date_publication}}<br>
                                </div>

                                <div class="col-sm-3 invoice-col">
                                    <b>Fecha de postulación</b><br>
                                    {{$job->date_postulation}}<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="row invoice-info">
                                <div class="col-sm-3 invoice-col">
                                    <address>
                                        <strong>Bases</strong><br>
                                        <a target="_blank" href="/admin/jobs/view-base?job_base={{\Crypt::encrypt($job->bases)}}" type="button" class="btn btn-danger">Descargar <i class="fas fa-download"></i></a><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                    <address>
                                        <strong>Cronograma</strong><br>
                                        <a target="_blank" href="/admin/jobs/view-schedule?job_schedule={{\Crypt::encrypt($job->schedule)}}" type="button" class="btn btn-danger">Descargar <i class="fas fa-download"></i></a><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                    <b>Perfil</b><br>
                                    <a target="_blank" href="/admin/jobs/view-profile?job_profile={{\Crypt::encrypt($job->profile)}}" type="button" class="btn btn-danger">Descargar <i class="fas fa-download"></i></a><br>
                                </div>

                                <div class="col-sm-3 invoice-col">
                                    <b>Candidatos</b><br>
                                    <a target="_blank" href="#" type="button" class="btn btn-primary"><i class="fas fa-user-tie"></i></a>`<br>
                                </div>
                                <div class="col-sm-12 invoice-col margin-top-30">
                                    @foreach($types as $item)
                                        @if($item->multiple == 1)
                                            @foreach($item->file as $buttons)
                                                <a target="_blank" href="/admin/jobs/view-result?result={{\Crypt::encrypt($buttons->path)}}" type="button" class="btn btn-info">{{strtoupper($buttons->typeResult->name)}}</a>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                                
                                
                                <!-- /.col -->
                            </div>
                            <!-- Table row -->
                            <div class="row margin-top-30" >
                                
                                <div class="col-md-12 table-responsive">
                                    <div class="col-md-12">
                                        <table id="datable" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ETAPA</th>
                                                    <th>PUBLICACION</th>
                                                    <th>RESULTADOS</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($types as $item)
                                                    <tr>
                                                        @if($item->multiple == 0)
                                                            <td>{{$item->name}}</td>
                                                        
                                                            @if(isset($item->file))
                                                                <td>{{$item->file->date_publication}}</td>
                                                                <td>                                    
                                                                    <a target="_blank" href="/admin/jobs/view-result?result={{Crypt::encrypt($item->file->path)}}" type="button" class="btn btn-info"><i class="fas fa-download"></i></a><br>
                                                                </td>
                                                                <td>
                                                                    <button type="button" data-id="{{\Crypt::encrypt($item->file->id)}}" data-type="{{$item->file->type_result_id}}" data-publication="{{$item->file->date_publication}}" data-name="{{$item->name}}" class="btn btn-warning edit-document"><i class="fas fa-edit"></i></button>
                                                                    <button type="button" data-id="{{\Crypt::encrypt($item->file->id)}}" class="btn btn-danger delete-document"><i class="fas fa-trash-alt"></i></button>
                                                                </td>
                                                            @else
                                                                <td>-------</td>
                                                                <td>-------</td>
                                                                <td>-------</td>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print" style="margin-top: 10px;">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary float-right" id="uploadDocument" style="margin-right: 5px;">
                                        <i class="fas fa-upload"></i> Subir Documentos
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        
    </div>
    <form id="formDocumentNew" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="modalDocumentNew" tabindex="-1" role="dialog" aria-labelledby="modalDocumentNew" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Publicar Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="type_document" class="col-sm-12 col-form-label">Tipo de Documento</label>
                                    <div class="col-sm-12">
                                        <select name="type_document" id="type_document" class="form-control" required>
                                            @foreach($types as $item)
                                                
                                                @if($item->multiple == 0)
                                                    @if(!isset($item->file))
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endif
                                                
                                            
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_publication" class="col-sm-12 col-form-label">Fecha de publicación</label>
                                    <div class="col-sm-12">
                                        <input type="date" name="date_publication" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_document" class="col-sm-12 col-form-label">Archivo</label>
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" name="file_document" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                            <label class="custom-file-label" for="file_document">Escoge un archivo</label>
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
    <form id="formDocumentEdit" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="modalDocumentEdit" tabindex="-1" role="dialog" aria-labelledby="modalDocumentEdit" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Editar Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="type_document" class="col-sm-12 col-form-label">Tipo de Documento</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="type_document_text" class="form-control" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_publication" class="col-sm-12 col-form-label">Fecha de publicación</label>
                                    <div class="col-sm-12">
                                        <input type="date" name="date_publication" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_document" class="col-sm-12 col-form-label">Archivo</label>
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" name="file_document" accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                            <label class="custom-file-label" for="file_document">Escoge un archivo</label>
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
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<!-- Page specific script -->
<script src="{{asset('js/admin/convoc/view-job.js')}}"></script>
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
    #datable thead th {
        vertical-align: middle;
        text-align: center; 
    }
    #datable tbody td {
        vertical-align: middle;
        text-align: center; 
    }

    .margin-top-30{
        margin-top: 30px !important;
    }
    
</style>
@endsection