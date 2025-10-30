<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Form Pembayaran SPP')
@section('title','Pembayaran SPP')
    
    <!--awal isi konten dinamis-->
    @section('konten')
        <table width="100%">
            <tr>
                <td width="50%">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPembayaran">
                        Tambah Data Pembayaran
                    </button>
                </td>
                <td width="50%">
                    <form action="/spp/cari" method="GET">
                        <input type="text" name="sppcari" class="input-group-text col-sm-6 float-right"
                            placeholder="Masukan NIS ..." value="{{ old('sppcari') }}">
                        <input type="submit" value="CARI" class="btn btn-primary float-right">
                    </form>
                </td>
            </tr>
        </table>

        <p>
            <!-- Awal membuat table NIS Nama Kelas Siswa -->
            <table>
                @foreach ($spp as $s)
                    <tr>
                        <td width="25%">NIS</td>
                        <td width="50%">: {{$s->nis}}</td>
                    </tr>
                    
                    <tr>
                        <td>Nama Siswa</td>
                        <td>: {{$s->namasiswa}}</td>
                    </tr>
                    <tr>
                        <td>Tahun Ajaran</td>
                        
                        <td>: </td>
                        
                    </tr>
                    @endforeach
            </table>
            <!-- Akhir membuat table NIS Nama Kelas Siswa -->
            <p>
            
            <!-- Awal membuat table bulan bayar SPP -->
            <table class="table-bordered table striped">
                
        
            </table>
            <!-- Akhir membuat table bulan bayar SPP -->


    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->