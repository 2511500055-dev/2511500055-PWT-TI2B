<?php
// Proses Hapus Data Jika Ada Parameter Hapus
if (isset($_GET['hapus'])) {
    $id_jadwal = $_GET['hapus'];

    // Hapus detail jadwal dulu
    mysqli_query($koneksi, "DELETE FROM detail_jadwal WHERE id_jadwal = '$id_jadwal'");

    // Lalu hapus jadwal kelas
    $hapus = mysqli_query($koneksi, "DELETE FROM jadwal_kelas WHERE id_jadwal = '$id_jadwal'");

    if ($hapus) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Berhasil!</strong> Data jadwal telah dihapus.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Gagal!</strong> Tidak dapat menghapus data.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php if ($role == 'admin') { ?>
                    <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm mb-3">Tambah Jadwal</a>
                <?php } ?>
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode Jadwal</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Detail Jadwal (Mapel - Guru - Hari - Jam)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Ambil data induk jadwal
                        $query = mysqli_query($koneksi, "SELECT id_jadwal, semester, thn_ajaran FROM jadwal_kelas");
                        
                        if (!$query) {
                            die("Query Error: " . mysqli_error($koneksi));
                        }

                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                            <td>{$row['id_jadwal']}</td>
                            <td>{$row['semester']}</td>
                            <td>{$row['thn_ajaran']}</td>
                            <td>
                            <ul>";
                            
                            // Ambil detail jadwal (Mapel, Guru, Hari, Jam)
                            $det = mysqli_query($koneksi, "SELECT d.*, m.nm_mapel, g.nm_guru 
                                                           FROM detail_jadwal d 
                                                           JOIN mapel m ON d.kd_mapel = m.kd_mapel 
                                                           JOIN guru g ON d.kd_guru = g.kd_guru
                                                           WHERE d.id_jadwal = '{$row['id_jadwal']}'");
                                                            
                            while ($d = mysqli_fetch_assoc($det)) {
                                echo "<li><b>{$d['nm_mapel']}</b> — {$d['nm_guru']} ({$d['hari']}, {$d['jam']})</li>";
                            }
                            
                            echo "</ul></td><td>";
                            
                            // Tombol Hapus khusus Admin
                            if ($role == 'admin') {
                                echo "<a href='index.php?page=jadwal&hapus={$row['id_jadwal']}' 
                                onclick=\"return confirm('yakin ingin menghapus data ini?')\" 
                                class='btn btn-danger btn-sm'>Hapus</a> ";
                            }
                            
                            // TOMBOL CETAK (Mengarahkan ke folder page/cetak_jadwal.php)
                            echo "<a href='page/cetak_jadwal.php?kd_jadwal={$row['id_jadwal']}' 
                            target='_blank'
                            class='btn btn-success btn-sm'>Cetak</a>
                            </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>