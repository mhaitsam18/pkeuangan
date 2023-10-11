<?php

function youtube($url)
{
    $link = str_replace("https://youtu.be/", "", $url);
    $link = str_replace("www.youtube.com/watch?v=", "", $link);
    $link = str_replace("youtube.com/watch?v=", "", $link);
    $link = str_replace("youtu.be/", "", $link);
    $link = str_replace('http://www.youtube.com/watch?v=', '', $link);
    $link = str_replace('https://www.youtube.com/watch?v=', '', $link);
    $data = '<object width="100%" height="500" data="http://www.youtube.com/v/' . $link . '" type="application/x-shockwave-flash">
	<param name="src" value="http://www.youtube.com/v/' . $link . '" />
	</object>';
    return $data;
}

function ambilYoutube($link)
{
    $link = str_replace("https://youtu.be/", "", $link);
    $link = str_replace("https://www.youtube.com/watch?v=", "", $link);
    $link = str_replace("http://www.youtube.com/watch?v=", "", $link);
    $link = str_replace("www.youtube.com/watch?v=", "", $link);
    $link = str_replace("youtube.com/watch?v=", "", $link);
    $link = str_replace("youtu.be/", "", $link);
    return $link;
}


function cari_tanggal($tanggal)
{
    $bulan = '';
    switch (date('n', strtotime($tanggal))) {
        case 1:
            $bulan = 'Januari';
            break;
        case 2:
            $bulan = 'Februari';
            break;
        case 3:
            $bulan = 'Maret';
            break;
        case 4:
            $bulan = 'April';
            break;
        case 5:
            $bulan = 'Mei';
            break;
        case 6:
            $bulan = 'Juni';
            break;
        case 7:
            $bulan = 'Juli';
            break;
        case 8:
            $bulan = 'Agustus';
            break;
        case 9:
            $bulan = 'September';
            break;
        case 10:
            $bulan = 'Oktober';
            break;
        case 11:
            $bulan = 'November';
            break;
        case 12:
            $bulan = 'Desember';
            break;
    }

    return date('j', strtotime($tanggal)) . " $bulan " . date('Y', strtotime($tanggal));
}
function cari_bulan($tanggal)
{
    $bulan = '';
    switch ($tanggal) {
        case 1:
            $bulan = 'Januari';
            break;
        case 2:
            $bulan = 'Februari';
            break;
        case 3:
            $bulan = 'Maret';
            break;
        case 4:
            $bulan = 'April';
            break;
        case 5:
            $bulan = 'Mei';
            break;
        case 6:
            $bulan = 'Juni';
            break;
        case 7:
            $bulan = 'Juli';
            break;
        case 8:
            $bulan = 'Agustus';
            break;
        case 9:
            $bulan = 'September';
            break;
        case 10:
            $bulan = 'Oktober';
            break;
        case 11:
            $bulan = 'November';
            break;
        case 12:
            $bulan = 'Desember';
            break;
        default:
            $bulan = 'Desember';
            break;
    }

    return $bulan;
}

function convRupiah($value)
{
    return 'Rp.' . number_format($value, 2, ',', '.');
}
