<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gejala = Gejala::all();

        // dd($gejala);
        return view('gejala/view', [
            'gejala' => $gejala,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gejala/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'nama_gejala' => 'required',
        ]);

        // masukkan ke db
        Gejala::create($request->all());
        
        return redirect()->route('gejala')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function show(Gejala $gejala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gejala = Gejala::where('id_gejala', $id)->first();
   
        return view('gejala/update', ['gejala' => $gejala]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gejala $gejala)
    {
        // $id = $request->input('id_gejala'); //dapatkan id dari hidden form

        $gejala = Gejala::find($request->input('id_gejala'));
        $gejala->nama_gejala = $request->input('nama_gejala');

        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'nama_gejala' => 'required',
        ]);

        // update ke db
        // Gejala::where('id_kategori', $id)->update($validated);
        $gejala->update(); //proses update ke db
        return redirect()->route('gejala')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $gejala = Gejala::findOrFail($id);
        $gejala->delete();
        return redirect()->route('gejala')->with('success','Data Berhasil di Hapus');
    }
}
