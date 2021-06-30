@extends('admin.app')

@section('content')
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
                        <li class="breadcrumb-item"><a href="/admin/jobs">Convocatorias</a></li>
                        <li class="breadcrumb-item active">Convocatoria N°058-2020</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        
        {{--<section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="company-detail-header text-center">
                                    <h2 class="heading mb-15">CONCURSO CAS N°058-2021 GOB.REG.TACNA DE LA SUB GERENCIA DE PLANEAMIENTO Y ACONDICIONAMIENTO TERRITORIAL</h2>
                                
                                    <div class="meta-div clearfix mb-25">
                                        <span>de <a target="_blank" href="#">Gobierno Regional De Tacna</a> estado </span>
                                        <span class="badge badge-success">CERRADA</span>	
                                    </div>
                                </div>
                            </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                           
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
        </section>--}}
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
                                        <a target="_blank" href="/admin/jobs/view-base?job_base={{$job->bases}}" type="button" class="btn btn-success">BASES</a><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                    <address>
                                        <strong>Cronograma</strong><br>
                                        <a target="_blank" href="/admin/jobs/view-schedule?job_schedule={{$job->schedule}}" type="button" class="btn btn-success">Cronograma</a><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                    <b>Perfil</b><br>
                                    <a target="_blank" href="/admin/jobs/view-profile?job_profile={{$job->profile}}" type="button" class="btn btn-success">Perfil</a><br>
                                </div>

                                <div class="col-sm-3 invoice-col">
                                    <b>Candidatos</b><br>
                                    15 candidatos<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- Table row -->
                            <div class="row" style="margin-top: 30px;">
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
                                                <tr>
                                                    <td>Evaluación de Requisitos</td>
                                                    <td>24/04/2021</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                </tr>
                                                <tr>
                                                    <td>Evaluación Curricular</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                </tr>
                                                <tr>
                                                    <td>Evaluación Psicológica</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                </tr>
                                                <tr>
                                                    <td>Evaluación de Conocimientos</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                </tr>
                                                <tr>
                                                    <td>Evaluación de Prueba de Campo</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                </tr>
                                                <tr>
                                                    <td>Entrevista personal</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                </tr>
                                                <tr>
                                                    <td>Resultado Final</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                    <td>-------</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
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
        

<!-- Modal -->

        <!-- /.content -->
    </div>
@endsection

@section('after-scripts')

<style>
    #datable thead th {
        vertical-align: middle;
        text-align: center; 
    }
    #datable tbody td {
        vertical-align: middle;
        text-align: center; 
    }
    
</style>
@endsection