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
        return view ('mahasiswa.index',$data);

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
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'nim' => 'required',
            'semester' => 'required',
        ], [
            'kode_alternatif.required' => 'Kode alternatif harus diisi',
            'kode_alternatif.unique' => 'Kode alternatif harus unik',
            'nama_alternatif.required' => 'Nama Lengkap harus diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'prodi.required' => 'Prodi harus diisi',
            'nim.required' => 'NIM harus diisi',
            'semester.required' => 'Semester harus diisi',
        ]);

        DB::table('tb_alternatif')->insert(
            array('kode_alternatif' => $request->kode_alternatif, 
            'nama_alternatif' => $request->nama_alternatif,
            'jenis_kelamin' => $request->jenis_kelamin,
            'prodi' =>  $request->prodi,
            'nim' =>  $request->nim,
            'semester' => $request->semester));
        
        // query("INSERT INTO tb_rel_alternatif (kode_alternatif, kode_kriteria) SELECT ?, kode_kriteria FROM tb_kriteria", [$request->kode_alternatif]);

        $kriteria = Kriteria::all();
        $kriteria->nilai = "0";
        foreach($kriteria as $col){
            $namaFile = Carbon::now()->timestamp;
            
            // $range = DB::table('tb_range')->where('kode_kriteria', '=', $col->kode_kriteria)->get();
            
            // foreach($range as $isi){
            //     if(empty($isi->range)){
            //         echo "ID: ".$isi->kode_kriteria." KOSONGG";
            //     }
            // }

            if($col->atribut == "cost"){
                if($request->nilai[$col->kode_kriteria] == 0){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 5,
        
                    ));
                }else if($request->nilai[$col->kode_kriteria] == 1){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 4,
        
                    ));
                }else if($request->nilai[$col->kode_kriteria] == 2){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 3,
        
                    ));
                }else if($request->nilai[$col->kode_kriteria] == 3){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 2,
        
                    ));
                }else if($request->nilai[$col->kode_kriteria] == 4){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 1,
        
                    ));
                }
            }else if($col->atribut == "benefit"){
                if($request->nilai[$col->kode_kriteria] == 0){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 5,
        
                    ));
                }else if($request->nilai[$col->kode_kriteria] == 1){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 4,
        
                    ));
                }else if($request->nilai[$col->kode_kriteria] == 2){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 3,
        
                    ));
                }else if($request->nilai[$col->kode_kriteria] == 3){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 2,
        
                    ));
                }else if($request->nilai[$col->kode_kriteria] == 4){
                    DB::table('tb_rel_alternatif')->insert(
                        array( 
                        'kode_alternatif' => $request->kode_alternatif,
                        'kode_kriteria' => $col->kode_kriteria,
                        'nilai' => 1,
        
                    ));
                }
            }
            return redirect('mahasiswa')->with('message', 'Data berhasil ditambah!');

            // if($request->hasfile('file')){
            //     $request->file("filename[".$col->kode_kriteria."]")->move(public_path().'/images/', $namaFile);  

            //     DB::table('tb_nilai')->insert(
            //         array('kode_kriteria' => $col->kode_kriteria, 
            //         'kode_alternatif' => $request->kode_alternatif,
            //         'nilai' => $request->nilai[$col->kode_kriteria],
            //         'file' => $namaFile
            //     ));
            // }else{
            //     DB::table('tb_nilai')->insert(
            //         array('kode_kriteria' => $col->kode_kriteria, 
            //         'kode_alternatif' => $request->kode_alternatif,
            //         'nilai' => $request->nilai[$col->kode_kriteria]
            //     ));
            // }
        }

    }

}
