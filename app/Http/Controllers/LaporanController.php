<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// panggil model bayar
use App\Models\BayarModel;

// panggil model bayardetail
use App\Models\BayarDetailModel;

use PDF;


class LaporanController extends Controller
{
    //====================AWAL METHODE UNTUK TAMPIL LAPORAN=================
    public function laporan()
    {
        // mengirim data BAYAR ke view LAPORAN BAYAR
        return view('admin.pages.laporan.v_laporan');
    }
    //===================AKHIR METHODE UNTUK TAMPIL LAPORAN================


    //===================AWAL METHODE UNTUK CARI LAPORAN================
    public function laporancari(Request $request)
    {
        //ambil value dari view laporan
        $awal = $request->tglawal;
        $akhir = $request->tglakhir;

        // SELECT 
        // * FROM 
        // tbl_bayardetail 
        // INNER JOIN tbl_bayar ON tbl_bayar.idbayar=tbl_bayardetail.idbayar 
        // INNER JOIN tbl_siswa ON tbl_siswa.idsiswa=tbl_bayar.idsiswa 
        // INNER JOIN users ON users.id=tbl_bayar.iduser 
        // INNER JOIN tbl_bulan ON tbl_bulan.idbulan=tbl_bayardetail.idbulan 
        // INNER JOIN tbl_periode ON tbl_periode.idperiode=tbl_bayardetail.idperiode 
        // INNER JOIN tbl_jenisbayar ON tbl_jenisbayar.idperiode=tbl_periode.idperiode 
        // WHERE 
        // tbl_bayar.created_at BETWEEN 2022-05-24 AND 2022-05-24
        // AND tbl_bayar.idthnajaran='3' 
        // AND tbl_jenisbayar.idjenisbayar='SPP' 
        // OR tbl_jenisbayar.idjenisbayar='DSP' 
        // ORDER BY tbl_bayar.created_at ASC;

        $databayar = BayarDetailModel::
        join('tbl_bayar','tbl_bayar.idbayar','=','tbl_bayardetail.idbayar')
        ->join('tbl_siswa','tbl_siswa.idsiswa','=','tbl_bayar.idsiswa')
        ->join('users','users.id','=','tbl_bayar.iduser')
        ->join('tbl_bulan','tbl_bulan.idbulan','=','tbl_bayardetail.idbulan')
        ->join('tbl_periode','tbl_periode.idperiode','=','tbl_bayardetail.idperiode')
        ->join('tbl_jenisbayar','tbl_jenisbayar.idperiode','=','tbl_periode.idperiode')

        ->whereBetween('tbl_bayar.created_at', [$awal, $akhir])
        //tahuan ajaran harus diganti dengan variable
        ->where('tbl_bayar.idthnajaran','3')
        ->where('tbl_jenisbayar.idjenisbayar','SPP')
        ->ORWHERE('tbl_jenisbayar.idjenisbayar','DSP')
        
        ->orderby('tbl_bayar.created_at', 'ASC')

        ->get();


        // mengirim data BAYAR ke view LAPORAN BAYAR
        return view('admin.pages.laporan.v_laporancari', ['bayar' => $databayar,'tglawal'=>$awal,'tglakhir'=>$akhir]);
    }
    //===================AKHIR METHODE UNTUK CARI LAPORAN================



    //===================AWAL METHODE UNTUK CETAK LAPORAN PDF================
    public function laporancetakpdf()
    {
        //mengambil data
        $databayar = BayarDetailModel::
        join('tbl_bayar','tbl_bayar.idbayar','=','tbl_bayardetail.idbayar')
        ->join('tbl_siswa','tbl_siswa.idsiswa','=','tbl_bayar.idsiswa')
        ->join('users','users.id','=','tbl_bayar.iduser')
        ->join('tbl_bulan','tbl_bulan.idbulan','=','tbl_bayardetail.idbulan')
        ->join('tbl_periode','tbl_periode.idperiode','=','tbl_bayardetail.idperiode')
        ->join('tbl_jenisbayar','tbl_jenisbayar.idperiode','=','tbl_periode.idperiode')

        //tahuan ajaran harus diganti dengan variable
        ->where('tbl_bayar.idthnajaran','3')
        ->where('tbl_jenisbayar.idjenisbayar','SPP')
        ->ORWHERE('tbl_jenisbayar.idjenisbayar','DSP')
        ->orderby('tbl_bayar.created_at', 'ASC')

        ->get();


        //cetak pdf
        $pdf = PDF::loadview('v_laporancetakpdf',['bayar' => $databayar]); 

        //mengirim data ke view ctak pdf
        return $pdf->download('laporan-pembayaran.pdf');
        //return $pdf->stream(); 
    }
    //===================AKHIR METHODE UNTUK CETAK LAPORAN PDF================
}
