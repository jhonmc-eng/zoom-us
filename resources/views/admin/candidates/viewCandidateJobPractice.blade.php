@extends('admin.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Candidato</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="/files/users/user_5/profile/file_perfil_1629234849.png"
                        alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ucwords(strtolower($candidate->names))}} {{ucwords(strtolower($candidate->lastname_patern))}} {{ucwords(strtolower($candidate->lastname_matern))}}</h3>
                    <p class="text-muted text-center">Analista Programador Web</p>
                </div>
                
              <!-- /.card-body -->
            </div>
            <div class="card card-danger collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Sobre Mi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab"><i class="fas fa-user"></i> Datos Personales</a></li>
                    <li class="nav-item"><a class="nav-link" href="#academic" data-toggle="tab"><i class="fas fa-graduation-cap"></i> Formacion Academica
                        <span class="badge bg-warning float-right">{{$count['academic']}}</span>
                        </a>
                    </li>
                    <li class="nav-item"><a href="#curses" class="nav-link" data-toggle="tab"><i class="fas fa-laptop"></i> Cursos o Programas
                        <span class="badge bg-warning float-right">{{$count['cursos']}}</span>
                        </a>
                    </li>
                    <li class="nav-item"><a href="#experiencie" class="nav-link" data-toggle="tab"><i class="fas fa-briefcase"></i> Experiencia Laboral
                        <span class="badge bg-warning float-right">{{$count['experiencia']}}</span>
                        </a>
                    </li>
                    <li class="nav-item"><a href="#conocimient" class="nav-link" data-toggle="tab"><i class="fas fa-brain"></i> Conocimientos
                        <span class="badge bg-warning float-right">{{$count['conocimientos']}}</span>
                        </a>
                    </li>
                    <li class="nav-item"><a href="#references" class="nav-link" data-toggle="tab"><i class="fas fa-people-arrows"></i> Referencias Laborales
                        <span class="badge bg-warning float-right">{{$count['referencias']}}</span>
                        </a>
                    </li>
                  <li class="nav-item">
                    <a href="#others" class="nav-link" data-toggle="tab">
                      <i class="fas fa-folder-open"></i> Otros Documentos
                      <span class="badge bg-warning float-right">{{$count['otros']}}</span>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-danger collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Formatos</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body box-profile">
                    
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Formato N° 01</b> <a target="_blank" href="/admin/candidates/view-document-candidate?token={{\Crypt::encrypt($postulation->format_1_path)}}"class="float-right btn btn-success" style="padding: 0.015rem 0.55rem;"><i class="fas fa-eye"></i></a>
                        </li>
                        <li class="list-group-item">
                            <b>Formato N° 02</b> <a target="_blank" href="/admin/candidates/view-document-candidate?token={{\Crypt::encrypt($postulation->format_2_path)}}" class="float-right btn btn-success" style="padding: 0.015rem 0.55rem;"><i class="fas fa-eye"></i></a>
                        </li>
                        <li class="list-group-item">
                            <b>C.V.</b> <a target="_blank" href="/admin/candidates/view-document-candidate?token={{\Crypt::encrypt($postulation->cv_path)}}" class="float-right btn btn-success" style="padding: 0.015rem 0.55rem;"><i class="fas fa-eye"></i></a>
                        </li>
                        <li class="list-group-item">
                            <b>Constancia O Certificado</b> <a class="float-right btn btn-success" style="padding: 0.015rem 0.55rem;"><i class="fas fa-eye"></i></a>
                        </li>
                        <li class="list-group-item">
                            <b>RNSCC</b> <a target="_blank" href="/admin/candidates/view-document-candidate?token={{\Crypt::encrypt($postulation->rnscc_path)}}" class="float-right btn btn-success" style="padding: 0.015rem 0.55rem;"><i class="fas fa-eye"></i></a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-danger btn-block"><b>Comprimido</b></a>
                </div>
                
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <div class="card card-danger card-outline" >
                            <div class="card-header">
                                <h3 class="card-title">DATOS PERSONALES</h3>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="dni">DNI (*)</label>
                                            <input type="number" class="form-control" name="dni" id="dni" placeholder="Ingrese su DNI" disabled value="{{$candidate->document}}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ruc">RUC (**)</label>
                                            <input type="number" class="form-control" id="ruc" name="ruc" placeholder="Ingrese su RUC" value="{{$candidate->ruc}}" required disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email">Correo Electronico (*)</label> 
                                            <input type="email" class="form-control" id="email" placeholder="Ingrese su correo electronico" disabled value="{{$candidate->email}}" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label for="lastname_patern">Apellido Paterno (*)</label>
                                            <input type="text" class="form-control" id="lastname_patern" name="lastname_patern" required placeholder="Ingrese su apellido paterno" disabled value="{{$candidate->lastname_patern}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lastname_matern">Apellido Materno (*)</label>
                                            <input type="text" class="form-control" id="lastname_matern" name="lastname_matern" required placeholder="Ingrese su apellido materno" disabled value="{{$candidate->lastname_matern}}"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label for="names">Nombres (*)</label>
                                            <input type="text" class="form-control" id="names" name="names" placeholder="Ingrese su nombre" required disabled value="{{$candidate->names}}">
                                        </div>
                                        
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label for="gender">Genero (*)</label>
                                            <select name="gender" id="gender" class="form-control" required disabled>
                                                <option value="">Seleccionar</option>
                                                @foreach($genders as $item)
                                                    @if($candidate->gender_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state_civil">Estado Civil (*)</label>
                                            <select name="state_civil" class="form-control" id="state_civil" required disabled>
                                                <option value="">Seleccionar</option>
                                                @foreach($status_civils as $item)
                                                    @if($candidate->status_civil_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone">Teléfono/Celular (*)</label>
                                            <input type="number" class="form-control" id="phone" value="{{$candidate->phone}}" name="phone" disabled required placeholder="Ingrese su telefono o celular">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="nationality">Nacionalidad  (*)</label>
                                            <select name="nationality" class="form-control" id="nationality" required disabled>
                                                <option value="">Seleccionar</option>
                                                @foreach($nationalitys as $item)
                                                    @if($candidate->nationality_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="file_dni">
                                                Adjuntar DNI (Ambos lados PDF)(*)
                                            </label>
                                            <div id="button-file" class="d-inline">
                                                @if($candidate->file_dni_path == '' || is_null($candidate->file_dni_path))
                                                <a type="button" id="file_dni_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>
                                                @else
                                                <a target="_blank" id="file_dni_path" href="/admin/candidates/view-document-candidate?token={{Crypt::encrypt($candidate->file_dni_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif
                                                <br>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="file_dni" id="file_dni" accept="application/pdf" class="form-control custom-file-input validation-pdf" disabled>
                                                <label class="custom-file-label" for="file_document">Escoge un archivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-9">
                                            <label for="exampleInputEmail1">Lugar de Nacimiento (*)</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select name="departament_birth" class="form-control" id="departament_birth" required disabled>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($departament as $item)
                                                            @if($candidate->departament_birth_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="province_birth" class="form-control" id="province_birth" required disabled>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($province_birth as $item)
                                                            @if($candidate->province_birth_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="district_birth" class="form-control" id="district_birth" required disabled>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($district_birth as $item)
                                                            @if($candidate->district_birth_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date_birth">Fecha de nacimiento(*)</label>
                                            <input type="date" class="form-control" name="date_birth" id="date_birth" required disabled value="{{$candidate->date_birth}}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Direccion de Domicilio (*)</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select name="departament_address" class="form-control" id="departament_address" required disabled>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($departament as $item)
                                                            @if($candidate->departament_address_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="province_address" class="form-control" id="province_address" required disabled>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($province_address as $item)
                                                            @if($candidate->province_address_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="district_address" class="form-control" id="district_address" required disabled>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($district_address as $item)
                                                            @if($candidate->district_address_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label for="address_one">Calle / Jirón / Avenida (*)</label>
                                            <input type="text" class="form-control" id="address_one" name="address_one" required disabled placeholder="Ingrese su apellido paterno" value="{{$candidate->address_one}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address_two">Urb./ AAHH./ Asoc. (*)</label>
                                            <input type="text" class="form-control" id="address_two" name="address_two" required disabled placeholder="Ingrese su apellido materno" value="{{$candidate->address_two}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address_number">Nro/MZ-LTE (*)</label>
                                            <input type="text" class="form-control" id="address_number" name="address_number" required disabled placeholder="Ingrese su nombre" value="{{$candidate->address_number}}">
                                        </div>
                                        
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label>Sistema pensionario (*)</label>
                                            <div class="row">
                                                <div class="form-check col-md-4">
                                                </div>
                                                @if($candidate->pension_id == 1)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="pension_state" id="pension_state_onp" value="1" disabled checked>
                                                    <label class="form-check-label" for="pension_state_onp">ONP</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="pension_state" id="pension_state_afp" disabled value="2">
                                                    <label class="form-check-label" for="pension_state_afp">AFP</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="pension_state" id="pension_state_onp" disabled value="1">
                                                    <label class="form-check-label" for="pension_state_onp">ONP</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="pension_state" id="pension_state_afp" disabled value="2" checked>
                                                    <label class="form-check-label" for="pension_state_afp">AFP</label>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="type_afp">Nombre de AFP</label>
                                            @if($candidate->pension_id == 1)
                                            <select class="form-control" id="type_afp" name="type_afp" required disabled>
                                                <option value="">Seleccionar</option>
                                                @foreach($pension as $item)
                                                    @if($candidate->type_pension_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @else
                                            <select class="form-control" id="type_afp" name="type_afp" required disabled>
                                                <option value="">Seleccionar</option>
                                                @foreach($pension as $item)
                                                    @if($candidate->type_pension_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @endif
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1">Licenciado FF.AA. (*)</label>
                                            <div class="row">
                                                <div class="form-check col-md-4">
                                                </div>
                                                @if($candidate->license_FA)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="fa_state" id="fa_state_y" disabled value="true" checked>
                                                    <label class="form-check-label" for="fa_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="fa_state" id="fa_state_n" disabled value="false">
                                                    <label class="form-check-label" for="fa_state_n">NO</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="fa_state" id="fa_state_y" disabled value="true">
                                                    <label class="form-check-label" for="fa_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="fa_state" id="fa_state_n" disabled value="false" checked>
                                                    <label class="form-check-label" for="fa_state_n">NO</label>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="file_fa">Adjuntar Documento</label>
                                            <div id="button-file" class="d-inline">
                                                @if($candidate->license_path == '' || is_null($candidate->license_path))
                                                <a type="button" id="file_license_fa_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>                                               
                                                @else
                                                <a target="_blank" id="file_license_fa_path" href="/admin/candidates/view-document-candidate?token={{Crypt::encrypt($candidate->license_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif                                                
                                                <br>
                                            </div>
                                            <div class="custom-file">
                                                @if($candidate->license_FA)
                                                <input type="file" name="file_fa" id="file_fa" accept="application/pdf" class="form-control custom-file-input validation-pdf" disabled>
                                                @else
                                                <input type="file" name="file_fa" id="file_fa" accept="application/pdf" class="form-control custom-file-input validation-pdf" disabled>
                                                @endif
                                                <label class="custom-file-label" for="file_document">Escoge un archivo</label>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label>Persona con Discapacidad (*)</label>
                                            <div class="row">
                                                <div class="form-check col-md-4">
                                                </div>
                                                @if($candidate->discapacity_state)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="discapacity_state" disabled value="true" id="discapacity_state_y" checked>
                                                    <label class="form-check-label" for="discapacity_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="discapacity_state" disabled value="false" id="discapacity_state_n">
                                                    <label class="form-check-label" for="discapacity_state_n">NO</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="discapacity_state" disabled value="true" id="discapacity_state_y" >
                                                    <label class="form-check-label" for="discapacity_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="discapacity_state" disabled value="false" id="discapacity_state_n" checked>
                                                    <label class="form-check-label" for="discapacity_state_n">NO</label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="type_discapacity">Tipo de Discapacidad</label>
                                            @if($candidate->discapacity_state)
                                            <select name="type_discapacity" id="type_discapacity" class="form-control" required>
                                                <option value="">Seleccionar</option>
                                                @foreach($type_discapacity as $item)
                                                    @if($candidate->type_discapacity_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @else
                                            <select name="type_discapacity" id="type_discapacity" class="form-control" disabled>
                                                <option value="">Seleccionar</option>
                                                @foreach($type_discapacity as $item)
                                                    @if($candidate->type_discapacity_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @endif
                                            
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="file_discapacity">Adjuntar Documento Sustentario</label>
                                            <div id="button-file" class="d-inline">
                                                @if($candidate->discapacity_file_path == '' || is_null($candidate->discapacity_file_path))
                                                <a type="button" id="file_discapacity_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>                                               
                                                @else
                                                <a target="_blank" id="file_discapacity_path" href="/admin/candidates/view-document-candidate?token={{Crypt::encrypt($candidate->discapacity_file_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif                                                
                                                <br>
                                            </div>
                                            <div class="custom-file">
                                                @if($candidate->discapacity_state)
                                                <input type="file" name="file_discapacity" id="file_discapacity" disabled accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                                @else
                                                <input type="file" name="file_discapacity" id="file_discapacity" disabled accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                                @endif
                                                <label class="custom-file-label" for="file_document">Escoge un archivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label>Licencia de Conducir(*)</label>
                                            <div class="row">
                                                <div class="form-check col-md-4">
                                                </div>
                                                @if($candidate->license_driver)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="license_driver" disabled value="true" id="license_driver_y" checked>
                                                    <label class="form-check-label" for="license_driver_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="license_driver" disabled value="false" id="license_driver_n">
                                                    <label class="form-check-label" for="license_driver_n">NO</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="license_driver" disabled value="true" id="license_driver_y" >
                                                    <label class="form-check-label" for="license_driver_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="license_driver" disabled value="false" id="license_driver_n" checked>
                                                    <label class="form-check-label" for="license_driver_n">NO</label>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">Adjuntar Documento Sustentario</label>
                                            <div id="button-file" class="d-inline">
                                                @if($candidate->license_driver_path == '' || is_null($candidate->license_driver_path))
                                                <a type="button" id="file_license_driver_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>                                               
                                                @else
                                                <a target="_blank" id="file_license_driver_path" href="/admin/candidates/view-document-candidate?token={{Crypt::encrypt($candidate->license_driver_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif                                                 <br>
                                            </div>
                                            <div class="custom-file">
                                                @if($candidate->license_driver)
                                                <input type="file" disabled name="file_license_driver" accept="application/pdf" id="file_license_driver" class="form-control custom-file-input validation-pdf">
                                                @else
                                                <input type="file" required name="file_license_driver" accept="application/pdf" id="file_license_driver" class="form-control custom-file-input validation-pdf" disabled>
                                                @endif
                                                <label class="custom-file-label" for="file_license_driver" >Escoge un archivo</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">¿Tiene familiares hasta en 4to grado de consanguinidad y segundo de afinidad laborando en el GRT?(*)</label>
                                            <div class="row">
                                                <div class="form-check col-md-4">
                                                </div>
                                                @if($candidate->consanguinity)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" id="consanguinity_state_y" disabled value="true" name="consanguinity_state" checked>
                                                    <label class="form-check-label" for="consanguinity_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" id="consanguinity_state_n" disabled value="false" name="consanguinity_state">
                                                    <label class="form-check-label" for="consanguinity_state_n">NO</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" id="consanguinity_state_y" disabled value="true" name="consanguinity_state">
                                                    <label class="form-check-label" for="consanguinity_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" id="consanguinity_state_n" disabled value="false" name="consanguinity_state" checked>
                                                    <label class="form-check-label" for="consanguinity_state_n">NO</label>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="description" class="col-md-12">Descripcion</label>
                                            {!!$candidate->description!!}
                                            
                                        </div>
                                    </div>
                                </div>
                        
                        </div>
                    </div>
                    <div class="tab-pane" id="academic">
                        <div class="card card-danger card-outline" >
                            <div class="card-header">
                                <h3 class="card-title">FORMACION ACADEMICA</h3>
                            </div>
                            <div class="card-body">
                                <table id="datable_academic" class="table table-bordered table-striped">
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
                    <div class="tab-pane" id="curses">
                        <div class="card card-danger card-outline" >
                            <div class="card-header">
                                <h3 class="card-title">CURSOS Y PROGRAMAS DE ESPECIALIZACION</h3>
                            </div>
                            <div class="card-body">
                                <table id="datable_curses" class="table table-bordered table-striped">
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
                        
                        </div>
                    </div>
                    <div class="tab-pane" id="experiencie">
                        <div class="card card-danger card-outline" >
                            <div class="card-header">
                                <h3 class="card-title">EXPERIENCIA LABORAL</h3>
                            </div>
                            <div class="card-body">
                                <table id="datable_experiencie" class="table table-bordered table-striped">
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
                    <div class="tab-pane" id="conocimient">
                        <div class="card card-danger card-outline" >
                            <div class="card-header">
                                <h3 class="card-title">CONOCIMIENTOS PARA EL PUESTO</h3>
                            </div>
                            <div class="card-body">
                                <table id="datable_know" class="table table-bordered table-striped">
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
                        
                        </div>
                    </div>
                    <div class="tab-pane" id="references">
                        <div class="card card-danger card-outline" >
                            <div class="card-header">
                                <h3 class="card-title">REFERENCIAS LABORALES</h3>
                            </div>
                            <div class="card-body">
                                <table id="datable_references" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Institución</th>
                                            <th>Nombre y Apellido</th>
                                            <th>Cargo</th>
                                            <th>Telefono/Celular</th>
                                            <th>Correo Electrónico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            
                                            </tr>
                                    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Institución</th>
                                            <th>Nombre y Apellido</th>
                                            <th>Cargo</th>
                                            <th>Telefono/Celular</th>
                                            <th>Correo Electrónico</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                    <div class="tab-pane" id="others">
                        <div class="card card-danger card-outline" >
                            <div class="card-header">
                                <h3 class="card-title">OTROS DOCUMENTOS</h3>
                            </div>
                            <div class="card-body">
                                <table id="datable_others" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Institución</th>
                                        <th>Fecha de Emisión</th>
                                        <th>Archivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                        </tr>
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Institución</th>
                                        <th>Fecha de Emisión</th>
                                        <th>Archivo</th>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">


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
<script src="{{asset('js/admin/candidates/viewDataCandidatePostulation.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">

<style>
    .table td, th{
        text-align: center !important; 
        vertical-align: middle !important;
    }
    .table thead th {
        vertical-align: middle !important;
    }
    .table tr {
    cursor: pointer !important;
    }
    .view-file{
    padding: .075rem .375rem !important;
    margin-left: 3px !important;
}
</style>
@endsection