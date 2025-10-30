<?php

namespace App\Http\Controllers;

use App\Models\RuanganModel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    use ValidatesRequests;

    //====================AWAL METHODE UNTUK TAMPIL RUANGAN=================
    //tampil dengan eloquent
    public function ruangan()
    {
        $ruangan = RuanganModel::all();

        // mengirim data guru ke view guru
        return view('admin.pages.master.v_ruangan', ['dataruangan' => $ruangan]);
        
    }
    //===================AKHIR METHODE UNTUK TAMPIL RUANGAN================


    //====================AWAL METHODE UNTUK TAMBAH RUANGAN=================
    //method tambah data ruangan dengan eloquent
    public function ruangantambah(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            // 'idruangan' => 'required',
            'koderuangan' => 'required',
            'namaruangan' => 'required',
            'lokasi' => 'required',
            'lebar' => 'required',
            'panjang' => 'required',
            'kondisi' => 'required',
        ]);

    
        RuanganModel::create([
            // 'idruangan' => $request->idruangan,
            'koderuangan' => $request->koderuangan,
            'namaruangan' => $request->namaruangan,
            'lokasi' => $request->lokasi,
            'lebar' => $request->lebar,
            'panjang' => $request->panjang,
            'kondisi' => $request->kondisi,
        ]);

        return redirect('/ruangan');
    }
    //====================AKHIR METHODE UNTUK TAMBAH RUANGAN=================


    //====================AWAL METHODE UNTUK HAPUS RUANGAN=================
    public function ruanganhapus($idruangan)
    {
        $ruangan = RuanganModel::find($idruangan);
        $ruangan->delete();

        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK HAPUS RUANGAN=================



    //====================AWAL METHODE UNTUK EDIT RUANGAN=================
    public function ruanganedit($idruangan, Request $request)
    {
        $this->validate($request, [
            'idruangan' => 'required',
            'koderuangan' => 'required',
            'namaruangan' => 'required',
            'lokasi' => 'required',
            'lebar' => 'required',
            'panjang' => 'required',
            'kondisi' => 'required',
        ]);

        $ruangan = RuanganModel::find($idruangan);
        $ruangan->idruangan = $request->idruangan;
        $ruangan->koderuangan = $request->koderuangan;
        $ruangan->namaruangan = $request->namaruangan;
        $ruangan->lokasi = $request->lokasi;
        $ruangan->lebar = $request->lebar;
        $ruangan->panjang = $request->panjang;
        $ruangan->kondisi = $request->kondisi;
        $ruangan->save();

        //return redirect('/ruangan');
        return redirect()->back();
    }
    //====================AKHIR METHODE UNTUK EDIT RUANGAN=================
}
