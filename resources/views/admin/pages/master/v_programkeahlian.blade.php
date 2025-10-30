<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Program Keahlian')
@section('title', 'Program Keahlian')

<!--awal isi konten dinamis-->
@section('konten')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahProgramKeahlian">
        Tambah Data Program Keahlian
    </button>

    <p>

    <!-- Awal membuat table-->
    <table id="table-programkeahlian" class="table table-bordered table-striped table-hover table-sm">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th width="5%">
                    <center>No</center>
                </th>

                {{-- <th width="15%">
                    <center>ID Program Keahlian</center>
                </th> --}}

                <th width="20%">
                    <center>Kode Program Keahlian</center>
                </th>

                <th width="20%">
                    <center>Nama Program Keahlian</center>
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
            @foreach ($programkeahlian as $index => $pk)
                <tr>
                    {{-- <td align="center" scope="row">{{ $index + $programkeahlian->firstItem() }}</td> --}}
                    <td align="center" scope="row">{{ $index + 1}}</td>
                    {{-- <td align="center">{{ $pk->idprogramkeahlian }}</td> --}}
                    <td align="center">{{ $pk->kodeprogramkeahlian }}</td>
                    <td>{{ $pk->namaprogramkeahlian }}</td>
                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalProgramKeahlianEdit{{ $pk->idprogramkeahlian }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data programkeahlian -->
                        <div class="modal fade" id="modalProgramKeahlianEdit{{ $pk->idprogramkeahlian }}" tabindex="-1" role="dialog" aria-labelledby="modalProgramKeahlianEditLabel" aria-hidden="true">    
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalProgramKeahlianEditLabel">Form Edit Data Program Keahlian</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formprogramkeahlianedit" id="formprogramkeahlianedit" action="/programkeahlian/edit/{{ $pk->idprogramkeahlian }}" method="post">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group row">
                                                <label for="idprogramkeahlian" class="col-sm-3 col-form-label">ID Program Keahlian</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="idprogramkeahlian" name="idprogramkeahlian" value="{{ $pk->idprogramkeahlian }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kodeprogramkeahlian" class="col-sm-3 col-form-label">Kode Program Keahlian</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="kodeprogramkeahlian" name="kodeprogramkeahlian" value="{{ $pk->kodeprogramkeahlian }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="namaprogramkeahlian" class="col-sm-3 col-form-label">Nama Program Keahlian</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="namaprogramkeahlian" name="namaprogramkeahlian" value="{{ $pk->namaprogramkeahlian }}">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="programkeahlianedit" class="btn btn-success" onclick="return confirm('Yakin Mau Edit Data Program Keahlian ?')">Edit</button>
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data programkeahlian -->


                        |

                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalProgramKeahlianHapus{{ $pk->idprogramkeahlian }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data programkeahlian -->
                        <div class="modal fade" id="modalProgramKeahlianHapus{{ $pk->idprogramkeahlian }}" tabindex="-1" aria-labelledby="modalProgramKeahlianHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalProgramKeahlianHapusLabel">Hapus Data Program Keahlian</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data programkeahlian ?</h5>
                                        <h3><font color="red"><span>{{ $pk->programkeahlian}} </span></font></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/programkeahlian/hapus/{{ $pk->idprogramkeahlian }}" method="get">
                                            <button type="submit" name="programkeahlianhapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal" class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data programkeahlian -->
                    </td>
                </tr>
                @endforeach
        </tbody>
        
        <!-- Akhir menampilkan data dalam table-->

    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-programkeahlian').DataTable();
        });
    </script>
    <!-- Akhir membuat table-->


    <!-- Awal Modal tambah data programkeahlian -->
    <div class="modal fade" id="modalTambahProgramKeahlian" tabindex="-1" role="dialog" aria-labelledby="modalTambahProgramKeahlianLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahProgramKeahlianLabel">Form Input Data Program Keahlian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formprogramkeahliantambah" id="formprogramkeahliantambah" action="/programkeahlian/tambah " method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="kodeprogramkeahlian" class="col-sm-3 col-form-label">Kode Program Keahlian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kodeprogramkeahlian" name="kodeprogramkeahlian" placeholder="Masukan Kode Program Keahlian">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="namaprogramkeahlian" class="col-sm-3 col-form-label">Nama Program Keahlian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namaprogramkeahlian" name="namaprogramkeahlian" placeholder="Masukan Nama Program Keahlian">
                            </div>
                        </div>

                    
                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahjurusan" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data programkeahlian -->

@endsection
<!--akhir isi konten dinamis-->



<!--akhir konten dinamis-->
