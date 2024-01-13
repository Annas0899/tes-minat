<?php

// $host = "localhost";
// $user = "root";
// $pass = "";
// $db = "dbsekolah";

// $koneksi = mysqli_connect($host, $user, $pass, $db);
// if (!$koneksi) { //cek koneksi
//     die("tidak bisa terkoneksi");
// } else {
//     echo "koneksi berhasil";
// }

$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "dbsekolah";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("tidak bisa terkoneksi");
}

$nis = "";
$nama = "";
$alamat = "";
$kelas = "";
$agama = "";
$jeniskelamin = "";
$usia = "";
$tanggallahir = "";
$suskes = "";
$error = "";

if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];
    $agama = $_POST['agama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $tanggallahir = $_POST['tanggallahir'];
    $usia = $_POST['usia'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $sql1 = "INSERT INTO tbl_siswa(nis, nama, alamat, kelas, agama, jenis_kelamin, usia, tanggal_lahir) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql1);

    // Binding parameter dan menjalankan pernyataan
    mysqli_stmt_bind_param($stmt, 'ssssssis', $nis, $nama, $alamat, $kelas, $agama, $jeniskelamin, $usia, $tanggallahir);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $suskes = "Berhasil memasukan data";
    } else {
        $error = "Gagal memasukan data";
    }

    // Tutup pernyataan
    mysqli_stmt_close($stmt);
}
?>

<!-- ... Kode HTML dan formulir Anda ... -->




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }

                ?>
                <?php
                if ($suskes) {
                ?>
                    <div class="alert alert-sukses" role="alert">
                        <?php echo $suskes ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nis" class="col-sm-2 col-form-label">nis</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">nama</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-" id="nama" name="nama" value="<?php echo $nama ?>">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                    </div>

                    <div class="mb-3">
                        <label for="kelas" class="col-sm-2 col-form-label">kelas</label>
                    </div>
                    <div class="col-sm-10">
                        <select class="form-control" name="kelas" id="kelas">
                            <option value="">- pilih kelas -</option>
                            <option value="IPA" <?php if ($kelas == "ipa") echo "selected" ?>>IPA</option>
                            <option value="IPS" <?php if ($kelas == "ips") echo "selected" ?>>IPS</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="agama" class="col-sm-2 col-form-label">agama</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="agama" name="agama" value="<?php echo $agama ?>">
                    </div>

                    <div class="mb-3">
                        <label for="jeniskelamin" class="col-sm-2 col-form-label">jeniskelamin</label>
                    </div>
                    <div class="col-sm-10">
                        <select class="form-control" name="jeniskelamin" id="jeniskelamin">
                            <option value="">-Jenis-Kelamin -</option>
                            <option value="laki-laki" <?php if ($kelas == "laki-laki") echo "selected" ?>>Laki-Laki</option>
                            <option value="perempuan" <?php if ($kelas == "perempuan") echo "selected" ?>>PEREMPUAN</option>
                        </select>
            </div>
                    <div class="mb-3">
                        <label for="tanggallahir" class="col-sm-2 col-form-label">tanggallahir</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="tanggallahir" id="tanggallahir"/>

                        <div class="mb-3">
                            <label for="usia" class="col-sm-2 col-form-label">usia</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="usia" name="usia" value="<?php echo $usia ?>">
                        </div>
                        <div class="co-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Siswa
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</body>

</html>