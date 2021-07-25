<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

function is_hidden($action)
{
    return is_able($action) ? '' : 'hidden';
}

function is_able($action)
{
    $role = [
        'superadmin' => [
            'home',
            'user.index', 'user.create', 'user.store', 'user.edit', 'user.update', 'user.destroy',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            // 'kriteria.index', 'kriteria.create', 'kriteria.store', 'kriteria.edit', 'kriteria.update', 'kriteria.destroy',
            // 'alternatif.index', 'alternatif.create', 'alternatif.store', 'alternatif.edit', 'alternatif.update', 'alternatif.destroy', 'alternatif.cetak',
            // 'rel_alternatif.index', 'rel_alternatif.edit', 'rel_alternatif.update',
            // 'hitung.index', 'hitung.cetak',
        ],
        'pegawai' => [
            'home',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'user.index', 'user.create', 'user.store', 'user.edit', 'user.update', 'user.destroy',
            'periode.index', 'periode.cetak', 'periode.create', 'periode.store', 'periode.edit', 'periode.update', 'periode.destroy',
            'kriteria.index', 'kriteria.cetak', 'kriteria.create', 'kriteria.store', 'kriteria.edit', 'kriteria.update', 'kriteria.destroy',
            'alternatif.index', 'alternatif.cetak', 'alternatif.create', 'alternatif.store', 'alternatif.edit', 'alternatif.update', 'alternatif.destroy',
            'rel_alternatif.index', 'rel_alternatif.cetak', 'rel_alternatif.edit', 'rel_alternatif.update',
            'hitung.index', 'hitung.cetak',
            'mahasiswa.index', 'mahasiswa.create', 'mahasiswa.store',
        ],
        'mhs' => [
            'home',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'mahasiswa.index', 'mahasiswa.create', 'mahasiswa.store', 'mahasiswa.information',
        ]
    ];
    $user = Auth::user();
    if ($user) {
        if (in_array($user->level, array_keys($role))) {
            return in_array($action, $role[$user->level]);
        }
    }
}

function is_admin()
{
    return Auth::user()->level == 'superadmin';
}

function is_user()
{
    return Auth::user()->level == 'pegawai';
}

function is_mhs()
{
    return Auth::user()->level == 'mhs';
}

function format_date($data, $format = 'd-M-Y')
{
    return date($format, strtotime($data));
}

function get_image_url($file)
{

    if (File::exists($file) && File::isFile($file))
        return asset($file);
    else
        return asset('images/no_image.png');
}
function current_user()
{
    return User::find(Auth::id());
}

function get_atribut_option($selected = '')
{
    $arr = [
        'benefit' => 'Benefit',
        'cost' => 'Cost'
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_level_option($selected = '')
{
    $arr = [
        'superadmin' => 'Super Admin',
        'pegawai' => 'Pegawai'        
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_status_user_option($selected = '')
{
    $arr = [
        0 => 'NonAktif',
        1 => 'Aktif'     
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_jenis_kelamin_option($selected = '')
{
    $arr = [
        'Laki-laki' => 'Laki-Laki',
        'Perempuan' => 'Perempuan'     
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_semester_option($selected = '')
{
    $arr = [
        '-' => '-',
        1 => '1',     
        3 => '3'     
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_prodi_option($selected = '')
{
    $arr = [
        '-' => '-',
        'Teknik Komputer Kontrol' => 'Teknik Komputer Kontrol',
        'Teknik Listrik' => 'Teknik Listrik',
        'Mesin Otomotif' => 'Mesin Otomotif',
        'Teknologi Informasi' => 'Teknologi Informasi',
        'Teknik Perkeretaapian' => 'Teknik Perkeretaapian',
        'Administrasi Bisnis' => 'Administrasi Bisnis',
        'Bahasa Inggris' => 'Bahasa Inggris',
        'Komputerisasi Akuntansi' => 'Komputerisasi Akuntansi',
        'Akuntansi' => 'Akuntansi'
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function show_error($errors)
{
    if ($errors->any()) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="m-0 pl-3">';
        foreach ($errors->all() as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>';
    }
}
function show_msg()
{
    if ($messsage = session()->get('message')) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">'
            . $messsage . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
}

function rp($number)
{
    return 'Rp ' . number_format($number);
}

function kode_oto($field, $table, $prefix, $length)
{
    $var = get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . ((int)substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function get_row($sql = '')
{
    $rows =  DB::select($sql);
    if ($rows)
        return $rows[0];
}

function get_results($sql = '')
{
    return DB::select($sql);
}

function get_var($sql = '')
{
    $row = DB::select($sql);
    if ($row) {
        return current(current($row));
    }
}

function query($sql, $params = [])
{
    return DB::statement($sql, $params);
}

function active($action){
    return Request::is($action) ? 'active' :  '';
}

// function get_desa_option($selected = '', $id_kecamatan)
// {
//     $rows = get_results("SELECT * FROM tb_desa WHERE id_kecamatan='$id_kecamatan' ORDER BY nama_desa");
//     $a = '';
//     foreach ($rows as $row) {
//         if ($row->id_desa == $selected)
//             $a .= '<option value="' . $row->id_desa . '" selected>' . $row->nama_desa . '</option>';
//         else
//             $a .= '<option value="' . $row->id_desa . '">' . $row->nama_desa . '</option>';
//     }
//     return $a;
// }
