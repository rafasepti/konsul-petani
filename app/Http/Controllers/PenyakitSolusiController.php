<?php

namespace App\Http\Controllers;

use App\Models\PenyakitSolusi;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyakitSolusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $penyakitsolusi = PenyakitSolusi::all();
        $sql = "SELECT * FROM penyakit_solusi INNER JOIN penyakit ON penyakit_solusi.id_penyakit = penyakit.id_penyakit";
        $penyakitsolusi = DB::select($sql);

        // dd($penyakitsolusi);
        return view('penyakitsolusi/view', [
            'penyakitsolusi' => $penyakitsolusi,
        ]);
        // dd($total_admin = User::where('tipe','=','admin')->count());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penyakit = Penyakit::all();
        return view('penyakitsolusi/create', ['penyakit' => $penyakit]);
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
            'solusi' => 'required',
            'id_penyakit' => 'required',
        ]);

        // masukkan ke db
        PenyakitSolusi::create($request->all());
        
        return redirect()->route('penyakitsolusi')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenyakitSolusi  $penyakitSolusi
     * @return \Illuminate\Http\Response
     */
    public function show(PenyakitSolusi $penyakitSolusi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenyakitSolusi  $penyakitSolusi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penyakitsolusi = PenyakitSolusi::where('id_penyakit_solusi', $id)->first();
        // $penyakit = Penyakit::orderBy('nama_penyakit')->get();
        // $sql2 = "SELECT * FROM penyakit INNER JOIN penyakit_solusi WHERE penyakit.id_penyakit = penyakit_solusi.id_penyakit";
        // $penyakit = DB::select($sql2);
        $penyakit = Penyakit::all();
        $sql = "SELECT * FROM penyakit INNER JOIN penyakit_solusi ON penyakit.id_penyakit_solusi = penyakit_solusi.id_penyakit_solusi 
                WHERE penyakit_solusi.id_penyakit_solusi = $id LIMIT 1";
        $penyakit_cek = DB::select($sql);

        // $sql = "SELECT * FROM penyakit_solusi INNER JOIN penyakit WHERE penyakit_solusi.id_penyakit = penyakit.id_penyakit";
        // $penyakit = DB::select($sql);

        // dd($penyakit_cek->nama_penyakit);
   
        return view('penyakitsolusi/update', 
            [
                'penyakitsolusi' => $penyakitsolusi,
                'penyakit_cek' => $penyakit_cek,
                'penyakit' => $penyakit
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenyakitSolusi  $penyakitSolusi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenyakitSolusi $penyakitSolusi)
    {
        // $id = $request->input('id_penyakit_solusi'); //dapatkan id dari hidden form

        $penyakitsolusi = PenyakitSolusi::find($request->input('id_penyakit_solusi'));
        $penyakitsolusi->solusi = $request->input('solusi');
        $penyakitsolusi->id_penyakit = $request->input('id_penyakit');

        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'solusi' => 'required',
            'id_penyakit' => 'required',
        ]);

        // update ke db
        // Gejala::where('id_kategori', $id)->update($validated);
        $penyakitsolusi->update(); //proses update ke db
        return redirect()->route('penyakitsolusi')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenyakitSolusi  $penyakitSolusi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $penyakitsolusi = PenyakitSolusi::findOrFail($id);
        $penyakitsolusi->delete();
        return redirect()->route('penyakitsolusi')->with('success','Data Berhasil di Hapus');
    }
}
