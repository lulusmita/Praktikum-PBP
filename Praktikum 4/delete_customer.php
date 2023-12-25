<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

require_once('./lib/db_login.php');

if (isset($_GET['id'])) {
    $no = $_GET['id'];
    $sql = "DELETE FROM customers WHERE customerid = '$no'";

    if ($db->query($sql) === TRUE) {
        //echo '<script>alert("Customer dengan ID ' . $no . ' berhasil dihapus.");</script>';
        echo '<script>window.location.href = "view_customer.php";</script>';
    } else {
        //echo '<script>alert("Error: ' . $sql . '\n' . $db->error . '");</script>';
        echo '<script>window.location.href = "view_customer.php";</script>';
    }

    $db->close();
} else {
    //echo '<script>alert("ID tidak ditemukan.");</script>';
    echo '<script>window.location.href = "view_customer.php";</script>';
}
?>


