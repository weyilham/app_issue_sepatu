<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Issue PDF</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
        }

        table {
            border-collapse: collapse;
            border: 1px solid black;
            width: 100%;
        }

        tr,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        .letterhead {
            padding: 20px;
            border-bottom: 1px solid #000;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo img {
            max-width: 100px;
            height: auto;
        }

        .company-info {
            text-align: right;
        }

        .company-info h1 {
            margin: 0;
            font-size: 24px;
        }

        .company-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        hr {
            border: 0;
            border-top: 1px solid #000;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="letterhead">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('/img/logo.png') }}" alt="Logo" />
                </div>
                <div class="company-info">
                    <h1>PT. PARKLAND WORLD INDONESIA PLANT-2</h1>
                    <p>Jl. Raya Gorda KM 6. Kecamatan Cikande, Kelurahan Julang, 42186. Kabupaten Serang Banten
                        Indonesia</p>
                    <p>Telepon: (0254) 402301 | Email: pt.parklandword@parklandworld.com</p>
                </div>
            </div>
            <hr />
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Artikel</th>
                <th>Tanggal Issue</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>

            @foreach ($issues as $issue)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $issue->artikel->nama_artikel }}</td>
                    <td>{{ $issue->created_at }}</td>
                    <td style="text-align: center">
                        <img src="{{ asset('storage/' . $issue->gambar) }}" width="100">
                    </td>
                    <td>{{ $issue->deskripsi }}</td>
                    <td>{{ $issue->status }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
