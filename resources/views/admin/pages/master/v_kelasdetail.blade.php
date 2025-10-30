<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Detail Kelas')
@section('title', 'Kelas')

<!--awal isi konten dinamis-->
@section('konten')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahkelas">
        Tambah Data Detail Kelas
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

                <th width="20%">
                    <center>Jurusan</center>
                </th>

                <th width="30%">
                    <center>Wali Kelas</center>
                </th>

                <th width="15%">
                    <center>Ruangan</center>
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
            @foreach ($kelasdetail as $index => $kd)
                <tr>
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    {{-- <td align="center">{{ $kd->idkelasdetail }}</td> --}}
                    <td align="center">{{ optional($kd->kelas)->namakelas }}</td>
                    <td align="center">{{ optional($kd->kelas)->jurusan->kodejurusan }}</td>
                    <td align="center">{{ optional($kd->guru)->namaguru }}</td>
                    <td align="center">{{ optional($kd->ruangan)->namaruangan }}</td>
                    
                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalkelasdetailEdit{{ $kd->idkelasdetail }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data kelas -->
                        <div class="modal fade" id="modalkelasdetailEdit{{ $kd->idkelasdetail }}" tabindex="-1" role="dialog" aria-labelledby="modalkelasdetailEditLabel" aria-hidden="true">    
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalkelasdetailEditLabel">Form Edit Data Kelas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formkelasdetailedit" id="formkelasdetailedit" action="/kelasdetail/edit/{{ $kd->idkelasdetail }}" method="post">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group row">
                                                <label for="idkelasdetail" class="col-sm-3 col-form-label">ID kelas</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="idkelasdetail" name="idkelasdetail" value="{{ $kd->idkelasdetail }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idkelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idkelas" name="idkelas">
                                                        @foreach ($kelas as $k)
                                                            @if ($k->idkelas == $kd->idkelas)
                                                                <option value="{{ $k->idkelas }}" selected>{{ $k->namakelas }}</option>
                                                            @else
                                                                <option value="{{ $k->idkelas }}">{{ $k->namakelas }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idguru" class="col-sm-3 col-form-label">Wali Kelas</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idguru" name="idguru">
                                                        @foreach ($guru as $g)
                                                            @if ($g->idguru == $kd->idguru)
                                                                <option value="{{ $g->idguru }}" selected>{{ $g->namaguru }}</option>
                                                            @else
                                                                <option value="{{ $g->idguru }}">{{ $g->namaguru }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idruangan" class="col-sm-3 col-form-label">Ruangan</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idruangan" name="idruangan">
                                                        @foreach ($ruangan as $r)
                                                            @if ($r->idruangan == $kd->idruangan)
                                                                <option value="{{ $r->idruangan }}" selected>{{ $r->namaruangan}}</option>
                                                            @else
                                                                <option value="{{ $r->idruangan }}">{{ $r->namaruangan }}</option>
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

                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalkelasHapus{{ $kd->idkelasdetail }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data kelas -->
                        <div class="modal fade" id="modalkelasHapus{{ $kd->idkelasdetail }}" tabindex="-1" aria-labelledby="modalkelasHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalkelasHapusLabel">Hapus Data Detail Kelas</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data kelas ?</h5>
                                        <h3><font color="red"><span>{{ $kd->kelas->namakelas}} </span></font></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/kelasdetail/hapus/{{ $kd->idkelasdetail }}" method="get">
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
                    <h5 class="modal-title" id="modalTambahkelasLabel">Form Input Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formkelastambah" id="formkelastambah" action="/kelasdetail/tambah " method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="idkelas" class="col-sm-3 col-form-label">Kelas</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idkelas" name="idkelas">
                                    <option></option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->idkelas }}">{{ $k->namakelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idguru" class="col-sm-3 col-form-label">Wali Kelas</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idguru" name="idguru">
                                    <option></option>
                                    @foreach($guru as $g)
                                        <option value="{{ $g->idguru }}">{{ $g->namaguru }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idruangan" class="col-sm-3 col-form-label">Ruangan</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idruangan" name="idruangan">
                                    <option></option>
                                    @foreach($ruangan as $r)
                                        <option value="{{ $r->idruangan }}">{{ $r->namaruangan }}</option>
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