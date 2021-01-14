<?php
// session_start();
// //ada session ga, user udh login ato belum
// if (!isset($_SESSION["login"])) {
//     header("Location: index.php");
//     exit;
// }
 
require 'functions.php';
//ambil data di URL
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$kondisi_kandang = query ("SELECT * FROM kondisi_kandang WHERE id = $id")[0];

if(isset($_POST["submit"])){
    //cek apakah data berhasil diubah atau tidak
    if (edit($_POST)> 0){
        echo "
           <script>
                alert('data berhasil diubah!');
                document.location.href='kandang.php';
           </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href='edit.php';
            </script>
        ";
    }


}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data kondisi kandang</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style3.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body style="background: linear-gradient(rgb(187, 153, 255), #eee6ff);">
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center" style=""></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <h2 style="position:fixed; font-family:'Lucida Sans';">Ubah Data Kondisi Kandang</h2>
            <img src="img/added.svg" style="height:400px; width:400px; position:fixed; bottom:120px">
            <img src="img/com.svg" style="height:400px; width:400px; position:fixed; bottom:140px; top:200px;">
            <img src="img/chick.svg" style="height:200px; width:200px; position:fixed; bottom:40px; left:220px;">
        </div>
        <div class="col-sm-6">
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $kondisi_kandang["id"];?>">
        <input type="hidden" name="gambarLama" value="<?= $kondisi_kandang["foto_ayam"];?>">
            <div class="form-group">
                <label for="kd_peternak">Peternak :</label>
                <input type="text" class="form-control" name="kd_peternak" id="kd_peternak" required value="<?= $kondisi_kandang["kd_peternak"];?>">
            </div>
            <div class="form-group">
                <label for="tgl">Tanggal :</label>
                <input type="text" class="form-control" name="tgl" id="tgl" value="<?= $kondisi_kandang["tgl"];?>">
            </div>
            <div class="form-group">
                <label for="waktu">Waktu :</label>
                <input type="text" class="form-control" name="waktu" id="waktu" value="<?= $kondisi_kandang["waktu"];?>">
            </div>
            <div class="form-group">
                <label for="suhu_1">Suhu 1 :</label>
                <input type="text" class="form-control" name="suhu_1" id="suhu_1" value="<?= $kondisi_kandang["suhu_1"];?>">
            </div>
            <div class="form-group">
                <label for="kelembapan_1">Humidity 1 :</label>
                <input type="text" class="form-control" name="kelembapan_1" id="kelembapan_1" value="<?= $kondisi_kandang["kelembapan_1"];?>">
            </div>
            <div class="form-group">
                <label for="suhu_2">Suhu 2 :</label>
                <input type="text" class="form-control" name="suhu_2" id="suhu_2" value="<?= $kondisi_kandang["suhu_2"];?>">
            </div>
            <div class="form-group">
                <label for="kelembapan_2">Humidity 2 :</label>
                <input type="text" class="form-control" name="kelembapan_2" id="kelembapan_2" value="<?= $kondisi_kandang["kelembapan_2"];?>">
            </div>
            <div class="form-group">
                <label for="suhu_3">Suhu 3 :</label>
                <input type="text" class="form-control" name="suhu_3" id="suhu_3" value="<?= $kondisi_kandang["suhu_3"];?>">
            </div>
            <div class="form-group">
                <label for="kelembapan_3">Humidity 3 :</label>
                <input type="text" class="form-control" name="kelembapan_3" id="kelembapan_3" value="<?= $kondisi_kandang["kelembapan_3"];?>">
            </div>
            <div class="form-group">
                <label for="jml_ayam">Jumlah ayam :</label>
                <input type="text" class="form-control" name="jml_ayam" id="jml_ayam" value="<?= $kondisi_kandang["jml_ayam"];?>">
            </div>
            <div class="form-group">
                <label for="gambar">Gambar :</label> <br>
                <img src="img/<?= $kondisi_kandang['foto_ayam']; ?>" alt=""> <br>
                <input type="file" class="form-control-file" name="gambar" id="gambar" >
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Ubah data!</button>
    </form>
    </div>
    </div>
    </div>
</body>
</html>