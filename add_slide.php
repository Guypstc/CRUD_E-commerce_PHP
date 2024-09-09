<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['btaddslide'])){
            $er_mes = '';
                //Image
                if(!empty($_FILES['s_img']['name'])){
                    $s_img = $_FILES['s_img'];
                    $tmp = explode('.',$s_img['name']);
                    $flietype = end($tmp);
                        if($flietype != 'jpeg' && $flietype != 'jpg' && $flietype != 'png'){
                            $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                        }else{
                            $filename = date('dmyHis').'.'.$flietype;
                        }
                }else{
                    $filename = '';
                }
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"INSERT INTO `tb_slide`( `s_image_file`) 
                    VALUES ('$filename')");
                        if(!empty($filename)){
                            move_uploaded_file($s_img['tmp_name'],'images/slide/'.$filename);
                        }
                        echo '<script type="text/Javascript">  ';
                        echo 'alert("เพิ่มรูปสไลด์เรียบร้อย"); window.location="show_slide.php" ;</script>';
                }else{
                    $_SESSION['error'] = $er_mes;
                }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรูปสไลด์</title>
    <?php include ('chk_id.php'); include ('head.php'); ?>
    <style>
        .bg {
            background: linear-gradient(to right, rgba(255, 0, 0, 0.9), rgba(37, 117, 252, 0.9));

            background-size: 150% auto;
            animation: gradient 13s linear infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
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
                        <h2 class="fw-bold text-uppercase mb-4">เพิ่มรูปสไลด์</h2>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-4 container" role="alert">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                        <?php $_SESSION['error'] = ''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row mb-4">
                                <div class="col-12 col-lg-4 container">
                                   <div class="form-control">
                                        <div class="row p-1">
                                            <div class="col-3">รูปภาพ</div>
                                            <div class="col-9">
                                                <input type="file" name="s_img" class="form-control"> 
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>

                            <input type="submit" name="btaddslide" class="btn btn-outline-success  btn-lg px-5" value="เพิ่มรูปสไลด์">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>