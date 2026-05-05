<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php

if(isset($_POST['simpan'])) {

    $id_kelas = $_POST['id_kelas'];
    $nm_kelas = $_POST['nm_kelas'];

    $query = mysqli_query($koneksi,
    "INSERT INTO kelas 
    (Id_kelas, Nm_kelas)
    VALUES 
    ('$id_kelas','$nm_kelas')");

    if ($query) {

        echo '
        <div class="alert alert-success">
        Data Berhasil Disimpan
        </div>';

        echo '<meta http-equiv="refresh"
        content="1;url=index.php?page=kelas">';
    }
}
?>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST">

<div class="form-group">
<label>Id Kelas</label>
<input type="text" 
name="id_kelas"
class="form-control"
required>
</div>

<div class="form-group">
<label>Nama Kelas</label>
<input type="text" 
name="nm_kelas"
class="form-control"
required>
</div>

<button type="submit" 
name="simpan"
class="btn btn-primary">
Simpan
</button>

<a href="index.php?page=kelas"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>
</div>
</div>
</div>