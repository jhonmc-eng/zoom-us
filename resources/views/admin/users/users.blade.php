@extends('admin.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de Usuarios Registrados</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
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
                <div class="card-header">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombres</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>DNI</th>
                            <th>Cargo</th>
                            <th>Fecha de Inicio</th>
                            <th>Estado</th>
                            <th>Nivel</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombres</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>DNI</th>
                            <th>Cargo</th>
                            <th>Fecha de Inicio</th>
                            <th>Estado</th>
                            <th>Nivel</th>
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
        <!-- /.content -->
    </div>
    
    <div class="modal fade" id="modalNewUser" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formRegisterUser" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                    
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputTypeUser" class="col-sm-4 col-form-label">Tipo de Usuario:</label>
                                    <div class="col-sm-8">
                                        
                                        <select name="inputTypeUser" id="inputTypeUser" class="form-control" required>
                                            <option value="USUARIO">USUARIO</option>
                                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputDni" class="col-sm-4 col-form-label">Dni:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="number" name="inputDni" id="inputDni"class="form-control dni" placeholder="DNI" required>
                                            
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row names">
                                    <label for="inputName" class="col-sm-4 col-form-label">Nombres:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inputName" class="form-control" id="inputName" placeholder="Nombres" required>
                                    </div>
                                </div>
                                <div class="form-group row lastnamePatern">
                                    <label for="inputLastNamePatern" class="col-sm-4 col-form-label">Apellido Paterno:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inputLastNamePatern" class="form-control" id="inputLastNamePatern" placeholder="Apellido Paterno" required>
                                    </div>
                                </div>
                                <div class="form-group row lastnameMatern">
                                    <label for="inputLastNameMatern" class="col-sm-4 col-form-label">Apellido Materno:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inputLastNameMatern" class="form-control" id="inputLastNameMatern" placeholder="Apellido Materno" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputDate" class="col-sm-4 col-form-label">Fecha de Inicio:</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="inputDate" class="form-control" id="inputDate" placeholder="Fecha de Inicio" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="form-group row username">
                                    <label for="inputUser" class="col-sm-4 col-form-label">Usuario:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inputUser" class="form-control" id="inputUser" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdatePassword" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cambiar Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUpdatePassword" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">

                        <div class="card">
                            
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputUserUpdatePassword" class="col-sm-4 col-form-label">Usuario:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="inputUserUpdatePassword" id="inputUserUpdatePassword" placeholder="Username" readonly required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPasswordUpdatePassword" class="col-sm-4 col-form-label">Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="inputPasswordUpdatePassword" id="inputPasswordUpdatePassword" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUpdateUser" class="needs-validation" novalidate >
                    @csrf
                    <div class="modal-body">
                        
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputUpdateTypeUser" class="col-sm-4 col-form-label">Tipo de Usuario:</label>
                                        <div class="col-sm-8">
                                            
                                            <select name="inputUpdateType" id="inputUpdateTypeUser" class="form-control" required>
                                                <option value="USUARIO">USUARIO</option>
                                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputUpdateDni" class="col-sm-4 col-form-label">Dni:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="number" class="form-control dni" name="inputUpdateDni" placeholder="DNI" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row names">
                                        <label for="inputUpdateName" class="col-sm-4 col-form-label">Nombres:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="inputUpdateNames" id="inputUpdateName" placeholder="Nombres" required>
                                        </div>
                                    </div>
                                    <div class="form-group row lastnamePatern">
                                        <label for="inputUpdateLastNamePatern" class="col-sm-4 col-form-label">Apellido Paterno:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="inputUpdateLastnamePatern" id="inputUpdateLastNamePatern" placeholder="Apellido Paterno" required>
                                        </div>
                                    </div>
                                    <div class="form-group row lastnameMatern">
                                        <label for="inputUpdateLastNameMatern" class="col-sm-4 col-form-label">Apellido Materno:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="inputUpdateLastnameMatern" id="inputUpdateLastNameMatern" placeholder="Apellido Materno" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputUpdateDate" class="col-sm-4 col-form-label">Fecha de Inicio:</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="inputUpdateDate" id="inputUpdateDate" placeholder="Fecha de Inicio" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputUpdateUser" class="col-sm-4 col-form-label">Usuario:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputUpdateUser" name="inputUpdateUsername" placeholder="Username" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputUpdateState" class="col-sm-4 col-form-label">Estado:</label>
                                        <div class="col-sm-8">
                                            <select name="inputUpdateState" id="inputUpdateState" class="form-control" required>
                                                <option value="0">Activo</option>
                                                <option value="1">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
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
    <div class="modal fade w-100 h-100" id="modal-loading" data-backdrop="false" >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="height: 100px !important;">
            <div class="overlay">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

@endsection

@section('after-scripts')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>

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
<script src="{{asset('js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('js/demo.js')}}"></script>
<!-- Page specific script -->
<script src="{{asset('js/admin/users/index.js')}}"></script>
<script>
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
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
})()
</script>
@endsection

<style>
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
</style>
