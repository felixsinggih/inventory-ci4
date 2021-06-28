<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #ffffff;
        }

        table {
            font-size: 0.85rem;
            font-weight: inherit;
            line-height: 1;
            margin: 10px 0px 10px 0px;
            border-collapse: collapse;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            margin: 5px;
        }

        h3 {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1;
            margin: 5px;
        }

        p {
            font-size: 0.75rem;
            font-weight: 400;
            line-height: 1;
            margin: 5px;
        }
    </style>

    <?php
    function tanggal($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $p = explode('-', $tanggal);
        return $p[2] . ' ' . $bulan[(int)$p[1]] . ' ' . $p[0];
    }
    function datetime($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $p = explode('-', $tanggal);
        $q = explode(' ', $p[2]);
        return $q[0] . ' ' . $bulan[(int)$p[1]] . ' ' . $p[0] . ' ' . $q[1];
    }
    function ribuan($nominal)
    {
        $rp = number_format($nominal, 0, ',', '.');
        return $rp;
    }
    ?>
</head>

<body>
    <div class="form-group" style="text-align: center;">
        <h2><?= $web['nm_web'] ?></h2>
        <p><?= $web['alamat'] ?></p>
        <p>Telepon : <?= $web['telp'] ?>, Email : <?= $web['email'] ?></p>
        <hr />
    </div>

    <div class="form-group">
        <h3 style="text-align: center;"><?= $title ?></h3>
    </div><br />

    <div class="form-group">
        <table width="100%">
            <tr>
                <td style="width: 20%;">ID</td>
                <td style="width: 5px;">:</td>
                <td><?= $suplai['id_suplai'] ?></td>
                <td align="right">Tanggal input <?= datetime($suplai['created_at']) ?></td>
            </tr>
            <tr>
                <td>Penyuplai</td>
                <td style="width: 5px;">:</td>
                <td colspan="2"><?= $suplai['penyuplai'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Masuk</td>
                <td style="width: 5px;">:</td>
                <td colspan="2"><?= $suplai['tanggal'] ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td style="width: 5px;">:</td>
                <td colspan="2"><?= $suplai['keterangan'] ?></td>
            </tr>
        </table>
    </div><br />

    <div class="form-group">
        <table width="100%" border="1">
            <thead align="center">
                <tr>
                    <td style="width: 50px;">No.</td>
                    <td>Nama Barang</td>
                    <td style="width: 150px;">Jumlah</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($suplaiDetail as $data) : ?>
                    <tr align="center">
                        <td><?= $i++ ?></td>
                        <td align="left"><?= $data['nm_barang'] ?></td>
                        <td><?= ribuan($data['jumlah']) . ' ' . $data['satuan'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>