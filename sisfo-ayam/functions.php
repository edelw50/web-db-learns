<?php 
$link=mysqli_connect('localhost','tentangk_edel','siewlede12345','tentangk_edel');

function query ($query) {
    global $link;
    $result = mysqli_query($link, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}

function registrasi ($data) {

    global $link;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($link, $data["password"]);
    $opsi = stripslashes($data["opsi"]);
    $nama = stripslashes($data["nama"]);
    $alamat = stripslashes($data["alamat"]);
    $kota = stripslashes($data["kota"]);
    $telepon = stripslashes($data["telepon"]);
    $email = stripslashes($data["email"]);

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($link, "INSERT INTO login VALUES ('$username', '$password','$opsi','$nama','$alamat','$kota','$telepon','$email')");
    return mysqli_affected_rows($link);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
   
    //cek apakah tidak ada gambar yg diupload
    if ($error === 4){
        echo "<script>
            alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }
    
    //cek apakah yg diupload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png']; 
    $ekstensiGambar = explode ('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
         echo "<script>
            alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }
    
    //cek jika ukuran  terlalu besar
    if ( $ukuranFile > 1000000 ) {
        echo "<script>
            alert('ukuran gambar terlalu besar');
            </script>";
        return false;
    }

    //lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
    return $namaFileBaru;


}

function hapus($id){
    global $link;
    mysqli_query ($link, "DELETE FROM kondisi_kandang WHERE id = $id");
    return mysqli_affected_rows($link);
}

function edit($data) {
    global $link;
    $id = $data["id"]; 
    $peternak = htmlspecialchars($data["kd_peternak"]);
    $tanggal =htmlspecialchars($data["tgl"]);
    $waktu = htmlspecialchars($data["waktu"]);
    $suhu1 = htmlspecialchars($data["suhu_1"]);
    $lembap1 = htmlspecialchars($data["kelembapan_1"]);
    $suhu2 = htmlspecialchars($data["suhu_2"]);
    $lembap2 = htmlspecialchars($data["kelembapan_2"]);
    $suhu3 = htmlspecialchars($data["suhu_3"]);
    $lembap3 = htmlspecialchars($data["kelembapan_3"]);
    $jumlah = htmlspecialchars($data["jml_ayam"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);



    //cek apakah user pilih gambar baru/ tidak
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    

    $query = "UPDATE kondisi_kandang SET
                kd_peternak = '$peternak',
                tgl = '$tanggal',
                waktu = '$waktu',
                suhu_1 = '$suhu1',
                kelembapan_1 = '$lembap1',
                suhu_2 = '$lembap2',
                kelembapan_2 = '$lembap2',
                suhu_3 = '$lembap3',
                kelembapan_3 = '$lembap3',
                jml_ayam = '$jumlah',
                foto_ayam = '$gambar'
            WHERE id = $id
            ";
    mysqli_query($link,$query);

    return mysqli_affected_rows($link);
}
?>