<?php
    session_start();
   
    include ('connect.php');
        if(!empty($_GET['deluser'])){
            mysqli_query($connect,"DELETE FROM `tb_member` WHERE m_id = '".$_GET['deluser']."' ");
            header('location:show_user.php');
        }

        
    $key = null;
    if(!empty($_POST['key'])){
        $key = $_POST['key'];
    }
    $rs_member = mysqli_query($connect,"SELECT * FROM `tb_member` WHERE tb_member.m_email LIKE '%".$key."%'");
    $row_member = mysqli_num_rows($rs_member);

    $count_member = mysqli_query($connect,"SELECT COUNT(*) As m_user FROM `tb_member` ");
    $count_row = mysqli_fetch_array($count_member);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้งาน</title>
    <?php include ('chk_id.php'); include ('head.php'); ?>
</head>
<body>
<?php require("menu_up.php") ?>
<?php require("menu.php") ?>
    <div class="container py-3">
        <h1 class="text-center">จัดการผู้ใช้งาน</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="11">
                        <div style="float:left">
                        <span>จำนวนสมาชิก : <?php echo $count_row['m_user'] ?> คน</span>
                        </div>
                        <div style="float:right">
                        <a class="btn btn-primary" href="add_user.php" class="text-white">เพิ่มผู้ใช้งาน</a>
                        </div>
                    </th>
                </tr>
                <tr class="text-center">
                    <th>ชื่อจริง-นามสกุล</th>
                    <th>อีเมล</th>
                    <th>เบอร์โทร</th>
                    <th>รูปภาพ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                    if($row_member > 0){
                        while($row_member = mysqli_fetch_array($rs_member)){
                ?>
                <tr>
                    <td><?php echo $row_member['m_name']; ?></td>
                    <td><?php echo $row_member['m_email']; ?></td>
                    <td><?php echo $row_member['m_tel']; ?></td>
                    <td><img src="images/member/<?php echo $row_member['m_image']; ?>" width="50"></td>
                    <td><a class="btn btn-warning" href="edit_user.php?edituser=<?php echo $row_member['m_id']; ?>">แก้ไข</a>  
                        <a class="btn btn-danger" href="show_user.php?deluser=<?php echo $row_member['m_id']; ?>"  onClick="return confirm('ต้องการลบหรือไม่?')">ลบ</a>
                
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