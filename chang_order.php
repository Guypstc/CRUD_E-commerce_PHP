<?php 
session_start();
include "connect.php";
$id = $_GET["id"];
$result = mysqli_query($connect, "UPDATE tb_order SET order_status = 2 WHERE order_id='$id'");
if($result){
    echo"<script>window.location='report_order_yes.php';</script>";
}else{
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
}
?>