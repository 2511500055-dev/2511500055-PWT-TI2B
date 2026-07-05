<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
// FITUR HAPUS OTOMATIS (ANTI ERROR NAMA KOLOM)
if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    
    // 1. Ambil data pertama untuk mencari tahu nama kolom ID asli di database kamu
    $cek_kolom = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500055 LIMIT 1");
    $info_kolom = mysqli_fetch_field_direct($cek_kolom, 0); // Mengambil info kolom pertama (index 0)
    $nama_kolom_id = $info_kolom->name; // Ini akan mendapatkan nama asli kolom ID kamu (misal: id_ekstra055 atau ekstra_id)

    // 2. Jalankan query hapus menggunakan nama kolom yang didapat otomatis tadi
    $query_hapus = mysqli_query($koneksi, "DELETE FROM ekstra_2511500055 WHERE $nama_kolom_id = '$kd'");
    
    if ($query_hapus) {
        echo '<div class="alert alert-warning alert-dismissible">Berhasil Di Hapus!</div>';
        echo '<script>window.location.href="index.php?page=ekstra2511500055";</script>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">Gagal Hapus: '.mysqli_error($koneksi).'</div>';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ekstra2511500055" class="btn btn-primary btn-sm mb-3">
                Tambah Ekstrakurikuler</a>
                
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%">NO</th>
                            <th>Id Ekstrakurikuler</th>
                            <th>Nama Ekstrakurikuler</th>
                            <th>Keterangan</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500055");
                    
                    if ($query) {
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                            ?>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?= $result[0]; ?></td>
                                <td><?= $result[1]; ?></td>
                                <td><?= $result[2]; ?></td>
                                <td><?= $result[3]; ?></td>
                                <td><?= $result[4]; ?></td>
                                <td>
                                    <a href="index.php?page=ekstra2511500055&action=hapus&kd=<?= $result[0]; ?>" class="btn btn-danger btn-xs font-weight-bold" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    <a href="index.php?page=edit_ekstra2511500055&kd=<?= $result[0]; ?>" class="btn btn-warning btn-xs font-weight-bold text-white">Edit</a>
                                </td>
                            </tr>
                            <?php 
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Data masih kosong.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>