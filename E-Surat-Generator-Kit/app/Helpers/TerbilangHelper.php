<?php

function terbilang($angka)
{
    $angka = (int) $angka;

    $angkaArr = [
        1 => 'satu',
        2 => 'dua',
        3 => 'tiga',
        4 => 'empat',
        5 => 'lima',
        6 => 'enam',
        7 => 'tujuh',
        8 => 'delapan',
        9 => 'sembilan',
        10 => 'sepuluh',
        11 => 'sebelas'
    ];

    if ($angka < 12) {
        return $angkaArr[$angka];
    } elseif ($angka < 20) {
        return terbilang($angka - 10) . ' belas';
    } elseif ($angka < 100) {
        return terbilang($angka / 10) . ' puluh ' . terbilang($angka % 10);
    } elseif ($angka < 200) {
        return 'seratus ' . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        return terbilang($angka / 100) . ' ratus ' . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        return 'seribu ' . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        return terbilang($angka / 1000) . ' ribu ' . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        return terbilang($angka / 1000000) . ' juta ' . terbilang($angka % 1000000);
    } elseif ($angka < 1000000000000) {
        return terbilang($angka / 1000000000) . ' miliar ' . terbilang($angka % 1000000000);
    } elseif ($angka < 1000000000000000) {
        return terbilang($angka / 1000000000000) . ' triliun ' . terbilang($angka % 1000000000000);
    } else {
        return 'Angka terlalu besar';
    }
}
