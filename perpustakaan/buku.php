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
        $edit = mysqli_query($koneksi, "UPDATE buku set
                                        kd_buku = '$_POST[kd_buku]',
                                        judul = '$_POST[judul]',
                                        kd_pengarang = '$_POST[kd_pengarang]',
                                        tahun_terbit = '$_POST[tahun_terbit]',
                                        stok = '$_POST[stok]'
                                        WHERE kd_buku = '$_GET[kd_buku]'
                                        ");
        if($edit)
        {
            echo "<script> alert('Data Buku Berhasil di Edit!'); 
            document.location='buku.php';
            </script>";
        }
    } else {
        //data disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO buku (kd_buku, judul, kd_pengarang, tahun_terbit, stok) 
                                        VALUES('$_POST[kd_buku]',
                                                '$_POST[judul]',
                                                '$_POST[kd_pengarang]',
                                                '$_POST[tahun_terbit]',
                                                '$_POST[stok]')
                                        ");
        if($simpan)
        {
            echo "<script> alert('Data Buku Berhasil di Tambah!'); 
            document.location='buku.php';
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
        $tampil = mysqli_query($koneksi, "SELECT * FROM buku WHERE kd_buku = '$_GET[kd_buku]'");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
            //jika data ditemukan, maka data ditampung ke dalam variabel
            $vkd_buku = $data['kd_buku'];
            $vjudul = $data['judul'];
            $vkd_pengarang = $data['kd_pengarang'];
            $vtahun_terbit = $data['tahun_terbit'];
            $vstok = $data['stok'];
        }
    }
    else if ($_GET['hal'] == "hapus")
    {
        $hapus = mysqli_query($koneksi, " DELETE FROM buku WHERE kd_buku = '$_GET[kd_buku]' ");
        if($hapus){
            echo "<script> alert('Data Buku Berhasil di Hapus!'); 
            document.location='buku.php';
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
        <h3><b>Masukkan Data Buku</b></h3><hr>
        <center>
            <table>
                <tr>
                    <td>Kode Buku</td>
                    <td><input type="text" name="kd_buku" value="<?=@$vkd_buku?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td><input type="text" name="judul" value="<?=@$vjudul?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Kode Pengarang</td>
                    <td><input type="text" name="kd_pengarang" value="<?=@$vkd_pengarang?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Tahun Terbit</td>
                    <td><input type="text" name="tahun_terbit" value="<?=@$vtahun_terbit?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td><input type="text" name="stok" value="<?=@$vstok?>" class="kotak"></td>
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
    <center><h3>Semua Data Buku Perpustakaan</h3></center>
    <center >
        <table border="1px" width="900px" cellspacing="0" cellpadding="10">
            <tr style="background-color: rgb(5, 126, 5);">
                <th>No.</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Kode Pengarang</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * FROM buku");
                while($data = mysqli_fetch_array($tampil)) :
            ?>

            <tr style="background-color: #97ff63;">
                <td> <center><?=$no++;?></center> </td>
                <td> <?=$data['kd_buku']?> </td>
                <td> <?=$data['judul']?></td>
                <td> <?=$data['kd_pengarang']?> </td>
                <td> <?=$data['tahun_terbit']?> </td>
                <td> <?=$data['stok']?> </td>
                <td> <center><button type="submit" class="btn"><a href="buku.php?hal=edit&kd_buku=<?=$data['kd_buku']?>" class="link">Edit</a></button>
                     <button type="submit" class="btn"><a href="buku.php?hal=hapus&kd_buku=<?=$data['kd_buku']?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="link">Hapus</a></button></center>
                </td>
            </tr>

            <?php endwhile; ?>

        </table>
    </center>
    <br><br><br>
</body>
</html>