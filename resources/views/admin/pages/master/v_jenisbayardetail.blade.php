<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Detail Jenis Bayar')
@section('title', 'Detail Jenis Bayar')

<!--awal isi konten dinamis-->
@section('konten')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahDetailJenisBayar">
        Tambah Data Detail Jenis Bayar
    </button>

    <p>

    <!-- Awal membuat table-->
    <table class="table table-bordered table-striped table-hover table-sm" id="table-DetailJenisBayar">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th>
                    <center>No</center>
                </th>

                <th>
                    <center>ID Detail <br>Jenis Bayar</center>
                </th>

                <th>
                    <center>Jenis Bayar</center>
                </th>

                <th>
                    <center>Tingkat</center>
                </th>

                <th>
                    <center>Tahun Ajaran <br>/ Tahun Masuk</center>
                </th>

                <th>
                    <center>Nominal Bayar</center>
                </th>

                <th>
                    <center>Aksi</center>
                </th>
            </tr>
        </thead>
        <!-- Akhir header table-->

        <!-- Awal menampilkan data dalam table-->
        <tbody>
            @foreach ($detailjenisbayar as $index => $djb)
                <tr>
                    {{-- <td align="center" scope="row">{{ $index + $Detail Jenis Bayar->firstItem() }}</td> --}}
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    <td align="center">{{ $djb->idjenisbayardetail }}</td>
                    <td align="center">{{ $djb->jenisbayar }}</td>
                    <td align="center">{{ $djb->tingkat }}</td>
                    <td align="center">{{ $djb->thnajaran }}</td>
                    <td align="right">@currency($djb->nominaljenisbayar)</td>
                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalDetailJenisBayarEdit{{ $djb->idjenisbayardetail }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data Detail Jenis Bayar -->
                        <div class="modal fade" id="modalDetailJenisBayarEdit{{ $djb->idjenisbayardetail }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailJenisBayarEditLabel" aria-hidden="true">    
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalDetailJenisBayarEditLabel">Form Edit Data Detail Jenis Bayar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formDetailJenisBayarEdit" id="formDetailJenisBayarEdit" action="/jenisbayardetail/edit/{{ $djb->idjenisbayardetail }}" method="post">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="form-group row">
                                                <label for="idDetailJenisBayar" class="col-sm-4 col-form-label">ID Detail Jenis Bayar</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="idDetailJenisBayar" name="idDetailJenisBayar" value="{{ $djb->idjenisbayardetail }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idjenisbayar" class="col-sm-4 col-form-label">Jenis Bayar</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control" id="idjenisbayar" name="idjenisbayar">
                                                        @foreach ($jenisbayar as $jb)
                                                            @if ($jb->idjenisbayar == $djb->idjenisbayar)
                                                                <option value="{{ $jb->idjenisbayar }}" selected>{{ $jb->jenisbayar }}</option>
                                                            @else
                                                                <option value="{{ $jb->idjenisbayar }}">{{ $jb->jenisbayar }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tingkat" class="col-sm-4 col-form-label">Tingkat</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control" id="idtingkat" name="idtingkat">
                                                        @foreach ($tingkat as $tk)
                                                            @if ($tk->idtingkat == $djb->idtingkat)
                                                                <option value="{{ $tk->idtingkat }}" selected>{{ $tk->tingkat }}</option>
                                                            @else
                                                                <option value="{{ $tk->idtingkat }}">{{ $tk->tingkat }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="thnajarant" class="col-sm-4 col-form-label">Tahun Ajaran</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control" id="idthnajaran" name="idthnajaran">
                                                        @foreach ($thnajaran as $thn)
                                                            @if ($thn->idthnajaran == $djb->idthnajaran)
                                                                <option value="{{ $thn->idthnajaran }}" selected>{{ $thn->thnajaran }}</option>
                                                            @else
                                                                <option value="{{ $thn->idthnajaran }}">{{ $thn->thnajaran }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nominaljenisbayar" class="col-sm-4 col-form-label">Nominal Jenis Bayar</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="nominaljenisbayar" name="nominaljenisbayar" value="{{ $djb->nominaljenisbayar }}" required>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="DetailJenisBayaredit" class="btn btn-success">Edit</button>
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data Detail Jenis Bayar -->



                        |
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDetailJenisBayarHapus{{ $djb->idjenisbayardetail }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data Detail Jenis Bayar -->
                        <div class="modal fade" id="modalDetailJenisBayarHapus{{ $djb->idjenisbayardetail }}" tabindex="-1" aria-labelledby="modalDetailJenisBayarHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalDetail Jenis BayarHapusLabel">Hapus Data Detail Jenis Bayar</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data Detail Jenis Bayar ?</h5>
                                        <h3><font color="red"><span>{{ $djb->jenisbayar}} </span></font></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/jenisbayardetail/hapus/{{ $djb->idjenisbayardetail }}" method="get">
                                            <button type="submit" name="DetailJenisBayarhapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal" class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data Detail Jenis Bayar -->
                    </td>
                </tr>
            @endforeach
        </tbody>
        <!-- Akhir menampilkan data dalam table-->
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-DetailJenisBayar').DataTable();
        });
    </script>
    <!-- Akhir membuat table-->



    <!-- Awal Modal tambah data Detail Jenis Bayar -->
    <div class="modal fade" id="modalTambahDetailJenisBayar" tabindex="-1" role="dialog" aria-labelledby="modalTambahDetailJenisBayarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahDetailJenisBayarLabel">Form Input Data Detail Jenis Bayar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form name="formDetailJenisBayarTambah" id="formDetailJenisBayarTambah" action="/jenisbayardetail/tambah " method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="idjenisbayar" class="col-sm-4 col-form-label">Jenis Bayar</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" id="idjenisbayar" name="idjenisbayar" required>
                                    <option>Pilih Jenis Bayar</option>
                                    @foreach ($jenisbayar as $j)
                                        <option value="{{ $j->idjenisbayar }}">{{ $j->jenisbayar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tingkat" class="col-sm-4 col-form-label">Tingkat</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" id="idtingkat" name="idtingkat" required>
                                    <option>Pilih Tingkat</option>
                                    @foreach ($tingkat as $t)
                                        <option value="{{ $t->idtingkat }}">{{ $t->tingkat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="thnajaran" class="col-sm-4 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-8">
                                <select type="text" class="form-control" id="idthnajaran" name="idthnajaran" required>
                                    <option>Pilih Tahun Ajaran</option>
                                    @foreach ($thnajaran as $th)
                                            <option value="{{ $th->idthnajaran }}">{{ $th->thnajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nominaljenisbayar" class="col-sm-4 col-form-label">Nominal Bayar</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nominaljenisbayar" name="nominaljenisbayar" placeholder="Masukan Nominal Bayar" required>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahDetail Jenis Bayar" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data Detail Jenis Bayar -->

@endsection
<!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->