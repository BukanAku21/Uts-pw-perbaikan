<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "setokbarang");

// Tambah Stock
// echo '</pre>'; print_r($_POST);
// exit;
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $stock = $_POST['stcok'];

    $addtotable = mysqli_query($conn, "INSERT INTO stockbarang (namabarang, keterangan, stock)
    VALUES ('$namabarang', '$keterangan', '$stock')");
    if($addtotable){
        header('location:stock.php');
    }else{
        echo "gagal";
        header('location:index.php');
    }
}

// tambah barang masuk
// echo '</pre>'; print_r($_POST);
// exit;
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * from stockbarang where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang= $ambildatanya['stock'];
    $add = $stocksekarang+$qty;


    $addtomasuk = mysqli_query($conn, "INSERT into barangmasuk (idbarang, keterangan, qty) values ('$barangnya','$keterangan',$qty)");
    $updatestcokmasuk = mysqli_query($conn, "UPDATE stockbarang set stock='$add' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestcokmasuk){
        header('location:masuk.php');
    }else{
        echo "gagal";
        header('location:index.php');
    }
}   

// Barang Keluar
// echo '</pre>'; print_r($_POST);
// exit;
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * from stockbarang where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang= $ambildatanya['stock'];
    $add = $stocksekarang-=$qty;


    $addtomasuk = mysqli_query($conn, "INSERT into barangkeluar (idbarang, penerima, qty) values ('$barangnya','$penerima',$qty)");
    $updatestcokmasuk = mysqli_query($conn, "UPDATE stockbarang set stock='$add' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestcokmasuk){
        header('location:keluar.php');
    }else{
        echo "gagal";
        header('location:index.php');
    }
}

// edit dan hapus barang
// echo '</pre>'; print_r($_POST);
// exit;
if(isset($_POST['editbarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];

    $editbarang = mysqli_query($conn, "UPDATE stockbarang set namabarang='$namabarang', keterangan='$keterangan' where idbarang='$idb'");
}
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $delete = mysqli_query($conn, "DELETE from stockbarang where idbarang='$idb'");
}
?>