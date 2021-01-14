<?php 
// session_start();
// //ada session ga, user udh login ato belum
// if (!isset($_SESSION["login"])) {
//     header("Location: index.php");
//     exit;
// }

require 'functions.php';
$id=$_GET["id"];

if (hapus ($id)>0)  {
    echo "
    <script>
        alert('data berhasil dihapus');
        document.location.href='kandang.php';
    </script>
    ";
}else {
    echo "
    <script>
        alert('data gagal dihapus');
        document.location.href='kandang.php';
    </script>
    ";
}
?>