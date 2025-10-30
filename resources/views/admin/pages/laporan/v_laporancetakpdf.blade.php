<!--awal konten dinamis-->
@extends('admin/v_admin')
@section('judulhalaman', 'Laporan Pembayaran')
@section('title','Laporan Pembayaran')
    
    <!--awal isi konten dinamis-->
    @section('konten')
        <form action="/laporan/cari" method="GET">
            <table width=100%>
                <tr>
                    <td width=25%>
                        Tanggal Awal
                        <input type="date" class="form-control col-sm-10" name="tglawal" id="tglawal">
                    </td>
                    
                    <td width=25%>
                        Tanggal Akhir
                        <input type="date" class="form-control col-sm-10" name="tglakhir" id="tglakhir">
                    </td>
                    
                    <td width=25%> 
                        <input type="submit" value="CARI" class="btn btn-primary">
                    </td>
                    
                    <td width=25%>
                    </td>
                </tr>
            </table>
        </form>


        

        <br/> <a href="/laporan/cetakpdf" class="btn btn-primary" target="_blank">CETAK PDF</a> <p>

        <table class="table table-bordered table-striped table-hover table-sm" id="table-laporan">
            <!-- Awal header table-->
            <thead>
                <tr>
                    <th>
                        <center>No</center>
                    </th>

                    <th>
                        <center>ID Detail Bayar</center>
                    </th>

                    <th>
                        <center>NIS</center>
                    </th>

                    <th>
                        <center>Nama Siswa</center>
                    </th>

                    <th>
                        <center>Petugas</center>
                    </th>

                    <th>
                        <center>Tanggal Bayar</center>
                    </th>
                    
                    <th>
                        <center>Jenis Pembayaran</center>
                    </th>

                    <th>
                        <center>Bulan</center>
                    </th>

                    <th>
                        <center>Nominal Bayar</center>
                    </th>
                </tr>
            </thead>
            <!-- Akhir header table-->

            <!-- Awal menampilkan data dalam table-->
            <tbody>
                @foreach ($bayar as $index => $b)
                    <tr>
                        <td align="center" scope="row">{{ $index + 1 }}</td>
                        <td align="center">{{$b->idbayardetail}}</td>
                        <td align="center">{{$b->nis}}</td>
                        <td>{{$b->namasiswa}}</td>
                        <td>{{$b->name}}</td>
                        <td>{{$b->bayar->created_at}}</td>
                        <td align="center">{{$b->jenisbayar}}</td>
                        <td align="center">{{$b->bulan}}</td>
                        <td align="right">@currency($b->nominalbayar)</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#table-laporan').DataTable();
            });
        </script>
        <!-- Akhir membuat table-->


    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->