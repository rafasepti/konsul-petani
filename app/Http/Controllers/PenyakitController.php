<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $penyakit = Penyakit::all();
         // $produk = Produk::with('kategori')->get();
         $sql = "SELECT * FROM penyakit";
         $penyakit = DB::select($sql);

        // dd($penyakit);
        return view('penyakit/view', [
            'penyakit' => $penyakit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penyakit/create');
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
        //dd($request->all());
        $validated = $request->validate([
            'gejala' => 'required',
            'nama_penyakit' => 'required',
            'definisi' => 'required',
        ]);

        // masukkan ke db
        $penyakit = Penyakit::create([
            'gejala' => $request->gejala,
            'nama_penyakit' => $request->nama_penyakit,
            'definisi' => $request->definisi,
        ]);

        //dd($penyakit);
        
        return redirect()->route('penyakit')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function show(Penyakit $penyakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penyakit = Penyakit::where('id_penyakit', $id)->first();
        $sql = "SELECT * FROM penyakit";
        $gejala_cek = DB::select($sql);

        // dd($gejala[0]->nama_gejala);
   
        return view('penyakit/update', 
        [
            'penyakit' => $penyakit,
            'gejala_cek' => $gejala_cek,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyakit $penyakit)
    {
        // $id = $request->input('id_penyakit'); //dapatkan id dari hidden form

        $penyakit = Penyakit::find($request->input('id_penyakit'));
        $penyakit->nama_penyakit = $request->input('nama_penyakit');
        $penyakit->definisi = $request->input('definisi');
        $penyakit->gejala = $request->input('gejala');

        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'gejala' => 'required',
            'definisi' => 'required',
            'nama_penyakit' => 'required',
        ]);

        // update ke db
        // Gejala::where('id_kategori', $id)->update($validated);
        $penyakit->update(); //proses update ke db
        return redirect()->route('penyakit')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->delete();
        return redirect()->route('penyakit')->with('success','Data Berhasil di Hapus');
    }
}
