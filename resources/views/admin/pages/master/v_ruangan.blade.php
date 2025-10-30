<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Ruangan')
@section('title', 'Ruangan')

<!--awal isi konten dinamis-->
@section('konten')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahRuangan">
        Tambah Data Ruangan
    </button>

    <p>

    <!-- Awal membuat table-->
    <table id="table-ruangan" class="table table-bordered table-striped table-hover table-sm">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th width="5%">
                    <center>No</center>
                </th>

                {{-- <th width="15%">
                    <center>ID Ruangan</center>
                </th> --}}

                <th width="20%">
                    <center>Kode Ruangan</center>
                </th>

                <th width="20%">
                    <center>Nama Ruangan</center>
                </th>

                <th width="20%">
                    <center>Lokasi</center>
                </th>

                <th width="20%">
                    <center>Lebar</center>
                </th>

                <th width="20%">
                    <center>Panjang</center>
                </th>

                <th width="20%">
                    <center>Kondisi</center>
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
            @foreach ($dataruangan as $index => $d)
                <tr>
                    <td align="center" scope="row">{{ $index + 1}}</td>
                    {{-- <td align="center">{{ $d->idruangan }}</td> --}}
                    <td align="center">{{ $d->koderuangan }}</td>
                    <td>{{ $d->namaruangan }}</td>
                    <td>{{ $d->lokasi }}</td>
                    <td>{{ $d->lebar }}</td>
                    <td>{{ $d->panjang }}</td>
                    <td>{{ $d->kondisi }}</td>
                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalRuanganEdit{{ $d->idruangan }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data ruangan -->
                        <div class="modal fade" id="modalRuanganEdit{{ $d->idruangan }}" tabindex="-1" role="dialog" aria-labelledby="modalRuanganEditLabel" aria-hidden="true">    
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalRuanganEditLabel">Form Edit Data Ruangan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formruanganedit" id="formruanganedit" action="/ruangan/edit/{{ $d->idruangan }}" method="post">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group row">
                                                <label for="idruangan" class="col-sm-3 col-form-label">ID ruangan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="idruangan" name="idruangan" value="{{ $d->idruangan }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="koderuangan" class="col-sm-3 col-form-label">Kode Ruangan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="koderuangan" name="koderuangan" value="{{ $d->koderuangan }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="namaruangan" class="col-sm-3 col-form-label">Nama Ruangan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="namaruangan" name="namaruangan" value="{{ $d->namaruangan }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="lokasi" class="col-sm-3 col-form-label">Lokasi Ruangan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $d->lokasi }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="lebar" class="col-sm-3 col-form-label">Lebar Ruangan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="lebar" name="lebar" value="{{ $d->lebar }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="panjang" class="col-sm-3 col-form-label">Panjang Ruangan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="panjang" name="panjang" value="{{ $d->panjang }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-3 col-form-label">Kondisi Ruangan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="kondisi" name="kondisi" value="{{ $d->kondisi }}">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="ruanganedit" class="btn btn-success" onclick="return confirm('Yakin Mau Edit Data Ruangan ?')">Edit</button>
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data ruangan -->


                        |

                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalRuanganHapus{{ $d->idruangan }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data ruangan -->
                        <div class="modal fade" id="modalRuanganHapus{{ $d->idruangan }}" tabindex="-1" aria-labelledby="modalRuanganHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalRuanganHapusLabel">Hapus Data Ruangan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data ruangan ?</h5>
                                        <h3><font color="red"><span>{{ $d->ruangan}} </span></font></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/ruangan/hapus/{{ $d->idruangan }}" method="get">
                                            <button type="submit" name="ruanganhapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal" class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data ruangan -->
                    </td>
                </tr>
                @endforeach
        </tbody>
        
        <!-- Akhir menampilkan data dalam table-->

    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-ruangan').DataTable();
        });
    </script>
    <!-- Akhir membuat table-->


    <!-- Awal Modal tambah data ruangan -->
    <div class="modal fade" id="modalTambahRuangan" tabindex="-1" role="dialog" aria-labelledby="modalTambahRuanganLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahRuanganLabel">Form Input Data Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formruangantambah" id="formruangantambah" action="/ruangan/tambah " method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="koderuangan" class="col-sm-3 col-form-label">Kode ruangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="koderuangan" name="koderuangan" placeholder="Masukan Kode Ruangan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namaruangan" class="col-sm-3 col-form-label">Nama Ruangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namaruangan" name="namaruangan" placeholder="Masukan Nama ruangan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lokasi" class="col-sm-3 col-form-label">Lokasi Ruangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukan Lokasi Ruangan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lebar" class="col-sm-3 col-form-label">Lebar Ruangan</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="lebar" name="lebar" placeholder="Masukan Lebar Ruangan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="panjang" class="col-sm-3 col-form-label">Panjang Ruangan</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="panjang" name="panjang" placeholder="Masukan Panjang Ruangan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kondisi" class="col-sm-3 col-form-label">Kondisi Ruangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kondisi" name="kondisi" placeholder="Masukan Kondisi Ruangan">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahruangan" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data ruangan -->

@endsection
<!--akhir isi konten dinamis-->



<!--akhir konten dinamis-->
