<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['Simpan'])) {
    $id_ekstra055   = $_POST['id_ekstra055'];
    $nama_ekstra055 = $_POST['nama_ekstra055'];
    $ket055         = $_POST['ket055'];
    $semester055    = $_POST['semester055'];
    $thn_ajaran055  = $_POST['thn_ajaran055'];

    // Menggunakan INSERT VALUES langsung secara urutan tanpa menulis manual nama kolomnya agar anti-error
    $query = mysqli_query($koneksi, "INSERT INTO ekstra_2511500055 VALUES ('$id_ekstra055', '$nama_ekstra055', '$ket055', '$semester055', '$thn_ajaran055')");

    if ($query) {
        echo '<div class="alert alert-success alert-dismissible">Data Berhasil Disimpan!</div>';
        echo '<script>window.location.href="index.php?page=ekstra2511500055";</script>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">Gagal Menyimpan Data! Error: '.mysqli_error($koneksi).'</div>';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Ekstrakurikuler</h3>
            </div>
            <form role="form" method="POST" action="">
                <div class="card-body">
                    <div class="form-group">
                        <label>Id Ekstrakurikuler</label>
                        <input type="text" class="form-control" name="id_ekstra055" placeholder="Masukkan ID" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ekstrakurikuler</label>
                        <input type="text" class="form-control" name="nama_ekstra055" placeholder="Masukkan Nama Ekstrakurikuler" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="ket055" placeholder="Masukkan Keterangan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Semester (Harus Angka)</label>
                        <input type="number" class="form-control" name="semester055" placeholder="Contoh: 1 atau 2" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" class="form-control" name="thn_ajaran055" placeholder="Contoh: 2025/2026" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" name="Simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=ekstra2511500055" class="btn btn-default">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>