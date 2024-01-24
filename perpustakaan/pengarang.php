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
        $edit = mysqli_query($koneksi, "UPDATE pengarang set
                                        kd_pengarang = '$_POST[kd_pengarang]',
                                        nama = '$_POST[nama]',
                                        email = '$_POST[email]'
                                        WHERE kd_pengarang = '$_GET[kd_pengarang]'
                                        ");
        if($edit)
        {
            echo "<script> alert('Data Pengarang Berhasil di Edit!'); 
            document.location='pengarang.php';
            </script>";
        }
    } else {
        //data disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO pengarang (kd_pengarang, nama, email)
                                        VALUES('$_POST[kd_pengarang]',
                                                '$_POST[nama]',
                                                '$_POST[email]')
                                        ");
        if($simpan)
        {
            echo "<script> alert('Data Pengarang Berhasil di Tambah!'); 
            document.location='pengarang.php';
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
        $tampil = mysqli_query($koneksi, "SELECT * FROM pengarang WHERE kd_pengarang = '$_GET[kd_pengarang]'");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
            //jika data ditemukan, maka data ditampung ke dalam variabel
            $vkd_pengarang = $data['kd_pengarang'];
            $vnama = $data['nama'];
            $vemail = $data['email'];
        }
    }
    else if ($_GET['hal'] == "hapus")
    {
        $hapus = mysqli_query($koneksi, " DELETE FROM pengarang WHERE kd_pengarang = '$_GET[kd_pengarang]'");
        if($hapus){
            echo "<script> alert('Data Pengarang Berhasil di Hapus!'); 
            document.location='pengarang.php';
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
        <h3><b>Masukkan Data Pengarang</b></h3><hr>
        <center>
            <table>
                <tr>
                    <td>Kode Pengarang</td>
                    <td><input type="text" name="kd_pengarang" value="<?=@$vkd_pengarang?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" value="<?=@$vnama?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" value="<?=@$vemail?>" class="kotak"></td>
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
    <center><h3>Semua Data Pengarang Buku Perpustakaan</h3></center>
    <center >
        <table border="1px" width="700px" cellspacing="0" cellpadding="10">
            <tr style="background-color: rgb(5, 126, 5);">
                <th>No.</th>
                <th>Kode Pengarang</th>
                <th>Nama Pengarang</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr> 

            <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * FROM pengarang");
                while($data = mysqli_fetch_array($tampil)) :
            ?>

            <tr style="background-color: #97ff63;">
                <td> <center><?=$no++;?></center> </td>
                <td> <?=$data['kd_pengarang']?> </td>
                <td> <?=$data['nama']?></td>
                <td> <?=$data['email']?> </td>
                <td> <center><button type="submit" class="btn"><a href="pengarang.php?hal=edit&kd_pengarang=<?=$data['kd_pengarang']?>" class="link">Edit</a></button>
                     <button type="submit" class="btn"><a href="pengarang.php?hal=hapus&kd_pengarang=<?=$data['kd_pengarang']?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="link">Hapus</a></button></center>
                </td>
            </tr>

            <?php endwhile; ?>

        </table>
    </center>
    <br><br><br>
</body>
</html>