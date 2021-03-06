<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('img/admin/logotipo_region_tacna.png') }}" alt="Gobierno Regional de Tacna" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Convocatorias - GRT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('img/admin/user8-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @if(Session::get('admin'))
            <a href="#" class="d-block">{{session('admin')->names}}</a>
          @elseif(Session::get('candidate'))
            <a href="#" class="d-block">{{session('candidate')->names}}</a>
          @endif
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @if(Session::get('admin'))
            @if(Session::get('admin')->nivel == 'ADMINISTRADOR')
              <li class="nav-item">
                <a href="/admin/users" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Inicio
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/users" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Usuarios
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Convocatorias
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/admin/jobs" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>CAS</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/practices" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Practicas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="/admin/modalitys" class="nav-link">
                  <i class="nav-icon fas fa-people-arrows"></i>
                  <p>
                    Modalidades
                  </p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Candidatos
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-headset"></i>
                  <p>
                    Soporte
                  </p>
                </a>
                
              </li>
              <li class="nav-item">
                  <a href="#Password" data-toggle="modal" data-target="#Password" class="nav-link">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                      Cambiar Password
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/logout" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                      Cerrar Sesi??n
                    </p>
                  </a>
                </li>
            @elseif(Session::get('admin')->nivel == 'USUARIO')
              <li class="nav-item">
                <a href="/admin" class="nav-link">
                  <i class="nav-icon fas fas fa-home"></i>
                  <p>
                    Inicio
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Convocatorias
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @if(Session::get('admin')->permission_cas)
                  <li class="nav-item">
                    <a href="/admin/jobs" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>CAS</p>
                    </a>
                  </li>
                  @endif
                  @if(Session::get('admin')->permission_practices)
                  <li class="nav-item">
                    <a href="/admin/practices" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Practicas</p>
                    </a>
                  </li>
                  @endif
                  
                </ul>
              </li>
              <li class="nav-item">
                  <a href="#Password" data-toggle="modal" data-target="#Password" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                      Candidatos
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#Password" data-toggle="modal" data-target="#Password" class="nav-link">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                      Cambiar Password
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/logout" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                      Cerrar Sesi??n
                    </p>
                  </a>
                </li>
            @endif
              
          @endif

          @if(Session::get('candidate'))
            <li class="nav-item">
              <a href="/candidate/profile" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Datos Personales
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/candidate/academic" class="nav-link">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                  Formacion Academica
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/candidate/qualifications" class="nav-link">
                <i class="nav-icon fas fa-laptop"></i>
                <p>
                  Cursos y/o Programas 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/candidate/knowledge" class="nav-link">
                <i class="nav-icon fas fa-brain"></i>
                <p>
                  Conocimientos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/candidate/experiencie" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                  Experiencia Laboral
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/candidate/training" class="nav-link">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>
                  Otros documentos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/candidate/references" class="nav-link">
                <i class="nav-icon fas fa-people-arrows"></i>
                <p>
                  Referencias
                </p>
              </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Convocatorias
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/candidate/jobs" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>CAS</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/candidate/practices" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Practicas</p>
                    </a>
                  </li>
                </ul>
              </li>
            
            <li class="nav-item">
              <a href="/candidate/postulations" class="nav-link">
                <i class="nav-icon fas fa-bookmark"></i>
                <p>
                  Postulaciones
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#Password" data-toggle="modal" data-target="#Password" class="nav-link">
                <i class="nav-icon fas fa-key"></i>
                <p>
                  Cambiar Contrase??a
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/candidate/logout-candidate" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Cerrar Sesi??n
                </p>
              </a>
            </li>

          @endif
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    
    <!-- /.sidebar -->
  </aside>