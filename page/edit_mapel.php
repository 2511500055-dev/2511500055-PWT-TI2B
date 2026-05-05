<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php

// ambil NIS dari URL
$nis = $_GET['nis'];

// ambil data siswa
$edit = mysqli_fetch_array(
    mysqli_query($koneksi,
    "SELECT * FROM siswa WHERE Nis='$nis'")
);

// proses update
if(isset($_POST['simpan'])){

    $nis       = $_POST['nis'];
    $nm_siswa  = $_POST['nm_siswa'];
    $jenkel    = $_POST['jenkel'];
    $hp        = $_POST['hp'];
    $id_kelas  = $_POST['id_kelas'];

    $update = mysqli_query($koneksi,
    "UPDATE siswa SET
        Nm_siswa='$nm_siswa',
        Jenkel='$jenkel',
        Hp='$hp',
        Id_kelas='$id_kelas'
     WHERE Nis='$nis'");

    if ($update) {

        echo '<div class="alert alert-success">
                Data Berhasil Diupdate
              </div>';

        echo '<meta http-equiv="refresh"
        content="1;url=index.php?page=siswa">';

    } else {

        echo '<div class="alert alert-danger">
                Data Gagal Diupdate
              </div>';

        echo mysqli_error($koneksi);
    }
}
?>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST">

<div class="form-group">
<label>NIS</label>

<input type="text"
name="nis"
value="<?= $edit['Nis']; ?>"
class="form-control"
readonly>

</div>

<div class="form-group">
<label>Nama Siswa</label>

<input type="text"
name="nm_siswa"
value="<?= $edit['Nm_siswa']; ?>"
class="form-control">

</div>

<div class="form-group">
<label>Jenis Kelamin</label>

<input type="text"
name="jenkel"
value="<?= $edit['Jenkel']; ?>"
class="form-control">

</div>

<div class="form-group">
<label>Hp</label>

<input type="text"
name="hp"
value="<?= $edit['Hp']; ?>"
class="form-control">

</div>

<div class="form-group">
<label>Id Kelas</label>

<input type="text"
name="id_kelas"
value="<?= $edit['Id_kelas']; ?>"
class="form-control">

</div>

<button type="submit"
name="simpan"
class="btn btn-primary">
Simpan
</button>

<a href="index.php?page=siswa"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>
</div>
</div>
</div>