<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['bteditslide'])){
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
                            move_uploaded_file($s_img['tmp_name'],'images/slide/'.$filename);
                            @unlink('images/slide/'.$_POST['oldimg']);
                        }
                }else{
                    $filename = '';
                }
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"UPDATE `tb_slide` SET `s_image_file`='$filename' WHERE s_id = '".$_GET['editslide']."' ");      
                        echo '<script type="text/Javascript">  ';
                        echo 'alert("แก้ไขรูปสไลด์เรียบร้อย"); window.location="show_slide.php" ;</script>';
                }else{
                    $_SESSION['error'] = $er_mes;
                }
        }
        $rs_slide = mysqli_query($connect,"SELECT * FROM `tb_slide` WHERE s_id = '".$_GET['editslide']."' ");
        $show_slide = mysqli_fetch_array($rs_slide);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขรูปสไลด์</title>
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
                        <h2 class="fw-bold text-uppercase mb-4">แก้ไขรูปสไลด์</h2>

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
                                                <input type="hidden" name="oldimg" value="<?php echo $show_slide['s_image_file'];?>">
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>

                            <input type="submit" name="bteditslide" class="btn btn-outline-success  btn-lg px-5" value="แก้ไขรูปสไลด์">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>