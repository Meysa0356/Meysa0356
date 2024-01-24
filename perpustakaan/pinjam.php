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
        $edit = mysqli_query($koneksi, "UPDATE pinjam set
                                        kd_pinjam = '$_POST[kd_pinjam]',
                                        NIS = '$_POST[NIS]',
                                        kd_buku = '$_POST[kd_buku]',
                                        tgl_pinjam = '$_POST[tgl_pinjam]'
                                        WHERE kd_pinjam = '$_GET[kd_pinjam]'
                                        ");
        if($edit)
        {
            echo "<script> alert('Data Pinjam Berhasil di Edit!'); 
            document.location='pinjam.php';
            </script>";
        }
    } else {
        //data disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO pinjam (kd_pinjam, NIS, kd_buku, tgl_pinjam)
                                        VALUES('$_POST[kd_pinjam]',
                                                '$_POST[NIS]',
                                                '$_POST[kd_buku]',
                                                '$_POST[tgl_pinjam]')
                                        ");
        if($simpan)
        {
            echo "<script> alert('Data Pinjam Berhasil di Tambah!'); 
            document.location='pinjam.php';
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
        $tampil = mysqli_query($koneksi, "SELECT * FROM pinjam WHERE kd_pinjam = '$_GET[kd_pinjam]'");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
            //jika data ditemukan, maka data ditampung ke dalam variabel
            $vkd_pinjam = $data['kd_pinjam'];
            $vNIS = $data['NIS'];
            $vkd_buku = $data['kd_buku'];
            $vtgl_pinjam = $data['tgl_pinjam'];
        }
    }
    else if ($_GET['hal'] == "hapus")
    {
        $hapus = mysqli_query($koneksi, "DELETE FROM pinjam WHERE kd_pinjam = '$_GET[kd_pinjam]'");
        if($hapus){
            echo "<script> alert('Data Pinjam Berhasil di Hapus!'); 
            document.location='pinjam.php';
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

    .btn{
        background-color:beige;
        width: 80px;
        border: none;
        font-size: 11pt;
        border-radius: 5px;
        padding: 10px 10px;
        cursor: pointer;
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
</style>
<body>

    <!-- form pinjam -->
    <div class="box">
        <form action="" method="post">
        <h3><b>Masukkan Data Pinjam</b></h3><hr>
        <center>
            <table>
                <tr>
                    <td>Kode Pinjam</td>
                    <td><input type="text" name="kd_pinjam" value="<?=@$vkd_pinjam?>" class="kotak" ></td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td><input type="text" name="NIS" value="<?=@$vNIS?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Kode Buku</td>
                    <td><input type="text" name="kd_buku" value="<?=@$vkd_buku?>" class="kotak"></td>
                </tr>
                <tr>
                    <td>Tanggal Pinjam</td>
                    <td><input type="date" name="tgl_pinjam" value="<?=@$vtgl_pinjam?>" class="kotak"></td>
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
    <center><h3>Semua Data Pinjam Perpustakaan</h3></center>
    <center >
        <table border="1px" width="700px" cellspacing="0" cellpadding="10">
            <tr style="background-color: rgb(5, 126, 5);">
                <th>No.</th>
                <th>Kode Pinjam</th>
                <th>NIS</th>
                <th>Kode Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Aksi</th>
            </tr>  
            <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * FROM pinjam");
                while($data = mysqli_fetch_array($tampil)) :
            ?>
            <tr style="background-color: #97ff63;">
                <td> <center><?=$no++;?></center> </td>
                <td> <?=$data['kd_pinjam']?> </td>
                <td> <center><?=$data['NIS']?></center> </td>
                <td> <?=$data['kd_buku']?> </td>
                <td> <?=$data['tgl_pinjam']?> </td>
                <td> <center><button type="submit" class="btn"><a href="pinjam.php?hal=edit&kd_pinjam=<?=$data['kd_pinjam']?>" class="link">Edit</a></button>
                     <button type="submit" class="btn"><a href="pinjam.php?hal=hapus&kd_pinjam=<?=$data['kd_pinjam']?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="link">Hapus</a></button></center>
                </td>
            </tr>

            <?php endwhile; ?>

        </table>
    </center>
    <br><br><br>
</body>
</html>