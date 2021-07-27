<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $periode)
    {  
        $data['title'] = 'Periode Beasiswa';
        $data['limit'] = 10;
        $data['rows'] = Periode::all();
        return view('periode.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Periode Beasiswa';
        return view('periode.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mulai' => 'required',
            'selesai' => 'required'
        ], [
            'mulai.required' => 'Tanggal Mulai harus diisi',
            'selesai.required' => 'Tanggal Selesai harus diisi'
        ]);

        // $periode = new Periode($request->all());
        // $periode->save();
        $tahun = explode("-", $request->selesai);
        Periode::insert(array('nama_periode' => 'Periode tahun '.$tahun[0],'mulai' => $request->mulai, 'selesai' => $request->selesai));

        return redirect('periode')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periode $periode)
    {
        //
    }
}
