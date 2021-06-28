<?php
function bulan($bln)
{
    $bulan = array(
        1 => 'JAN',
        'FEB',
        'MAR',
        'APR',
        'MEI',
        'JUN',
        'JUL',
        'AGS',
        'SEP',
        'OKT',
        'NOV',
        'DES'
    );
    return $bulan[ltrim($bln, '0')];
}

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

function rupiah($nominal)
{
    $rp = number_format($nominal, 2, ',', '.');
    return $rp;
}

function ribuan($nominal)
{
    $rp = number_format($nominal, 0, ',', '.');
    return $rp;
}

function persen($nominal)
{
    $pr = number_format($nominal, 2, ',', '.');
    return $pr . '%';
}
