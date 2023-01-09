<?php
if(isset($_POST['total'])) {
    $idsArray = $_POST['id'];
    $total = $_POST['total'];
}
if (!isset($_COOKIE['recent-bought'])) {
    setcookie('recent-bought', $_COOKIE['cart'], time()+3600 , '/');
    setcookie('cart', null, -1, '/');
}

header('Location: ../index.php');
?>