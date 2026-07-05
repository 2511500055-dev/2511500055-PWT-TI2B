<?php
require 'vendor/autoload.php';
include 'config/koneksi.php';

use Dompdf\Dompdf;

// validasi
if (!isset($_GET['Id_jadwal'])) {
    die("ID Jadwal tidak ditemukan");
}

$Id_jadwal = $_GET['Id_jadwal'];

// ambil data utama
$query = mysqli_query($koneksi, "SELECT j.*, k.Nm_kelas FROM jadwal_kelas j JOIN kelas k ON j.Id_kelas = k.Id_kelas WHERE j.Id_jadwal = '$Id_jadwal'");
$data = mysqli_fetch_assoc($query);

// ambil detail
$det = mysqli_query($koneksi, "SELECT d.*, m.Nm_mapel, g.Nm_guru FROM detail_kelas d JOIN mapel m ON d.Kd_mapel = m.Kd_mapel JOIN guru g ON d.Kd_guru = g.Kd_guru WHERE d.Id_jadwal = '$Id_jadwal'");

// Konversi data info utama ke huruf kecil
$id_jadwal_lc   = strtolower($data['Id_jadwal']);
$nm_kelas_lc    = strtolower($data['Nm_kelas']);
$thn_ajaran_lc  = strtolower($data['Thn_ajaran']);
$semester_lc    = strtolower($data['Semester']);

// HTML PDF
$html = "
<style>
body {
    font-family: Arial, sans-serif;
    font-size: 12px;
}
h3 {
    text-align: center;
}
.info {
    margin-bottom: 10px;
}
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    border: 1px solid black;
    padding: 6px;
    text-align: center;
}
th {
    background-color: #ff0000;
}
</style>

<h3>JADWAL KELAS</h3>

<div class='info'>
<b>ID Jadwal:</b> {$id_jadwal_lc} <br>
<b>Kelas:</b> {$nm_kelas_lc} <br>
<b>Tahun Ajaran:</b> {$thn_ajaran_lc} <br>
<b>Semester:</b> {$semester_lc}
</div>

<table>
<tr>
    <th>No</th>
    <th>Mata Pelajaran</th>
    <th>Guru</th>
    <th>Hari</th>
    <th>Jam</th>
</tr>
";

$no = 1;
while ($d = mysqli_fetch_assoc($det)) {
    // Konversi data baris tabel ke huruf kecil
    $nm_mapel_lc = strtolower($d['Nm_mapel']);
    $nm_guru_lc  = strtolower($d['Nm_guru']);
    $hari_lc     = strtolower($d['Hari']);
    $jam_lc      = strtolower($d['Jam']);

    $html .= "
    <tr>
        <td>$no</td>
        <td>{$nm_mapel_lc}</td>
        <td>{$nm_guru_lc}</td>
        <td>{$hari_lc}</td>
        <td>{$jam_lc}</td>
    </tr>
    ";
    $no++;
}

$html .= "</table>";

// DOMPDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// tampilkan di browser
$dompdf->stream("jadwal_kelas.pdf", array("Attachment" => false));