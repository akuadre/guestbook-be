<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar Guru')
@section('title', 'Guru')

<!--awal isi konten dinamis-->
@section('konten')

    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahGuru">
        Tambah Data Guru
    </button> --}}

    <a href="/guru/tambah" class="btn btn-primary">Tambah Data Guru</a>

    <p>

        <!-- Awal membuat table-->
    <table class="table table-bordered table-striped table-hover" id="table-guru">
        <!-- Awal header table-->
        <thead>
            <tr>
                <th>
                    <center>No</center>
                </th>

                <th>
                    <center>NIP</center>
                </th>

                {{-- <th>
                    <center>NUPTK</center>
                </th> --}}

                <th>
                    <center>Nama Guru</center>
                </th>

                <th>
                    <center>Tempat Lahir</center>
                </th>

                <th>
                    <center>Tanggal Lahir</center>
                </th>

                <th>
                    <center>Jenis Kelamin</center>
                </th>

                {{-- <th>
                    <center>Alamat</center>
                </th> --}}

                {{-- <th>
                    <center>Agama</center>
                </th> --}}

                {{-- <th>
                    <center>Tlp Rumah</center>
                </th> --}}

                {{-- <th>
                    <center>HP</center>
                </th> --}}

                {{-- <th>
                    <center>Photo</center>
                </th> --}}

                <th>
                    <center>Status Aktif</center>
                </th>

                <th>
                    <center>Aksi</center>
                </th>
            </tr>
        </thead>

        <!-- Akhir header table-->

        <!-- Awal menampilkan data dalam table-->
        <tbody>
            @foreach ($guru as $index=> $g)
                <tr> 
                    <td align="center" scope="row">{{ $index + 1 }}</td>
                    <td align="center">{{ $g->nip }}</td>
                    {{-- <td align="center">{{ $g->nuptk }}</td> --}}
                    <td data-toggle="modal" data-target="#modalguruEdit{{ $g->idguru }}">{{ $g->gelardepan}}{{$g->namaguru}}, {{ $g->gelarbelakang}}</data-toggle=></td>
                    
                    <td>{{ $g->tmplahir }}</td>
                    <td align="right">{{ \Carbon\Carbon::parse($g->tgllahir )->locale('id_ID')->isoFormat('D-MM-YYYY') }}</td>
                    {{-- <td>{{ \Carbon\Carbon::parse($g->tgllahir )->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</td> --}}
                    {{-- <td align="right">{{ $g->tgllahir }}</td> --}}
                    <td>{{ $g->jk }}</td>

                    {{-- <td>{{ $g->alamat }}</td> --}}
                    {{-- <td>{{ $g->agama->agama }}</td> --}}
                    {{-- <td>{{ $g->tlprumah }}</td> --}}
                    {{-- <td>{{ $g->hpguru }}</td> --}}
                    {{-- <td><img width="60px" src="{{ url('/PhotoGuru/' . $g->photoguru) }}"></td> --}}
                    <td align="center">{{ $g->statusaktif }}</td>

                    <td align="center">
                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal"
                            data-target="#modalguruEdit{{ $g->idguru }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Awal Modal EDIT data GURU -->
                        <div class="modal fade" id="modalguruEdit{{ $g->idguru }}" tabindex="-1" role="dialog"
                            aria-labelledby="modalguruEditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalguruEditLabel">Form Edit Data Guru</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="formguruedit" id="formguruedit" action="/guru/edit/{{ $g->idguru }}" method="post" enctype="multipart/form-data">
                                            <!--z@csrf-->
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group row">
                                                <label for="idguru" class="col-sm-3 col-form-label text-left">ID Guru</label>
                                                <div class="col-sm-9 text-left">
                                                    <input type="text" class="form-control" id="idguru" name="idguru" value="{{ $g->idguru }}" readonly>
                                                </div>
                                            </div>
                                                                    
                                            <div class="form-group row">
                                                <label for="namaguru" class="col-sm-3 col-form-label text-left">Nama Guru</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="namaguru" name="namaguru" value="{{ $g->namaguru }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nuptk" class="col-sm-3 col-form-label text-left">NUPTK</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="nuptk" name="nuptk" value="{{ $g->nuptk }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nip" class="col-sm-3 col-form-label text-left">NIP</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="nip" name="nip" value="{{ $g->nip }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gelardepan" class="col-sm-3 col-form-label text-left">Gelar Depan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="gelardepan" name="gelardepan" value="{{ $g->gelardepan }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gelarbelakang" class="col-sm-3 col-form-label text-left">Gelar Belakang</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="gelarbelakang" name="gelarbelakang" value="{{ $g->gelarbelakang }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jk" class="col-sm-3 col-form-label text-left">Jenis Kelamin</label>
                                                <div class="col-sm-9 input-group">
                                                    @if ($g->jk == "Laki-laki")
                                                        <div class="input-group-text">
                                                            <input type="radio" id="jk" name="jk" value="Laki-laki" checked>
                                                        </div>
                                                        Laki-laki

                                                        <div class="input-group-text">
                                                            <input type="radio" id="jk" name="jk" value="Perempuan">
                                                        </div>
                                                        Perempuan
                                                    @else
                                                        <div class="input-group-text">
                                                            <input type="radio" id="jk" name="jk" value="Laki-laki" >
                                            
                                                        </div>
                                                        Laki-laki

                                                        <div class="input-group-text">
                                                            <input type="radio" id="jk" name="jk" value="Perempuan" checked>
                                                        </div>
                                                        Perempuan
                                                    @endif      
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tmplahir" class="col-sm-3 col-form-label text-left">Tempat Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="tmplahir" name="tmplahir" value="{{ $g->tmplahir }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tgllahir" class="col-sm-3 col-form-label text-left">Tanggal Lahir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tgllahir" name="tgllahir" value="{{ $g->tgllahir }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jenisptk" class="col-sm-3 col-form-label text-left">Jenis PTK</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="jenisptk" name="jenisptk">
                                                        <option value="{{ $g->jenisptk }}" selected>{{ $g->jenisptk }}</option>
                                                        <option value="Guru">Guru</option>
                                                        <option value="TU">TU</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="statuskepegawaian" class="col-sm-3 col-form-label text-left">Status Kepegawaian</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="statuskepegawaian" name="statuskepegawaian">
                                                        <option value="{{ $g->statuskepegawaian }}" selected>{{ $g->statuskepegawaian }}</option>
                                                        <option value="CPNS">CPNS</option>
                                                        <option value="PNS">PNS</option>
                                                        <option value="PPPK">PPPK</option>
                                                        <option value="GTY/PTY">GTY/PTY</option>
                                                        <option value="Honor Sekolah">Honor Sekolah</option>
                                                        <option value="Honor Daerah TK.I Provinsi">Honor Daerah TK.I Provinsi</option>
                                                        <option value="Honor Daerah TK.II Kab/Kota">Honor Daerah TK.II Kab/Kota</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="mapel" class="col-sm-3 col-form-label text-left">Mata Pelajaran</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="mapel" name="mapel" value="{{ $g->mapel }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idagama" class="col-sm-3 col-form-label text-left">Agama</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idagama" name="idagama">
                                                        @foreach ($agama as $a)
                                                            @if ($a->idagama == $g->idagama)
                                                                <option value="{{ $a->idagama }}" selected>{{ $a->agama }}</option>
                                                            @else
                                                                <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jalan" class="col-sm-3 col-form-label text-left">Jalan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="jalan" name="jalan" value="{{ $g->jalan }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="rt" class="col-sm-3 col-form-label text-left">RT</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="rt" name="rt" value="{{ $g->rt }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="rw" class="col-sm-3 col-form-label text-left">RW</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="rw" name="rw" value="{{ $g->rw }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="dusun" class="col-sm-3 col-form-label text-left">Dusun</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="dusun" name="dusun" value="{{ $g->dusun }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="desa" class="col-sm-3 col-form-label text-left">Desa</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="desa" name="desa" value="{{ $g->desa }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kecamatan" class="col-sm-3 col-form-label text-left">Kecamatan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ $g->kecamatan }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kabupaten" class="col-sm-3 col-form-label text-left">Kabupaten</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ $g->kabupaten }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kodepos" class="col-sm-3 col-form-label text-left">Kode Pos</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="kodepos" name="kodepos" value="{{ $g->kodepos }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tlprumah" class="col-sm-3 col-form-label text-left">Telepon Rumah</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="tlprumah" name="tlprumah" value="{{ $g->tlprumah }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hpguru" class="col-sm-3 col-form-label text-left">HP</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="hpguru" name="hpguru" value="{{ $g->hpguru }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 col-form-label text-left">E-mail</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="email" name="email" value="{{ $g->email }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="skcpns" class="col-sm-3 col-form-label text-left">Nomor SK CPNS</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="skcpns" name="skcpns" value="{{ $g->skcpns }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tmtcpns" class="col-sm-3 col-form-label">TMT CPNS</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tmtcpns" name="tmtcpns" value="{{ $g->tmtcpns }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="skpns" class="col-sm-3 col-form-label text-left">Nomor SK PNS</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="skpns" name="skpns" value="{{ $g->skpns }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tmtpns" class="col-sm-3 col-form-label">TMT PNS</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tmtpns" name="tmtpns" value="{{ $g->tmtpns }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="lembagapengangkat" class="col-sm-3 col-form-label text-left">Lembaga Pengangkat</label>
                                                <select type="text" class="form-control" id="lembagapengangkat" name="lembagapengangkat">
                                                    <option value="{{ $g->lembagapengangkat }}" selected>{{ $g->lembagapengangkat }}</option>
                                                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                                                    <option value="Ketua Yayasan">Ketua Yayasan</option>
                                                    <option value="Pemerintah Kab/Kota">Pemerintah Kab/Kota</option>
                                                    <option value="Pemerintah Propinsi">Pemerintah Propinsi</option>
                                                    <option value="Pemerintah Pusat">Pemerintah Pusat</option>
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label for="idpangkat" class="col-sm-3 col-form-label text-left">Pangkat</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="idpangkat" name="idpangkat">
                                                        @foreach ($pangkat as $p)
                                                            @if ($p->idpangkat == $g->idpangkat)
                                                                <option value="{{ $p->idpangkat }}" selected>{{$p->pangkat}}  |  {{$p->golongan}}-{{$p->ruang}}  |  {{$p->jabatan}}</option>
                                                            @else
                                                                <option value="{{ $p->idpangkat }}">{{$p->pangkat}}  |  {{$p->golongan}}-{{$p->ruang}}  |  {{$p->jabatan}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tmt_pangkat" class="col-sm-3 col-form-label text-left">TMT Pangkat Terakhir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tmtpangkat" name="tmtpangkat" value="{{ $g->tmtpangkat }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="sumbergaji" class="col-sm-3 col-form-label text-left">Sumber Gaji</label>
                                                <select type="text" class="form-control" id="sumbergaji" name="sumbergaji">
                                                    <option value="{{ $g->sumbergaji }}" selected>{{ $g->sumbergaji }}</option>
                                                    <option value="APBD Kabupaten/Kota">APBD Kabupaten/Kota</option>
                                                    <option value="APBD Provinsi">APBD Provinsi</option>
                                                    <option value="APBN">APBN</option>
                                                    <option value="Sekolah">Sekolah</option>
                                                    <option value="Yayasan">Yayasan</option>
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label for="npwp" class="col-sm-3 col-form-label text-left">NPWP</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="npwp" name="npwp" value="{{ $g->npwp }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="namawajibpajak" class="col-sm-3 col-form-label text-left">Nama Wajib Pajak</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="namawajibpajak" name="namawajibpajak" value="{{ $g->namawajibpajak }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nik" class="col-sm-3 col-form-label text-left">NIK</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="nik" name="nik" value="{{ $g->nik }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kartukeluarga" class="col-sm-3 col-form-label text-left">Nomor Kartu Keluarga</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="kartukeluarga" name="kartukeluarga" value="{{ $g->kartukeluarga }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="karpeg" class="col-sm-3 col-form-label text-left">Nomor Karpeg</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="karpeg" name="karpeg" value="{{ $g->karpeg }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="karis" class="col-sm-3 col-form-label text-left">Nomor Karis/Karsu</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="karis" name="karis" value="{{ $g->karis }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tmtkgb" class="col-sm-3 col-form-label text-left">TMT KGB Terakhir</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tmtkgb" name="tmtkgb" value="{{ $g->tmtkgb }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="pendidikanterakhir" class="col-sm-3 col-form-label text-left">Pendidikan Terakhir</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="pendidikanterakhir" name="pendidikanterakhir">
                                                        <option value="{{ $g->pendidikanterakhir }}" selected>{{ $g->pendidikanterakhir}}</option>
                                                        <option value="SMA/SMK/MA/Sederajat">SMA/SMK/Sederajat</option>
                                                        <option value="D-1">D-1</option>
                                                        <option value="D-2">D-2</option>
                                                        <option value="D-3">D-3</option>
                                                        <option value="D-4">D-4</option>
                                                        <option value="S-1">S-1</option>
                                                        <option value="S-2">S-2</option>
                                                        <option value="S-3">S-3</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="programstudi" class="col-sm-3 col-form-label text-left">Program Studi</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="programstudi" name="programstudi" value="{{ $g->programstudi }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="perguruantinggi" class="col-sm-3 col-form-label text-left">Perguruan Tinggi</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="perguruantinggi" name="perguruantinggi" value="{{ $g->perguruantinggi }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tahunlulus" class="col-sm-3 col-form-label text-left">Tahun Lulus</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="tahunlulus" name="tahunlulus" value="{{ $g->tahunlulus }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="photo" class="col-sm-3 col-form-label text-left">Photo</label>
                                                <div class="col-sm-9 text-left">
                                                    <img src="{{ url('/PhotoGuru/'.$g->photoguru) }}" width="120px" height="160px">
                                                    <p>
                                                    <input type="file" id="photoguru" name="photoguru">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="statusaktif" class="col-sm-3 col-form-label text-left">Status Aktif</label>
                                                <div class="col-sm-9 input-group">
                                                    @if ($g->statusaktif == "Aktif")
                                                        <div class="input-group-text">
                                                            <input type="radio" id="statusaktif" name="statusaktif" value="Aktif" checked>
                                                        </div>
                                                        Aktif

                                                        <div class="input-group-text">
                                                            <input type="radio" id="statusaktif" name="statusaktif" value="Tidak Aktif">
                                                        </div>
                                                        Tidak Aktif
                                                    @else
                                                        <div class="input-group-text">
                                                            <input type="radio" id="statusaktif" name="statusaktif" value="Aktif" >
                                                        </div>
                                                        Aktif

                                                        <div class="input-group-text">
                                                            <input type="radio" id="statusaktif" name="statusaktif" value="Tidak Aktif" checked>
                                                        </div>
                                                        Tidak Aktif
                                                    @endif      
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="namaibu" class="col-sm-3 col-form-label text-left">Nama Ibu</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="namaibu" name="namaibu" value="{{ $g->namaibu }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="statuskawin" class="col-sm-3 col-form-label text-left">Status Pernikahan</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="statuskawin" name="statuskawin">
                                                        <option value="{{ $g->statuskawin }}" selected>{{ $g->statuskawin }}</option>
                                                        <option value="Lajang">Lajang</option>
                                                        <option value="Menikah">Menikah</option>
                                                        <option value="Cerai">Cerai</option>
                                                        <option value="Cerai Mati">Cerai Mati</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="namasuamiistri" class="col-sm-3 col-form-label text-left">Nama Suami/Istri</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="namasuamiistri" name="namasuamiistri" value="{{ $g->namasuamiistri }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nipsuamiistri" class="col-sm-3 col-form-label text-left">NIP Suami/Istri</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="nipsuamiistri" name="nipsuamiistri" value="{{ $g->nipsuamiistri }}">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="pekerjaansuamiistri" class="col-sm-3 col-form-label text-left">Pekerjaan Suami/Istri</label>
                                                <select type="text" class="form-control" id="pekerjaansuamiistri" name="pekerjaansuamiistri">
                                                    <option value="{{ $g->pekerjaansuamiistri }}" selected>{{ $g->pekerjaansuamiistri }}</option>
                                                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                                                    <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                    <option value="Wirausaha">Wirausaha</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" name="guruedit" class="btn btn-success" onclick="return confirm('Data Guru Sudah benar?')">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal EDIT data guru -->


                        |
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#modalguruHapus{{ $g->idguru}}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Awal Modal hapus data guru -->
                        <div class="modal fade" id="modalguruHapus{{ $g->idguru }}" tabindex="-1"
                            aria-labelledby="modalguruHapusLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modalguruHapusLabel">Hapus Data Guru</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Yakin Mau menghapus data Guru ?</h5>
                                        <h3>
                                            <font color="red"><span>{{ $g->namaguru }} </span></font>
                                        </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/guru/hapus/{{ $g->idguru }}" method="get">
                                            <button type="submit" name="guruhapus" class="btn btn-danger">Hapus</a></button>
                                        </form>
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal"
                                            class="float-right">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal hapus data guru -->
                    </td>
                </tr>
            @endforeach
        <tbody
        <!-- Akhir menampilkan data dalam table-->
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-guru').DataTable();
        });
    </script>


    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#table-guru').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": "{{ asset('ssp') }}/loaddata.php",
            } );
        } );
    </script> --}}


    <!-- Akhir membuat table-->


    
    {{-- <!--awal pagination-->
    Halaman : {{ $guru->currentPage() }} <br />
    Jumlah Data : {{ $guru->total() }} <br />
    Data Per Halaman : {{ $guru->perPage() }} <br />

    {{ $guru->links() }}
    <!--akhir pagination--> --}}


    
    

    <!-- Awal Modal tambah data guru -->
    <div class="modal fade" id="modalTambahGuru" tabindex="-1" role="dialog" aria-labelledby="modalTambahGuruLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahGuruLabel">Form Input Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formgurutambah" id="formgurutambah" action="/guru/tambah " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukan NIP">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nuptk" class="col-sm-3 col-form-label">NUPTK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nuptk" name="nuptk" placeholder="Masukan NUPTK">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namaguru" class="col-sm-3 col-form-label">Nama Guru</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namaguru" name="namaguru"
                                    placeholder="Masukan Nama Guru">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tmplahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tmplahir" name="tmplahir"
                                    placeholder="Masukan Kota Kelahiran">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgllahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tgllahir" name="tgllahir">
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="jk" value="Laki-laki">
                                </div>
                                Laki-laki 

                                <div class="input-group-text">
                                    <input type="radio" name="jk" value="Perempuan">
                                </div>
                                Perempuan 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Masukan Alamat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idagama" class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="idagama" name="idagama">
                                    <option></option>
                                    @foreach ($agama as $a)
                                        <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tlprumah" class="col-sm-3 col-form-label">Telepon Rumah</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="tlprumah" name="tlprumah"
                                    placeholder="Masukan Nomor Telepon Rumah">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hpguru" class="col-sm-3 col-form-label">HP</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="hpguru" name="hpguru"
                                    placeholder="Masukan Nomor HP Guru">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <input type="file" id="photo" name="photo">
                            </div>
                        </div>

                        <div class="form-group row">     
                            <label for="statusaktif" class="col-sm-3 col-form-label">Status Aktif</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-text">
                                    <input type="radio" name="statusaktif" value="Aktif">
                                </div>
                                Aktif

                                <div class="input-group-text">
                                    <input type="radio" name="statusaktif" value="Tidak Aktif">
                                </div>
                                Tidak Aktif 
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahguru" class="btn btn-success" onclick="return confirm('Data Guru Sudah benar?')">Tambah</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data Guru -->



@endsection
<!--akhir isi konten dinamis-->





<!--akhir konten dinamis-->
