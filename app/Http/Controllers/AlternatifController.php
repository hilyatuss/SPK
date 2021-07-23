<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AlternatifController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Alternatif';
        $data['rows'] = Alternatif::orderBy('kode_alternatif')->get();
        $data['tgl'] = Carbon::now()->locale('id')->isoFormat('LL');
        return view('alternatif.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Alternatif';
        $data['limit'] = 10;
        $data['rows'] = Alternatif::where('nama_alternatif', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_alternatif')
            ->paginate($data['limit'])->withQueryString();
        return view('alternatif.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Alternatif';
        return view('alternatif.create', $data);
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
            'kode_alternatif' => 'required|unique:tb_alternatif',
            'nama_alternatif' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            // 'semester' => 'required',
        ], [
            'kode_alternatif.required' => 'Kode alternatif harus diisi',
            'kode_alternatif.unique' => 'Kode alternatif harus unik',
            'nama_alternatif.required' => 'Nama alternatif harus diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'prodi' => 'Program Studi harus diisi',
            // 'semester' => 'Program Studi harus diisi',
        ]);
        $alternatif = new Alternatif($request->all());
        $alternatif->save();

        query("INSERT INTO tb_rel_alternatif (kode_alternatif, kode_kriteria) SELECT ?, kode_kriteria FROM tb_kriteria", [$alternatif->kode_alternatif]);

        return redirect('alternatif')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternatif $alternatif)
    {
        $data['row'] = $alternatif;
        $data['title'] = 'Ubah Alternatif';
        return view('alternatif.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'nama_alternatif' => 'required',
            'prodi' => 'required',
        ], [
            'nama_alternatif.required' => 'Nama alternatif harus diisi',
            'prodi.required' => 'Program Studi harus diisi',
        ]);
        $alternatif->nama_alternatif = $request->nama_alternatif;
        $alternatif->prodi = $request->prodi;
        $alternatif->save();
        return redirect('alternatif')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternatif $alternatif)
    {
        // query("DELETE FROM tb_rel_alternatif WHERE kode_alternatif=?", [$alternatif]);
        // $alternatif->delete();

        DB::table('tb_rel_alternatif')->where('kode_alternatif', $alternatif->kode_alternatif)->delete();
        DB::table('tb_nilai')->where('kode_alternatif', $alternatif->kode_alternatif)->delete();
        Alternatif::where('kode_alternatif', $alternatif->kode_alternatif)->delete();

        return redirect('alternatif')->with('message', 'Data berhasil dihapus!');
    }
}
