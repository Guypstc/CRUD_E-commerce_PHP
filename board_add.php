<?php
    session_start();
    if (empty($_SESSION['m_id'])) {//ไม่พบค่าเซสชั่น mem_id แสดงว่าไม่ใช่สมาชิก จึงไม่สามารถตั้งกระทู้ได้
        header('Location:index.php');
    }
    require('connect.php'); //เรียกไฟล์เชื่อมต่อกับฐานข้อมูล
    if (!empty($_POST['btSave'])) {//มีการคลิกที่ปุ่มบันทึกตั้งกระทู้
        $msgError = '';
        if (!empty($_POST['b_topic']) || !empty($_POST['b_detail'])) {
            $pro_id = $_GET['id']; //รหัสหมวดกระทู้
            $b_topic = trim($_POST['b_topic']); //หัวข้อกระทู้
            $b_detail = nl2br($_POST['b_detail']); //รายละเอียดกระทู้
            mysqli_query($connect, "INSERT INTO tb_board(pro_id,b_topic,b_detail,b_time_add,b_time_update,m_id) 
    VALUES($pro_id,'$b_topic','$b_detail',SYSDATE(),SYSDATE()," . $_SESSION['m_id'] . ")");
            mysqli_query($connect, "UPDATE tbl_product SET pro_topic_totals=pro_topic_totals+1 WHERE pro_id=$pro_id");
            header("Location:show_pro.php?id=" . $_GET['id'] . '&notview=1');
        } else {
            $msgError.='กรุณากรอกหัวข้อกระทู้และรายละเอียดของกระทู้ด้วย<br />';
        }
        if (empty($msgError)) {
            //หากสมาชิกพิมพ์ข้อมูลถูกต้อง ให้Redirect หน้าไปที่ไฟล์ category.php
            header("Location:show_pro.php?id=" . $_GET['id']);
        } else {
            //หากกรอกข้อมูลไม่ถูกต้อง ให้สร้างตัวแปร session มารับค่าเพื่อแจ้งให้ทราบถึงปัญหาที่เกิดขึ้น
            $_SESSION['message_error'] = $msgError;
        }
    }
    $show_pro = '';
    if (!empty($_GET['id'])) {
        $rs_cg = mysqli_query($connect, "SELECT pro_name,pro_id FROM tb_product WHERE pro_id='".$_GET['id']."'");
        $show_pro = mysqli_fetch_assoc($rs_cg); //นับจำนวนแถวของหมวดกระทู้
        if (empty($show_pro['pro_name'])) {
            header('Location:index.php');
        }
    } else {//ไม่พบพารามิเตอร์ $_GET['id'] .ให้กลับไปหน้าแรก
        header('Location:index.php');
    }
?>
<html>
    <head>
        <?php require('head.php'); ?>
        <link rel="stylesheet" type="text/css" href="btvalidate/dist/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="btvalidate/dist/js/bootstrapValidator.min.js"></script>
        <title>ตั้งกระทู้ห้อง <?php echo $show_pro['pro_name']; ?></title>
    </head>
    <body>
        <?php include ('chk_id.php'); require('menu.php'); ?>
        <div class="container">

            <div class="row ws-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item "><a href="show_pro.php?id=<?php echo $show_pro['pro_id']; ?>"><?php echo $show_pro['pro_name']; ?></a></li>
                    <li class="breadcrumb-item active">ตั้งกระทู้</li>
                </ol>
                <div class="col-md-7  col-sm-7 col-md-offset-2 col-sm-offset-2">
                    <h1>ตั้งกระทู้</h1>
                    <?php
                    if (!empty($_SESSION['message_error'])) {
                        //แสดงปัญที่เกิดขึ้นจากการไม่กรอกชื่อหมวดกระทู้
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['message_error']; ?>
                        </div>
                        <?php
                        $_SESSION['message_error'] = '';
                    }
                    ?>
                    <form  method="post" enctype="multipart/form-data"  name="bForm" action="">
                        <div class="form-group">
                            <label for="Category Name">หัวข้อกระทู้</label>
                            <input type="text" class="form-control"  name="b_topic" placeholder="หัวข้อกระทู้">
                        </div>
                        <div class="form-group">
                            <label for="Category Description">รายละเอียด</label>
                            <textarea class="form-control" name="b_detail" placeholder="รายละเอียดของกระทู้" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            ตั้งกระทู้โดย : <b><?php echo $_SESSION['m_name']; ?></b>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="btSave" value="บันทึกตั้งกระทู้" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>