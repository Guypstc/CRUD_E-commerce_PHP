<?php 
    session_start();
    include ('connect.php');
        if(!empty($_GET['delpro'])){
            mysqli_query($connect,"DELETE FROM `tb_product` WHERE  pro_id = '".$_GET['delpro']."' ");
        } 

        $key = null;
        if(!empty($_POST['key'])){
            $key = $_POST['key'];
        }
    $rs_product = mysqli_query($connect,"SELECT * FROM `tb_product` WHERE tb_product.pro_name LIKE '%".$key."%' ");
    $show_row = mysqli_num_rows($rs_product);
    
    $count_1 = mysqli_query($connect,"SELECT COUNT(*) As pro_name FROM `tb_product` ");
    $count_row = mysqli_fetch_array($count_1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสินค้า</title>
    <?php include ('chk_id.php');  include ('head.php');?>
</head>
<body>
<?php require("menu_up.php") ?>
<?php require("menu.php") ?>
    <div class="container py-3">
        <h1 class="fw-bold text-uppercase text-center">จัดการสินค้า</h1>
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th colspan="6">
                    <div style="float:left">
                        <span>จำนวนสินค้า : <?php echo $count_row['pro_name'];?> ชิ้น</span>
                        </div>
                        <div style="float:right">
                           <a class="btn btn-primary" class="text-white" href="add_product.php">เพิ่มสินค้า</a>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>ชื่อสินค้า</th>
                    <th>รูปสินค้า</th>
                    <th>จำนวนสินค้า</th>
                    <th>ราคาสินค้า</th>
                    <th>สถานะสินค้า</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if($show_row > 0){
                    while($row = mysqli_fetch_array($rs_product)){?>
                <tr>
                    <td><?php echo $row['pro_name']; ?></td>
                    <td><img src="images/product/<?php echo $row['pro_image1'] ?>" width="50"></td>
                    <td><?php echo $row['pro_num']; ?></td>
                    <td><?php echo $row['pro_price']; ?></td>
                    <td>
                        <?php if($row['s_id'] == 1){ ?>
                            สินค้าใหม่
                        <?php }else if($row['s_id'] == 2){ ?>
                            สินค้าแนะนำ
                        <?php }else{ ?>
                            สินค้าลดราคา20%
                        <?php } ?>
                    </td>
                    <td><a class="btn btn-warning" href="edit_product.php?editpro=<?php echo $row['pro_id'] ;?>">แก้ไข</a> 
                        <a class="btn btn-danger" href="show_product.php?delpro=<?php echo $row['pro_id'] ;?>" Onclick="return confirm('ยืนยันจะลบหรือไม่?')">ลบ</a> 
                    </td>
                </tr>
                <?php } }else{ ?>
                    <td colspan="6"><b>ไม่มีข้อมูล</b></td>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>