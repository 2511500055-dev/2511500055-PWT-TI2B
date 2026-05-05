<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Ekstrakurikuler</h1>
    </div>
</div>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

$edit = mysqli_fetch_array(mysqli_query($koneksi,
"SELECT * FROM Ekstra_055 WHERE id_ekstra055='$id'"));

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $ket = $_POST['ket'];
    $semester = $_POST['semester'];
    $thn = $_POST['thn'];

    $update = mysqli_query($koneksi,"UPDATE Ekstra_055 SET 
    nama='$nama',
    ket='$ket',
    semester='$semester',
    thn='$thn'
    WHERE id_ekstra055='$id'");

    if($update){
        echo '<div class="alert alert-success">Berhasil Diupdate</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra055">';
    } else {
        echo '<div class="alert alert-danger">Gagal: '.mysqli_error($koneksi).'</div>';
    }
}
?>

<section class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST">

<div class="form-group">
<label>ID Ekstra</label>
<input type="text" name="id" value="<?= $edit['id_ekstra055']; ?>" class="form-control" readonly>
</div>

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama" value="<?= $edit['nama']; ?>" class="form-control">
</div>

<div class="form-group">
<label>Keterangan</label>
<input type="text" name="ket" value="<?= $edit['ket']; ?>" class="form-control">
</div>

<div class="form-group">
<label>Semester</label>
<select name="semester" class="form-control">
    <option value="1" <?= $edit['semester']=='1'?'selected':''; ?>>1</option>
    <option value="2" <?= $edit['semester']=='2'?'selected':''; ?>>2</option>
</select>
</div>

<div class="form-group">
<label>Tahun</label>
<input type="text" name="thn" value="<?= $edit['thn']; ?>" class="form-control">
</div>

<div class="card-footer">
<input type="submit" name="update" value="Update" class="btn btn-primary">
</div>

</form>

</div>
</div>
</div>
</section>