@extends('layout')

@section('konten')
 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Penyakit Solusi</h1>
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
                <div class="card-header">Tambah Penyakit Solusi</div>
                  <div class="card-body">
                      <!-- Awal Dari Input Form -->
                      <form action="{{ url('/penyakitsolusi/store') }}" method="post">
                          @csrf
                          <input class="form-control form-control-solid" id="id_penyakit_solusi" name="id_penyakit_solusi" type="hidden">
                          
                          <div class="mb-3"><label for="namagejalalabel">Nama Penyakit</label>
                            <select class="form-control form-control-solid" id="id_penyakit" name="id_penyakit" aria-label="Default select example">
                              @foreach ($penyakit as $k)
                                <option value="{{$k->id_penyakit}}">{{$k->nama_penyakit}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="mb-3"><label for="solusilabel">Solusi</label>
                            <textarea class="form-control form-control-solid" id="solusi" name="solusi" type="textarea" value="{{old('solusi')}}"></textarea>
                          </div>
      
                          <br>
                          <!-- untuk tombol simpan -->
                          
                          <input class="col-sm-1 btn btn-info btn-sm" type="submit" value="Simpan">
      
                          <!-- untuk tombol batal simpan -->
                          <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/penyakitsolusi') }}" role="button">Batal</a>
                      </form>
                      <!-- Akhir Dari Input Form -->
                  </div>
                </div>
              </div>
    
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- End of Main Content -->

</div>
@endsection