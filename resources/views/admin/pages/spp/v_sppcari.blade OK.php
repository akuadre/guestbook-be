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
                    <form action="/spp/cari" method="GET">
                        <input type="text" name="sppcari" class="input-group-text col-sm-6 float-right"
                            placeholder="Masukan NIS ..." value="{{ old('nis') }}">
                        <input type="submit" value="CARI" class="btn btn-primary float-right">
                    </form>
                </td>
            </tr>
        </table>

        
        <p>
        <!-- Awal membuat table NIS Nama Kelas Siswa -->
        <table>
            @foreach ($headerspp as $hs)
            <tr>
                <td width="15%">ID Siswa</td>
                <td width="50%">: {{$hs->idsiswa}}</td>
            </tr>

            <tr>
                <td>NIS</td>
                <td>: {{$hs->nis}}</td>
            </tr>
            
            <tr>
                <td>Nama Siswa</td>
                <td>: {{$hs->namasiswa}}</td>
            </tr>

            <tr>
                <td>Tahun Ajaran</td>  
                <td>: {{$hs->thnajaran}}</td>   
            </tr> 

            <tr>
                <td>Tingkat</td>  
                <td>: {{$hs->tingkat}}</td>   
            </tr> 

            <tr>
                <td>Kelas</td>  
                <td>: {{$hs->kelas}}</td>   
            </tr>

            <tr>
                <td>Nominal SPP perbulan</td>  
                <td>: <b>@currency($hs->nominaljenisbayar)</b></td>   
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
                    <td align="center"><b>Tanggal Bayar</b></td>
                    <td align="center"><b>Petugas</b></td>
                    <td align="center"><b>Jumlah Bayar</b></td>
                </tr>
            </thead>

            <?php
                $subtotal=0;
            ?>
            <tbody>
                @foreach ($spp as $index=>$item)
                    <tr>
                        <td align="center" scope="row">{{ $index + 1}}</td>
                        <td align="center">{{$item->created_at}}</td>
                        <td>{{$item->name}}</td>
                        <td align="right">@currency($item->nominalbayar)</td>
                    </tr>
                    
                    <?php
                        $subtotal += $item->nominalbayar;
                    ?>
                
                @endforeach
                <tr>
                    <td colspan="3" align="right"><b>Total yang sudah di bayar</b></td>
                    <td align="right" class="bg-success">
                        <b>
                            @currency($subtotal)
                        </b>
                    </td>
                </tr>

                <tr>
                    <td colspan="3" align="right"><b>Sisa yang belum di bayar</b></td>
                    <td align="right" class="bg-danger">
                        <b>
                            @currency((($hs->nominaljenisbayar)*12)-($subtotal))
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>

        
        <!-- Akhir membuat table bayar SPP -->
        
        <br/>



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
                        <div class="form-group row">
                            <label for="idsiswa" class="col-sm-4 col-form-label">ID Siswa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="idsiswa" name="idsiswa" value="{{ $hs->idsiswa }}" readonly>
                            </div>
                        </div>

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
                            <label for="nominalbayar" class="col-sm-4 col-form-label">Jumlah Bayar  Rp. </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nominalbayar" name="nominalbayar">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambahkelas" class="btn btn-success" onclick="return confirm('Data Pembayaran Sudah benar?')">Tambah</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
        </div>
        <!-- Akhir Modal tambah data bayar SPP -->


    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->