<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// panggil model jurusan
use App\Models\JurusanModel;
use App\Models\ProgramKeahlianModel;
use Illuminate\Foundation\Validation\ValidatesRequests;

class JurusanController extends Controller
{
    use ValidatesRequests;

    //====================AWAL METHODE UNTUK TAMPIL JURUSAN=================
    //tampil dengan eloquent
    public function jurusan()
    {
        $jurusan = JurusanModel::all();
        $programkeahlian=ProgramKeahlianModel::all();

        // mengirim data guru ke view guru
        return view('admin.pages.master.v_jurusan', ['datajurusan' => $jurusan,'programkeahlian'=> $programkeahlian]);
        
    }
    //===================AKHIR METHODE UNTUK TAMPIL JURUSAN================


    //====================AWAL METHODE UNTUK TAMBAH JURUSAN=================
    //method tambah data jurusan dengan eloquent
    public function jurusantambah(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            // 'idjurusan' => 'required',
            'kodejurusan' => 'required',
            'namajurusan' => 'required',
            'idprogramkeahlian' => 'required',
        ]);

    
        JurusanModel::create([
            // 'idjurusan' => $request->idjurusan,
            'kodejurusan' => $request->kodejurusan,
            'namajurusan' => $request->namajurusan,
            'idprogramkeahlian' => $request->idprogramkeahlian,
        ]);

        return redirect('/jurusan');
    }
    //====================AKHIR METHODE UNTUK TAMBAH JURUSAN=================




    //====================AWAL METHODE UNTUK HAPUS JURUSAN=================
    public function jurusanhapus($idjurusan)
    {
        $jurusan = JurusanModel::find($idjurusan);
        $jurusan->delete();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS JURUSAN=================

    //====================AWAL METHODE UNTUK EDIT JURUSAN=================
    public function jurusanedit($idjurusan, Request $request)
    {
        $this->validate($request, [
            'idjurusan' => 'required',
            'kodejurusan' => 'required',
            'namajurusan' => 'required',
            'idprogramkeahlian' => 'required',
        ]);

        $jurusan = JurusanModel::find($idjurusan);
        $jurusan->idjurusan = $request->idjurusan;
        $jurusan->kodejurusan = $request->kodejurusan;
        $jurusan->namajurusan = $request->namajurusan;
        $jurusan->idprogramkeahlian = $request->idprogramkeahlian;
        $jurusan->save();

        //return redirect('/jurusan');
        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT JURUSAN=================
}
