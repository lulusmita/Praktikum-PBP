<?php
// File : delete_cart.php
// Deskripsi : untuk menghapus session
session_start();
if (isset($_SESSION['cart'])) {
unset($_SESSION['cart']);
}
header('Location: show_cart.php');