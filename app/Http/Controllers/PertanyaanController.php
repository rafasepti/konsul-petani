<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pertanyaan = Pertanyaan::all();
        $sql = "SELECT * FROM pertanyaan INNER JOIN penyakit ON pertanyaan.id_penyakit = penyakit.id_penyakit 
                INNER JOIN users WHERE pertanyaan.id_petani = users.id";
        $pertanyaan = DB::select($sql);

        // dd($pertanyaan);
        return view('pertanyaan/view', [
            'pertanyaan' => $pertanyaan,
        ]);
    }

    public function konsultasi()
    {
        return view('konsultasi/view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanyaan/create');
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
            'pertanyaan' => 'required',
            'id_penyakit' => 'required',
            'id_petani' => 'required',
        ]);

        // masukkan ke db
        Pertanyaan::create($request->all());
        
        return redirect()->route('pertanyaan')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::where('id_pertanyaan', $id)->first();
   
        return view('pertanyaan/update', ['pertanyaan' => $pertanyaan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        // $id = $request->input('id_pertanyaan'); //dapatkan id dari hidden form

        $pertanyaan = Pertanyaan::find($request->input('id_pertanyaan'));
        $pertanyaan->pertanyaan = $request->input('pertanyaan');
        $pertanyaan->id_penyakit = $request->input('id_penyakit');
        $pertanyaan->id_petani = $request->input('id_petani');

        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'pertanyaan' => 'required',
            'id_penyakit' => 'required',
            'id_petani' => 'required',
        ]);

        // update ke db
        // Gejala::where('id_kategori', $id)->update($validated);
        $pertanyaan->update(); //proses update ke db
        return redirect()->route('pertanyaan')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //hapus dari database
         $pertanyaan = Pertanyaan::findOrFail($id);
         $pertanyaan->delete();
         return redirect()->route('pertanyaan')->with('success','Data Berhasil di Hapus');
    }

    public function print(Request $request){
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal',
        ]);

        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $pertanyaan = Pertanyaan::with('penyakit', 'user')
        ->whereBetween('updated_at', [$tgl_awal, date('Y-m-d', strtotime($tgl_akhir . ' +1 day'))])
        ->get();

        //dd($pertanyaan);

        return view('pertanyaan.report', compact('pertanyaan' ,'tgl_awal', 'tgl_akhir'));
    }
}
