<?php
// Menaikkan satu folder (../) untuk menemukan vendor dan config dari dalam folder page
require '../vendor/autoload.php'; 
include '../config/koneksi.php';  

use Dompdf\Dompdf;

// 1. Ambil parameter kd_jadwal dari URL
if (!isset($_GET['kd_jadwal'])) {
    die("ID Jadwal tidak ditemukan");
}

$id_jadwal = $_GET['kd_jadwal'];

// 2. Ambil data induk (Jadwal Kelas)
$query_induk = mysqli_query($koneksi, "SELECT id_jadwal, semester, thn_ajaran FROM jadwal_kelas WHERE id_jadwal = '$id_jadwal'");
$data_induk = mysqli_fetch_assoc($query_induk);

if (!$data_induk) {
    die("Data jadwal tidak ditemukan.");
}

// Konversi data induk ke huruf kecil semua sesuai style cetak_kelas.php
$id_jadwal_lc  = strtolower($data_induk['id_jadwal']);
$semester_lc   = strtolower($data_induk['semester']);
$thn_ajaran_lc = strtolower($data_induk['thn_ajaran']);

// 3. Susun HTML & CSS untuk PDF
$html = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            color: #333;
            line-height: 1.3;
        }
        h3 {
            text-align: center;
            text-transform: lowercase;
            margin-bottom: 5px;
            font-size: 14pt;
        }
        .info-header {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .info-header td {
            padding: 4px 0;
            font-size: 11pt;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table-data th {
            background-color: #f2f2f2;
            border: 1px solid #000;
            padding: 7px;
            text-align: left;
            text-transform: lowercase;
            font-size: 11pt;
        }
        .table-data td {
            border: 1px solid #000;
            padding: 7px;
            text-transform: lowercase;
            font-size: 11pt;
        }
    </style>
</head>
<body>

    <h3>cetak detail jadwal</h3>
    <hr style='border: 1px solid #000; margin-bottom: 15px;'>

    <table class='info-header'>
        <tr>
            <td style='width: 22%; font-weight: bold;'>kode jadwal</td>
            <td style='width: 3%;'>:</td>
            <td>" . htmlspecialchars($id_jadwal_lc) . "</td>
        </tr>
        <tr>
            <td style='font-weight: bold;'>semester</td>
            <td>:</td>
            <td>" . htmlspecialchars($semester_lc) . "</td>
        </tr>
        <tr>
            <td style='font-weight: bold;'>tahun ajaran</td>
            <td>:</td>
            <td>" . htmlspecialchars($thn_ajaran_lc) . "</td>
        </tr>
    </table>

    <table class='table-data'>
        <thead>
            <tr>
                <th style='width: 7%; text-align: center;'>no</th>
                <th>mata pelajaran</th>
                <th>guru pengajar</th>
                <th>hari</th>
                <th>jam</th>
            </tr>
        </thead>
        <tbody>";

        // 4. Ambil data relasi detail jadwal (Looping baris)
        $query_detail = mysqli_query($koneksi, "SELECT d.*, m.nm_mapel, g.nm_guru 
                                                FROM detail_jadwal d 
                                                JOIN mapel m ON d.kd_mapel = m.kd_mapel 
                                                JOIN guru g ON d.kd_guru = g.kd_guru
                                                WHERE d.id_jadwal = '$id_jadwal'");
        
        $no = 1;
        while ($d = mysqli_fetch_assoc($query_detail)) {
            $html .= "<tr>
                <td style='text-align: center;'>{$no}</td>
                <td>" . htmlspecialchars(strtolower($d['nm_mapel'])) . "</td>
                <td>" . htmlspecialchars(strtolower($d['nm_guru'])) . "</td>
                <td>" . htmlspecialchars(strtolower($d['hari'])) . "</td>
                <td>" . htmlspecialchars(strtolower($d['jam'])) . "</td>
            </tr>";
            $no++;
        }

$html .= "
        </tbody>
    </table>

</body>
</html>
";

// 5. Eksekusi Dompdf untuk generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Membuka PDF langsung di browser (Preview mode)
$dompdf->stream("jadwal_" . $id_jadwal_lc . ".pdf", array("Attachment" => 0));
?>