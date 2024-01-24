<?php

require 'function.php';

$dokter = query("SELECT * FROM passien");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <h1>Data Pasien</h1>
    <a href="create.php">tambah data pasien!</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
       <tr>
        <th>aksi</th>
        <th>nama_pasien</th>
        <th>jenis_kelamin</th>
        <th>tanggal_lahir</th>
        <th>no_telp</th>
        <th>alamat</th>
        <th>pesan</th>
       </tr>
       <?php foreach( $dokter as $row ) : ?>
       <tr>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
            <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin ingin menghapus data?');">hapus</a>
        </td>
        <td><?= $row["nama_pasien"]; ?></td>
        <td><?= $row["jenis_kelamin"]; ?></td>
        <td><?= $row["tanggal_lahir"]; ?></td>
        <td><?= $row["no_telp"]; ?></td>
        <td><?= $row["alamat"]; ?></td>
        <td><?= $row["pesan"]; ?></td>
       </tr> 
       <?php endforeach; ?>
</table>   
</body>
</html>