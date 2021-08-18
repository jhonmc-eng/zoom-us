@extends('admin.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Datos Personales</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/candidate/profile">Inicio</a></li>
                <li class="breadcrumb-item active">Datos Personales</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

       
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <p class="mb-0">Los campos con (*) son obligatorios</p>
                            <p class="mb-0">Los campos con (**) es opcional para la modalidad de prácticas</p>
                            <p class="mb-0">El tamaño máximo para los documentos adjuntos (.pdf) es de 10MB</p>
                        </div>


                    <!-- Main content -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="formProfile" class="needs-validation" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="dni">DNI (*)</label>
                                            <input type="number" class="form-control" name="dni" id="dni" placeholder="Ingrese su DNI" disabled value="{{$data->document}}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ruc">RUC (**)</label>
                                            <input type="number" class="form-control" id="ruc" name="ruc" placeholder="Ingrese su RUC" value="{{$data->ruc}}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email">Correo Electronico (*)</label> 
                                            <input type="email" class="form-control" id="email" placeholder="Ingrese su correo electronico" disabled value="{{$data->email}}" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label for="lastname_patern">Apellido Paterno (*)</label>
                                            <input type="text" class="form-control" id="lastname_patern" name="lastname_patern" required placeholder="Ingrese su apellido paterno" disabled value="{{$data->lastname_patern}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lastname_matern">Apellido Materno (*)</label>
                                            <input type="text" class="form-control" id="lastname_matern" name="lastname_matern" required placeholder="Ingrese su apellido materno" disabled value="{{$data->lastname_matern}}"> 
                                        </div>
                                        <div class="col-md-4">
                                            <label for="names">Nombres (*)</label>
                                            <input type="text" class="form-control" id="names" name="names" placeholder="Ingrese su nombre" required disabled value="{{$data->names}}">
                                        </div>
                                        
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label for="gender">Genero (*)</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="">Seleccionar</option>
                                                @foreach($genders as $item)
                                                    @if($data->gender_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state_civil">Estado Civil (*)</label>
                                            <select name="state_civil" class="form-control" id="state_civil" required>
                                                <option value="">Seleccionar</option>
                                                @foreach($status_civils as $item)
                                                    @if($data->status_civil_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone">Teléfono/Celular (*)</label>
                                            <input type="number" class="form-control" id="phone" value="{{$data->phone}}" name="phone" required placeholder="Ingrese su telefono o celular">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label for="nationality">Nacionalidad  (*)</label>
                                            <select name="nationality" class="form-control" id="nationality" required>
                                                <option value="">Seleccionar</option>
                                                @foreach($nationalitys as $item)
                                                    @if($data->nationality_id == $item->id)
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
                                                @if($data->file_dni_path == '' || is_null($data->file_dni_path))
                                                <a type="button" id="file_dni_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>
                                                @else
                                                <a target="_blank" id="file_dni_path" href="/candidate/profile/view-document?id={{Crypt::encrypt($data->file_dni_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif
                                                <br>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="file_dni" id="file_dni" accept="application/pdf" class="form-control custom-file-input validation-pdf">
                                                <label class="custom-file-label" for="file_document">Escoge un archivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-9">
                                            <label for="exampleInputEmail1">Lugar de Nacimiento (*)</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select name="departament_birth" class="form-control" id="departament_birth" required>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($departament as $item)
                                                            @if($data->departament_birth_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="province_birth" class="form-control" id="province_birth" required>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($province_birth as $item)
                                                            @if($data->province_birth_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="district_birth" class="form-control" id="district_birth" required>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($district_birth as $item)
                                                            @if($data->district_birth_id == $item->id)
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
                                            <input type="date" class="form-control" name="date_birth" id="date_birth" required value="{{$data->date_birth}}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Direccion de Domicilio (*)</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select name="departament_address" class="form-control" id="departament_address" required>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($departament as $item)
                                                            @if($data->departament_address_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="province_address" class="form-control" id="province_address" required>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($province_address as $item)
                                                            @if($data->province_address_id == $item->id)
                                                                <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="district_address" class="form-control" id="district_address" required>
                                                        <option value="">Seleccionar</option>
                                                        @foreach($district_address as $item)
                                                            @if($data->district_address_id == $item->id)
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
                                            <input type="text" class="form-control" id="address_one" name="address_one" required placeholder="Ingrese su apellido paterno" value="{{$data->address_one}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address_two">Urb./ AAHH./ Asoc. (*)</label>
                                            <input type="text" class="form-control" id="address_two" name="address_two" required placeholder="Ingrese su apellido materno" value="{{$data->address_two}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address_number">Nro/MZ-LTE (*)</label>
                                            <input type="text" class="form-control" id="address_number" name="address_number" required placeholder="Ingrese su nombre" value="{{$data->address_number}}">
                                        </div>
                                        
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label>Sistema pensionario (*)</label>
                                            <div class="row">
                                                <div class="form-check col-md-4">
                                                </div>
                                                @if($data->pension_id == 1)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="pension_state" id="pension_state_onp" value="1" checked>
                                                    <label class="form-check-label" for="pension_state_onp">ONP</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="pension_state" id="pension_state_afp" value="2">
                                                    <label class="form-check-label" for="pension_state_afp">AFP</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="pension_state" id="pension_state_onp" value="1">
                                                    <label class="form-check-label" for="pension_state_onp">ONP</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="pension_state" id="pension_state_afp" value="2" checked>
                                                    <label class="form-check-label" for="pension_state_afp">AFP</label>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="type_afp">Nombre de AFP</label>
                                            @if($data->pension_id == 1)
                                            <select class="form-control" id="type_afp" name="type_afp" required disabled>
                                                <option value="">Seleccionar</option>
                                                @foreach($pension as $item)
                                                    @if($data->type_pension_id == $item->id)
                                                        <option value="{{$item->id}}" selected >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @else
                                            <select class="form-control" id="type_afp" name="type_afp" required>
                                                <option value="">Seleccionar</option>
                                                @foreach($pension as $item)
                                                    @if($data->type_pension_id == $item->id)
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
                                                @if($data->license_FA)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="fa_state" id="fa_state_y" value="true" checked>
                                                    <label class="form-check-label" for="fa_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="fa_state" id="fa_state_n" value="false">
                                                    <label class="form-check-label" for="fa_state_n">NO</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="fa_state" id="fa_state_y" value="true">
                                                    <label class="form-check-label" for="fa_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="fa_state" id="fa_state_n" value="false" checked>
                                                    <label class="form-check-label" for="fa_state_n">NO</label>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="file_fa">Adjuntar Documento</label>
                                            <div id="button-file" class="d-inline">
                                                @if($data->license_path == '' || is_null($data->license_path))
                                                <a type="button" id="file_license_fa_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>                                               
                                                @else
                                                <a target="_blank" id="file_license_fa_path" href="/candidate/profile/view-document?id={{Crypt::encrypt($data->license_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif                                                
                                                <br>
                                            </div>
                                            <div class="custom-file">
                                                @if($data->license_FA)
                                                <input type="file" name="file_fa" id="file_fa" accept="application/pdf" class="form-control custom-file-input validation-pdf">
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
                                                @if($data->discapacity_state)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="discapacity_state" value="true" id="discapacity_state_y" checked>
                                                    <label class="form-check-label" for="discapacity_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="discapacity_state" value="false" id="discapacity_state_n">
                                                    <label class="form-check-label" for="discapacity_state_n">NO</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="discapacity_state" value="true" id="discapacity_state_y" >
                                                    <label class="form-check-label" for="discapacity_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="discapacity_state" value="false" id="discapacity_state_n" checked>
                                                    <label class="form-check-label" for="discapacity_state_n">NO</label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="type_discapacity">Tipo de Discapacidad</label>
                                            @if($data->discapacity_state)
                                            <select name="type_discapacity" id="type_discapacity" class="form-control" required>
                                                <option value="">Seleccionar</option>
                                                @foreach($type_discapacity as $item)
                                                    @if($data->type_discapacity_id == $item->id)
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
                                                    @if($data->type_discapacity_id == $item->id)
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
                                                @if($data->discapacity_file_path == '' || is_null($data->discapacity_file_path))
                                                <a type="button" id="file_discapacity_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>                                               
                                                @else
                                                <a target="_blank" id="file_discapacity_path" href="/candidate/profile/view-document?id={{Crypt::encrypt($data->discapacity_file_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif                                                
                                                <br>
                                            </div>
                                            <div class="custom-file">
                                                @if($data->discapacity_state)
                                                <input type="file" name="file_discapacity" id="file_discapacity" accept="application/pdf" class="form-control custom-file-input validation-pdf">
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
                                                @if($data->license_driver)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="license_driver" value="true" id="license_driver_y" checked>
                                                    <label class="form-check-label" for="license_driver_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="license_driver" value="false" id="license_driver_n">
                                                    <label class="form-check-label" for="license_driver_n">NO</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="license_driver" value="true" id="license_driver_y" >
                                                    <label class="form-check-label" for="license_driver_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" name="license_driver" value="false" id="license_driver_n" checked>
                                                    <label class="form-check-label" for="license_driver_n">NO</label>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">Adjuntar Documento Sustentario</label>
                                            <div id="button-file" class="d-inline">
                                                @if($data->license_driver_path == '' || is_null($data->license_driver_path))
                                                <a type="button" id="file_license_driver_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>                                               
                                                @else
                                                <a target="_blank" id="file_license_driver_path" href="/candidate/profile/view-document?id={{Crypt::encrypt($data->license_driver_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif                                                 <br>
                                            </div>
                                            <div class="custom-file">
                                                @if($data->license_driver)
                                                <input type="file"  name="file_license_driver" accept="application/pdf" id="file_license_driver" class="form-control custom-file-input validation-pdf">
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
                                                @if($data->consanguinity)
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" id="consanguinity_state_y" value="true" name="consanguinity_state" checked>
                                                    <label class="form-check-label" for="consanguinity_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" id="consanguinity_state_n" value="false" name="consanguinity_state">
                                                    <label class="form-check-label" for="consanguinity_state_n">NO</label>
                                                </div>
                                                @else
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" id="consanguinity_state_y" value="true" name="consanguinity_state">
                                                    <label class="form-check-label" for="consanguinity_state_y">SI</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input class="form-check-input" type="radio" id="consanguinity_state_n" value="false" name="consanguinity_state" checked>
                                                    <label class="form-check-label" for="consanguinity_state_n">NO</label>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="description" class="col-md-12">Sobre mi</label>
                                            <textarea class="col-md-12 summernote" name="description" id="description">
                                            {{$data->description}}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="file_perfil">Subir Imagen de Perfil</label>
                                            <div id="button-file" class="d-inline">
                                                @if($data->photo_perfil_path == '' || is_null($data->photo_perfil_path))
                                                <a type="button" id="file_perfil_path" class="btn btn-danger view-file"><i class="fas fa-eye-slash"></i></a>                                               
                                                @else
                                                <a target="_blank" id="file_perfil_path" href="/candidate/profile/view-document?id={{Crypt::encrypt($data->photo_perfil_path)}}" type="button" class="btn btn-success view-file"><i class="fas fa-eye"></i></a>
                                                @endif                                                <br>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="file_perfil" id="file_perfil" class="form-control custom-file-input">
                                                <label class="custom-file-label" for="file_perfil">Escoge un archivo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- /.card-body -->

                                <div class="card-footer d-flex justify-content-end">
                                    <input type="submit" class="btn btn-success" value="GUARDAR">
                                </div>
                            </form>
                        </div>

                       
                    <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

<!-- Modal -->

        <!-- /.content -->
    </div>
    <div class="modal fade" id="modalSuccess" aria-hidden="true" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalToggleLabel1" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">¡Exito!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> 

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" data-mdb-target="#exampleModalToggle22" data-mdb-toggle="modal" data-mdb-dismiss="modal" >
                    OK
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after-scripts')
<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('js/admin/profile/profile.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<script>
    bsCustomFileInput.init();
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
        focus: false 
    })
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
</script>
<style>
.view-file{
    padding: .075rem .375rem !important;
    margin-left: 3px !important;
}
</style>
@endsection