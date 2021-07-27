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
        $data['rows'] = Alternatif::orderBy('nim')->get();
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
        $data['rows'] = Alternatif::join('tb_user', 'tb_alternatif.user_id', '=', 'tb_user.id')
            ->where('nama_user', 'like', '%' . $data['q'] . '%')
            ->orderBy('nim')
            ->paginate($data['limit'])->withQueryString();

        // echo json_encode($data['rows']);
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
            'nim' => 'required|unique:tb_alternatif',
            'nama_alternatif' => 'required',
            'prodi' => 'required',
            // 'semester' => 'required',
        ], [
            'nim.required' => 'NIM harus diisi',
            'nim.unique' => 'NIM harus unik',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'prodi' => 'Program Studi harus diisi',
            // 'semester' => 'Program Studi harus diisi',
        ]);
        // $alternatif = new Alternatif($request->all());
        // $alternatif->save();

        $alternatif = Alternatif::insert(['nim' => $request->nim, 'jenis_kelamin' => $request->jenis_kelamin, 'prodi' => $request->prodi]);

        query("INSERT INTO tb_rel_alternatif (nim, kode_kriteria) SELECT ?, nim FROM tb_kriteria", [$alternatif->nim]);

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
            'nim' => 'required',
            'nama_alternatif' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'semester' => 'required',
        ], [
            'nim.required' => 'NIM harus diisi',
            'nama_alternatif.required' => 'Nama alternatif harus diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'prodi.required' => 'Program Studi harus diisi',
            'semester.required' => 'Semester harus diisi',
        ]);
        $alternatif->nim = $request->nim;
        $alternatif->jenis_kelamin = $request->jenis_kelamin;
        $alternatif->prodi = $request->prodi;
        $alternatif->semester = $request->semester;
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
        DB::table('tb_rel_alternatif')->where('nim', $alternatif->nim)->delete();
        Alternatif::where('nim', $alternatif->nim)->delete();

        return redirect('alternatif')->with('message', 'Data berhasil dihapus!');
    }
}
