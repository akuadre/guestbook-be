<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Tahun Ajaran')
@section('title', 'Tahun Ajaran')

<!--awal isi konten dinamis-->
@section('konten')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalThnAjaranTambah">
        Tambah Data Tahun Ajaran
    </button>
    <p>

    <!-- Awal membuat table-->
    <table class="table table-bordered table-striped table-hover table-sm" id="table-thnajaran">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th width="5%">
                    <center>No</center>
                </th>

                <th width="20%">
                    <center>Tahun Ajaran</center>
                </th>

                <th width="20%">
                    <center>Tanggal Mulai</center>
                </th>

                <th width="20%">
                    <center>Tanggal Akhir</center>
                </th>

                </th>
                <th width="20%">
                    <center>Aksi</center>
                </th>
            </tr>
        </thead>
        <!-- Akhir header table-->

        <!-- Awal menampilkan data dalam table-->
        <tbody>
            @foreach ($thnajaran as $index => $t)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    {{-- <td align="center">{{ $t->idthnajaran }}</td> --}}
                    <td align="center">{{ $t->thnajaran }}</td>
                    <td align="center">{{ $t->tglmulai }}</td>
                    <td align="center">{{ $t->tglakhir }}</td>
                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalThnAjaranEdit{{ $t->idthnajaran }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data tahun ajaran -->
                        <div class="modal fade" id="modalThnAjaranEdit{{ $t->idthnajaran }}" tabindex="-1" role="dialog" aria-labelledby="modalThnAjaranEditLabel" aria-hidden="true">    
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalThnAjaranEditLabel">Form Edit Data Tahun Ajaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formthnajaranedit" id="formthnajaranedit" action="/thnajaran/edit/{{ $t->idthnajaran }}" method="post">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group row">
                                                <label for="idthnajaran" class="col-sm-3 col-form-label">ID Tahun Ajaran</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="idthnajaran" name="idthnajaran" value="{{ $t->idthnajaran }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="thnajaran" class="col-sm-3 col-form-label">Tahun Ajaran</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="thnajaran" name="thnajaran" value="{{ $t->thnajaran }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tglmulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tglmulai" name="tglmulai" value="{{ $t->tglmulai }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tglakhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tglakhir" name="tglakhir" value="{{ $t->tglakhir }}">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="thnajaranedit" class="btn btn-success" onclick="return confirm('Yakin Mau Edit Tahun Ajaran ?')">Edit</button>
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data tahun ajaran -->
                        |
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalThnAjaranHapus{{ $t->idthnajaran }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        
                        <!-- Awal Modal hapus data tahun ajaran -->
                        <div class="modal fade" id="modalThnAjaranHapus{{ $t->idthnajaran }}" tabindex="-1" aria-labelledby="modalThnAjaranHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalThnAjaranHapusLabel">Hapus Data Tahun Ajaran</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data Tahun Ajaran ?</h5>
                                        <h3><font color="red"><span>{{ $t->thnajaran}} </span></font></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/thnajaran/hapus/{{ $t->idthnajaran }}" method="get">
                                            <button type="submit" name="thnajaranhapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal" class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data tahun ajaran -->
                    </td>
                </tr>
            @endforeach
        </tbody>
        <!-- Akhir menampilkan data dalam table-->

    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-thnajaran').DataTable();
        });
    </script>
    <!-- Akhir membuat table-->

{{-- 
    <!--awal pagination-->
    Halaman : {{ $thnajaran->currentPage() }} <br />
    Jumlah Data : {{ $thnajaran->total() }} <br />
    Data Per Halaman : {{ $thnajaran->perPage() }} <br />

    {{ $thnajaran->links() }}
    <!--akhir pagination--> --}}




    <!-- Awal Modal tambah data tahun ajaran -->
    <div class="modal fade" id="modalThnAjaranTambah" tabindex="-1" role="dialog" aria-labelledby="modalThnAjaranTambahLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalThnAjaranTambahLabel">Form Input Data Tahun Ajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formthnajarantambah" id="formthnajarantambah" action="/thnajaran/tambah " method="post">
                        @csrf
                        {{-- <div class="form-group row">
                            <label for="idthnajaran" class="col-sm-3 col-form-label">ID Tahun Ajaran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="idthnajaran" name="idthnajaran" placeholder="Masukan ID Tahun Ajaran">
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="thnajaran" class="col-sm-3 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="thnajaran" name="thnajaran" placeholder="Masukan Tahun Ajaran">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglmulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tglmulai" name="tglmulai">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tglakhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tglakhir" name="tglakhir">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahthnajaran" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data tahun ajaran -->


@endsection
<!--akhir isi konten dinamis-->



<!--akhir konten dinamis-->
