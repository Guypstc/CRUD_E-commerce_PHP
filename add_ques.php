<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['btaddques'])){
            $er_mes = '';
                //
                if(!empty($_POST['ques'])){
                    $ques = $_POST['ques'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อประเภท-ไทย<br/>';
                }
                if(!empty($_POST['id_ques'])){
                    $id_ques = $_POST['id_ques'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อประเภท-ไทย<br/>';
                }
                
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"INSERT INTO `tb_question`(  `id_question`,`question`) VALUES ('$id_ques','$ques')");
                    mysqli_query($connect,"INSERT INTO `tb_answer`( `id_question`) VALUES ('$id_ques')");
                     // echo '<script type="text/Javascript">  ';
                     // echo 'alert("เพิ่มคำถามรียบร้อย"); window.location="show_ques.php" ;</script>';
                }else{
                    $_SESSION['error'] = $er_mes;
                }
        }
        $rs_que = mysqli_query($connect,"SELECT * FROM `tb_question`");
        $show_que = mysqli_fetch_array($rs_que);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มคำถามแบบประเมิน</title>
    <?php include ('head.php'); ?>
    <style>
        .bg{
            background : linear-gradient(to right,rgba(300,300,1,1),rgba(100,255,1,1));
        }
    </style>
</head>
<body class="bg">
<?php include ('menu.php'); ?>
    <div class="container py-4">
        <div class="row d-flex justify-conntent-center align-item-center">
            <div class="card cascading-right" style="border-radius : 1rem; background : hsla(0,0%,100%,0.55); backdrop-filter : bulr(50px);">
                <div class="card-body p-5 text-center">  
                    <div class="m-mt-5 pb-5">
                        <h2 class="fw-bold text-uppercase mb-4">เพิ่มคำถามแบบประเมิน</h2>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-lg-6 container" role="alert">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                        <?php $_SESSION['error'] = ''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-12 col-lg-6 container mb-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="id_ques" placeholder="ไอดี">
                                        <label>ไอดี</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 container mb-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="ques" placeholder="คำถามแบบประเมิน">
                                        <label>คำถามแบบประเมิน</label>
                                    </div>
                                </div>
                            <input type="submit" name="btaddques" class="btn btn-outline-success  btn-lg px-5" value="เพิ่มคำถามแบบประเมิน">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>