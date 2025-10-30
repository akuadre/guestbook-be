<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Form Pembayaran SPP')
@section('title','Pembayaran SPP')
    
    <!--awal isi konten dinamis-->
    @section('konten')
        <table width="100%">
            <tr>
                <td width="50%">
                    
                </td>
                <td width="50%">
                    <form action="/spp" method="GET">
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
                @endforeach
                    <tr>
                        <td width="25%">ID Siswa</td>
                        <td width="50%">: {{$s->idsiswa}}</td>
                    </tr>

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
                        
                        <td>: {{$s->thnajaran}}</td>
                        
                    </tr>
                    
            </table>
            <!-- Akhir membuat table NIS Nama Kelas Siswa -->
            <p>
            
            <!-- Awal membuat table bulan bayar SPP -->
            @foreach ($spp as $item)
            <table class="table-bordered table striped">
            
                <tr height="60px">
                    <td width="25%">
                        @if ($item->idbulan == "1")
                            <input type="checkbox" class="checkbox-success" id="1" name="1" value="1" checked disabled>   Juli
                        @else
                            <input type="checkbox" id="1" name="1" value="1">   Juli
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "2")
                            <input type="checkbox" id="2" name="2" value="2" checked disabled>   Agustus
                        @else
                            <input type="checkbox" id="2" name="2" value="2">   Agustus
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "3")
                            <input type="checkbox" id="3" name="3" value="3" checked disabled>   September
                        @else
                            <input type="checkbox" id="3" name="3" value="3">   September
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "4")
                            <input type="checkbox" id="4" name="4" value="4" checked disabled>   Oktober
                        @else
                            <input type="checkbox" id="4" name="4" value="4">   Oktober
                        @endif
                    </td>
                </tr>

                <tr height="60px">
                    <td width="25%">
                        @if ($item->idbulan == "5")
                            <input type="checkbox" id="5" name="5" value="5" checked disabled>   November
                        @else
                            <input type="checkbox" id="5" name="5" value="5">   November
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "6")
                            <input type="checkbox" id="6" name="6" value="6" checked disabled>   Desember
                        @else
                            <input type="checkbox" id="6" name="6" value="6">   Desember
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "7")
                            <input type="checkbox" id="7" name="7" value="7" checked disabled>   Januari
                        @else
                            <input type="checkbox" id="7" name="7" value="7">   Januari
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "8")
                            <input type="checkbox" id="8" name="8" value="8" checked disabled>   Februari
                        @else
                            <input type="checkbox" id="8" name="8" value="8">   Februari
                        @endif
                    </td>
                </tr>

                <tr height="60px">
                    <td width="25%">
                        @if ($item->idbulan == "9")
                            <input type="checkbox" id="9" name="9" value="9" checked disabled>   Maret
                        @else
                            <input type="checkbox" id="9" name="9" value="9">   Maret
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "10")
                            <input type="checkbox" id="10" name="10" value="10" checked disabled>   April
                        @else
                            <input type="checkbox" id="10" name="10" value="10">   April
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "11")
                            <input type="checkbox" id="11" name="11" value="11" checked disabled>    Mei
                        @else
                            <input type="checkbox" id="11" name="11" value="11">    Mei
                        @endif
                    </td>
                
                    <td width="25%">
                        @if ($item->idbulan == "12")
                            <input type="checkbox" id="12" name="12" value="12" checked disabled>   Juni
                        @else
                            <input type="checkbox" id="12" name="12" value="12">   Juni
                        @endif
                    </td>
                </tr>
                
            </table>
            @endforeach
            <!-- Akhir membuat table bulan bayar SPP -->
            <br/>
            <center>
                <button type="button" class="btn btn-primary" onclick="return confirm('Data Pembayaran Sudah benar?')">
                    Simpan Data Pembayaran
                </button>
            </center>

    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->