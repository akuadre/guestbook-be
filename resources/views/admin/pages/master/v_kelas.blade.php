<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Kelas')
@section('title', 'Kelas')

<!--awal isi konten dinamis-->
@section('konten')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahkelas">
        Tambah Data Kelas
    </button>

    <p>

    <!-- Awal membuat table-->
    <table id="table-datakelas" class="table table-bordered table-striped table-hover table-sm">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th width="5%">
                    <center>No</center>
                </th>

                {{-- <th width="10%">
                    <center>ID Kelas</center>
                </th> --}}

                <th width="20%">
                    <center>Kelas</center>
                </th>

                <th width="30%">
                    <center>Jurusan</center>
                </th>

                <th width="15%">
                    <center>Tingkat</center>
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
            @foreach ($kelas as $index => $k)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    {{-- <td align="center">{{ $k->idkelas }}</td> --}}
                    <td align="center">{{ $k->namakelas }}</td>
                    <td>{{ $k->jurusan->namajurusan }}</td>
                    <td align="center">{{ optional($k->tingkat)->tingkat }}</td>

                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalkelasEdit{{ $k->idkelas }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data kelas -->
                        <div class="modal fade" id="modalkelasEdit{{ $k->idkelas }}" tabindex="-1" role="dialog" aria-labelledby="modalkelasEditLabel" aria-hidden="true">    
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalkelasEditLabel">Form Edit Data kelas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formkelasedit" id="formkelasedit" action="/kelas/edit/{{ $k->idkelas }}" method="post">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group row">
                                                <label for="idkelas" class="col-sm-3 col-form-label">ID kelas</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="idkelas" name="idkelas" value="{{ $k->idkelas }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="namakelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                                                <div class="col-sm-9">
                                                    <input type="select" class="form-control" id="namakelas" name="namakelas" value="{{ $k->namakelas }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jurusan" class="col-sm-3 col-form-label">Nama Jurusan</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idjurusan" name="idjurusan">
                                                        @foreach ($jurusan as $j)
                                                            @if ($j->idjurusan == $k->idjurusan)
                                                                <option value="{{ $j->idjurusan }}" selected>{{ $j->namajurusan }}</option>
                                                            @else
                                                                <option value="{{ $j->idjurusan }}">{{ $j->namajurusan }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tingkat" class="col-sm-3 col-form-label">Tingkat</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idtingkat" name="idtingkat">
                                                        @foreach ($tingkat as $t)
                                                            @if ($t->idtingkat == $k->idtingkat)
                                                                <option value="{{ $t->idtingkat }}" selected>{{ $t->tingkat }}</option>
                                                            @else
                                                                <option value="{{ $t->idtingkat }}">{{ $t->tingkat }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="kelasedit" class="btn btn-success" onclick="return confirm('Yakin Mau Edit Data Jurusan ?')">Edit</button>
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data kelas -->

                        |

                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalkelasHapus{{ $k->idkelas }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data kelas -->
                        <div class="modal fade" id="modalkelasHapus{{ $k->idkelas }}" tabindex="-1" aria-labelledby="modalkelasHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalkelasHapusLabel">Hapus Data kelas</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data kelas ?</h5>
                                        <h3><font color="red"><span>{{ $k->kelas}} </span></font></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/kelas/hapus/{{ $k->idkelas }}" method="get">
                                            <button type="submit" name="kelashapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal" class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data kelas -->
                    </td>
                </tr>
            @endforeach
        </tbody>
        <!-- Akhir menampilkan data dalam table-->
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-datakelas').DataTable();
        });
    </script>
    <!-- Akhir membuat table-->


    <!-- Awal Modal tambah data kelas -->
    <div class="modal fade" id="modalTambahkelas" tabindex="-1" role="dialog" aria-labelledby="modalTambahkelasLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahkelasLabel">Form Input Data kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formkelastambah" id="formkelastambah" action="/kelas/tambah " method="post">
                        @csrf
                        {{-- <div class="form-group row">
                            <label for="idkelas" class="col-sm-3 col-form-label">ID Kelas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="idkelas" name="idkelas" placeholder="Masukan ID kelas">
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="namakelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namakelas" name="namakelas" placeholder="Masukan Nama kelas">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idjurusan" name="idjurusan">
                                    <option></option>
                                    @foreach($jurusan as $j)
                                        <option value="{{ $j->idjurusan }}">{{ $j->namajurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tingkat" class="col-sm-3 col-form-label">Tingkat</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idtingkat" name="idtingkat">
                                    <option></option>
                                    @foreach($tingkat as $t)
                                        <option value="{{ $t->idtingkat }}">{{ $t->tingkat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahkelas" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data kelas -->

@endsection
<!--akhir isi konten dinamis-->