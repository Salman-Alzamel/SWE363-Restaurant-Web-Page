<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (!isset($_COOKIE['cart'])) {
    $idsarray = array();
    array_push($idsarray, $id);
    $json = json_encode($idsarray);
    setcookie('cart', $json, time()+3600 , '/');
}
else {
    $cookie = $_COOKIE['cart'];
    $cookie = stripslashes($cookie);
    $savedCardArray = json_decode($cookie, true);
    array_push($savedCardArray, $id);
    $idsarray = $savedCardArray;
    $json = json_encode($idsarray);
    setcookie('cart', $json, '' , '/');
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>