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
                        <input type="date" class="form-control col-sm-10" name="tglawal" id="tglawal" required>
                    </td>
                    
                    <td width=25%>
                        Tanggal Akhir
                        <input type="date" class="form-control col-sm-10" name="tglakhir" id="tglakhir" required>
                    </td>
                    
                    <td width=25%> 
                        <input type="submit" value="CARI" class="btn btn-primary">
                    </td>
                    
                    <td width=25%>
                    </td>
                </tr>
            </table>
        </form>


    
    @endsection
    <!--akhir isi konten dinamis-->

<!--akhir konten dinamis-->