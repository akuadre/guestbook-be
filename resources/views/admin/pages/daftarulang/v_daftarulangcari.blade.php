<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Proses Daftar Ulang')
@section('title','Proses Daftar Ulang')
    
    <!--awal isi konten dinamis-->
    @section('konten')
        <table width="100%">
            <tr>
                <td width="55%">
                    
                </td>

                <td width="45%">
                    <form action="/daftarulang/carisiswa" method="GET">
                        <select type="text" class="form-control col-sm-9 float-right" name="siswacari" id="siswacari">
                            <option></option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->nis}}">{{ $s->nis }} | {{ $s->namasiswa }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="CARI" class="btn btn-primary">
                    </form>
                </td>
                
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#siswacari').select2({
                            placeholder: 'Cari NIS atau Nama Siswa',
                            allowClear: true
                        });
                    });
                </script>
            </tr>
        </table>

        
        <p>
        <!-- Awal membuat table NIS Nama Kelas Siswa -->
        <table width="100%">
            @foreach ($headerdaftarulang as $hdu)
                <tr>
                    <td width="10%">ID Siswa</td>
                    <td width="15%">: <label>{{$hdu->idsiswa}}</label></td>
                    <td width="20%" rowspan="7">
                        <img width="150px" height="220px" src="{{ url('/PhotoSiswa/' . $hdu->photosiswa) }}">
                    </td>
                </tr>

                <tr>
                    <td>NIS</td>
                    <td>: <label>{{$hdu->nis}}</label></td>
                </tr>
                
                <tr>
                    <td>Nama Siswa</td>
                    <td>: <label>{{$hdu->namasiswa}}</label></td>
                </tr>

                {{-- <tr>
                    <td>Tahun Ajaran Sebelumnya</td>  
                    <td>: <label>{{$hdu->thnajaran}}</label></td>   
                </tr>  --}}

                <tr>
                    <td>Tingkat pada TA {{$hdu->thnajaran}}</td>  
                    <td>: <label>{{$hdu->tingkat}}</label></td>   
                </tr> 

                <tr>
                    <td>Kelas pada TA {{$hdu->thnajaran}}</td>  
                    <td>: <label>{{$hdu->namakelas}}</label></td>   
                </tr>

                <tr>
                    <td>
                        TA {{Session::get('namatahunajaran')}} Naik/Tidak Naik ke Kelas 
                    </td>
                    
                    <td>
                        : <select type="text" class="form-control col-sm-8 " id="idkelas" name="idkelas" onkeyup="bayardaftarulang();">
                            @foreach ($kelas as $k)
                                @if ($k->idkelas == $hdu->idkelas)
                                    <option value="{{ $k->idkelas }}" selected>{{ $k->namakelas }}</option>
                                @else
                                    <option value="{{ $k->idkelas }}">{{ $k->namakelas }}</option>
                                @endif
                            @endforeach
                        </select>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#idkelas').select2({
                                    placeholder: 'Pilih Kelas',
                                    allowClear: true
                                });
                            });
                        </script>
                    </td>  
                </tr>

                
                <tr>
                    <td>Tunggakan SPP TA {{$hdu->thnajaran}}</td>  
                    <td>: <label id="nominaldaftarulang" name="nominaldaftarulang">@currency($hdu->nominaljenisbayar)</label></td>   
                </tr>

                <tr>
                    <td>SPP per Bulan pada TA {{Session::get('namatahunajaran')}}</td>  
                    <td>: <label id="nominaldaftarulang" name="nominaldaftarulang">@currency($hdu->nominaljenisbayar)</label></td>   
                </tr>
            @endforeach
        </table>
        
        <!-- Akhir membuat table NIS Nama Kelas Siswa -->
        <p>
        <br>
        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBayarSPP{{$hdu->idsiswa }}">
            Proses Daftar Ulang
        </button>



        <script>
            function bayardaftarulang() {
                var bulan = document.getElementById('idkelas').value;
                // var txtSecondNumberValue = document.getElementById('txt2').value;
                // var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
                var jumlahbayar = parseInt(bulan)*{{$hdu->nominaljenisbayar}};

                var jumlahbayar = parseInt(200000);

                if (!isNaN(jumlahbayar)) {
                    document.getElementById('nominaldaftarulang').value = jumlahbayar;
                }
            }
        </script>
        

    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->