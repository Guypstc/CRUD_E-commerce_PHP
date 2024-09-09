<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['bteditques'])){
            $er_mes = '';
                //
                if(!empty($_POST['ques'])){
                    $ques = $_POST['ques'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อประเภท-ไทย<br/>';
                }
                
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"UPDATE `tb_question` SET `question`='$ques' WHERE id_question= '".$_GET['editques']."'");
                      echo '<script type="text/Javascript">  ';
                      echo 'alert("แก้ไขคำถามรียบร้อย"); window.location="show_ques.php" ;</script>';
                }else{
                    $_SESSION['error'] = $er_mes;
                }
        }
        $rs_ques = mysqli_query($connect,"SELECT * FROM `tb_question` WHERE id_question= '".$_GET['editques']."' ");
        $show_ques = mysqli_fetch_array($rs_ques);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขคำถามแบบประเมิน</title>
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
                        <h2 class="fw-bold text-uppercase mb-4">แก้ไขคำถามแบบประเมิน</h2>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-lg-6 container" role="alert">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                        <?php $_SESSION['error'] = ''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-12 col-lg-6 container mb-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="ques" placeholder="คำถามแบบประเมิน" value="<?php echo $show_ques['question']; ?>">
                                        <label>คำถามแบบประเมิน</label>
                                    </div>
                                </div>
                            <input type="submit" name="bteditques" class="btn btn-outline-success  btn-lg px-5" value="แก้ไขคำถามแบบประเมิน">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>