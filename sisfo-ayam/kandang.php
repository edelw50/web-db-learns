<?php 
$link=mysqli_connect('localhost','tentangk_edel','siewlede12345','tentangk_edel');
$kondisi_kandang = mysqli_query($link, "SELECT * FROM kondisi_kandang");
$transaksi= mysqli_query($link, "SELECT * FROM transaksi");

if (isset($_POST["kirim"])){
    $namaa = $_POST["namaa"];
    $emaill = $_POST["emaill"];
    $pesan = $_POST["pesan"];

    $query = "INSERT INTO pesan VALUES 
    ('', '$namaa', '$emaill', '$pesan') ";

    mysqli_query($link, $query);
}

if(isset($_POST['logout'])) {
    session_destroy();
    header('location:index.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peternakan Ayam</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style4.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.min.js"></script>



</head>
<body>

<!--navigasi bar-->
<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#home" class="navbar-brand page-scroll">Peternakan  Ayam</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#kondisi_kandang" class="page-scroll">Kondisi</a></li>
                    <li><a href="#transaksi" class="page-scroll">Transaksi</a></li>
                    <li><a href="#contact" class="page-scroll">Contact</a></li>
                    <li><a href="shop.php"><i class="fas fa-shopping-cart"></i></a></li>
                    <li name="logout"><button type="button" class="btn btn-default navbar-btn"><a href="logout.php" class="page-scroll">Logout</a></button></li>
                    
                </ul>
            </div>
        </div>
    </nav>
<!--end of navbar-->

<!--jumbotron-->
<div class="container">
    <div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <h1>SISFO Peternakan Ayam</h1>
            <p>Selamat datang! Di sistem informasi ini Anda dapat memperoleh informasi
            tentang kondisi kandang dan transaksi penjualan peternak-pembeli.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
        </div>
    </div>
    </div>
</div>

<!--end of jumbotron-->

<!--kondisi kandang-->
<section class="kondisi_kandang" id="kondisi_kandang">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">Kondisi Kandang</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Aksi</th>
                    <th>Peternak</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Suhu 1</th>
                    <th>Humidity 1</th>
                    <th>Suhu 2</th>
                    <th>Humidity 2</th>
                    <th>Suhu 3</th>
                    <th>Humidity 3</th>
                    <th>Jumlah Ayam</th>
                    <th>Foto</th>
                </tr>
                    <?php $i=1;?>
                    <?php foreach($kondisi_kandang as $row) : ?>
                <tr>
                    <td><?=$i; ?></td>
                    <td>
                        <button type="button" class="btn btn-success"><a href="edit.php?id=<?= $row["id"];?>">edit</a></button>
                        <button type="button" class="btn btn-danger"><a href="hapus.php?id=<?=$row["id"]?>" onclick = "return confirm ('yakin?');">hapus</a></button>
                    </td>
                    <td><?=$row["kd_peternak"]?></td>
                    <td><?=$row["tgl"]?></td>
                    <td><?=$row["waktu"]?></td>
                    <td><?=$row["suhu_1"]?></td>
                    <td><?=$row["kelembapan_1"]?></td>
                    <td><?=$row["suhu_2"]?></td>
                    <td><?=$row["kelembapan_2"]?></td>
                    <td><?=$row["suhu_3"]?></td>
                    <td><?=$row["kelembapan_3"]?></td>
                    <td><?=$row["jml_ayam"]?></td>
                    <td><img src="img/<?=$row["foto_ayam"]?>"></td>
                </tr>
                    <?php $i++;?>
                    <?php endforeach; ?>
            </table>
            </div>
        </div>
    </container>
</section>
<!--end of kondisi kandang-->

<!--transaksi-->
<section class="transaksi" id="transaksi">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">Transaksi Penjualan</h2>
                <hr>
            </div>

            <div class="col-sm-12">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama Peternak</th>
                        <th>Nama Penjual</th>
                        <th>Tanggal Transaksi</th>
                        <th>Waktu Transaksi</th>
                        <th>Jumlah Ayam</th>
                        <th>Harga Per Ekor</th>
                        <th>Total Penjualan</th>
                    </tr>
                        <?php $i=1;?>
                        <?php foreach($transaksi as $t) : ?>
                    <tr>
                        <td><?=$i; ?></td>
                        <td><?=$t["kd_peternak"]?></td>
                        <td><?=$t["kd_penjual"]?></td>
                        <td><?=$t["tgl"]?></td>
                        <td><?=$t["waktu"]?></td>
                        <td><?=$t["jml"]?></td>
                        <td><?=$t["harga"]?></td>
                        <td><?=$t["total"]?></td>
                    </tr>
                        <?php $i++;?>
                        <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</section>
<!--end of transaksi-->

<!--contact-->
<section class="contact" id="contact">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center">Contact</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <img src="img/chick.svg" style="width:200px; height:200px;">
        </div>
        <div class="col-sm-4">
            <img src="img/fb.png">
            <p>Sisfo Peternakan Ayam</p>
            <img src="img/insta.png">
            <p>@sisfoternakayam</p>
            <img src="img/twit.png">
            <p>@sisfoternakayam</p>
        </div>
        <div class="col-sm-4">
        <h3> Info lebih lanjut</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="namaa">Nama :</label>
                <input type="text" class="form-control" id="namaa" name="namaa" placeholder="Nama">
            </div>
            <div class="form-group">
                <label for="emaill">Email :</label>
                <input type="text" class="form-control" id="emaill" name="emaill" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="textarea1">Pesan :</label>
                <textarea class="form-control" id="textarea1" name="pesan" rows="3" placeholder="Masukkan pesan"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="kirim">Kirim</button>
        </form>
        </div>
    </div>
</div>
</section>
<!--end of contact-->

<!--footer-->
<footer>
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12">
                <p>&copy; copyright 2020 | Sisfo Ternak Ayam by <a href="http://instagram.com/delweiss99">Edelweis</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p><i class="fas fa-phone-square-alt"></i> +62 888-0689-7055</p>
            </div>
        </div>
    </div>
</footer>
<!--end of footer-->



</body>
</html>