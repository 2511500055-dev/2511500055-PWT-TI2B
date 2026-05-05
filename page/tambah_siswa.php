<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Siswa</h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode otomatis
$carikode = mysqli_query($koneksi,"select max(id_kelas) from siswa") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode[0]) { // Perbaikan: Tambah [0] agar tidak error saat baca data pertama
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode ="K-".str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {$hasilkode="K-001"; } // Perbaikan: Langsung K-001 jika data kosong
$_SESSION["KODE"] = $hasilkode;

if(isset($_POST['tambah'])){
    $nis = $_POST['nis'];
    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $id_kelas = $_POST['id_kelas'];

    $insert = mysqli_query($koneksi,"INSERT INTO siswa values ('$nis', '$nm_siswa','$jenkel','$hp','$id_kelas')");
    
    if ($insert) {
        $username = $nis;
        $password = '1234';
        $role = 'siswa';

    mysqli_query($koneksi, "INSERT INTO user (username, password, role) 
    VALUES ('$username', '$password', '$role')");

        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">'; // Perbaikan: "contents" jadi "content"
    }else{
        // Perbaikan: Tambah tanda < di depan div
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan: '.mysqli_error($koneksi).'</h4></div>'; // Tambah pesan error asli
        }
    }
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-body p-2">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" name="nis" id="nis" placeholder="NIS" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nm_siswa">Nama Siswa</label>
                                <input type="text" name="nm_siswa" id="nm_siswa" placeholder="Nama Siswa" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="jenkel">jenkel</label>
                                <input type="text" name="jenkel" id="jenkel" placeholder="Jenkel" class="form-control">
                            </div>
                             <div class="form-group">
                                <label for="hp">No Hp</label>
                                <input type="text" name="hp" id="hp" placeholder="hp" class="form-control">
                            </div>
                             <div class="form-group">
                                <label for="id_kelas">Kd Kelas</label>
                                <input type="text"name="id_kelas" value="<?= $hasilkode; ?>" placeholder="id_kelas" class="form-control" readonly>
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>