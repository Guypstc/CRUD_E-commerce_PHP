<?php
    session_start();
  
    include ('connect.php');
        if(!empty($_POST['btpro'])){
            $er_mes = '';         

                if(!empty($_POST['pro_name'])){
                    $pro_name = $_POST['pro_name'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อสินค้า<br/>'; 
                }
                if(!empty($_POST['pro_num'])){
                    $pro_num = $_POST['pro_num'];
                }else{
                    $er_mes .= 'กรุณากรอกจำนวนสินค้า<br/>'; 
                }
                if(!empty($_POST['pro_price'])){
                    $pro_price = $_POST['pro_price'];
                }else{
                    $er_mes .= 'กรุณากรอกราคาสินค้า<br/>'; 
                }
                if(!empty($_POST['pro_detail'])){
                    $pro_detail = $_POST['pro_detail'];
                }else{
                    $er_mes .= 'กรุณากรอกราคาสินค้า<br/>'; 
                }

                if(!empty($_FILES['pro_image1']['name'])){
                    $pro_image1 = $_FILES['pro_image1'];
                    $tmp = explode('.',$pro_image1['name']);
                    $filetype = end($tmp);
                        if($filetype != 'jpeg' && $filetype != 'JPGE' && $filetype != 'jpg' && $filetype != 'JPG' && $filetype != 'png' && $filetype != 'PNG'){
                            $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                        }else{
                            $filename1  = date('dmyHis').'0.'.$filetype; 
                        }
                }else{
                    $filename1 = '';
                }
                if(!empty($_FILES['pro_image2']['name'])){
                    $pro_image2 = $_FILES['pro_image2'];
                    $tmp = explode('.',$pro_image2['name']);
                    $filetype = end($tmp);
                        if($filetype != 'jpeg' && $filetype != 'jpg' && $filetype != 'png' && $filetype != 'PNG'){
                            $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                        }else{
                            $filename2  = date('dmyHis').'1.'.$filetype; 
                        }
                }else{
                    $filename2 = '';
                }
                if(!empty($_FILES['pro_image3']['name'])){
                    $pro_image3 = $_FILES['pro_image3'];
                    $tmp = explode('.',$pro_image3['name']);
                    $filetype = end($tmp);
                        if($filetype != 'jpeg' && $filetype != 'jpg' && $filetype != 'png' && $filetype != 'PNG'){
                            $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                        }else{
                            $filename3  = date('dmyHis').'2.'.$filetype; 
                        }
                }else{
                    $filename3 = '';
                }
                $t_id = $_POST['t_id'];
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"INSERT INTO `tb_product`(`pro_name`, `pro_image1`, `pro_image2`, `pro_image3`, `pro_num`, `pro_price`, `pro_detail`, `s_id`, `t_id`)
                    VALUES ('$pro_name','$filename1','$filename2','$filename3','$pro_num','$pro_price','$pro_detail','1',$t_id)");
                    if(!empty($filename1)){
                        move_uploaded_file($pro_image1['tmp_name'],'images/product/'.$filename1);
                    }   
                    if(!empty($filename2)){
                        move_uploaded_file($pro_image2['tmp_name'],'images/product/'.$filename2);
                    }   
                    if(!empty($filename3)){
                        move_uploaded_file($pro_image3['tmp_name'],'images/product/'.$filename3);
                    }   
                        header('location:show_product.php');
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
    <title>เพิ่มสินค้า</title>
    
    <?php 
      include ('chk_id.php');
    include ('head.php'); 
    ?>
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
        <div class="row d-flex justify-content-center align-item-center">
            <div class="card cascading-right" style="border-radius : 1rem; background : hsla(0,0%,100%,0.55); backdrop-filter : bulr(50px);">
                <div class="card-body p-5 text-center">
                    <div class="m-mt-5 pb-5">
                        <h1 class="fw-bold text-uppercase mb-5">เพิ่มสินค้า</h1>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-4 container" role="alert">
                                <?php echo $_SESSION['error'];?>
                            </div> 
                        <?php $_SESSION['error'] =''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="pro_name" class="form-control" placeholder="ชื่อสินค้า">
                                    <label>ชื่อสินค้า</label>
                                </div>
                            </div>
                            
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="pro_num" class="form-control" placeholder="จำนวนสินค้า">
                                    <label>จำนวนสินค้า</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="pro_price" class="form-control" placeholder="ราคาสินค้า">
                                    <label>ราคาสินค้า</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12 col-lg-4">
                                <div class="form-control text-dark">
                                    <div class="row p-1">
                                        <div class="col-3">
                                            <label>รูปภาพที่1</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="file" name="pro_image1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-control text-dark">
                                    <div class="row p-1">
                                        <div class="col-3">
                                            <label>รูปภาพที่2</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="file" name="pro_image2" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-control text-dark">
                                    <div class="row p-1">
                                        <div class="col-3">
                                            <label>รูปภาพที่3</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="file" name="pro_image3" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                        <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="pro_detail" class="form-control" placeholder="รายละเอียดสินค้า">
                                    <label>รายละเอียดสินค้า</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <select name="t_id" class="form-select form-select-lg">
                                <option value="">เลือกประเภทสินค้า</option>
                                    <?php 
                                        $rs_ty = mysqli_query($connect,"SELECT * FROM `tb_type`");
                                        while($row = mysqli_fetch_array($rs_ty)){
                                            echo "<option value=$row[t_id]>$row[t_name]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <input type="submit" name="btpro" class="btn btn-outline-success btn-lg px-5" value="เพิ่มสินค้า">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
