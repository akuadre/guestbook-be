<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// panggil model jurusan
use App\Models\JurusanModel;

// panggil model tingkat
use App\Models\TingkatModel;

// panggil model kelas
use App\Models\KelasModel;
use Illuminate\Foundation\Validation\ValidatesRequests;

class KelasController extends Controller
{
    use ValidatesRequests;

    //====================AWAL METHODE UNTUK TAMPIL kelas=================
    //tampil dengan eloquent
    public function kelas()
    {
        $datakelas = KelasModel::all();
        $datajurusan = JurusanModel::all();
        $datatingkat = TingkatModel::all();

        // mengirim data guru ke view guru
        return view('admin.pages.master.v_kelas', ['kelas' => $datakelas, 'jurusan' => $datajurusan, 'tingkat' => $datatingkat]);
    }
    //===================AKHIR METHODE UNTUK TAMPIL kelas================



    //====================AWAL METHODE UNTUK TAMBAH kelas=================
    //method tambah data kelas dengan eloquent
    public function kelastambah(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            // 'idkelas' => 'required',
            'namakelas' => 'required',
            'idjurusan' => 'required',
            'idtingkat' => 'required'
        ]);

        //kelasModel::create([
        KelasModel::create([
            // 'idkelas' => $request->idkelas,
            'namakelas' => $request->namakelas,
            'idjurusan' => $request->idjurusan,
            'idtingkat' => $request->idtingkat
        ]);

        return redirect('/kelas');
    }
    //====================AKHIR METHODE UNTUK TAMBAH kelas=================



    //====================AWAL METHODE UNTUK HAPUS kelas=================
    public function kelashapus($idkelas)
    {
        $kelas = KelasModel::find($idkelas);
        $kelas->delete();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS kelas=================



    //====================AWAL METHODE UNTUK EDIT kelas=================
    public function kelasedit($idkelas, Request $request)
    {
        $this->validate($request, [
            // 'idkelas' => 'required',
            'namakelas' => 'required',
            'idjurusan' => 'required',
            'idtingkat' => 'required'
        ]);

        $kelas = KelasModel::find($idkelas);
        // $kelas->idkelas = $request->idkelas;
        $kelas->namakelas = $request->namakelas;
        $kelas->idjurusan = $request->idjurusan;
        $kelas->idtingkat = $request->idtingkat;
        $kelas->save();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT kelas=================
}