@extends('client.app')

@section('content')



<!-- Content
================================================== -->


<!-- Container -->
<div class="container">

		<div class="row">
            <div class="col-lg-2">
            </div>
			<div class="col-lg-8">

				<div class="notification notice large margin-top-55">
					<h4>¿No tienes una cuenta? Registrate</h4>
					<p>Le sugerimos hacer uso de un correo GMAIL ya que recibe los correos al Instante, y no olvide revisar en su carpeta de SPAM.</p>
				</div>

				<div id="add-listing" class="separated-form margin-bottom-55">
                    <form id="form_register">
                        <div class="add-listing-section">

                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-doc"></i> Ingrese sus datos</h3>
                            </div>

                            <div class="row with-forms">
                                <div class="col-md-3">
                                    <h5>Tipo</h5>
                                    <select name="type_document" id="type_document">
                                        <option value="1">DNI</option>
                                        <option value="2">PASAPORTE</option>
                                        <option value="3">OTROS</option>
                                    </select>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-12">
                                        <h5>Numero de Documento(*) <i class="tip" data-tip-content="Numero de Documento"></i></h5>
                                    </div>
                                    <div class="col-md-10">
                                        <input class="search-field" name="document" type="text"/>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="button medium" id="validate_document"> Validar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Title -->
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <h5>Nombres(*) <i class="tip" data-tip-content="Name of your business"></i></h5>
                                    <input class="search-field disabled api" name="name" type="text" disabled/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <h5>Apellido Paterno(*) <i class="tip" data-tip-content="Apellido Paterno"></i></h5>
                                    <input class="search-field disabled api" name="lastname_patern" type="text" disabled/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <h5>Apellido Materno(*) <i class="tip" data-tip-content="Apellido Materno"></i></h5>
                                    <input class="search-field disabled api" name="lastname_matern" type="text" disabled/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <h5>Correo Electronico(*) <i class="tip" data-tip-content="Ingrese Correo Electronico"></i></h5>
                                    <input class="search-field" type="text" name="email" required placeholder="Ingrese correo electronico"/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <h5>Contraseña(*) <i class="tip" data-tip-content="Min 8 y Max 20 caracteres"></i></h5>
                                    <input class="search-field" type="password" required placeholder="Min 8 y Max 20 caracteres"/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <h5>Confirmar Contraseña(*) <i class="tip" data-tip-content="Confirme contraseña"></i></h5>
                                    <input class="search-field" type="password" required placeholder="Confirme contraseña"/>
                                </div>
                            </div>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <input class="search-field" type="submit" value="Registrarse"/>
                                </div>
                            </div>


                        </div>
                    </form>
				</div>
			</div>
            <div class="col-lg-2">
            </div>

		</div>

	</div>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/client/register/register.js')}}"></script>
    
    
@endsection
<style>
    .disabled{
        background-color: #e9ecef !important;
        opacity: 1 !important;
    }
</style>

