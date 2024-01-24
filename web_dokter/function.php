<?php
$conn = mysqli_connect("localhost", "root", "", "db_pasien");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    $nama_pasien = $data["nama_pasien"];
    $jenis_kelamin = $data["jenis_kelamin"];
    $tanggal_lahir = $data["tanggal_lahir"];
    $no_telp = $data["no_telp"];
    $alamat = $data["alamat"];
    $pesan = $data["pesan"];

    $query = "INSERT INTO passien VALUES('','$nama_pasien', '$jenis_kelamin', '$tanggal_lahir', '$no_telp', '$alamat', '$pesan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}    

function delete($nama_pasien) {
    global $conn;
    mysqli_query($conn, "DELETE FROM passien WHERE id = '$nama_pasien'");
    return mysqli_affected_rows($conn);

}

function edit($data){
    global $conn;
    $id = $data["id"];
    $nama_pasien = $data["nama_pasien"];
    $jenis_kelamin = $data["jenis_kelamin"];
    $tanggal_lahir = $data["tanggal_lahir"];
    $no_telp = $data["no_telp"];
    $alamat = $data["alamat"];
    $pesan = $data["pesan"];

    $query = "UPDATE passien SET
    nama_pasien = '$nama_pasien',
                 jenis_kelamin = '$jenis_kelamin',
                 tanggal_lahir = '$tanggal_lahir',
                 no_telp = '$no_telp',
                 alamat = '$alamat',
                 pesan = '$pesan'
                 WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

}    
?>