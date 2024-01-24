<?php

$conn = mysqli_connect ("localhost", "root", "", "perpustakaan");

if(isset($_POST["Login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if($username == "admin" && $password == "administrator"){
        echo "<script> alert('Login Berhasil!'); 
        document.location='menu.html';
        </script>";
    } else {
        echo "<script> alert('Login Gagal!'); 
        document.location='index.php';
        </script>";
    }

    $query = "INSERT INTO masuk VALUES ('$username', '$password')";
    mysqli_query($conn, $query);
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=t, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        background-image: url(green.jpg);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .box {
        width: 300px;
        background: black;
        margin: 170px auto;
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
    .btn{
        background-color:beige;
        width: 80px;
        border: none;
        font-size: 11pt;
        border-radius: 5px;
        padding: 7px;
        cursor: pointer;
    }
    
</style>
<body>
    <div class="box">
    <form action="" method="post">
        <center><img src="stm.png" alt="" style="float:left;width:55px;height:55px;"><h3><b style="color: white;">Perpustakaan SMK Negeri 1 Majalengka</b></h3></center>
        <hr><br>
        <center>
        <table>
        <tr>
            <td style="color: white;">Username</td>
            <td></td>
            <td><input type="text" name="username" class="kotak"></td>
        </tr>
        <tr>
            <td style="color: white;">Password</td>
            <td></td>
            <td><input type="password" name="password" class="kotak"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><button type="submit" name="Login" class="btn">Login</button> <button type="reset" name="Hapus" class="btn">Hapus</button></td>
        </tr> 
        </table>
        </center>
    </form>
    </div>
        
   
</body>
</html>