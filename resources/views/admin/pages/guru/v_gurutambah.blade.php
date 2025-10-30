<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Daftar guru')
@section('title', 'guru')

<!--awal isi konten dinamis-->
@section('konten')
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahguru">
        Tambah Data guru
    </button> --}}

    <a href="/guru" class="btn btn-secondary">Kembali</a>

    <p>

    <form name="formgurutambah" id="formgurutambah" action="/guru/tambahaksi " method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="namaguru" class="col-sm-2 col-form-label">Nama Guru</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="namaguru" name="namaguru" placeholder="Masukan Nama Guru" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nuptk" class="col-sm-2 col-form-label">NUPTK</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="nuptk" name="nuptk" placeholder="Masukan NUTPK" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="nip" name="nip" placeholder="Masukan NIP" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="gelardepan" class="col-sm-2 col-form-label">Gelar Depan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="gelardepan" name="gelardepan" placeholder="Masukan Gelar Depan (jika ada)">
            </div>
        </div>

        <div class="form-group row">
            <label for="gelarbelakang" class="col-sm-2 col-form-label">Gelar Belakang</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="gelarbelakang" name="gelarbelakang" placeholder="Masukan Gelar Belakang (jika ada)">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
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
            <label for="tmplahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="tmplahir" name="tmplahir" placeholder="Masukan Kota Lahir" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="tgllahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" id="tgllahir" name="tgllahir" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="jenisptk" class="col-sm-2 col-form-label">Jenis PTK</label>
            <div class="col-sm-3">
                <select type="text" class="form-control" id="jenisptk" name="jenisptk" required>
                    <option></option>
                    <option value="Guru">Guru</option>
                    <option value="TU">TU</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="statuskepegawaian" class="col-sm-2 col-form-label">Status Kepegawaian</label>
            <div class="col-sm-3">
                <select type="text" class="form-control" id="statuskepegawaian" name="statuskepegawaian" required>
                    <option></option>
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
            <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Masukan Mata Pelajaran" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="idagama" class="col-sm-2 col-form-label">Agama</label>
            <div class="col-sm-3">
                <select type="text" class="form-control" id="idagama" name="idagama" required>
                    <option></option>
                    @foreach($agama as $a)
                        <option value="{{ $a->idagama }}">{{ $a->agama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="jalan" class="col-sm-2 col-form-label">Jalan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="jalan" name="jalan" placeholder="Masukan Nama Jalan" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="rt" class="col-sm-2 col-form-label">RT</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="rt" name="rt" placeholder="Masukan RT" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="rw" class="col-sm-2 col-form-label">RW</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="rw" name="rw" placeholder="Masukan RW" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="dusun" class="col-sm-2 col-form-label">Dusun</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="dusun" name="dusun" placeholder="Masukan Nama Dusun" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="desa" class="col-sm-2 col-form-label">Desa/Kelurahan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="desa" name="desa" placeholder="Masukan Nama Desa/Kelurahan" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Masukan Nama Kecamatan" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Masukan Nama Kabupaten/Kota" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="kodepos" class="col-sm-2 col-form-label">Kode Pos</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="kodepos" name="kodepos" placeholder="Masukan Kode Pos" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="tlprumah" class="col-sm-2 col-form-label">Telepon Rumah</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="tlprumah" name="tlprumah" placeholder="Masukan Telepon Rumah">
            </div>
        </div>

        <div class="form-group row">
            <label for="hpguru" class="col-sm-2 col-form-label">HP Guru</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="hpguru" name="hpguru" placeholder="Masukan Nomor HP Guru" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukan E-mail" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="skcpns" class="col-sm-2 col-form-label">Nomor SK CPNS</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="skcpns" name="skcpns" placeholder="Masukan Nomor SK CPNS">
            </div>
        </div>

        <div class="form-group row">
            <label for="tmtcpns" class="col-sm-2 col-form-label">TMT CPNS</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" id="tmtcpns" name="tmtcpns" placeholder="Masukan TMT CPNS">
            </div>
        </div>

        <div class="form-group row">
            <label for="skpns" class="col-sm-2 col-form-label">Nomor SK PNS</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="skpns" name="skpns" placeholder="Masukan Nomor SK PNS">
            </div>
        </div>

        <div class="form-group row">
            <label for="tmtpns" class="col-sm-2 col-form-label">TMT PNS</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" id="tmtpns" name="tmtpns" placeholder="Masukan TMT PNS">
            </div>
        </div>

        <div class="form-group row">
            <label for="lembagapengangkat" class="col-sm-2 col-form-label">Lembaga Pengangkat</label>
            <div class="col-sm-3">
                <select type="text" class="form-control" id="lembagapengangkat" name="lembagapengangkat">
                    <option></option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                    <option value="Ketua Yayasan">Ketua Yayasan</option>
                    <option value="Pemerintah Kab/Kota">Pemerintah Kab/Kota</option>
                    <option value="Pemerintah Propinsi">Pemerintah Propinsi</option>
                    <option value="Pemerintah Pusat">Pemerintah Pusat</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="idpangkat" class="col-sm-2 col-form-label">Pangkat Terakhir</label>
            <div class="col-sm-5">
                <select type="text" class="form-control" id="idpangkat" name="idpangkat">
                    <option></option>
                    @foreach($pangkat as $p)
                        <option value="{{ $p->idpangkat }}">{{$p->pangkat}}  |  {{$p->golongan}}-{{$p->ruang}}  |  {{$p->jabatan}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="tmtpangkat" class="col-sm-2 col-form-label">TMT Pangkat Terakhir</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" id="tmtpangkat" name="tmtpangkat">
            </div>
        </div>

        <div class="form-group row">
            <label for="sumbergaji" class="col-sm-2 col-form-label">Sumber Gaji</label>
            <div class="col-sm-3">
                <select type="text" class="form-control" id="sumbergaji" name="sumbergaji" required>
                    <option></option>
                    <option value="APBD Kabupaten/Kota">APBD Kabupaten/Kota</option>
                    <option value="APBD Provinsi">APBD Provinsi</option>
                    <option value="APBN">APBN</option>
                    <option value="Sekolah">Sekolah</option>
                    <option value="Yayasan">Yayasan</option>
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="npwp" class="col-sm-2 col-form-label">NPWP</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="npwp" name="npwp" placeholder="Masukan Nomor NPWP" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="namawajibpajak" class="col-sm-2 col-form-label">Nama Wajib Pajak</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="namawajibpajak" name="namawajibpajak" placeholder="Masukan Nama Wajib Pajak" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukan Nomor Induk Kependudukan" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="kartukeluarga" class="col-sm-2 col-form-label">Nomor Kartu Keluarga</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="kartukeluarga" name="kartukeluarga" placeholder="Masukan Nomor Kartu Keluarga" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="karpeg" class="col-sm-2 col-form-label">Kartu Pegawai</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="karpeg" name="karpeg" placeholder="Masukan Nomor Kartu Pegawai">
            </div>
        </div>

        <div class="form-group row">
            <label for="karis" class="col-sm-2 col-form-label">Kartu Istri/Suami</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="karis" name="karis" placeholder="Masukan Nomor KArtu Istri/Suami">
            </div>
        </div>

        <div class="form-group row">
            <label for="tmtkgb" class="col-sm-2 col-form-label">TMT KGB Terakhir</label>
            <div class="col-sm-3">
                <input type="date" class="form-control" id="tmtkgb" name="tmtkgb">
            </div>
        </div>

        

        <div class="form-group row">
            <label for="pendidikanterakhir" class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
            <div class="col-sm-3">
                <select type="text" class="form-control" id="pendidikanterakhir" name="pendidikanterakhir" required>
                    <option></option>
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
            <label for="programstudi" class="col-sm-2 col-form-label">Program Studi Pendidikan Terakhir</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="programstudi" name="programstudi" placeholder="Masukan Program Studi Pendidikan Terakhir" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="perguruantinggi" class="col-sm-2 col-form-label">Perguruan Tinggi Pendidikan Terakhir</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="perguruantinggi" name="perguruantinggi" placeholder="Masukan Perguruan Tinggi Pendidikan Terakhir" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="tahunlulus" class="col-sm-2 col-form-label">Tahun Lulus</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="tahunlulus" name="tahunlulus" placeholder="Masukan Tahun Lulus" required>
            </div>
        </div>

        
        <div class="form-group row">
            <label for="photoguru" class="col-sm-2 col-form-label text-left">Photo</label>
            <div class="col-sm-9 text-left">
                <input type="file" id="photoguru" name="photoguru">
            </div>
        </div>
        
        
        <div class="form-group row">
            <label for="statusaktif" class="col-sm-2 col-form-label">statusaktif</label>
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

        <div class="form-group row">
            <label for="namaibu" class="col-sm-2 col-form-label text-left">Nama Ibu</label>
            <div class="col-sm-9 text-left">
                <input type="text" class="form-control" id="namaibu" name="namaibu" placeholder="Masukan Nama Ibu">
            </div>
        </div>

        <div class="form-group row">
            <label for="statuskawin" class="col-sm-2 col-form-label">Status Pernikahan</label>
            <div class="col-sm-3">
                <select type="text" class="form-control" id="statuskawin" name="statuskawin" required>
                    <option></option>
                    <option value="Lajang">Lajang</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Cerai">Cerai</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="namasuamiistri" class="col-sm-2 col-form-label text-left">Nama Suami/Istri</label>
            <div class="col-sm-9 text-left">
                <input type="text" class="form-control" id="namasuamiistri" name="namasuamiistri" placeholder="Masukan Nama Suami/Istri">
            </div>
        </div>

        <div class="form-group row">
            <label for="nipsuamiistri" class="col-sm-2 col-form-label text-left">NIP Suami/Istri</label>
            <div class="col-sm-9 text-left">
                <input type="number" class="form-control" id="nipsuamiistri" name="nipsuamiistri" placeholder="Masukan NIP Suami/Istri">
            </div>
        </div>

        <div class="form-group row">
            <label for="pekerjaansuamiistri" class="col-sm-2 col-form-label text-left">Pekerjaan Suami/Istri</label>
            <div class="col-sm-3">
                <select type="text" class="form-control" id="pekerjaansuamiistri" name="pekerjaansuamiistri">
                    <option></option>
                    <option value="-">-</option>
                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                    <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                    <option value="Wirausaha">Wirausaha</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <a href="/guru" class="btn btn-secondary">Tutup</a>
            {{-- <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
            <button type="submit" name="tambahguru" class="btn btn-success">Tambah</button>
        </div>
    </form>


    {{-- 
    <!--awal pagination-->
    Halaman : {{ $guru->currentPage() }} <br />
    Jumlah Data : {{ $guru->total() }} <br />
    Data Per Halaman : {{ $guru->perPage() }} <br />

    {{ $guru->links() }}
    <!--akhir pagination--> --}}



























    <!-- Awal Modal tambah data guru -->
    <div class="modal fade" id="modalTambahguru" tabindex="-1" role="dialog" aria-labelledby="modalTambahguruLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahguruLabel">Form Input Data guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="formgurutambah" id="formgurutambah" action="/guru/tambah " method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="idguru" class="col-sm-3 col-form-label">ID guru</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="idguru" name="idguru" placeholder="Masukan ID guru">
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="namaguru" class="col-sm-3 col-form-label">Nama guru</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namaguru" name="namaguru" placeholder="Masukan Nama guru">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namajurusan" class="col-sm-3 col-form-label">Nama Jurusan</label>
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
                        </div> --}}

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahguru" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
    <!-- Akhir Modal tambah data guru -->

@endsection
<!--akhir isi konten dinamis-->