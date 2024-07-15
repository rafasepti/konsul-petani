  <!-- Main Sidebar Container -->
  <aside class="main-sidebar navbar-dark elevation-4" style="background-color: #19920e; ">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('img/logo_konsultasipetani.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light text-light">Konsultasi Petani</span>
    </a>

    <!-- Sidebar -->
    {{-- <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar btn-dark">
              <i class="fas fa-search fa-fw text-light"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            
          <li class="nav-header text-light">MENU</li>
          <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt text-light"></i>
              <p class="text-light">
                Dashboard
                {{-- <span class="badge badge-info right">2</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('user') }}" class="nav-link">
              <i class="nav-icon far fa-user text-light"></i>
              <p class="text-light">
                Data User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('konsultasi') }}" class="nav-link">
              <i class="nav-icon fas fa-comments text-light"></i>
              <p class="text-light">
                Konsultasi Petani
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ url('gejala') }}" class="nav-link">
              <i class="nav-icon fas fa-columns text-light"></i>
              <p class="text-light">
                Data Gejala
              </p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{ url('penyakit') }}" class="nav-link">
              <i class="nav-icon fas fa-columns text-light"></i>
              <p class="text-light">
                Data Penyakit
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('penyakitsolusi') }}" class="nav-link">
              <i class="nav-icon fas fa-columns text-light"></i>
              <p class="text-light">
                Data Penyakit Solusi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('pertanyaan') }}" class="nav-link">
              <i class="nav-icon fas fa-columns text-light"></i>
              <p class="text-light">
                Data Pernyataan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>