<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['btaddtype'])){
            $er_mes = '';
                //th
                if(!empty($_POST['t_name'])){
                    $t_name = $_POST['t_name'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อประเภท-ไทย<br/>';
                }
                //en
                if(!empty($_POST['t_name_eng'])){
                    $t_name_eng = $_POST['t_name_eng'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อประเภท-อังกฤษ<br/>';
                }
            
                
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"INSERT INTO `tb_type`( `t_name`, `t_name_eng`)
                    VALUES ('$t_name','$t_name_eng')");
                      echo '<script type="text/Javascript">  ';
                      echo 'alert("เพิ่มประเภทสินค้าเรียบร้อย"); window.location="show_type.php" ;</script>';
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
    <title>เพิ่มสมาชิก</title>
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
                        <h2 class="fw-bold text-uppercase mb-4">เพิ่มประเภทสินค้า</h2>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-4 container" role="alert">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                        <?php $_SESSION['error'] = ''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-12 col-lg-4 container mb-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="t_name" placeholder="ชื่อประเภท-ไทย">
                                        <label>ชื่อประเภท-ไทย</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 container mb-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="t_name_eng" placeholder="ชื่อประเภท-อังกฤษ">
                                        <label>ชื่อประเภท-อังกฤษ</label>
                                    </div>
                                </div>
                            <input type="submit" name="btaddtype" class="btn btn-outline-success  btn-lg px-5" value="เพิ่มประเภทสินค้า">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>