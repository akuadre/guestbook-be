<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Jurusan')
@section('title', 'Jurusan')

<!--awal isi konten dinamis-->
@section('konten')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahJurusan">
        Tambah Data Jurusan
    </button>

    <p>

    <!-- Awal membuat table-->
    <table id="table-jurusan" class="table table-bordered table-striped table-hover table-sm">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th width="5%">
                    <center>No</center>
                </th>

                {{-- <th width="15%">
                    <center>ID Jurusan</center>
                </th> --}}

                <th width="20%">
                    <center>Kode Jurusan</center>
                </th>

                <th width="20%">
                    <center>Nama Jurusan</center>
                </th>

                <th width="20%">
                    <center>Program Keahlian</center>
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
            @foreach ($datajurusan as $index => $j)
                <tr>
                    {{-- <td align="center" scope="row">{{ $index + $jurusan->firstItem() }}</td> --}}
                    <td align="center" scope="row">{{ $index + 1}}</td>
                    {{-- <td align="center">{{ $j->idjurusan }}</td> --}}
                    <td align="center">{{ $j->kodejurusan }}</td>
                    <td>{{ $j->namajurusan }}</td>
                    <td>{{ $j->programkeahlian->namaprogramkeahlian }}</td>
                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalJurusanEdit{{ $j->idjurusan }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data jurusan -->
                        <div class="modal fade" id="modalJurusanEdit{{ $j->idjurusan }}" tabindex="-1" role="dialog" aria-labelledby="modalJurusanEditLabel" aria-hidden="true">    
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalJurusanEditLabel">Form Edit Data Jurusan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formjurusanedit" id="formjurusanedit" action="/jurusan/edit/{{ $j->idjurusan }}" method="post">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group row">
                                                <label for="idjurusan" class="col-sm-3 col-form-label">ID Jurusan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="idjurusan" name="idjurusan" value="{{ $j->idjurusan }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kodejurusan" class="col-sm-3 col-form-label">Kode Jurusan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="kodejurusan" name="kodejurusan" value="{{ $j->kodejurusan }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="namajurusan" class="col-sm-3 col-form-label">Nama Jurusan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="namajurusan" name="namajurusan" value="{{ $j->namajurusan }}">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="idprogramkeahlian" class="col-sm-3 col-form-label">Program Keahlian</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idprogramkeahlian" name="idprogramkeahlian">
                                                        @foreach ($programkeahlian as $pk)
                                                            @if ($pk->idprogramkeahlian == $j->idprogramkeahlian)
                                                                <option value="{{ $pk->idprogramkeahlian }}" selected>{{ $pk->namaprogramkeahlian }}</option>
                                                            @else
                                                                <option value="{{ $pk->idprogramkeahlian }}">{{ $pk->namaprogramkeahlian }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="jurusanedit" class="btn btn-success" onclick="return confirm('Yakin Mau Edit Data Jurusan ?')">Edit</button>
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data jurusan -->


                        |

                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalJurusanHapus{{ $j->idjurusan }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data jurusan -->
                        <div class="modal fade" id="modalJurusanHapus{{ $j->idjurusan }}" tabindex="-1" aria-labelledby="modalJurusanHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalJurusanHapusLabel">Hapus Data Jurusan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data jurusan ?</h5>
                                        <h3><font color="red"><span>{{ $j->jurusan}} </span></font></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/jurusan/hapus/{{ $j->idjurusan }}" method="get">
                                            <button type="submit" name="jurusanhapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal" class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data jurusan -->
                    </td>
                </tr>
                @endforeach
        </tbody>
        
        <!-- Akhir menampilkan data dalam table-->

    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-jurusan').DataTable();
        });
    </script>
    <!-- Akhir membuat table-->


    <!-- Awal Modal tambah data jurusan -->
    <div class="modal fade" id="modalTambahJurusan" tabindex="-1" role="dialog" aria-labelledby="modalTambahJurusanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahJurusanLabel">Form Input Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formjurusantambah" id="formjurusantambah" action="/jurusan/tambah " method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="kodejurusan" class="col-sm-3 col-form-label">Kode Jurusan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kodejurusan" name="kodejurusan" placeholder="Masukan Kode Jurusan">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="namajurusan" class="col-sm-3 col-form-label">Nama Jurusan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namajurusan" name="namajurusan" placeholder="Masukan Nama Jurusan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idprogramkeahlian" class="col-sm-3 col-form-label">Program Keahlian</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idprogramkeahlian" name="idprogramkeahlian">
                                    <option></option>
                                    @foreach($programkeahlian as $pk)
                                        <option value="{{ $pk->idprogramkeahlian }}">{{ $pk->namaprogramkeahlian }}</option>
                                    @endforeach
                                </select>
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
    <!-- Akhir Modal tambah data jurusan -->

@endsection
<!--akhir isi konten dinamis-->



<!--akhir konten dinamis-->
