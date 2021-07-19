<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $data['kode_kriteria'] = $request->input('kode_kriteria');
        $data['title'] = 'Daftar Beasiswa Bidikmisi';
        $data['kriterias'] = Kriteria::all();
        return view ('mahasiswa.create',$data);

    }

    public function create()
    {
        $data['title'] = 'Daftar Beasiswa Bidikmisi';
        $data['kriterias'] = Kriteria::all();
        return view('mahasiswa.create', $data);
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'kode_alternatif' => 'required|unique:tb_alternatif',
            'nama_alternatif' => 'required',
            'prodi' => 'required',
            ''
        ], [
            'kode_alternatif.required' => 'Kode alternatif harus diisi',
            'kode_alternatif.unique' => 'Kode alternatif harus unik',
            'nama_alternatif.required' => 'Nama Lengkap harus diisi',
            'prodi.required' => 'Prodi harus diisi',
        ]);

        DB::table('tb_alternatif')->insert(
            array('kode_alternatif' => $request->kode_alternatif, 
            'nama_alternatif' => $request->nama_alternatif,
            'jenis_kelamin' => $request->jenis_kelamin,
            'prodi' =>  $request->prodi));
        
        query("INSERT INTO tb_rel_alternatif (kode_alternatif, kode_kriteria) SELECT ?, kode_kriteria FROM tb_kriteria", [$request->kode_alternatif]);
        $kriteria = Kriteria::all();
        foreach($kriteria as $col){
            $namaFile = Carbon::now()->timestamp;

            if($request->hasfile('file')){
                $request->file("filename[".$col->kode_kriteria."]")->move(public_path().'/images/', $namaFile);  

                DB::table('tb_nilai')->insert(
                    array('kode_kriteria' => $col->kode_kriteria, 
                    'kode_alternatif' => $request->kode_alternatif,
                    'nilai' => $request->nilai[$col->kode_kriteria],
                    'file' => $namaFile
                ));
            }else{
                DB::table('tb_nilai')->insert(
                    array('kode_kriteria' => $col->kode_kriteria, 
                    'kode_alternatif' => $request->kode_alternatif,
                    'nilai' => $request->nilai[$col->kode_kriteria]
                ));
            }
        }
        return redirect('mahasiswa')->with('message', 'Data berhasil ditambah!');
    }

}
