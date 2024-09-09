<?php 
session_start();
include "connect.php";
$rs_board = '';
$show_topic = '';
if(isset($_GET['delTopicID'])){
    $id = $_GET['delTopicID'];
    mysqli_query($connect, "DELETE FROM tb_board WHERE b_id='".$id."' ");
    mysqli_query($connect, "DELETE FROM tb_board WHERE b_parent_id='".$id."' ");
    header('Location:testviewboard.php?id='.$id);
    exit();
}
if(isset($_GET['delAnsID']) && isset($_GET['topic_id'])){
    $id = $_GET['delAnsID'];
    $topic_id = $_GET['topic_id'];
    mysqli_query($connect, "DELETE FROM tb_board WHERE b_id='".$id."' ");
    header('Location:testviewboard.php?id='.$topic_id);
    exit();
}
if(isset($_POST['btSave'])){
    if(empty($_SESSION['m_id'])){
        header('Location:index.php');
        exit();
    }
    $id = $_GET['id'];
    $m_id = $_SESSION['m_id'];
    if(!empty($_POST['b_detail'])){
        $b_detail = $_POST['b_detail'];
        mysqli_query($connect, "INSERT INTO `tb_board`(`b_parent_id`,`b_detail`,`b_time_add`,`m_id`) 
        VALUES ('$id','$b_detail',SYSDATE(),'$m_id')");
        mysqli_query($connect, "UPDATE tb_board SET b.b_replie=b.b_replie+1,b.b_time_update=SYSDATE(),p.pro_replie_total=p.pro_replie_total+1 WHERE b_id='".$id."' ");
    }
    header('Location:testviewboard.php?id='.$id);
    exit();
}
if(isset($_GET['id'])){
    $rs_topic = mysqli_query($connect, "SELECT b.b_id,b.b_topic,b.b_detail,b.b_time_add,p.pro_id,p.pro_name,p.pro_image1 FROM tb_board as b LEFT JOIN tb_product as p ON b.pro_id = p.pro_id WHERE b.b_id='".$_GET['id']."'  ");
    $show_topic = mysqli_fetch_assoc($rs_topic);
    if(empty($show_topic['b_id'])){
        header('Location:index.php');
    }else if(empty($_GET['notview'])){
        mysqli_query($connect, "UPDATE tb_board SET b_views=b_views+1 WHERE b_id='".$_GET['id']."' ");
    }
    if(isset($_SESSION['m_id'])){
        if($_SESSION['m_level'] == 1){
            mysqli_query($connect,"UPDATE tb_board SET read_status = 1 WHERE b_id = '".$_GET['id']."' AND read_status = 0");
        }
    }
}else{
    header('Location:index.php');
}
?>
<html>
    <head>
        <?php include "head.php"; ?>
        <style>
            section:hover{
                background-color:LightGray;
                
            }

        </style>
    </head>
    <body>
    <?php include "menu_up.php"; ?>
    <?php include "menu.php"; ?>
        <div class="container">
            <div class="row my-3">
                <div class="col">
                    <nav class="bg-light  border rounded-3 p-2">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="show_pro.php?id=<?php echo $show_topic['pro_id'] ?>"><?php echo $show_topic['pro_name'] ?></a></li>
                            <li class="breadcrumb-item active">หัวข้อคำถาม<?php echo $show_topic['b_topic'] ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-12 col-lg-3 col-sm-12 col-md-12 p-2">
                    <div class="card p-2">
                        <img src="images/product/<?php echo $show_topic['pro_image1'];  ?>" class="w-100 d-block" height="250">
                    </div>
                </div>
                <div class="col-12 col-lg-9 col-md-12 col-sm-12">
                    <?php 
                    $rs_board = mysqli_query($connect, "SELECT b.b_id,b.m_id,b.b_topic,b.b_detail,b_time_add,p.pro_id,p.pro_name,m.m_image,m.m_name FROM tb_board as b LEFT JOIN tb_product as p ON b.pro_id = p.pro_id LEFT JOIN tb_member as m ON b.m_id = m.m_id
                    WHERE b.b_id='".$_GET['id']."' OR b.b_parent_id='".$_GET['id']."' ORDER BY b.b_time_add ASC ");
                    $rowNo = 0;
                    while($show_board = mysqli_fetch_assoc($rs_board)){
                        $b_id = $show_board['b_id'];
                        $pro_id = $show_board['pro_id'];
                    ?>
                        <section class="card p-3 my-2">
                            <div class="row">
                                <div class=" col-1 text-center">
                                    <?php 
                                    $usericon = 'usericon.png';
                                    if(!empty($show_board['m_image'])){
                                        $usericon = $show_board['m_image'];
                                    }
                                    ?>
                                    <img src="images/member/<?php echo $usericon; ?>" width="50" height="50">
                                </div>
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-12 text-end secondary" style="border-bottom:1px dashed #c8c8c8">
                                            <?php 
                                            $linkedit = "board_edit.php?id=$b_id&pro_id=$pro_id";
                                            $linkdel = "testviewboard.php?delTopicID=".$b_id;
                                            if($rowNo != 0){
                                            $linkedit = "ans_edit.php?id=$b_id&topic_id=".$_GET['id'];
                                            $linkdel = "testviewboard.php?delAnsID=".$b_id.'&topic_id='.$_GET['id'];
                                            ?>
                                                <b>ความคิดเห็นที่<?php echo $rowNo; ?></b>
                                            <?php }else {?>
                                                    กระทู้หลัก
                                                <?php } ?>
                                                BY : <?php echo $show_board['m_name']; ?>
                                                DATE : <?php echo $show_board['b_time_add']; ?>
                                                <span><?php 
                                                    if(isset($_SESSION['m_id'])){
                                                        if($_SESSION['m_level'] ==1 || $show_board['m_id'] == $_SESSION['m_id']){
                                                            ?>
                                                                <a href="<?php echo $linkedit; ?>">เเก้ไข</a>
                                                                <?php if($_SESSION['m_level'] == 1 && $rowNo == 0){ ?>
                                                                    <a href="<?php echo $linkdel; ?>" onClick="return confirm('ยืนยันการลบ')">ลบ</a>
                                                                    <?php }else if($rowNo > 0) { ?>
                                                                        <a href="<?php echo $linkdel; ?>" onClick="return confirm('ยืนยันการลบ')">ลบ</a>
                                                                        <?php } ?>
                                                            <?php 
                                                        }
                                                    }
                                                ?></span>
                                        </div>
                                        <div class="col-12 p-2 mt-2">
                                            <?php echo $show_board['b_detail']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php $rowNo++; } ?>
                </div>
            </div>
            <div class="row p-3">
                <?php if(!empty($_SESSION['m_name'])){?>
                    <div class="card p-4 m-2 shadow">
                        <div class="col-md-7  col-sm-7 col-md-offset-2 col-sm-offset-2">
                        <h1>เเสดงความคิดเห็น</h1>
                        <form  method="post" enctype="multipart/form-data"  name="bForm" action="">
                            <div class="form-group">
                                <label for="Category Description">เเสดงความคิดเห็น</label>
                                <textarea class="form-control" name="b_detail" placeholder="รายละเอียดของกระทู้" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                เเสดงความคิดเห็นโดย : <b><?php echo $_SESSION['m_name']; ?></b>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="btSave" value="บันทึกตั้งคำถาม" >
                            </div>
                        </form>
                    </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </body>
</html>