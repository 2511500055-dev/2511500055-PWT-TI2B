<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Guru</h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode otomatis
$carikode = mysqli_query($koneksi,"select max(kd_guru) from guru") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode[0]) { // Perbaikan: Tambahkan index [0] agar tidak error jika data kosong
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode ="G-".str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode="G-001"; // Perbaikan: Default G-001 jika data pertama kali
}
$_SESSION["KODE"] = $hasilkode;

if(isset($_POST['tambah'])){
    $kd_guru = $_POST['kd_guru'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    // Perbaikan: Sebutkan nama kolom tabel guru kamu di sini agar query tidak gagal
    // Contoh: INSERT INTO guru (kd_guru, nm_guru, jenkel, pend_terakhir, hp, alamat)
    $insert = mysqli_query($koneksi,"INSERT INTO guru VALUES ('$kd_guru', '$nm_guru', '$jenkel', '$pend_terakhir', '$hp', '$alamat')");

    if ($insert) {
        $username = $kd_guru;
        $password = '1234';
        $role = 'guru';

        mysqli_query($koneksi, "INSERT INTO user (username, password, role) 
        VALUES ('$username', '$password', '$role')");

        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">'; // Perbaikan: "contents" jadi "content"
    } else {
        // Perbaikan: Tambahkan tanda < di awal div dan tampilkan error asli dari MySQL
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan: '.mysqli_error($koneksi).'</h4></div>';
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
                            <label for="kd_guru">Kode Guru</label>
                            <input type="text" name="kd_guru" value="<?= $hasilkode; ?>" placeholder="Id Kat" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nm_guru">Nama Guru</label>
                            <input type="text" name="nm_guru" id="nm_guru" placeholder="Nama Guru" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jenkel">Jenis Kelamin</label>
                            <input type="text" name="jenkel" id="jenkel" placeholder="Jenis Kelamin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="pend_terakhir">Pendidikan Terakhir</label>
                            <input type="text" name="pend_terakhir" id="pend_terakhir" placeholder="Pendidikan Terakhir" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="hp">No Hp</label>
                            <input type="text" name="hp" id="hp" placeholder="Hp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="form-control">
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