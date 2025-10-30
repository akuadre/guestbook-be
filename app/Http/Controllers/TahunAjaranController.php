<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// panggil model Tahun Ajaran
use App\Models\TahunAjaranModel;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TahunAjaranController extends Controller
{
    use ValidatesRequests;

    ///====================AWAL METHODE UNTUK TAMPIL Tahun Ajaran=================
    //tampil dengan eloquent
    public function thnajaran()
    {
        // mengambil data Tahun Ajaran
        $thnajaran = TahunAjaranModel::orderby('idthnajaran', 'DESC')
        ->get();
        
        // mengirim data tahuan ajaran ke view Tahun Ajaran
        return view('admin.pages.master.v_thnajaran',['thnajaran' => $thnajaran]);
    }
    //===================AKHIR METHODE UNTUK TAMPIL Tahun Ajaran================

    //====================AWAL METHODE UNTUK TAMBAH Tahun Ajaran=================
    //method tambah data Tahun Ajaran dengan eloquent
    public function thnajarantambah(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            // 'idthnajaran' => 'required',
            'thnajaran' => 'required',
            'tglmulai' => 'required',
            'tglakhir' => 'required',
        ]);
        
        TahunAjaranModel::create([
            // 'idthnajaran' => $request->idthnajaran,
            'thnajaran' => $request->thnajaran,
            'tglmulai' => $request->tglmulai,
            'tglakhir' => $request->tglakhir,
        ]);
        
        return redirect('/thnajaran');
    }
    //====================AKHIR METHODE UNTUK TAMBAH Tahun Ajaran=================



    //====================AWAL METHODE UNTUK HAPUS Tahun Ajaran=================
    public function thnajaranhapus($idthnajaran)
    {
        $thnajaran = TahunAjaranModel::find($idthnajaran);
        $thnajaran->delete();
        
        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS Tahun Ajaran=================


    //====================AWAL METHODE UNTUK EDIT Tahun Ajaran=================
    public function thnajaranedit($idthnajaran, Request $request)
    {
        $this->validate($request,[
            'idthnajaran' => 'required',
            'thnajaran' => 'required',
            'tglmulai' => 'required',
            'tglakhir' => 'required',
        ]);
        
        $thnajaran = TahunAjaranModel::find($idthnajaran);
        $thnajaran->idthnajaran = $request->idthnajaran;
        $thnajaran->thnajaran = $request->thnajaran;
        $thnajaran->tglmulai = $request->tglmulai;
        $thnajaran->tglakhir = $request->tglakhir;
        $thnajaran->save();
        
        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT Tahun Ajaran=================
}