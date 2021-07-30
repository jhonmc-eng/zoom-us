<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed !important;/*background-color: #c12323fa;*/">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
      <img src="{{ asset('img/admin/logotipo_region_tacna.png') }}" alt="Gobierno Regional de Tacna" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GRT - OTI</span>
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
            <a href="#" class="d-block">{{session('admin')->names}} {{session('admin')->lastnamePatern}}</a>
          @else
            <a href="#" class="d-block">{{session('candidate')->names}} {{session('candidate')->lastnamePatern}}</a>
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
                    Usuarios
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/jobs" class="nav-link">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Convocatorias
                  </p>
                </a>
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
              
            @endif
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-key"></i>
                  <p>
                    Cambiar Password
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Configuración
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/logout" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    Cerrar Sesión
                  </p>
                </a>
              </li>
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
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-laptop"></i>
                <p>
                  Cursos o Programas {{--de Especializacion--}}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                  Conocimientos {{--para el puesto--}}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>
                  Otros documentos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Referencias
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bookmark"></i>
                <p>
                  Convocatorias
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bookmark"></i>
                <p>
                  Postulaciones
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-key"></i>
                <p>
                  Cambiar Contraseña
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/candidate/logout-candidate" class="nav-link">
                <i class="nav-icon fas fa-people-arrows"></i>
                <p>
                  Cerrar Sesión
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