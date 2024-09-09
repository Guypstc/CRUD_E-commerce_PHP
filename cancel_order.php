<?php
include 'connect.php';
$ids=$_GET['id'];

$sql1="SELECT * FROM order_detail WHERE order_id='$ids' ";
$hand=mysqli_query($connect,$sql1);
while($row1=mysqli_fetch_array($hand)){
$proid=$row1['pro_id'];
$num=$row1['quantity'];

//เพิ่มสต๊อกสินค้า
$sql2="UPDATE tb_product set pro_num=pro_num + $num WHERE pro_id='$proid' ";
$result=mysqli_query($connect,$sql2);
}

//ปรับสถานะ
$sql= "UPDATE tb_order SET order_status = 0 WHERE order_id='$ids' ";
$result=mysqli_query($connect,$sql);
if($result){
    echo "<script> window.location='report_order_no.php'; </script>";
}else{
    echo "<script>alert('ไม่สามารถลบข้อมูลได้') ; </script>";
}
mysqli_close($connect);
?>