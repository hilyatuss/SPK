<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\Rel_Alternatif;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DB;
use Carbon\Carbon;
use Auth;

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
        $data['periode'] = DB::table('tb_periode')->latest('selesai')->first();
        $data['user'] = Auth::user();
        return view('mahasiswa.create', $data);
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'nim' => 'required|unique:tb_alternatif',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'semester' => 'required'
        ], [
            'nim.required' => 'NIM harus diisi',
            'nim.min' => 'NIM salah',
            'nama_alternatif.required' => 'Nama Lengkap harus diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'prodi.required' => 'Prodi harus diisi',
            'semester.required' => 'Semester harus diisi'
        ]);

        $periode = DB::table('tb_periode')->latest('selesai')->first();

        DB::table('tb_alternatif')->insert(
            array(
            'nim' =>  $request->nim,
            'user_id' => Auth::user()->id,
            'periode_id' => $periode->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'prodi' =>  $request->prodi,            
            'semester' => $request->semester));
        
        // query("INSERT INTO tb_rel_alternatif (kode_alternatif, kode_kriteria) SELECT ?, kode_kriteria FROM tb_kriteria", [$request->kode_alternatif]);

        $kriteria = Kriteria::all();
        $kriteria->nilai = "0";
        // $request->validate([
        //     'file' => 'required',
        //     'file.*' => 'mimes:PDF,pdf|max:20000'
        // ]);
        
        foreach($kriteria as $no => $col){
            $namaFile = Carbon::now()->timestamp;
            
            
            if($col->atribut == "cost"){
                if($request->nilai[$col->kode_kriteria] == 0){
                    if ($request->hasfile('file')) { 
                            $filename = $request->file('file');
                            if ($filename[$col->kode_kriteria]->isValid()) {
                                $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                                $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                                DB::table('tb_rel_alternatif')->insert(
                                    array( 
                                    'nim' => $request->nim,
                                    'kode_kriteria' => $col->kode_kriteria,
                                    'nilai' => 1,
                                    'file' => $file
                                ));
                            }
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 1,
                        ));
                    }
                    
                    
                }else if($request->nilai[$col->kode_kriteria] == 1){
                    if ($request->hasfile('file')) { 
                        $filename = $request->file('file');
                        if ($filename[$col->kode_kriteria]->isValid()) {
                            $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                            $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                            DB::table('tb_rel_alternatif')->insert(
                                array( 
                                'nim' => $request->nim,
                                'kode_kriteria' => $col->kode_kriteria,
                                'nilai' => 2,
                                'file' => $file
                            ));
                        }
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 2,
                        ));
                    }
                }else if($request->nilai[$col->kode_kriteria] == 2){
                    if ($request->hasfile('file')) { 
                        $filename = $request->file('file');
                        if ($filename[$col->kode_kriteria]->isValid()) {
                            $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                            $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                            DB::table('tb_rel_alternatif')->insert(
                                array( 
                                'nim' => $request->nim,
                                'kode_kriteria' => $col->kode_kriteria,
                                'nilai' => 3,
                                'file' => $file
                            ));
                        }
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 3,
                        ));
                    }
                }else if($request->nilai[$col->kode_kriteria] == 3){
                    if ($request->hasfile('file')) { 
                        $filename = $request->file('file');
                        if ($filename[$col->kode_kriteria]->isValid()) {
                            $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                            $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                            DB::table('tb_rel_alternatif')->insert(
                                array( 
                                'nim' => $request->nim,
                                'kode_kriteria' => $col->kode_kriteria,
                                'nilai' => 4,
                                'file' => $file
                            ));
                        }
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 4,
                        ));
                    }
                }else if($request->nilai[$col->kode_kriteria] == 4){
                    if ($request->hasfile('file')) { 
                        $filename = $request->file('file');
                        if ($filename[$col->kode_kriteria]->isValid()) {
                            $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                            $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                            DB::table('tb_rel_alternatif')->insert(
                                array( 
                                'nim' => $request->nim,
                                'kode_kriteria' => $col->kode_kriteria,
                                'nilai' => 5,
                                'file' => $file
                            ));
                        }
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 5,
                        ));
                    }
                }
            }else if($col->atribut == "benefit"){
                if($request->nilai[$col->kode_kriteria] == 0){
                    if ($request->hasfile('file')) { 
                            $filename = $request->file('file');
                            if ($filename[$col->kode_kriteria]->isValid()) {
                                $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                                $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                                DB::table('tb_rel_alternatif')->insert(
                                    array( 
                                    'nim' => $request->nim,
                                    'kode_kriteria' => $col->kode_kriteria,
                                    'nilai' => 5,
                                    'file' => $file
                                ));
                            }
    
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 5,
                        ));
                    }
                }else if($request->nilai[$col->kode_kriteria] == 1){
                    if ($request->hasfile('file')) { 
                            $filename = $request->file('file');
                            if ($filename[$col->kode_kriteria]->isValid()) {
                                $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                                $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                                DB::table('tb_rel_alternatif')->insert(
                                    array( 
                                    'nim' => $request->nim,
                                    'kode_kriteria' => $col->kode_kriteria,
                                    'nilai' => 4,
                                    'file' => $file
                                ));
                            }
    
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 4,
                        ));
                    }
                }else if($request->nilai[$col->kode_kriteria] == 2){
                    if ($request->hasfile('file')) { 
                            $filename = $request->file('file');
                            if ($filename[$col->kode_kriteria]->isValid()) {
                                $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                                $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                                DB::table('tb_rel_alternatif')->insert(
                                    array( 
                                    'nim' => $request->nim,
                                    'kode_kriteria' => $col->kode_kriteria,
                                    'nilai' => 3,
                                    'file' => $file
                                ));
                            }
    
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 3,
                        ));
                    }
                }else if($request->nilai[$col->kode_kriteria] == 3){
                    if ($request->hasfile('file')) { 
                            $filename = $request->file('file');
                            if ($filename[$col->kode_kriteria]->isValid()) {
                                $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                                $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                                DB::table('tb_rel_alternatif')->insert(
                                    array( 
                                    'nim' => $request->nim,
                                    'kode_kriteria' => $col->kode_kriteria,
                                    'nilai' => 2,
                                    'file' => $file
                                ));
                            }
    
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 2,
                        ));
                    }
                }else if($request->nilai[$col->kode_kriteria] == 4){
                    if ($request->hasfile('file')) { 
                            $filename = $request->file('file');
                            if ($filename[$col->kode_kriteria]->isValid()) {
                                $file = round(microtime(true) * 1000).'-'.str_replace(' ','-',$filename[$col->kode_kriteria]->getClientOriginalName());
                                $filename[$col->kode_kriteria]->move(public_path('document'), $file);            
                                DB::table('tb_rel_alternatif')->insert(
                                    array( 
                                    'nim' => $request->nim,
                                    'kode_kriteria' => $col->kode_kriteria,
                                    'nilai' => 1,
                                    'file' => $file
                                ));
                            }
    
                    }else{
                        DB::table('tb_rel_alternatif')->insert(
                            array( 
                            'nim' => $request->nim,
                            'kode_kriteria' => $col->kode_kriteria,
                            'nilai' => 1,
                        ));
                    }
                }
            }

            // if($request->hasfile('file')){
            //     $request->file("filename[".$col->kode_kriteria."]")->move(public_path().'/images/', $namaFile);  

            //     DB::table('tb_nilai')->insert(
            //         array('kode_kriteria' => $col->kode_kriteria, 
            //         'nim' => $request->nim,,
            //         'nilai' => $request->nilai[$col->kode_kriteria],
            //         'file' => $namaFile
            //     ));
            // }else{
            //     DB::table('tb_nilai')->insert(
            //         array('kode_kriteria' => $col->kode_kriteria, 
            //         'nim' => $request->nim,,
            //         'nilai' => $request->nilai[$col->kode_kriteria]
            //     ));
            // }
        }
        return redirect('mahasiswa')->with('message', 'Pendaftaran Berhasil!');
    }

}
