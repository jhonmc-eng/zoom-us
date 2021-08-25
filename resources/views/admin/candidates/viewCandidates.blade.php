@extends('admin.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de Candidatos Postulando</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/candidate/profile">Inicio</a></li>
                @if($job->modality->id != 2)
                <li class="breadcrumb-item"><a href="/admin/jobs">CAS</a></li>
                @else
                <li class="breadcrumb-item"><a href="/admin/practices">Practicas</a></li>
                @endif
                <li class="breadcrumb-item"><a href="/candidate/jobs/view">Convocatoria N° {{substr(str_repeat(0, 3).$job->number_jobs, - 3)}} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $job->date_publication)->year}}</a></li>
                <li class="breadcrumb-item active">Candidatos Postulando</li>
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
              <div class="card-header">
                <label class="card-title">{{strtoupper($job->title)}}</label>
              </div>
              <div class="card-body">
                <table id="datable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombres y Apellido</th>
                        <th>DNI</th>
                        <th>Telefono/Celular</th>
                        <th>Correo Electronico</th>
                        @if($job->modality->id == 2)
                        <th>Oficina</th>
                        @endif
                        <th>Ver</th>
                    </tr>
                  </thead>
                  <tbody>
                        
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombres y Apellido</th>
                        <th>DNI</th>
                        <th>Telefono/Celular</th>
                        <th>Correo Electronico</th>
                        @if($job->modality->id == 2)
                        <th>Oficina</th>
                        @endif
                        <th>Ver</th>
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
@if($job->modality->id == 2)
<script src="{{asset('js/admin/candidates/viewCandidatesPractices.js')}}"></script>
@else
<script src="{{asset('js/admin/candidates/viewCandidatesJob.js')}}"></script>
@endif
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