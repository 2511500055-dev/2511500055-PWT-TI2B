<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php

// ambil id dari URL
$id = $_GET['id'];

// ambil data kelas
$edit = mysqli_fetch_array(
    mysqli_query($koneksi, 
    "SELECT * FROM kelas 
    WHERE Id_kelas='$id'")
);

// proses update
if(isset($_POST['update'])){

    $nm_kelas = $_POST['nm_kelas'];

    $update = mysqli_query($koneksi, 
    "UPDATE kelas 
    SET Nm_kelas='$nm_kelas' 
    WHERE Id_kelas='$id' ");

    if ($update) {

        echo '<div class="alert alert-info alert-dismissible">
        Berhasil Disimpan
        </div>';

        echo '<meta http-equiv="refresh" 
        content="1;url=index.php?page=kelas">';

    } else {

        echo '<div class="alert alert-warning alert-dismissible">
        Gagal Disimpan
        </div>';

    }
}
?>

<section class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST">

<div class="form-group">
<label>Id Kelas</label>

<input type="text"
value="<?= $edit['Id_kelas']; ?>"
class="form-control"
readonly>

</div>

<div class="form-group">
<label>Nama Kelas</label>

<input type="text"
name="nm_kelas"
value="<?= $edit['Nm_kelas']; ?>"
class="form-control"
required>

</div>

<div class="card-footer">

<input type="submit"
class="btn btn-primary"
name="update"
value="Update">

<a href="index.php?page=kelas"
class="btn btn-secondary">
Kembali
</a>

</div>

</form>

</div>
</div>
</div>
</section>