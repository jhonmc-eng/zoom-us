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
                        <li class="breadcrumb-item"><a href="/candidate/jobs">Convocatorias</a></li>
                        <li class="breadcrumb-item active">Convocatoria N°058-2020</li>
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
                                    <span>de <a class="text-primary text-decoration-none" style="color: #2991A2 !important;font-weight: 600;">Gobierno Regional De Tacna</a> estado </span>
                                    @switch($job->stateJob->name)
                                        @case('ABIERTA')
                                            <span class="badge badge-success">{{$job->stateJob->name}}</span>
                                            @break
                                        @case('CANCELADA')
                                            <span class="badge badge-info">{{$job->stateJob->name}}</span>
                                            @break
                                        @case('EN PROCESO')
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
                                        N°058-2020<br>
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
                                        <a target="_blank" href="/candidate/jobs/view-base?job_base={{\Crypt::encrypt($job->bases)}}" type="button" class="btn btn-danger">Descargar <i class="fas fa-download"></i></a><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                    <address>
                                        <strong>Cronograma</strong><br>
                                        <a target="_blank" href="/candidate/jobs/view-schedule?job_schedule={{\Crypt::encrypt($job->schedule)}}" type="button" class="btn btn-danger">Descargar <i class="fas fa-download"></i></a><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                    <b>Perfil</b><br>
                                    <a target="_blank" href="/candidate/jobs/view-profile?job_profile={{\Crypt::encrypt($job->profile)}}" type="button" class="btn btn-danger">Descargar <i class="fas fa-download"></i></a><br>
                                </div>

                                <div class="col-sm-12 invoice-col margin-top-30">
                                    @foreach($types as $item)
                                        @if($item->multiple == 1)
                                            @foreach($item->file as $buttons)
                                                <a target="_blank" href="/candidate/jobs/view-result?result={{\Crypt::encrypt($buttons->path)}}" type="button" class="btn btn-info">{{strtoupper($buttons->typeResult->name)}}</a>
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
                                                                    <a target="_blank" href="/candidate/jobs/view-result?result={{Crypt::encrypt($item->file->path)}}" type="button" class="btn btn-info"><i class="fas fa-download"></i></a><br>
                                                                </td>
                                                            @else
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
                            @if($job->date_postulation == \Carbon\Carbon::now()->format('Y-m-d') && !App\Models\Postulation::where([['state_delete', 0],['candidate_id', session('candidate')->id],['job_id', $job->id]])->first())
                                <div class="row invoice-info" style="margin-top: 10px;">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success float-center" id="postulate" style="margin-right: 5px;">
                                            <i class="fas fa-user-check"></i> POSTULAR
                                        </button>
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                        
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        
    </div>



    @if($job->date_postulation == \Carbon\Carbon::now()->format('Y-m-d') && !App\Models\Postulation::where([['state_delete', 0],['candidate_id', session('candidate')->id],['job_id', $job->id]])->first())

        <div class="modal fade" id="modalMessageDate" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-costumable modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">REQUISITOS PARA POSTULAR</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label d-flex justify-content-center title-modal"><u>FORMATOS DE POSTULACION</u></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="badge badge-info col-sm-2 badge-required"><u>FORMATO Nº 01 :</u></span>
                                        <div class="col-sm-10">
                                            <label class="col-form-label"><u>FICHA DE INSCRIPCION A MODALIDAD FORMATIVA DE SERVICIO.</u></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <p class="col-form-label">Seleccione la oficina a la cual desea postular</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <select name="chargue_postulation" class="form-control" id="chargue_postulation">
                                            @foreach($oficines as $item)
                                                <option value="{{$item->name->id}}">{{$item->name->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-danger form-control" id="generate-format">Generar</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="badge badge-info col-sm-2 badge-required"><u>HOJA DE VIDA :</u></span>
                                        <div class="col-sm-10">
                                            <label class="col-form-label"><u>RESUMEN DE HOJA DE VIDA (CV) EN FORMATO .PDF</u></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <p class="col-form-label">Adjunte su Curriculum Vitae en Formato PDF <span><a  href="#" class="text-primary text-decoration-none" style="color: #2991A2 !important;font-weight: 600;">Descargar</a></span></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="badge badge-info col-sm-2 badge-required"><u>FORMATO Nº 02 :</u></span>
                                        <div class="col-sm-10">
                                            <label class="col-form-label"><u>DECLARACIONES JURADAS A, B, C, D y E</u></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <p class="col-form-label">Llene las declaraciones juradas respectivas con su firma y huella. <span><a  href="#" class="text-primary text-decoration-none" style="color: #2991A2 !important;font-weight: 600;">Descargar</a></span></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label d-flex justify-content-center title-modal"><u>REQUISITOS PARA POSTULAR</u></label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <span class="badge badge-info col-sm-2 badge-required"><u>Certificado :</u></span>
                                        <div class="col-sm-10">
                                            <label class="col-form-label"><u>CERTIFICADO DE EGRESADO Ó CONSTANCIA DE ESTUDIOS</u></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <p class="col-form-label">Adjuntar Certificado de Egresado (Profesionales) ó Constancia de Estudios (Pre-Profesionales).</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="badge badge-info col-sm-2 badge-required"><u>RNSSC :</u></span>
                                        <div class="col-sm-10">
                                            <label class="col-form-label"><u>REGISTRO NACIONAL DE SANCIONES</u></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <p class="col-form-label">Consultar datos personales e imprimir Reporte de Sanciones.  <span><a target="_blank" href="http://www.sanciones.gob.pe/rnssc/#/transparencia/acceso" class="text-primary text-decoration-none" style="color: #2991A2 !important;font-weight: 600;">Ir a Pagina Web</a></span></p>
                                            <p class="col-form-label">Manual para impresión del Reporte de Sanciones.  <span><a href="#" class="text-primary text-decoration-none" style="color: #2991A2 !important;font-weight: 600;">Descargar</a></span></p>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id='cancel'>Cancelar</button>
                        <button type="button" class="btn btn-success" id="next-modal">Subir Formatos</button>
                    </div>
                </div>
            </div>
        </div>

        <form id="formPostulation" class="needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="modal fade" id="modalPostulation" tabindex="-1" role="dialog" aria-labelledby="modalDocumentNew" data-backdrop="static" data-keyboard="false" aria-hidden="true">
                
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">SUBIR FORMATOS</h5>
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
                                        <p class="mb-0">Debes adjuntar los 04 formatos debidamente llenados y firmados antes de postular.</p>
                                        <p class="mb-0">El tamaño máximo para los formatos requeridos es de 10MB (.pdf)</p>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label">Seleccione la oficina a la cual desea postular</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <select name="oficine_postulation" class="form-control" id="oficine_postulation" required>
                                            @foreach($oficines as $item)
                                                <option value="{{$item->name->id}}">{{$item->name->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="file_format_1" class="col-sm-12 col-form-label">Formato N° 01:</label>
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" name="file_format_1" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                                <label class="custom-file-label" for="file_format_1">Escoge un archivo</label>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                        <label for="file_cv" class="col-sm-12 col-form-label">Hoja de Vida:</label>
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" name="file_cv" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                                <label class="custom-file-label" for="file_cv">Escoge un archivo</label>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                        <label for="file_format_2" class="col-sm-12 col-form-label">Formato N° 02:</label>
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" name="file_format_2" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                                <label class="custom-file-label" for="file_format_2">Escoge un archivo</label>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                        <label for="file_certificate" class="col-sm-12 col-form-label">Certificado de Egresado o Constancia de Estudios:</label>
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" name="file_certificate" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                                <label class="custom-file-label" for="file_certificate">Escoge un archivo</label>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="form-group row">
                                        <label for="file_rnscc" class="col-sm-12 col-form-label">RNSCC:</label>
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" name="file_rnscc" accept="application/pdf" class="form-control custom-file-input validation-pdf" required>
                                                <label class="custom-file-label" for="file_rnscc">Escoge un archivo</label>
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

        <div class="modal fade" id="information" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-costumable modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">COMPLETAR LA SIGUIENTE INFORMACIÓN</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">1. Cuento con Antecedentes Policiales.(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">2. Cuento con Antecedentes Penales.(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">3. Cuento con Antecedentes Judiciales.(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">4. Cuento con sentencia condenatoria consentida y/o ejecutoriada por delito doloso.(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">5. Me encuentro inscrito en el registro Nacional de Sanciones contra Servidores Civiles.(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">6. Me encuentro inscrito en el Registro de Deudores Alimentarios Morosos REDAM.(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">7. Tengo familiares directos de cuarto grado de consenguinidad y segundo de afinidad efectuando labores en la actualidad en el Gobierno Regional de Tacna.(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">8. Tengo vinculo laboral, contractual, de servicios o de cualquier índole con alguna entidad del Sector Público.(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <p class="col-form-label">9. No haber alcanzado el tiempo máximo establecido por la ley para las prácticas Pre Profesionales (02 años) ó prácticas Profesionales (01 año).(*)</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" value="Generar">
                    </div>
                </div>
            </div>
        </div>
    @endif
    
@endsection

@section('after-scripts')
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
@if($job->date_postulation == \Carbon\Carbon::now()->format('Y-m-d') && !App\Models\Postulation::where([['state_delete', 0],['candidate_id', session('candidate')->id],['job_id', $job->id]])->first())
    <script src="{{asset('js/admin/practices/practiceCandidatePostulate.js')}}"></script>
@endif
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
    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
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
    .format-colum{
        padding: 0.4em !important;
    }
    .badge-required {
        padding: .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 2;
        text-align: center;
    }
    .modal-costumable{
        max-width: 650px !important;
    }
    #next-modal, #cancel{
        animation-iteration-count:infinite !important;
    }
    .title-modal{
        font-size: 25px !important;
    }
    @keyframes button{
        0%{
            transform:scale(1.2);
        }
        100%{
            transform:scale(1);
        }
    }

    /*#next-modal, #cancel{
        transform:scale(1.1);
    }*/
    
    /*
    #next-modal, #cancel{
        transition: all .5s ease;
    }
    #next-modal:hover, #cancel:hover{
        transform:scale(1.1);
        
    }
    */

</style>
@endsection