<?php 
session_start();
include("connect.php");

    if(!isset($_SESSION['chkcart'])){
        $_SESSION["chkcart"] = 0;
        $_SESSION["str_proid"][0] = $_GET["pro_id"];
        $_SESSION["str_qty"] = 1;
        header("location: cart.php");
    }else{
        $key_cart = array_search($_GET["pro_id"], $_SESSION["sty_proid"]);
    }
?>