@extends('layout.app')
@section('title', $title)
@section('content')
    <div class="alert alert-info">
        <h5>Selamat Datang Di Sistem Pendukung Keputusan Penerimaan Beasiswa Bidikmisi Politeknik Negeri Madiun</h5>
    </div>

    <!-- Main content -->
    <section class="content" {{ is_hidden('alternatif.index') }}>
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>150</h3>

                <p>Total Mahasiswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('alternatif.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        </div>
    </section>
@endsection