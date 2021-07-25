@extends('layout.app')
@section('content')
    <div class="alert alert-info">
        <h5><center>Selamat Datang Di Sistem Pendukung Keputusan Penerimaan Beasiswa Bidikmisi Politeknik Negeri Madiun</center></h5>
    </div>

    <div class="col-md-7" {{ is_hidden('mahasiswa.information') }}>
        <div class="callout callout-warning">
            <h5><strong>Beasiswa Bidikmisi</strong></h5>

            <p>Bidikmisi yaitu bantuan biaya pendidikan bagi calon mahasiswa tidak mampu secara ekonomi dan memiliki potensi 
                akademik baik untuk menempuh pendidikan di perguruan tinggi pada program studi unggulan sampai lulus tepat waktu.</p>
        </div>
        <div class="callout callout-info">
            <h5><strong>Berkas Yang Perlu Disiapkan</strong></h5>

            <p>
                Sebelum anda mendaftarkan diri pada Sistem Pendukung Keputusan Penerimaan Beasiswa Bidikmisi, silahkan siapkan berkas-berkas di bawah ini:</br>
                1. Scan Struk Gaji Orangtua</br>
                2. Surat Keterangan Tidak Mampu</br>
                3. Struk Tagihan Air 3 bulan terakhir</br>
                4. Struk Tagihan Listrik 3 bulan terakhir</br>
                5. Surat PBB</br>
                6. Scan Kartu Keluarga</br>
                7. Scan Ijazah terakhir</br>
                8. Scan Raport Terakhir</br>
                9. Piagam Prestasi (opsional)</br>
                10. Foto Rumah tampak depan, ruang tamu, dan kamar mandi (dijadikan satu file format .pdf)
            </p>
        </div>
    </div>

    <!-- Main content -->
@endsection