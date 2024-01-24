<?php

require 'function.php';

//ambil data di url
$id = $_GET["id"];

//query biodata berdasarkan id
$dokter = query("SELECT * FROM passien WHERE id = '$id'")[0];

//cek apakah tombol sumbit sudah ditekan atau belum
if( isset($_POST["Kirim"]) ) {
 
    //cek apakah data berhasil diubah atau tidak
    if( edit($_POST) > 0 ) {
        echo 
        "<script> 
        alert('data berhasil diedit'); 
        document.location.href = 'admin.php';
        </script>";
    } else {
        echo 
        "<script> 
        alert('data gagal diedit'); 
        document.location.href = 'admin.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>edit data pasien!</title>
</head>
<style>
    .kotak {
  box-sizing: border-box;
  width: 200px;
  padding: 5px;
  font-size: 11pt;
}

.tombol_kirim {
  background-color: rgb(10, 10, 10);
  color: rgb(253, 250, 250);
  width: 128px;
  border: none;
  font-size: 11pt;
  border-radius: 3px;
  padding: 10px 20px;
  cursor: pointer;
}
</style> 
<body>
    <h1>Data Pasien</h1>
    <form action="" method="POST" name="input">
    <center><br><br><br>
    <input type="hidden" name="id" id="id" value="<?= $dokter["id"]; ?>">
            <table>
             <tr> 
                <td><b>Nama Lengkap</b></td> 
                <td><b>:</b></td> 
                <td> <input type="text" name="nama_pasien" class="kotak" required value="<?= $dokter["nama_pasien"]; ?>"> </td> 
            </tr> 
            <tr> 
              <td><b>Jenis Kelamin</b></td> 
              <td><b>:</b></td> 
              <td> 
                  <select name="jenis_kelamin" class="kotak" required value="<?= $dokter["jenis_kelamin"]; ?>"> 
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option> 
                  </select>
               </td> 
          </tr>
            <tr> 
                <td><b>Tanggal Lahir</b></td> 
                <td><b>:</b></td> 
                <td> <input type="date" name="tanggal_lahir" class="kotak" required value="<?= $dokter["tanggal_lahir"]; ?>"> </td> 
            </tr> 
            <tr> 
              <td><b>No. Telp</b></td> 
              <td><b>:</b></td> 
              <td> <input type="text" name="no_telp" class="kotak" required value="<?= $dokter["no_telp"]; ?>"> </td> 
          </tr> 
          <tr> 
            <td><b>Alamat</b></td> 
            <td><b>:</b></td> 
            <td> <input type="text" name="alamat" class="kotak" required value="<?= $dokter["alamat"]; ?>"> </td> 
        </tr> 
            <tr>
                <td><b>Pesan</b></td>
                <td><b>:</b></td>
                <td><textarea name="pesan" cols="65" rows="8" placeholder="(Keluhan, Konsultasi)" required value="<?= $dokter["pesan"]; ?>"></textarea></td>
            </tr>
            </table>
            </center>
            <div style="text-indent: 500px;"><input type="submit" name="Kirim" value="Edit Data" class="tombol_kirim"></div>
        </form>   
</body>
</html>