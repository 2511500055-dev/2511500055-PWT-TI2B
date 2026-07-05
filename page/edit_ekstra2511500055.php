<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = isset($_GET['kd']) ? $_GET['kd'] : '';

// 1. Deteksi Nama Kolom ID Pertama secara otomatis dari Database
$cek_tabel = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500055 LIMIT 1");
$info_kolom = mysqli_fetch_field_direct($cek_tabel, 0); 
$nama_kolom_id = $info_kolom->name; // Mencari nama kolom ke-1 di database kamu

// 2. Deteksi Nama Kolom Lainnya secara berurutan
$nama_kolom_nama  = mysqli_fetch_field_direct($cek_tabel, 1)->name;
$nama_kolom_ket   = mysqli_fetch_field_direct($cek_tabel, 2)->name;
$nama_kolom_sem   = mysqli_fetch_field_direct($cek_tabel, 3)->name;
$nama_kolom_tahun = mysqli_fetch_field_direct($cek_tabel, 4)->name;

// Jika tombol Simpan ditekan
if (isset($_POST['Simpan'])) {
    $id_ekstra055   = $_POST['id_ekstra055'];
    $nama_ekstra055 = $_POST['nama_ekstra055'];
    $ket055         = $_POST['ket055'];
    $semester055    = $_POST['semester055'];
    $thn_ajaran055  = $_POST['thn_ajaran055'];

    // Update menggunakan nama kolom otomatis hasil deteksi sistem
    $query_update = mysqli_query($koneksi, "UPDATE ekstra_2511500055 SET 
        $nama_kolom_nama = '$nama_ekstra055', 
        $nama_kolom_ket = '$ket055', 
        $nama_kolom_sem = '$semester055', 
        $nama_kolom_tahun = '$thn_ajaran055' 
        WHERE $nama_kolom_id = '$kd'");

    if ($query_update) {
        echo '<div class="alert alert-success alert-dismissible">Data Berhasil Diperbarui!</div>';
        echo '<script>window.location.href="index.php?page=ekstra2511500055";</script>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">Gagal Memperbarui Data! Error: '.mysqli_error($koneksi).'</div>';
    }
}

// Mengambil data lama untuk form
$query_get = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500055 WHERE $nama_kolom_id = '$kd'");
$data = mysqli_fetch_array($query_get);

if (!$data) {
    $data = array('', '', '', '', '');
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title text-white">Form Edit Ekstrakurikuler</h3>
            </div>
            <form role="form" method="POST" action="">
                <div class="card-body">
                    <div class="form-group">
                        <label>Id Ekstrakurikuler (Tidak Bisa Diubah)</label>
                        <input type="text" class="form-control" name="id_ekstra055" value="<?= $data[0]; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Ekstrakurikuler</label>
                        <input type="text" class="form-control" name="nama_ekstra055" value="<?= $data[1]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="ket055" required><?= $data[2]; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Semester (Harus Angka)</label>
                        <input type="number" class="form-control" name="semester055" value="<?= $data[3]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" class="form-control" name="thn_ajaran055" value="<?= $data[4]; ?>" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" name="Simpan" class="btn btn-warning text-white font-weight-bold">Simpan</button>
                    <a href="index.php?page=ekstra2511500055" class="btn btn-default">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>