<?php
$simpan_sukses = false;
$simpan_gagal = false;
$delete_sukses = false;
$delete_gagal = false;
$edit_sukses = false;
$edit_gagal = false;

// Koneksi Database
$server = "localhost";
$user = "root";
$password = "";
$database = "tubesBD_Restoran";

// Buat Koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

// jika tombol delete all di klik
if (isset($_POST['bdeleteall'])) {
    // hapus semua data
    $hapus_all = mysqli_query($koneksi, "DELETE FROM pelayan");

    // uji jika hapus semua data sukses
    if ($hapus_all) {
        $delete_sukses = true;
    } else {
        $delete_gagal = true;
    }
}

// jika tombol simpan di klik
if (isset($_POST['bsimpan'])) {

    // Cek data kosong
    if (empty($_POST['tid_pelayan']) || empty($_POST['tnama']) || $_POST['tjns_kelamin'] == "" || $_POST['tjadwal_kerja'] == "" || empty($_POST['tno_hp']) || empty($_POST['tgaji'])) {
        echo "<script>
                alert('Semua kolom harus diisi!');
                document.location='pelayan.php';  
            </script>";
        // Hentikan eksekusi lebih lanjut jika ada kolom yang kosong
        exit();
    }

    // pengujian apakah data akan diedit atau dibuat baru
    if (isset($_GET['hal']) == "edit") {
        // data akan diedit
        $edit = mysqli_query($koneksi,  "UPDATE pelayan SET
                                            id_pelayan = '$_POST[tid_pelayan]',
                                            nama = '$_POST[tnama]',
                                            jns_kelamin = '$_POST[tjns_kelamin]',
                                            jadwal_kerja = '$_POST[tjadwal_kerja]',
                                            no_hp = '$_POST[tno_hp]',
											gaji = '$_POST[tgaji]'
                                        WHERE id_pelayan = '$_GET[id]'    
                                        ");
        // uji jika edit data sukses
        if ($edit) {
            $edit_sukses = true;
        } else {
            $edit_gagal = true;
        }
    } else {
        // Data akan disimpan baru
        $simpan = mysqli_query($koneksi, "  INSERT INTO pelayan (id_pelayan, nama, jns_kelamin, jadwal_kerja, no_hp, gaji)
                                            VALUE ( '$_POST[tid_pelayan]',
                                                    '$_POST[tnama]',
                                                    '$_POST[tjns_kelamin]',
                                                    '$_POST[tjadwal_kerja]',
                                                    '$_POST[tno_hp]',
													'$_POST[tgaji]' )
                                            ");

        // uji jika simpan data sukses
        if ($simpan) {
            $simpan_sukses = true;
        } else {
            $simpan_gagal = true;
        }
    }
}

// deklarasi variabel untuk menampung data yang akan diedit
$vid_pelayan = "";
$vnama = "";
$vjns_kelamin = "";
$vjadwal_kerja = "";
$vno_hp = "";
$vgaji = "";

// pengujian jika tombol edit atau delete di klik
if (isset($_GET['hal'])) {

    // pengujian jika edit data
    if ($_GET['hal'] == "edit") {

        // tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM pelayan WHERE id_pelayan = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            // jika data ditemukan, maka data di tampung ke dalam variabel
            $vid_pelayan = $data['id_pelayan'];
            $vnama = $data['nama'];
            $vjns_kelamin = $data['jns_kelamin'];
            $vjadwal_kerja = $data['jadwal_kerja'];
            $vno_hp = $data['no_hp'];
            $vgaji = $data['gaji'];
        }
    } else if ($_GET['hal'] == "delete") {
        // persiapan hapus data
        $hapus = mysqli_query($koneksi, "DELETE FROM pelayan WHERE id_pelayan = '$_GET[id]' ");
        // uji jika hapus data sukses
        if ($hapus) {
            $delete_sukses = true;
        } else {
            $delete_gagal = true;
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tubes Basis Data Restoran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <style>
        *,
        html,
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--dark-blue);
        }

        :root {
            --blue: #0ef;
            --white: #fcf2fa;
            --dark-blue: #06141e;
            --trans-blc: rgba(0, 0, 0, 0.9);
            --shadow-nav: 0 2px 10px 2px #0ef;
            --shadow: 1px 1px 10px 0 #0ef;
        }

        nav {
            position: sticky;
            position: -webkit-sticky;
            top: 0;
            z-index: 1;
            margin: auto;
            background: var(--dark-blue);
            box-shadow: var(--shadow-nav);
            height: 80px;
            width: 100%;
        }

        label.logo {
            color: var(--white);
            font-size: 40px;
            line-height: 80px;
            padding: 0 80px;
            letter-spacing: -1px;
            font-weight: 800;
            font-style: italic;
            transition: 0.2s ease;
            text-shadow: 3px 5px 20px #230622aa;
            cursor: pointer;
        }

        nav ul {
            float: right;
            margin-right: 130px;
        }

        nav ul li {
            display: inline-block;
            line-height: 75px;
        }

        nav ul li .link-nav {
            align-items: center;
            color: grey;
            font-size: 18px;
            padding: 7px 13px;
            text-decoration: none;
        }

        .link-nav ::before {
            content: "";
            position: absolute;
            width: 0;
            height: 2px;
            background-color: skyblue;
            bottom: -2px;
            left: 0;
            transition: width 0.3s ease;
        }

        .link-nav:hover::before {
            width: 100%;
        }

        .link-nav {
            color: White;
        }

        .checkbtn {
            line-height: 80px;
            font-size: 30px;
            float: right;
            cursor: pointer;
            margin-right: 40px;
            display: none;
        }

        .checkbtn i {
            color: var(--white);
            padding: 5px;
            border-radius: 10px;
            transition: 0.5s ease;
        }

        .checkbtn i:hover {
            background: var(--blue);
        }

        #check-nav {
            display: none;
        }

        h1.text-center {
            text-align: center;
            margin-top: 20px;
            color: white;
            font-family: Agbalumo;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--dark-blue);
            font-weight: bold;
            font-size: 20px;
        }

        .card-footer {
            background-color: var(--dark-blue);
            height: 35px;
        }

        .card {
            box-shadow: var(--shadow);
            border: none;
            color: white;
            margin-bottom: 100px;
        }

        hr {
            color: black;
        }

        nav a {
            font-family: Poppins;
            position: relative;
            text-decoration: none;
            transition: 0.2s;
        }

        nav a::before {
            content: "";
            position: absolute;
            width: 0;
            height: 3px;
            background-color: var(--blue);
            bottom: -2px;
            left: 0;
            transition: width 0.3s ease;
        }

        nav li a.active {
            color: var(--white);
        }

        .table-content {
            height: 310px;
            overflow-x: auto;
        }

        table {
            table-layout: auto;
        }

        th {
            position: sticky;
            top: 0;
        }

        td {
            vertical-align: middle;
        }

        h5 {
            padding-left: 15px;
            color: black;
            font-size: 14px;
            font-weight: 400;
        }

        .fa-right-from-bracket {
            position: fixed;
            top: 20px;
            right: 35px;
            color: grey;
            cursor: pointer;
            font-size: 35px;
            z-index: 999;
            transition: 0.5s;
        }

        .fa-right-from-bracket:hover {
            color: white;
        }

        /* pop up */
        .popup-simpan-benar,
        .popup-simpan-salah,
        .popup-delete-benar,
        .popup-delete-salah,
        .popup-edit-benar,
        .popup-edit-salah {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            visibility: hidden;
            display: none;
        }

        .popup-simpan-benar img,
        .popup-simpan-salah img,
        .popup-delete-benar img,
        .popup-delete-salah img,
        .popup-edit-benar img,
        .popup-edit-salah img {
            width: 100px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .open-popup-simpan-benar,
        .open-popup-simpan-salah,
        .open-popup-delete-benar,
        .open-popup-delete-salah,
        .open-popup-edit-benar,
        .open-popup-edit-salah {
            display: block;
            visibility: visible;
            top: 50%;
            transform: translate(-50%, -50%) scale(1);
        }

        .popup-simpan-benar h1,
        .popup-simpan-salah h1,
        .popup-delete-benar h1,
        .popup-delete-salah h1,
        .popup-edit-benar h1,
        .popup-edit-salah h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .popup-simpan-benar p,
        .popup-simpan-salah p,
        .popup-delete-benar p,
        .popup-delete-salah p,
        .popup-edit-benar p,
        .popup-edit-salah p {
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .popup-simpan-benar button,
        .popup-simpan-salah button,
        .popup-delete-benar button,
        .popup-delete-salah button,
        .popup-edit-benar button,
        .popup-edit-salah button {
            background-color: var(--dark-blue);
            border: 1px solid var(--blue);
            color: var(--white);
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.5s;
        }

        .popup-simpan-benar button:hover,
        .popup-simpan-salah button:hover,
        .popup-delete-benar button:hover,
        .popup-delete-salah button:hover,
        .popup-edit-benar button:hover,
        .popup-edit-salah button:hover {
            color: black;
            background-color: var(--blue);
        }
    </style>

    <nav>
        <input type="checkbox" id="check-nav" />
        <label for="check-nav" class="checkbtn">
            <i class="bx bx-meja"></i>
        </label>
        <a href="pelayan.php"><label class="logo" style="font-family: Agbalumo;">AFFA Resto</label></a>
        <ul class="nav-links">
            <li><a href="pembeli.php" class="link-nav">Pembeli</a></li>
            <li><a href="menu.php" class="link-nav">Menu</a></li>
            <li><a href="pelayan.php" class="link-nav active">Pelayan</a></li>
            <li><a href="meja.php" class="link-nav ">Meja</a></li>
            <li><a href="memesan.php" class="link-nav">Memesan</a></li>
        </ul>
        <a href="Halamanlogin/login.php" onclick="return confirm('Apakah anda yakin ingin logout')"><i class="fa-solid fa-right-from-bracket"></i></a>
    </nav>

    <!-- Awal container -->
    <div class="container">
        <h1 class="text-center">Database Restoran</h1>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header text-center">
                        Tabel Pelayan
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-1">
                                <label class="form-label">ID Pelayan</label>
                                <h5>ID Pelayan</h5>
                                <input type="text" name="tid_pelayan" value="<?= $vid_pelayan ?>" class="form-control" placeholder="Masukkan ID Pelayan">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label class="form-label">Nama Pelayan</label>
                                        <h5>Nama Pelayan</h5>
                                        <input type="text" name="tnama" value="<?= $vnama ?>" class="form-control" placeholder="Masukkan Nama Pelayan">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <h5>Jenis Kelamin</h5>
                                        <select class="form-select" name="tjns_kelamin">
                                            <option value="<?= $vjns_kelamin ?>"><?= $vjns_kelamin ?></option>
                                            <option value="Laki-Laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-1">
                                <label class="form-label">Jadwal Kerja</label>
                                <h5>Jadwal Kerja</h5>
                                <select class="form-select" name="tjadwal_kerja">
                                    <option value="<?= $vjadwal_kerja ?>"><?= $vjadwal_kerja ?></option>
                                    <option value="Shift Siang">12.00-18.00</option>
                                    <option value="Shift Malam">18.00-00.00</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label class="form-label">No. Telp</label>
                                        <h5>No. Telp</h5>
                                        <input type="tel" name="tno_hp" value="<?= $vno_hp ?>" class="form-control" placeholder="Masukkan No. Telp">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label class="form-label">Gaji</label>
                                        <h5>Gaji</h5>
                                        <input type="number" name="tgaji" value="<?= $vgaji ?>" class="form-control" placeholder="Masukkan Gaji Pelayan">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <hr>
                                <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                                <button class="btn btn-danger" name="bhapus" type="reset">Hapus</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-center">
                Data Pelayan
            </div>
            <div class="card-body">

                <div class="col-md-6 mx-auto">
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" value="<?= isset($_POST['tcari']) ? $_POST['tcari'] : ''; ?>" class="form-control" placeholder="Cari">
                            <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                            <button class="btn btn-warning" name="breset" type="submit">Reset</button>
                            <button class="btn btn-danger" name="bdeleteall" type="submit">Delete All</button>
                        </div>
                    </form>
                </div>
                <div class="table-content">
                    <table class="table table-hover">
                        <tr class="table-secondary">
                            <th>No.</th>
                            <th>ID Pelayan</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jadwal Kerja</th>
                            <th>No. Telp</th>
                            <th>Gaji</th>
                            <th>Aksi</th>
                        </tr>

                        <?php
                        // Persiapan Menampilkan Data
                        $no = 1;

                        // untuk pencarian data
                        // jika tombol cari di klik
                        if (isset($_POST['bcari'])) {
                            // tampilkan data yang di cari
                            $keyword = $_POST['tcari'];
                            $q = "SELECT * FROM pelayan WHERE id_pelayan like '%$keyword%' or nama like '%$keyword%' or jns_kelamin like '%$keyword%'
                        or jadwal_kerja like '%$keyword%' or no_hp like '%$keyword%' or gaji like '%$keyword%' order by id_pelayan asc";
                        } else {
                            $q = "SELECT * FROM pelayan order by id_pelayan asc";
                        }

                        $tampil = mysqli_query($koneksi, $q);
                        while ($data = mysqli_fetch_array($tampil)) :
                        ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['id_pelayan'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['jns_kelamin'] ?></td>
                                <td><?= $data['jadwal_kerja'] ?></td>
                                <td><?= $data['no_hp'] ?></td>
                                <td><?= $data['gaji'] ?></td>
                                <td>
                                    <a href="pelayan.php?hal=edit&id=<?= $data['id_pelayan'] ?>" class="btn btn-warning">Edit</a>

                                    <a href="pelayan.php?hal=delete&id=<?= $data['id_pelayan'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan hapus data ini')">Delete</a>
                                </td>
                            </tr>

                        <?php endwhile;
                        ?>

                    </table>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
        <div class="popup-simpan-benar" id="popup-simpan-benar">
            <img src="Img/Benar.png" alt="Benar">
            <h1>Save successful</h1>
            <p>Data berhasil disimpan</p>
            <button type="button" onclick="closePopupSimpanBenar()">OKE!</button>
        </div>
        <div class="popup-simpan-salah" id="popup-simpan-salah">
            <img src="Img/Salah.png" alt="Salah">
            <h1>Save failed</h1>
            <p>Data gagal disimpan</p>
            <button type="button" onclick="closePopupSimpanSalah()">Coba Lagi!</button>
        </div>
        <div class="popup-delete-benar" id="popup-delete-benar">
            <img src="Img/Benar.png" alt="Benar">
            <h1>Delete successful</h1>
            <p>Data berhasil dihapus</p>
            <button type="button" onclick="closePopupDeleteBenar()">OKE!</button>
        </div>
        <div class="popup-delete-salah" id="popup-delete-salah">
            <img src="Img/Salah.png" alt="Salah">
            <h1>Delete failed</h1>
            <p>Data gagal disimpan</p>
            <button type="button" onclick="closePopupDeleteSalah()">Coba Lagi!</button>
        </div>
        <div class="popup-edit-benar" id="popup-edit-benar">
            <img src="Img/Benar.png" alt="Benar">
            <h1>Edit successful</h1>
            <p>Data berhasil di update</p>
            <button type="button" onclick="closePopupEditBenar()">OKE!</button>
        </div>
        <div class="popup-edit-salah" id="popup-edit-salah">
            <img src="Img/Salah.png" alt="Salah">
            <h1>Edit failed</h1>
            <p>Data gagal di update</p>
            <button type="button" onclick="closePopupEditSalah()">Coba Lagi!</button>
        </div>
    </div>
    <!-- Akhir container -->
    <script>
        // popup

        // simpan
        function showPopupSimpanBenar() {
            var popup = document.getElementById("popup-simpan-benar");
            popup.classList.add("open-popup-simpan-benar");
        }

        function closePopupSimpanBenar() {
            var popup = document.getElementById("popup-simpan-benar");
            popup.classList.remove("open-popup=simpan-benar");
            window.location.href = "pelayan.php";
        }

        function showPopupSimpanSalah() {
            var popup = document.getElementById("popup-simpan-salah");
            popup.classList.add("open-popup-simpan-salah");
        }

        function closePopupSimpanSalah() {
            var popup = document.getElementById("popup-simpan-salah");
            popup.classList.remove("open-popup-simpan-salah");
            window.location.href = "pelayan.php";
        }

        <?php
        if ($simpan_sukses) {
            echo 'showPopupSimpanBenar();';
        }

        if ($simpan_gagal) {
            echo 'showPopupSimpanSalah();';
        }
        ?>

        // delete
        function showPopupDeleteBenar() {
            var popup = document.getElementById("popup-delete-benar");
            popup.classList.add("open-popup-delete-benar");
        }

        function closePopupDeleteBenar() {
            var popup = document.getElementById("popup-delete-benar");
            popup.classList.remove("open-popup=delete-benar");
            window.location.href = "pelayan.php";
        }

        function showPopupDeleteSalah() {
            var popup = document.getElementById("popup-delete-salah");
            popup.classList.add("open-popup-delete-salah");
        }

        function closePopupDeleteSalah() {
            var popup = document.getElementById("popup-delete-salah");
            popup.classList.remove("open-popup-delete-salah");
            window.location.href = "pelayan.php";
        }
        <?php
        if ($delete_sukses) {
            echo 'showPopupDeleteBenar();';
        }

        if ($delete_gagal) {
            echo 'showPopupDeleteSalah();';
        }
        ?>

        // edit
        function showPopupEditBenar() {
            var popup = document.getElementById("popup-edit-benar");
            popup.classList.add("open-popup-edit-benar");
        }

        function closePopupEditBenar() {
            var popup = document.getElementById("popup-edit-benar");
            popup.classList.remove("open-popup=edit-benar");
            window.location.href = "pelayan.php";
        }

        function showPopupEditSalah() {
            var popup = document.getElementById("popup-edit-salah");
            popup.classList.add("open-popup-edit-salah");
        }

        function closePopupEditSalah() {
            var popup = document.getElementById("popup-edit-salah");
            popup.classList.remove("open-popup-edit-salah");
            window.location.href = "pelayan.php";
        }
        <?php
        if ($edit_sukses) {
            echo 'showPopupEditBenar();';
        }

        if ($edit_gagal) {
            echo 'showPopupEditSalah();';
        }
        ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>