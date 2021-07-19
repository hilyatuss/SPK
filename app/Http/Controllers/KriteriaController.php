<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KriteriaController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Kriteria';
        $data['rows'] = Kriteria::orderBy('kode_kriteria')->get();
        $data['tgl'] = Carbon::now()->locale('id')->isoFormat('LL');
        return view('kriteria.cetak', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Kriteria';
        $data['limit'] = 10;
        $data['rows'] = Kriteria::where('nama_kriteria', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_kriteria')
            ->paginate($data['limit'])->withQueryString();
        return view('kriteria.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Kriteria';
        return view('kriteria.create', $data);
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
            'kode_kriteria' => 'required|unique:tb_kriteria',
            'nama_kriteria' => 'required',
            // 'range1' => 'required',
            // 'range2' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ], [
            'kode_kriteria.required' => 'Kode kriteria harus diisi',
            'kode_kriteria.unique' => 'Kode kriteria harus unik',
            'nama_kriteria.required' => 'Nama kriteria harus diisi',
            // 'range1.required' => 'Range1 harus diisi',
            // 'range2.required' => 'Range2 harus diisi',
            'atribut.required' => 'Atribut harus diisi',
            'bobot.required' => 'Bobot harus diisi',
        ]);

        // $kriteria = new Kriteria($request->all());
        // $kriteria->save();

        foreach($request->range as $row){
            Kriteria::insert(
                array('kode_kriteria' => $request->kode_kriteria, 
                'nama_kriteria' => $request->nama_kriteria,
                'atribut' => $request->atribut,
                'bobot' =>  $request->bobot,
                'range1' => $row,

            ));
        }

        query("INSERT INTO tb_rel_alternatif (kode_alternatif, kode_kriteria) SELECT kode_alternatif, ? FROM tb_alternatif", [$kriteria->kode_kriteria]);

        return redirect('kriteria')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(string $kriteria)
    {
        $data['row'] = Kriteria::findOrFail($kriteria);
        $data['title'] = 'Ubah Kriteria';
        return view('kriteria.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $kriteria)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'range1' => 'required',
            'range2' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ], [
            'nama_kriteria.required' => 'Nama kriteria harus diisi',
            'range1.required' => 'Range1 harus diisi',
            'range2.required' => 'Range2 harus diisi',
            'atribut.required' => 'Atribut harus diisi',
            'bobot.required' => 'Bobot harus diisi',
        ]);
        $kriteria = Kriteria::findOrFail($kriteria);
        $kriteria->nama_kriteria = $request->nama_kriteria;
        $kriteria->range1 = $request->range1;
        $kriteria->range2 = $request->range2;
        $kriteria->atribut = $request->atribut;
        $kriteria->bobot = $request->bobot;
        $kriteria->save();
        return redirect('kriteria')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $kriteria)
    {
        $kriteria = Kriteria::findOrFail($kriteria);
        $kriteria->delete();
        return redirect('kriteria')->with('message', 'Data berhasil dihapus!');
    }
}
