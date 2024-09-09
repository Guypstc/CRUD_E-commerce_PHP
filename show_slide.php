<?php
    session_start();
    include ('connect.php');
        if(!empty($_GET['delslide'])){
            mysqli_query($connect,"DELETE FROM `tb_slide` WHERE s_id = '".$_GET['delslide']."' ");
            header('location:show_slide.php');
        }
    $rs_slide = mysqli_query($connect,"SELECT * FROM `tb_slide`");
    $row_slide = mysqli_num_rows($rs_slide);

    $count_slide = mysqli_query($connect,"SELECT COUNT(*) As s_image_file FROM `tb_slide` ");
    $count_row = mysqli_fetch_array($count_slide);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการรูปภาพสไลด์</title>
    <?php include ('chk_id.php'); include ('head.php'); ?>
</head>
<body>
<?php require("menu_up.php") ?>
<?php require("menu.php") ?>
    <div class="container py-3">
        <h1 class="text-center">จัดการรูปภาพสไลด์</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="11">
                        <div style="float:left">
                        <span>จำนวนรูปภาพสไลด์ : <?php echo $count_row['s_image_file'] ?> รูป</span>
                        </div>
                        <div style="float:right">
                        <a class="btn btn-primary" href="add_slide.php" class="text-white">เพิ่มรูปภาพสไลด์</a>
                        </div>
                    </th>
                </tr>
                <tr class="text-center">
                    <th>รูปภาพ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                    if($row_slide > 0){
                        while($row_slide = mysqli_fetch_array($rs_slide)){
                ?>
                <tr>
                    <td style="width:80%"><img src="images/slide/<?php echo $row_slide['s_image_file']; ?>" width="100"></td>
                    <td style="width:20%"><a class="btn btn-warning" href="edit_slide.php?editslide=<?php echo $row_slide['s_id']; ?>">แก้ไข</a> 
                        <a class="btn btn-danger" href="show_slide.php?delslide=<?php echo $row_slide['s_id']; ?>"  onClick="return confirm('ต้องการลบหรือไม่?')">ลบ</a>
                
                    </td>
                </tr>
                <?php } }else{ ?>
                    <td colspan="11"><b>ไม่มีข้อมูล</b></td>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>