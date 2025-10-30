<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Kelas Siswa')
@section('title', 'Kelas Siswa')

<!--awal isi konten dinamis-->
@section('konten')
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSiswaKelas">
        Tambah Data Kelas Siswa
    </button> --}}
    <p>


    <form action="/siswakelas/cari" method="GET">
        <div class="form-group row">
            <div class="col-md-3">
                <select type="text" class="form-control" id="carikelas" name="carikelas">
                    <option>{{$katakunci}}</option>
                    @foreach($kelasdetail as $k)
                        <option value="{{ $k->kelas->namakelas}}">{{ $k->kelas->namakelas }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="CARI" class="btn btn-primary">
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#carikelas').select2({
                placeholder: 'Pilih Kelas',
                allowClear: true
            });
        });
    </script>
    
    

    

    <p>
    <!-- Awal membuat table-->
    <table class="table table-bordered table-striped table-hover table-sm" id="table-siswakelas">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th>
                    <center>No</center>
                </th>

                <th>
                    <center>NIS</center>
                </th>

                <th>
                    <center>NISN</center>
                </th>

                <th>
                    <center>Nama Siswa</center>
                </th>

                <th>
                    <center>Aksi</center>
                </th>
            </tr>
        </thead>
        <!-- Akhir header table-->

        <!-- Awal menampilkan data dalam table-->
        <tbody>
            @foreach ($siswakelas as $index => $sk)
                <tr>
                    <td align="center" scope="row">{{ $index + 1}}</td>
                    <td align="center">{{ $sk->nis }}</td>
                    <td align="center">{{ $sk->nisn }}</td>
                    <td><a href="" data-toggle="modal" data-target="#modalSiswaDetail{{ $sk->idsiswa }}">{{ $sk->namasiswa }}</a>

                    <td align="center">
                        {{-- <button type="button" class="btn btn-xs btn-warning" data-toggle="modal"
                            data-target="#modalSiswaKelasEdit{{ $sk->idsiswakelas }}">
                            <i class="fas fa-edit"></i>
                        </button>


                        | --}}
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#modalsiswakelasHapus{{ $sk->idsiswakelas }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data siswakelas -->
                        <div class="modal fade" id="modalsiswakelasHapus{{ $sk->idsiswakelas }}" tabindex="-1"
                            aria-labelledby="modalsiswakelasHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalsiswakelasHapusLabel">Hapus Data siswakelas</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data siswa</h5>
                                        <h3>
                                            <font color="red"><span>{{ $sk->siswa->namasiswa }} </span></font>
                                        </h3>
                                        di kelas
                                        <h3>
                                            <font color="red"><span>{{ $sk->kelasdetail->kelas->namakelas }} </span></font>
                                        </h3>
                                            
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/siswakelas/hapus/{{ $sk->idsiswakelas }}" method="get">
                                            <button type="submit" name="siswakelashapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal"
                                            class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data siswakelas -->
                    </td>
                </tr>
            @endforeach
        </tbody>
        <!-- Akhir menampilkan data dalam table-->
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-siswakelas').DataTable({
                "lengthMenu": [
                    [ -1, 10],
                    [ 'All','10 siswa']
                ],
            }
            );
        });
    </script>

    <!-- Akhir membuat table-->
    


    {{-- <!-- Awal Modal tambah data siswakelas -->
    <div class="modal fade" id="modalTambahSiswaKelas" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaKelasLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahSiswaKelasLabel">Form Input Data Kelas Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formsiswakelastambah" id="formsiswakelastambah" action="/siswakelas/tambah " method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="idsiswakelas" class="col-sm-3 col-form-label">ID Kelas Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="idsiswakelas" name="idsiswakelas" placeholder="Masukan ID Kelas Siswa">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nis" class="col-sm-3 col-form-label">Nama Siswa</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control select2" id="select2" name="nis">
                                    
                                    @foreach ($siswa as $s)
                                        <option value="{{ $s->nis }}">{{ $s->namasiswa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idthnajaran" class="col-sm-3 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idthnajaran" name="idthnajaran">
                                    <option></option>
                                    @foreach ($thnajaran as $t)
                                        <option value="{{ $t->idthnajaran }}">{{ $t->thnajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idkelas" class="col-sm-3 col-form-label">Kelas</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idkelas" name="idkelas">
                                    <option></option>
                                    @foreach ($kelasdetail as $k)
                                        <option value="{{ $k->idkelas }}">{{ $k->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahsiswakelas" class="btn btn-success">Tambah</button>
                        </div>
                    </form>

                    {{-- <script type="text/javascript">
                        $(document).ready(function() {
                            $('#nis').select2({
                            placeholder: 'Pilih Nama Siswa',
                            allowClear: true
                            });
                        });
                    </script> --}}

                </div>
            </div>
        </div>
    </div> --}}
    <!-- Akhir Modal tambah data siswakelas -->



@endsection
<!--akhir isi konten dinamis-->

