<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Cetak @yield('title')</title>

    <link rel="icon" href="{{ asset('images/pnm.png') }}">
    <style>
        * {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        h1,
        h2 {
            font-weight: normal;
            padding: 0;
            margin: 0 0 10px 0;
            text-align: center;
        } 

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td,
        .table th {
            border: 1px solid black;
            padding: 5px;
        }

        .content {
            max-width: 1024px;
            margin: 0 auto;
        }

        .footer {
            text-align: left;
            font-weight: normal;
            margin-left:400px;
            font-size: 18px;
        }
    </style>
</head>

<body onload="window.print()">

    <section class="content">
        <h1>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN</h1>
        <h1>RISET, DAN TEKNOLOGI</h1>
        <h1><b>POLITEKNIK NEGERI MADIUN</b></h1>
        <p>________________________________________________________________________________</p>
        <h1>@yield('title')</h1>
        @yield('content')
        <br><br>
        </section>
    <section class="content footer">
        <p>Madiun, {{ $tgl }}</p>
        <p>a.n Direktur</p>
        <p>Wakil Direktur III</p>
        <p style="margin-top:100px;"><u><b>Prasetyo Yekti Utomo, S.E., M.M.</b></u></p>
        <p>NIDN : 0712107001</p>
    </section>

</body>

</html>