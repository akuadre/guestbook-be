<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlianModel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ProgramKeahlianController extends Controller
{
    use ValidatesRequests;

    //====================AWAL METHODE UNTUK TAMPIL programkeahlian=================
    //tampil dengan eloquent
    public function programkeahlian()
    {
        $dataprogramkeahlian = ProgramKeahlianModel::all();
        
        // mengirim data guru ke view guru
        return view('admin.pages.master.v_programkeahlian', ['programkeahlian' => $dataprogramkeahlian]);
    }
    //===================AKHIR METHODE UNTUK TAMPIL programkeahlian================



    //====================AWAL METHODE UNTUK TAMBAH programkeahlian=================
    //method tambah data programkeahlian dengan eloquent
    public function programkeahliantambah(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'kodeprogramkeahlian' => 'required',
            'namaprogramkeahlian' => 'required',
        ]);

        //programkeahlianModel::create([
        ProgramKeahlianModel::create([
            // 'idprogramkeahlian' => $request->idprogramkeahlian,
            'kodeprogramkeahlian' => $request->namaprogramkeahlian,
            'namaprogramkeahlian' => $request->namaprogramkeahlian,
        ]);

        return redirect('/programkeahlian');
    }
    //====================AKHIR METHODE UNTUK TAMBAH programkeahlian=================



    //====================AWAL METHODE UNTUK HAPUS programkeahlian=================
    public function programkeahlianhapus($idprogramkeahlian)
    {
        $programkeahlian = ProgramKeahlianModel::find($idprogramkeahlian);
        $programkeahlian->delete();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS programkeahlian=================



    //====================AWAL METHODE UNTUK EDIT programkeahlian=================
    public function programkeahlianedit($idprogramkeahlian, Request $request)
    {
        $this->validate($request, [
            'namaprogramkeahlian' => 'required',
        ]);

        $programkeahlian = ProgramKeahlianModel::find($idprogramkeahlian);
        $programkeahlian->kodeprogramkeahlian = $request->kodeprogramkeahlian;
        $programkeahlian->namaprogramkeahlian = $request->namaprogramkeahlian;
        $programkeahlian->save();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT programkeahlian=================
}
