<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Data Ekstrakurikuler</h1>
    </div>
</div>

<section class="content">
<div class="container-fluid">

<div class="card">
<div class="card-body">

<a href="index.php?page=tambah_ekstra055" class="btn btn-primary mb-3">
    Tambah Data
</a>

<table class="table table-bordered">
<thead>
<tr>
    <th>No</th>
    <th>ID</th>
    <th>Nama</th>
    <th>Keterangan</th>
    <th>Semester</th>
    <th>Tahun</th>
</tr>
</thead>

<tbody>
<?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM Ekstra_055");

while($d = mysqli_fetch_array($data)){
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['id_ekstra055']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['ket']; ?></td>
    <td><?= $d['semester']; ?></td>
    <td><?= $d['thn']; ?></td>
</tr>
<?php } ?>
</tbody>

</table>

</div>
</div>

</div>
</section>