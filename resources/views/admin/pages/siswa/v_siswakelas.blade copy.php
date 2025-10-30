<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Kelas Siswa')
@section('title', 'Kelas Siswa')

<!--awal isi konten dinamis-->
@section('konten')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSiswaKelas">
        Tambah Data Kelas Siswa
    </button>
    <p>


    {{-- <form action="#" method="GET">
        <div class="input-group mb-3">
            <label for="filter-satuan"> Pilih Kelas :</label> 
            <select>
                @foreach ($kelas as $k)
                    <option name="kelas" id="kelas" value="{{$k->idkelas}}">
                        {{$k->kelas}}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary" type="submit">GET</button>
        </div>
    </form> --}}
    
    

    <div class="row">
        <div class="col-md-4">
            <label for="filter-kelas"> Pilih Kelas :</label> 
            <select id="filter-kelas" class="form-control filter">
                <option value="">Pilih Kelas</option>
                @foreach ($kelas as $k)
                    <option name="kelas" id="kelas" value="{{$k->idkelas}}">
                        {{$k->kelas}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <p>
    <!-- Awal membuat table-->
    <table class="table table-bordered table-striped table-hover table-sm" id="table-siswakelas">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th>
                    <center>No</center>
                </th>

                {{-- <th>
                    <center>ID Kelas Siswa</center>
                </th> --}}

                <th>
                    <center>NIS</center>
                </th>

                <th>
                    <center>Nama Siswa</center>
                </th>

                <th>
                    <center>Tahun Ajaran</center>
                </th>

                <th>
                    <center>Kelas</center>
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
                    {{-- <td align="center">{{ $sk->idsiswakelas }}</td> --}}
                    <td align="center">{{ $sk->siswa->nis }}</td>
                    <td>{{ $sk->siswa->namasiswa }}</td>
                    <td align="center">{{ $sk->thnajaran->thnajaran }}</td>
                    <td align="center">{{ $sk->kelas->kelas }}</td>

                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal"
                            data-target="#modalSiswaKelasEdit{{ $sk->idsiswakelas }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data siswakelas -->
                        <div class="modal fade" id="modalSiswaKelasEdit{{ $sk->idsiswakelas }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalSiswaKelasEditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalSiswaKelasEditLabel">Form Edit Data Kelas Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formsiswakelasedit" id="formsiswakelasedit" action="/siswakelas/edit/{{ $sk->idsiswakelas }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group row">
                                                <label for="nis" class="col-sm-3 col-form-label text-left">ID Kelas Siswa</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="idsiswakelas" name="idsiswakelas" value="{{ $sk->idsiswakelas }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nis" class="col-sm-3 col-form-label text-left">Nama Siswa</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="nis" name="nis">
                                                        @foreach ($siswa as $s)
                                                            @if ($s->idsiswa == $sk->idsiswa)
                                                                <option value="{{ $s->idsiswa }}" selected>{{ $s->namasiswa }}</option>
                                                            @else
                                                                <option value="{{ $s->idsiswa }}">{{ $s->namasiswa }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idthnajaran" class="col-sm-3 col-form-label text-left">Tahun Masuk</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idthnajaran" name="idthnajaran">
                                                        @foreach ($thnajaran as $t)
                                                            @if ($t->idthnajaran == $sk->idthnajaran)
                                                                <option value="{{ $t->idthnajaran }}" selected>{{ $t->thnajaran }}</option>
                                                            @else
                                                                <option value="{{ $t->idthnajaran }}">{{ $t->thnajaran }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idkelas" class="col-sm-3 col-form-label text-left">Kelas</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idkelas" name="idkelas">
                                                        @foreach ($kelas as $k)
                                                            @if ($k->idkelas == $sk->idkelas)
                                                                <option value="{{ $k->idkelas }}" selected>{{ $k->kelas }}</option>
                                                            @else
                                                                <option value="{{ $k->idkelas }}">{{ $k->kelas }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="siswakelasedit" class="btn btn-success">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data siswakelas -->


                        |
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
                                        <h5>Yakin Mau menghapus data siswakelas ?</h5>
                                        <h3>
                                            <font color="red"><span>{{ $sk->idsiswakelas }} </span></font>
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
            $('#table-siswakelas').DataTable(
                {
                    "lengthMenu": [
                        [ 40, -1 ],
                        [ '40 rows', 'All' ]
                    ],

                }
            );

            
        });

    </script>



    <!-- Akhir membuat table-->


    {{-- <!--awal pagination-->
    Halaman : {{ $siswakelas->currentPage() }} <br />
    Jumlah Data : {{ $siswakelas->total() }} <br />
    Data Per Halaman : {{ $siswakelas->perPage() }} <br />

    {{ $siswakelas->links() }}
    <!--akhir pagination--> --}}




    <!-- Awal Modal tambah data siswakelas -->
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
                                    @foreach ($kelas as $k)
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
    </div>
    <!-- Akhir Modal tambah data siswakelas -->



@endsection
<!--akhir isi konten dinamis-->




{{--
<!--akhir konten dinamis-->
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>


@endpush
--}}