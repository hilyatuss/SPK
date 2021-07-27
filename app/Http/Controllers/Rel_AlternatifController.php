<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Rel_Alternatif;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class Rel_AlternatifController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Nilai Alternatif';
        $data['rows'] = Alternatif::join('tb_user', 'tb_alternatif.user_id', '=', 'tb_user.id')->with(['nilais'])->orderBy('nim')->get();
        $data['kriterias'] = Kriteria::all();
        $data['tgl'] = Carbon::now()->locale('id')->isoFormat('LL');
        return view('rel_alternatif.cetak', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Nilai Alternatif';
        $data['limit'] = 10;
        $data['rows'] = Alternatif::
            join('tb_user', 'tb_alternatif.user_id', '=', 'tb_user.id')
            ->with(['nilais'])
            ->where('nama_user', 'like', '%' . $data['q'] . '%')
            ->orderBy('nim')
            ->paginate($data['limit'])->withQueryString();

        $data['kriterias'] = Kriteria::all();
        return view('rel_alternatif.index', $data);
        // echo json_encode($data['rows']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function show(Rel_Alternatif $rel_Alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(string $alternatif)
    {
        $data['row'] = Alternatif::join('tb_user', 'tb_alternatif.user_id', '=', 'tb_user.id')->findOrFail($alternatif);
        $data['title'] = 'Ubah Nilai Alternatif';
        return view('rel_alternatif.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rel_Alternatif $rel_Alternatif)
    {
        $request->validate([
            'nilai.*' => 'required',
        ], [
            'nilai.*.required' => 'Nilai :attribute harus diisi',
        ]);
        foreach ($request->nilai as $key => $val) {
            $rel_alternatif = Rel_Alternatif::find($key);
            $rel_alternatif->nilai = $val;
            $rel_alternatif->save();
        }
        return redirect('rel_alternatif')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rel_Alternatif $rel_Alternatif)
    {
        //
    }
}
