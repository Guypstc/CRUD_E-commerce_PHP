<?php 
session_start();
include "connect.php";

 $result = mysqli_query($connect, "INSERT INTO `tb_order`(`cus_name`, `address`, `Subdistrict`, `District`, `Province`, `Zipcode`, `phone`, `total_price`, `order_status`) 
 VALUES ('".$_SESSION['m_name']."','".$_SESSION['Address']."','".$_SESSION['Subdistrict']."','".$_SESSION['District']."','".$_SESSION['Province']."','".$_SESSION['Zipcode']."','".$_SESSION['m_tel']."','".$_SESSION['sum_price']."','1')");

 $order_id = mysqli_insert_id($connect);
 $_SESSION['order_id'] =  $order_id;

 for ($i = 0; $i <= (int) $_SESSION['chk_order']; $i++) {
    if ($_SESSION['strProductID'][$i] != "") {
        $result1 = mysqli_query($connect, "select * from tb_product where  pro_id = '" . $_SESSION["strProductID"][$i] . "' ");
        $row = mysqli_fetch_array($result1);
        $price = $row['pro_price'];
        $total  = $_SESSION['strQty'][$i] * $price;
        $result2 =  "INSERT INTO order_detail(order_id,pro_id,order_price,quantity,total) 
        VALUES ('$order_id','" . $_SESSION["strProductID"][$i] . "','$price','".$_SESSION['strQty'][$i]."','$total' )";
         if(mysqli_query($connect,$result2)){
            mysqli_query($connect,"update tb_product set pro_num  = pro_num - '".$_SESSION['strQty'][$i]."' 
            where  pro_id = '" . $_SESSION["strProductID"][$i] . "' ");
            echo "<script> window.location='print_product.php'; </script>";
         }else if(mysqli_query($connect,$result2) && $_SESSION['m_level'] == 1){
            mysqli_query($connect,"update tb_product set pro_num  = pro_num - '".$_SESSION['strQty'][$i]."' 
            where  pro_id = '" . $_SESSION["strProductID"][$i] . "' ");
            echo "<script> window.location='cancel_order.php'; </script>";
         }
    }
}
mysqli_close($connect);
unset($_SESSION['chk_order']);
unset($_SESSION['strProductID']);
unset($_SESSION['strQty']);
?>