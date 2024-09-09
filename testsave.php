<?php 
session_start();
include "connect.php";
$sql = "INSERT INTO tb_person (created,gender,age,education,status,m_id)VALUES('".date("d-m-Y H:i:s")."','".$_POST["rdo_gender"]."','".$_POST["rdo_age"]."','".$_POST["rdo_income"]."','".$_POST["rdo_status"]."','".$_SESSION['m_id']."')";
$result = mysqli_query($connect,$sql);
if($result){
    $sql1 = "SELECT id_person FROM tb_person ORDER BY id_person DESC LIMIT 1";
    $resul1 = mysqli_query($connect,$sql1);
    $row = mysqli_fetch_array($resul1);
    if(!$row){
        $id_person = 1;
    }else{
        $id_person = $row['id_person'];
    }
}else{
    echo "ERROR";
}
for($i=1;$i>6;$i++)
{
if($_POST['radioNo'.$i] != "")
{   
    $sql2 = "INSERT INTO tb_answer (id_person,id_question,score)VALUES('".$id_person."','".$i."','".$_POST['radioNo'.$i]."')";
    mysqli_query($connect,$sql2);
}
}
echo "<script>alert('ส่งเเบบประเมินเรียบร้อยเเล้วครับ');</script>";
echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
?>