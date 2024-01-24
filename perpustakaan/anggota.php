<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "perpustakaan";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die (mysqli_error($koneksi)); 

if(isset($_POST['Tambah']))
{
    //pengujian edit disimpan baru atau edit
    if($_GET['hal'] == "edit"){
        //data akan diedit
        $edit = mysqli_query($koneksi, "UPDATE anggota set
                                        NIS = '$_POST[NIS]',
                                        nama = '$_POST[nama]', 
                                        alamat = '$_POST[alamat]',
                                        telp = '$_POST[telp]'
                                        WHERE NIS = '$_GET[NIS]'
                                        ");
        if($edit)
        {
            echo "<script> alert('Data Anggota Berhasil di Edit!'); 
            document.location='anggota.php';
            </script>";
        }
    } else {
        //data disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO anggota (NIS, nama, alamat, telp)
                                        VALUES('$_POST[NIS]',
                                                '$_POST[nama]',
                                                '$_POST[alamat]',
                                                '$_POST[telp]')
                                        ");
        if($simpan)
        {
            echo "<script> alert('Data Anggota Berhasil di Tambah!'); 
            document.location='anggota.php';
            </script>";
        }
    }
}

//pengujian tombol edit / hapus di klik
if(isset($_GET['hal']))
{
    //edit data
    if($_GET['hal'] == "edit")
    {
        //tampilkan data yg akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM anggota WHERE NIS = '$_GET[NIS]'");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
            //jika data ditemukan, maka data ditampung ke dalam variabel
            $vNIS = $data['NIS'];
            $vnama = $data['nama'];
            $valamat = $data['alamat'];
            $vtelp = $data['telp'];
        }
    }
    else if ($_GET['hal'] == "hapus")
    {
        $hapus = mysqli_query($koneksi, " DELETE FROM anggota WHERE NIS = '$_GET[NIS]'");
        if($hapus){
            echo "<script> alert('Data Anggota Berhasil di Hapus!'); 
            document.location='anggota.php';
            </script>";
        }
    }
    
    
}
?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        background-color: rgb(150, 211, 110);
    }

    .box {
        width: 350px;
        background: rgb(5, 126, 5);
        margin: 20px auto;
        padding: 30px 30px;
        border-radius: 10px;
    }

    .kotak {
        box-sizing: border-box;
        border-radius: 3px;
        width: 200px;
        padding: 5px;
        font-size: 11pt;
    }

    .link {
        text-decoration:none;
        color: black;
    } 

    .btn{
        background-color:beige;
        width: 80px;
        border: none;
        font-size: 11pt;
        border-radius: 5px;
        padding: 10px 10px;
        cursor: pointer;
    }
</style>
<body>
    <div class="box">
        <form action="" method="post">
        <h3><b>Masukkan Data Anggota</b></h3><hr>
        <center>
            <table>
                <tr>
                    <td>NIS</td>
                    <td><input type="text" name="NIS" value="<?=@$vNIS?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" value="<?=@$vnama?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" value="<?=@$valamat?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td><input type="number" name="telp" value="<?=@$vtelp?>" class="kotak"></td>
                </tr>
            </table>
        </center>
        <hr>
        <table>
            <tr>                
                <td>
                    <button type="submit" name="Tambah" class="btn">Tambah</button> 
                    <button type="reset" name="Hapus" class="btn">Hapus</button> 
                    <button type="submit" class="btn"><a href="menu.html" class="link">Kembali</a></button>
                </td>
            </tr>
        </table>
        </form>
    </div>

    <!-- halaman admin -->
    <hr>
    <center><h3>Semua Data Anggota</h3></center>
    <center >
        <table border="1px" width="700px" cellspacing="0" cellpadding="10">
            <tr style="background-color: rgb(5, 126, 5);">
                <th>No.</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>

            <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * FROM anggota");
                while($data = mysqli_fetch_array($tampil)) :
            ?>

            <tr style="background-color: #97ff63;">
                <td> <center><?=$no++;?></center> </td>
                <td> <?=$data['NIS']?> </td>
                <td> <?=$data['nama']?></td>
                <td> <?=$data['alamat']?> </td>
                <td> <?=$data['telp']?> </td>
                <td> <center><button type="submit" class="btn"><a href="anggota.php?hal=edit&NIS=<?=$data['NIS']?>" class="link">Edit</a></button>
                     <button type="submit" class="btn"><a href="anggota.php?hal=hapus&NIS=<?=$data['NIS']?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="link">Hapus</a></button></center>
                </td>
            </tr>

            <?php endwhile; ?>

        </table>
    </center>
    <br><br><br>
</body>
</html>