<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Form Pembayaran DSP')
@section('title','Pembayaran DSP')
    
    <!--awal isi konten dinamis-->
    @section('konten')
        <table width="100%">
            <tr>
                <td width="55%">
                    
                </td>


                <td width="45%">
                    <form action="/dsp/cari" method="GET">
                        <select type="text" class="form-control col-sm-9 float-right" name="dspcari" id="dspcari">
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
                        $('#dspcari').select2({
                            placeholder: 'Cari NIS atau Nama Siswa',
                            allowClear: true
                        });
                    });
                </script>

            </tr>
        </table>

        
        
        
        <p>
        <!-- Awal membuat table NIS Nama Kelas Siswa -->
        <table>
            @foreach ($headerdsp as $hd)
                <tr>
                    <td width="10%">ID Siswa</td>
                    <td width="15%">: <label>{{$hd->idsiswa}}</label></td>
                    <td width="20%" rowspan="7">
                        <img width="150px" height="220px" src="{{ url('/PhotoSiswa/' . $hd->photo) }}">
                    </td>
                </tr>

                <tr>
                    <td>NIS</td>
                    <td>: <label>{{$hd->nis}}</label></td>
                </tr>
                
                <tr>
                    <td>Nama Siswa</td>
                    <td>: <label>{{$hd->namasiswa}}</label></td>
                </tr>

                <tr>
                    <td>Tingkat</td>  
                    <td>: <label>{{$hd->tingkat}}</label></td>   
                </tr> 

                <tr>
                    <td>Kelas</td>  
                    <td>: <label>{{$hd->kelas}}</label></td>   
                </tr>

                <tr>
                    <td>Tahun Masuk</td>  
                    <td>: <label>{{$hd->thnajaran}}</label></td>   
                </tr> 

                <tr>
                    <td>Jumlah DSP yang harus di bayar</td>  
                    <td>: <label>@currency($hd->nominaljenisbayar)</label></td>   
                </tr>
            @endforeach
        </table>
        
        
        <!-- Akhir membuat table NIS Nama Kelas Siswa -->
        <p>
        <br>
        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBayarDSP{{ $hd->idsiswa }}">
            Tambah Data Pembayaran
        </button>

        <!-- Awal membuat table bayar DSP -->
        <table id="table-dsp" class="table table-bordered table-striped table-hover">
            <tr>
                <td align="center"><b>No</b></td>
                <td align="center"><b>Tanggal Bayar</b></td>
                <td align="center"><b>Petugas</b></td>
                <td align="center"><b>Jumlah Bayar</b></td>
            </tr>

            <?php
                $subtotal=0;
            ?>

            @foreach ($dsp as $index=>$item)
                <tr>
                    <td align="center" scope="row">{{ $index + 1}}</td>
                    <td align="center">{{$item->bayar->created_at}}</td>
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
                            @currency(($hd->nominaljenisbayar)-($subtotal))
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Akhir membuat table bayar DSP -->
        
        <br/>



        <!-- Awal Modal tambah data bayar DSP -->
        <div class="modal fade" id="modalTambahBayarDSP{{ $hd->idsiswa }}" tabindex="-1" role="dialog" aria-labelledby="modalTambahBayarDSP"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahBayarDSPLabel">Form Input Data Pembayaran DSP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="formBayarDSPtambah" id="formBayarDSPtambah" action="/dsp/tambah" method="post">
                            @csrf
                            
                            <input type="hidden" class="form-control" id="idsiswa" name="idsiswa" value="{{ $hd->idsiswa }}" readonly>

                            <div class="form-group row">
                                <label for="nis" class="col-sm-4 col-form-label">NIS</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nis" name="nis" value="{{ $hd->nis }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="namasiswa" class="col-sm-4 col-form-label">Nama Siswa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="namasiswa" name="namasiswa" value="{{ $hd->namasiswa }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="idkelas" class="col-sm-4 col-form-label">Kelas</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="idkelas" name="idkelas" value="{{ $hd->kelas }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nominalbayar" class="col-sm-4 col-form-label">Jumlah Bayar  Rp. </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nominalbayar" name="nominalbayar">
                                </div>
                            </div>

                            {{-- Untuk input ke tbl_bayar --}}
                            <input type="hidden" class="form-control" id="iduser" name="iduser" value={{ Auth::user()->id }}>
                            {{-- tahun ajaran ganti dengan variable tahun ajaran yang dikirim dari login --}}
                            <input type="hidden" class="form-control" id="idthnajaran" name="idthnajaran" value="{{Session::get('idthnajaran')}}">


                            <div class="modal-footer">
                                <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="tambahdsp" class="btn btn-success" onclick="return confirm('Data Pembayaran Sudah benar?')">Tambah</button>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
        <!-- Akhir Modal tambah data bayar DSP -->


    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->