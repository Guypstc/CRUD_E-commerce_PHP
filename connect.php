<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "project";

    $connect = mysqli_connect($host,$user,$pass,$db);
    mysqli_query($connect,"SET NAMES UTF8");
?>