<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Form Pembayaran SPP')
@section('title','Pembayaran SPP')
    
    <!--awal isi konten dinamis-->
    @section('konten')
        <table width="100%">
            <tr>
                <td width="55%">
                    
                </td>


                <td width="45%">
                    <form action="/spp/cari" method="GET">
                        <select type="text" class="form-control col-sm-9 float-right" name="sppcari" id="sppcari">
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
                        $('#sppcari').select2({
                            placeholder: 'Cari NIS atau Nama Siswa',
                            allowClear: true
                        });
                    });
                </script>

                {{-- <td width="50%">
                    <form action="/spp/cari" method="GET">
                        <input type="text" name="sppcari" class="input-group-text col-sm-6 float-right"
                            placeholder="Masukan NIS ..." value="{{ old('nis') }}">
                        <input type="submit" value="CARI" class="btn btn-primary float-right">
                    </form>
                </td> --}}
            </tr>
        </table>

        
        <p>
        <!-- Awal membuat table NIS Nama Kelas Siswa -->
        <table>
            @foreach ($headerspp as $hs)
            <tr>
                <td width="10%">ID Siswa</td>
                <td width="15%">: <label>{{$hs->idsiswa}}</label></td>
                <td width="20%" rowspan="7">
                    <img width="150px" height="220px" src="{{ url('/PhotoSiswa/' . $hs->photo) }}">
                </td>
            </tr>

            <tr>
                <td>NIS</td>
                <td>: <label>{{$hs->nis}}</label></td>
            </tr>
            
            <tr>
                <td>Nama Siswa</td>
                <td>: <label>{{$hs->namasiswa}}</label></td>
            </tr>

            <tr>
                <td>Tahun Ajaran</td>  
                <td>: <label>{{$hs->thnajaran}}</label></td>   
            </tr> 

            <tr>
                <td>Tingkat</td>  
                <td>: <label>{{$hs->tingkat}}</label></td>   
            </tr> 

            <tr>
                <td>Kelas</td>  
                <td>: <label>{{$hs->kelas}}</label></td>   
            </tr>

            <tr>
                <td>Nominal SPP perbulan</td>  
                <td>: <label>@currency($hs->nominaljenisbayar)</label></td>   
            </tr>
            @endforeach
        </table>
        
        <!-- Akhir membuat table NIS Nama Kelas Siswa -->
        <p>
        <br>
        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBayarSPP{{ $hs->idsiswa }}">
            Tambah Data Pembayaran
        </button>

        <!-- Awal membuat table bayar SPP -->
        <table id="table-spp" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td align="center"><b>No</b></td>
                    <td align="center"><b>Bulan</b></td>
                    <td align="center"><b>ID Detail Bayar</b></td>
                    <td align="center"><b>Tanggal Bayar</b></td>
                    <td align="center"><b>Petugas</b></td>
                    <td align="center"><b>Jumlah Bayar</b></td>
                </tr>
            </thead>

            <?php
                $subtotal=0;
                $idbulanterakhir=0;
            ?>
            
            @foreach ($spp as $index=>$item)
                <tr>
                    <td align="center" scope="row">{{ $index + 1}}</td>
                    <td align="center">{{$item->bulan}}</td>
                    <td align="center">{{$item->idbayardetail}}</td>
                    <td align="center">{{$item->bayar->created_at}}</td>
                    <td>{{$item->name}}</td>
                    <td align="right">@currency($item->nominalbayar)</td>
                </tr>
                
                <?php
                    $subtotal += $item->nominalbayar;
                    $idbulanterakhir = $item->idbulan;
                ?>
            
            @endforeach
            
            
            <tr>
                <td colspan="5" align="right"><b>Total yang sudah di bayar</b></td>
                <td align="right" class="bg-success">
                    <b>
                        @currency($subtotal)
                    </b>
                </td>
            </tr>

            <tr>
                <td colspan="5" align="right"><b>Sisa yang belum di bayar</b></td>
                <td align="right" class="bg-danger">
                    <b>
                        {{12-$idbulanterakhir}} bulan (@currency((($hs->nominaljenisbayar)*12)-($subtotal)))
                    </b>
                </td>
            </tr>
        </table>


        <!-- Awal Modal tambah data bayar SPP -->
        <div class="modal fade" id="modalTambahBayarSPP{{ $hs->idsiswa }}" tabindex="-1" role="dialog" aria-labelledby="modalTambahBayarSPP"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahBayarSPPLabel">Form Input Data Pembayaran SPP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form name="formBayarSPPtambah" id="formBayarSPPtambah" action="/spp/tambah" method="post">
                            @csrf
                            
                                    <input type="hidden" class="form-control" id="idsiswa" name="idsiswa" value="{{ $hs->idsiswa }}" readonly>
                                    <input type="hidden" class="form-control" id="idbulanterakhir" name="idbulanterakhir" value="{{$idbulanterakhir}}">
                                    <input type="hidden" class="form-control" id="nominaljenisbayar" name="nominaljenisbayar" value="{{$hs->nominaljenisbayar}}">
                            

                            <div class="form-group row">
                                <label for="nis" class="col-sm-4 col-form-label">NIS</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nis" name="nis" value="{{ $hs->nis }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="namasiswa" class="col-sm-4 col-form-label">Nama Siswa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="namasiswa" name="namasiswa" value="{{ $hs->namasiswa }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="idkelas" class="col-sm-4 col-form-label">Kelas</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="idkelas" name="idkelas" value="{{ $hs->kelas }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jumlahbulan" class="col-sm-4 col-form-label">Jumlah Bulan </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="jumlahbulan" name="jumlahbulan" onkeyup="jumlah();">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nominalbayar" class="col-sm-4 col-form-label">Jumlah Bayar  Rp. </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nominalbayar" name="nominalbayar" readonly>
                                </div>
                            </div>

                            {{-- Untuk input ke tbl_bayar --}}
                            <input type="hidden" class="form-control" id="iduser" name="iduser" value={{ Auth::user()->id }}>
                            {{-- tahun ajaran ganti dengan variable tahun ajaran yang dikirim dari login --}}
                            <input type="hidden" class="form-control" id="idthnajaran" name="idthnajaran" value="{{Session::get('idthnajaran')}}">
                            


                            <div class="modal-footer">
                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="tambahkelas" class="btn btn-success" onclick="return confirm('Data Pembayaran Sudah benar?')">Tambah</button>
                            </div>
                        </form>

                        <script>
                            function jumlah() {
                                var bulan = document.getElementById('jumlahbulan').value;
                                // var txtSecondNumberValue = document.getElementById('txt2').value;
                                // var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
                                var jumlahbayar = parseInt(bulan)*{{$hs->nominaljenisbayar}};
                                if (!isNaN(jumlahbayar)) {
                                    document.getElementById('nominalbayar').value = jumlahbayar;
                                }
                            }
                        </script>

                    </div>  
                </div>
            </div>
        </div>
        <!-- Akhir Modal tambah data bayar SPP -->


        
        {{-- <br>
        <table class="table-bordered table striped">
            @foreach ($spp as $index=>$item)
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
            @endforeach
        </table>
        
        <!-- Akhir membuat table bayar SPP -->
        
        <br/> --}}

    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->