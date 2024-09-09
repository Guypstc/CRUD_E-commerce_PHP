<?php
    session_start();
    include ('connect.php');
        if(!empty($_GET['delques'])){
            mysqli_query($connect,"DELETE q,a FROM `tb_question` As q LEFT JOIN `tb_answer` As a ON q.id_question=a.id_question WHERE q.id_question = '".$_GET['delques']."' ");
            header('location:show_ques.php');
        }
        $key = null;
        if(!empty($_POST['key'])){
            $key = $_POST['key'];
        }
    $rs_ques = mysqli_query($connect,"SELECT * FROM `tb_question` WHERE tb_question.question  LIKE '%".$key."%'");
    $row_ques = mysqli_num_rows($rs_ques);

    $count_ques = mysqli_query($connect,"SELECT COUNT(*) As question FROM `tb_question` ");
    $count_row = mysqli_fetch_array($count_ques);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการคำถามแบบประเมิน</title>
    <?php include ('head.php'); ?>
</head>
<body>
<?php require("menu_up.php") ?>
<?php require("menu.php") ?>
    <div class="container py-3">
        <h1 class="text-center">จัดการคำถามแบบประเมิน</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th colspan="3">
                        <div style="float:left">
                        <span>จำนวนคำถามแบบประเมิน : <?php echo $count_row['question'];?> คำถาม</span>
                        </div>
                        <div style="float:right">
                        <span class="btn btn-primary"><a href="add_ques.php" class="text-white">เพิ่มคำถามแบบประเมิน</a></span>
                        </div>
                    </th>
                </tr>
                <tr class="text-center">
                    <th>คำถามแบบประเมิน</th> 
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                    if($row_ques > 0){
                        while($row_ques = mysqli_fetch_array($rs_ques)){
                ?>
                <tr>
                    <td style="width:80%"><?php echo $row_ques['question']; ?></td>
                    <td><a href="edit_ques.php?editques=<?php echo $row_ques['id_question']; ?>">แก้ไข</a> / 
                        <a href="show_ques.php?delques=<?php echo $row_ques['id_question']; ?>"  onClick="return confirm('ต้องการลบหรือไม่?')">ลบ</a>
                
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