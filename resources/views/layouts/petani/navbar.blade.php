<nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
  <div class="container-fluid px-0">
    <a class="navbar-brand font-weight-bolder ms-sm-3" href="">
      Konsultasi Pertanian
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
      <ul class="navbar-nav navbar-nav-hover ms-auto">
        @if (auth()->check())
          <li class="nav-item dropdown dropdown-hover mx-2">
            <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuDocs" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="material-icons opacity-6 me-2 text-md">person</i>
                {{ auth()->user()->name }}
              <img src="{{ asset('petani/assets') }}/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive mt-0 mt-lg-3 p-3 border-radius-lg" aria-labelledby="dropdownMenuDocs">
              <div class="d-none d-lg-block">
                <ul class="list-group">
                  {{-- <li class="nav-item list-group-item border-0 p-0">
                    <a class="dropdown-item py-2 ps-3 border-radius-md" href="">
                      <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Profile</h6>
                    </a>
                  </li> --}}
                  <li class="nav-item list-group-item border-0 p-0">
                    <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item py-2 ps-3 border-radius-md" style="
                        margin-bottom: 0px;">
                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Logout</h6>
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </ul>
          </li>
        @else
          <li class="nav-item ms-lg-auto">
            <a class="nav-link nav-link-icon me-2" href="{{ route('login') }}">
              <p class="d-inline text-sm z-index-1 font-weight-bold" rel="tooltip" title="Login Untuk masuk" data-placement="bottom">Login</p>
            </a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>