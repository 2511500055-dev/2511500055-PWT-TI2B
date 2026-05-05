<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Ganti Password</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Pastikan session username ada
$username = $_SESSION['username'];

if(isset($_POST['tambah'])) {
    $pl = $_POST['pl'];
    $pb = $_POST['pb'];
    
    // Cek apakah password lama benar
    $cek = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM user WHERE username = '$username' AND password='$pl' "));
    
    if($cek) {
        $update = mysqli_query($koneksi,"UPDATE user SET password = '$pb' WHERE username = '$username' ");

        if ($update) {
            // Perbaikan class alert dan penambahan angka 1 di refresh
            echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    <h4>Password Berhasil Diganti</h4>
                  </div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ganti_password">';
        }
    } else {
        // Perbaikan class alert untuk password lama salah
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Info</h5>
                <h4>Password Lama Salah!</h4>
              </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" name="pl" class="form-control" placeholder="Masukkan Password Lama" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="pb" class="form-control" placeholder="Masukkan Password Baru" required>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>