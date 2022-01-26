<?
include_once "Php/Helpers/AutoLoader.Php";
session_start();
if ($_SESSION['cart'] != null) {
    $cart = new Cart($_SESSION['cart']);
} else {
    $cart = new Cart(array());
    $_SESSION['cart'] = $cart->getItems();
}
$usersreg = new Usersreg();
$comment = new Comment();
$images = new Images();
$goods = new Goods();
$DIR = __DIR__;
include_once "View/Helpers/Header.php";
?>
<?php
switch ($_SERVER['REQUEST_URI']) {
    case "/contact":
        include_once "View/Body/Contact.php";
        break;
    case "/galari":
        include_once "View/Body/Galari.php";
        break;
    case "/goods":
        include_once "View/Body/Goods.php";
        break;
    case "/login":
        include_once "View/Body/Login.php";
        break;
    case "/about":
        include_once "View/Body/About.php";
        break;
    case "/registration":
        include_once "View/Body/Registration.php";
        break;
    case "/AddPhoto":
        include_once "View/Body/AddPhoto.php";
        break;
    case "/AddProduct":
        include_once "View/Body/AddProduct.php";
        break;
    case "/cart":
        include_once "View/Body/Cart.php";
        break;
    case "/":
        include_once "View/Body/Index.php";
        break;
    default:
        echo($_SERVER['REQUEST_URI']);
        include_once "View/Body/404.php";
        break;
}
?>
<?php include_once "View/Helpers/Footer.php"; ?>