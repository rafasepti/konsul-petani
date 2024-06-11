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

                @if($message = Session::get('success'))

                <div class="alert alert-success">
                    {{ $message }}
                </div>
                
                @endif
                
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-md-6"><b>User Data</b></div>
                            <div class="col col-md-6">
                                <a href="{{ url('user/create') }}" class="btn btn-success btn-sm float-right">
                                    <i class="fas fa-plus"> Tambah</i></a>
                            </div>
                        </div>
                    </div>
                    <?php $noUrut = 0; ?>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                            @if(count($user) > 0)
                
                                @foreach($user as $row)
                                    <?php $noUrut++; ?>
                                    <tr>
                                        <td>{{ $noUrut }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->tipe }}</td>
                                        <td>
                                            <a href="{{url('user/edit',$row->id)}}" class="btn btn-success btn-circle">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a onclick="deleteConfirm(this); return false;" href="#" data-id="{{ $row->id }}" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No Data Found</td>
                                </tr>
                            @endif
                        </table>
                        {{-- {!! $user->links() !!} --}}
                    </div>
                </div>

            </div>

            
        </div>

        
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Modal Delete -->
        <script>
            function deleteConfirm(e){
                var tomboldelete = document.getElementById('btn-delete')  
                id = e.getAttribute('data-id');

                // const str = 'Hello' + id + 'World';
                var url3 = "{{url('user/destroy/')}}";
                var url4 = url3.concat("/",id);
                // console.log(url4);

                // console.log(id);
                // var url = "{{url('perusahaan/destroy/"+id+"')}}";
                
                // url = JSON.parse(rul.replace(/"/g,'"'));
                tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

                var pesan = "Data dengan ID <b>"
                var pesan2 = " </b>akan dihapus"
                var res = id;
                document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

                var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
                
                myModal.show();
            
            }
        </script>
        <!-- Logout Delete Confirmation-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="xid"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                    
                </div>
                </div>
            </div>
        </div>   
    <!-- Akhir Modal Delete -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection