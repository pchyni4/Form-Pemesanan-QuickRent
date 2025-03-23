<?php
// Inisialisasi variabel
$nama = $email = $nomor = $alamat = $jenis_kendaraan = $merk_kendaraan = $tahun_kendaraan = $layanan = "";
$namaErr = $emailErr = $nomorErr = $alamatErr = $merkErr = "";

// Proses form saat dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $nomor = trim($_POST["nomor"]);
    $alamat = trim($_POST["alamat"]);
    $jenis_kendaraan = $_POST["jenis_kendaraan"] ?? "";
    $merk_kendaraan = trim($_POST["merk_kendaraan"]);
    $tahun_kendaraan = $_POST["tahun_kendaraan"] ?? "";
    $layanan = $_POST["layanan"] ?? "";

    // Validasi sederhana
    if (empty($nama)) $namaErr = "Nama wajib diisi";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $emailErr = "Email tidak valid";
    if (empty($nomor) || !ctype_digit($nomor)) $nomorErr = "Nomor harus berupa angka";
    if (empty($alamat)) $alamatErr = "Alamat wajib diisi";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Rental</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: auto;
            max-width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1b2851;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>QuickRent</h2>
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama); ?>">
                <span class="error"><?= $namaErr; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email); ?>">
                <span class="error"><?= $emailErr; ?></span>
            </div>

            <div class="form-group">
                <label for="nomor">Nomor Telepon:</label>
                <input type="text" id="nomor" name="nomor" value="<?= htmlspecialchars($nomor); ?>">
                <span class="error"><?= $nomorErr; ?></span>
            </div>

            <div class="form-group">
                <label for="jenis_kendaraan">Jenis Kendaraan:</label>
                <select id="jenis_kendaraan" name="jenis_kendaraan">
                    <option value="mobil" <?= ($jenis_kendaraan == "Mobil") ? "selected" : ""; ?>>Mobil</option>
                    <option value="motor" <?= ($jenis_kendaraan == "Motor") ? "selected" : ""; ?>>Motor</option>
                </select>
            </div>

            <div class="form-group">
                <label for="merk_kendaraan">Merk Kendaraan:</label>
                <input type="text" id="merk_kendaraan" name="merk_kendaraan" value="<?= htmlspecialchars($merk_kendaraan); ?>">
            </div>

            <div class="form-group">
                <label for="tahun_kendaraan">Tahun Kendaraan:</label>
                <select id="tahun_kendaraan" name="tahun_kendaraan">
                    <?php for ($tahun = date("Y"); $tahun >= 2018; $tahun--) { ?>
                        <option value="<?= $tahun; ?>" <?= ($tahun_kendaraan == $tahun) ? "selected" : ""; ?>><?= $tahun; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="layanan">Layanan:</label>
                <select id="layanan" name="layanan">
                    <option value="Lepas Kunci" <?= ($layanan == "Lepas Kunci") ? "selected" : ""; ?>>Lepas Kunci</option>
                    <option value="Dengan Pengemudi" <?= ($layanan == "Dengan Pengemudi") ? "selected" : ""; ?>>Dengan Pengemudi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Pengiriman:</label>
                <textarea id="alamat" name="alamat"><?= htmlspecialchars($alamat); ?></textarea>
                <span class="error"><?= $alamatErr; ?></span>
            </div>

            <div class="button-container">
                <button type="submit">Rental Sekarang</button>
            </div>
        </form>
    </div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nomorErr && !$alamatErr) { ?>
        <div class="container">
            <h3>Data Pemesanan:</h3>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Jenis Kendaraan</th>
                        <th>Merk Kendaraan</th>
                        <th>Tahun Kendaraan</th>
                        <th>Layanan</th>
                        <th>Alamat Pengiriman</th>
                    </tr>
                    <tr>
                        <td><?= $nama; ?></td>
                        <td><?= $email; ?></td>
                        <td><?= $nomor; ?></td>
                        <td><?= $jenis_kendaraan; ?></td>
                        <td><?= $merk_kendaraan; ?></td>
                        <td><?= $tahun_kendaraan; ?></td>
                        <td><?= $layanan; ?></td>
                        <td><?= $alamat; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php } ?>
</body>
</html>
