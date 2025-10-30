<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// panggil model DSP
use App\Models\DspModel;

// panggil model Tahun Ajaran
use App\Models\TahunAjaranModel;

// panggil model Siswa
use App\Models\SiswaModel;

// panggil model Siswa
use App\Models\SiswaKelasModel;

// panggil model
use App\Models\BayarModel;
use App\Models\BayarDetailModel;
use App\Models\BulanModel;
use App\Models\JenisBayarDetailModel;
use App\Models\JenisBayarModel;

class DspController extends Controller
{
    //====================AWAL METHODE UNTUK TAMPIL PEMBAYARN DSP=================
    //tampil dengan eloquent
    public function dsp()
    {
        //$bayardsp = BayarDetailModel::all();

        // mengirim data guru ke view guru
        return view('admin.pages.v_dsp');
    }
    //===================AKHIR METHODE UNTUK TAMPIL PEMBAYARN DSP================




    public function dspcari(Request $request)
    {
        $katakunci = $request->dspcari;

        // SELECT * FROM tbl_bayardetail INNER JOIN tbl_bayar ON tbl_bayar.idbayar=tbl_bayardetail.idbayar 
        // INNER JOIN tbl_siswa ON tbl_siswa.idsiswa=tbl_bayar.idsiswa 
        // INNER JOIN tbl_thnajaran ON tbl_thnajaran.idthnajaran=tbl_bayar.idthnajaran 
        // INNER JOIN tbl_user ON tbl_user.iduser=tbl_bayar.iduser 
        // INNER JOIN tbl_periode ON tbl_periode.idperiode=tbl_bayardetail.idperiode 
        // INNER JOIN tbl_jenisbayar ON tbl_jenisbayar.idperiode=tbl_periode.idperiode 
        // INNER JOIN tbl_jenisbayardetail ON tbl_jenisbayardetail.idjenisbayar=tbl_jenisbayar.idjenisbayar 
        // WHERE tbl_siswa.nis='001' AND tbl_bayardetail.idperiode='2';


        // SELECT 
        // tbl_bayardetail.idbayardetail, 
        // tbl_bayardetail.idbayar idperiode, 
        // tbl_bayardetail.idbulan nominal, 
        // tbl_bayardetail.updated_at, 
        // tbl_bayardetail.created_at,

        // tbl_bayar.idbayar,
        // tbl_bayar.idsiswa,	
        // tbl_bayar.iduser,	
        // tbl_bayar.tglbayar,	
        // tbl_bayar.idthnajaran,

        // tbl_siswa.idsiswa,	
        // tbl_siswa.nis,
        // tbl_siswa.nisn,
        // tbl_siswa.namasiswa,
        // tbl_siswa.idthnmasuk,
            
        // tbl_thnajaran.thnajaran,

        // tbl_user.iduser,
        // tbl_user.user,	

        // tbl_jenisbayardetail.idjenisbayardetail,
        // tbl_jenisbayardetail.idjenisbayar,	
        // tbl_jenisbayardetail.idtingkat,	
        // tbl_jenisbayardetail.nominaljenisbayar	


        // FROM tbl_bayardetail 
        // INNER JOIN tbl_bayar ON tbl_bayar.idbayar=tbl_bayardetail.idbayar 
        // INNER JOIN tbl_siswa ON tbl_siswa.idsiswa=tbl_bayar.idsiswa 
        // INNER JOIN tbl_thnajaran ON tbl_thnajaran.idthnajaran=tbl_bayar.idthnajaran 
        // INNER JOIN tbl_user ON tbl_user.iduser=tbl_bayar.iduser 
        // INNER JOIN tbl_periode ON tbl_periode.idperiode=tbl_bayardetail.idperiode 
        // INNER JOIN tbl_jenisbayar ON tbl_jenisbayar.idperiode=tbl_periode.idperiode 
        // INNER JOIN tbl_jenisbayardetail ON tbl_jenisbayardetail.idjenisbayar=tbl_jenisbayar.idjenisbayar 

        // WHERE tbl_siswa.nis='001' AND tbl_bayardetail.idperiode='2';
        

        $bayardsp = BayarDetailModel::join('tbl_bayar','tbl_bayar.idbayar','=','tbl_bayardetail.idbayar')
        ->join('tbl_siswa','tbl_siswa.idsiswa','=','tbl_bayar.idsiswa')
        ->join('tbl_thnajaran','tbl_thnajaran.idthnajaran','=','tbl_bayar.idthnajaran')
        ->join('tbl_user','tbl_user.iduser','=','tbl_bayar.iduser')
        ->join('tbl_periode','tbl_periode.idperiode','=','tbl_bayardetail.idperiode')
        ->join('tbl_jenisbayar','tbl_jenisbayar.idperiode','=','tbl_periode.idperiode')
        ->join('tbl_jenisbayardetail','tbl_jenisbayardetail.idjenisbayar','=','tbl_jenisbayar.idjenisbayar')
        
        ->where('nis', 'like', "%" . $katakunci . "%")
        //->where('thnajaran','coba tahun')
        ->where('tbl_bayardetail.idperiode','2')

        //->paginate(1);
        //->orderBy("created_at", 'ASC')
        //->orderBy("created_at",'DESC');
        ->get();

        return view('admin.pages.v_dspcari', ['dsp' => $bayardsp]);
    }


    //====================AWAL METHODE UNTUK TAMBAH Pembayaran DSP=================
    //method tambah data pembayaran DSP dengan eloquent
    public function kelastambah(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            //'idsiswa' => 'required',
            'nominal' => 'required'
        ]);


        //insert ke table tbl_bayar
        BayarModel::create([
            'idbayar' => $request->idbayar,
            'idsiswa' => $request->idsiswa,
            'iduser' => $request->iduser,
            'tglbayar' => $request->tglbayar,
            'idthnajaran' => $request->idtingkat
        ]);


        //insert ke table tbl_bayardetail
        BayarDetailModel::create([
            'idbayardetail' => $request->idkelas,
            'idbayar' => $request->idkelas,
            'idperiode' => $request->kelas,
            'idbulan' => $request->idjurusan,
            'nominal' => $request->idtingkat,
        ]);
        

        //dd($x);
        //return redirect('/kelas');
        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK TAMBAH Pembayaran DSP=================





}