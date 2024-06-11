@extends('layout')

@section('konten')
 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Keluar</a></li>
              {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
              {{-- <li class="breadcrumb-item active">Dashboard v1</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12 col-sm-12">

            <!-- Display Error jika ada error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Akhir Display Error -->

            <div class="card">
                <div class="card-header">Ubah User</div>
                  <div class="card-body">
                    <!-- Awal Dari Input Form -->
                    <form action="{{ url('/user/update') }}" method="post">
                        @csrf
                            <input class="form-control form-control-solid" type="hidden" name="id" value="{{ $user->id }}">

                            <div class="mb-3"><label for="namelabel">Nama</label>
                                <input class="form-control form-control-solid" id="name" name="name" type="text" value="{{ $user->name }}">
                              </div>
    
                              <div class="mb-3"><label for="emaillabel">Email</label>
                                <input class="form-control form-control-solid" id="email" name="email" type="text" value="{{ $user->email }}">
                              </div>
    
                              <div class="mb-3"><label for="passwordlabel">Password</label>
                                <input class="form-control form-control-solid" id="password" name="password" type="password" value="{{ $user->password }}">
                              </div>
    
                              <div class="mb-3"><label for="tipeuserlabel">Tipe User</label>
                                <select class="form-control form-control-solid block mt-1 w-full" id="tipe" name="tipe" aria-label="Defaulselect example">
                                    <option value="admin"> Admin </option>
                                    <option value="petani"> Petani </option>
                                </select>
                              </div>

                            <!-- untuk tombol simpan -->
                            
                            <input class="col-sm-1 btn btn-info btn-sm" type="submit" value="Ubah">

                            <!-- untuk tombol batal simpan -->
                            <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/user') }}" role="button">Batal</a>
                    </form>
                    <!-- Akhir Dari Input Form -->
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- End of Main Content -->

</div>
@endsection