<?php
    session_start();
    include ('connect.php');
        if(!empty($_GET['deltype'])){
            mysqli_query($connect,"DELETE FROM `tb_type` WHERE t_id = '".$_GET['deltype']."' ");
            header('location:show_type.php');
        }
        $key = null;
        if(!empty($_POST['key'])){
            $key = $_POST['key'];
        }
    $rs_type = mysqli_query($connect,"SELECT * FROM `tb_type` WHERE tb_type.t_name  LIKE '%".$key."%'");
    $row_type = mysqli_num_rows($rs_type);

    $count_type = mysqli_query($connect,"SELECT COUNT(*) As t_name FROM `tb_type` ");
    $count_row = mysqli_fetch_array($count_type);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการประเภทสินค้า</title>
    <?php include ('chk_id.php'); include ('head.php'); ?>
</head>
<body>
<?php require("menu_up.php") ?>
<?php require("menu.php") ?>
    <div class="container py-3">
        <h1 class="text-center">จัดการประเภทสินค้า</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="3">
                        <div style="float:left">
                        <span>จำนวนประเภทสินค้า : <?php echo $count_row['t_name'];?> ประเภท</span>
                        </div>
                        <div style="float:right">
                            <a class="btn btn-primary" href="add_type.php" class="text-white">เพิ่มประเภทสินค้า</a>
                        </div>
                    </th>
                </tr>
                <tr class="text-center">
                    <th>ชื่อประเภท-ไทย</th> 
                    <th>ชื่อประเภท-อังกฤษ</th> 
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                    if($row_type > 0){
                        while($row_type = mysqli_fetch_array($rs_type)){
                ?>
                <tr>
                    <td style="width:40%"><?php echo $row_type['t_name']; ?></td>
                    <td style="width:40%"><?php echo $row_type['t_name_eng']; ?></td>
                    <td><a class="btn btn-warning" href="edit_type.php?edittype=<?php echo $row_type['t_id']; ?>">แก้ไข</a> 
                        <a class="btn btn-danger" href="show_type.php?deltype=<?php echo $row_type['t_id']; ?>"  onClick="return confirm('ต้องการลบหรือไม่?')">ลบ</a>
                
                    </td>
                </tr>
                <?php } }else{ ?>
                    <td colspan="3"><b>ไม่มีข้อมูล</b></td>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>