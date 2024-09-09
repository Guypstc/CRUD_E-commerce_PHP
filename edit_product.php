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
                    $er_mes .= 'กรุณากรอกรายละเอียดสินค้า<br/>'; 
                }


                
                if(!empty($_FILES['pro_image1']['name'])){
                    $pro_image1 = $_FILES['pro_image1'];
                    $tmp = explode('.',$pro_image1['name']);
                    $filetype = end($tmp);
                        if($filetype != 'jpeg' && $filetype != 'jpg' && $filetype != 'png' && $filetype != 'PNG'){
                            $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                        }else{
                            $filename1  = date('dmyHis').'0.'.$filetype; 
                            move_uploaded_file($_FILES['pro_image1']['tmp_name'],'images/product/'.$filename1);
                            @unlink("images/product/".$_POST['old1']);
                        }
                }
                if(!empty($_FILES['pro_image2']['name'])){
                    $pro_image2 = $_FILES['pro_image2'];
                    $tmp = explode('.',$pro_image2['name']);
                    $filetype = end($tmp);
                        if($filetype != 'jpeg' && $filetype != 'jpg' && $filetype != 'png' && $filetype != 'PNG'){
                            $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                        }else{
                            $filename2  = date('dmyHis').'1.'.$filetype; 
                            move_uploaded_file($_FILES['pro_image2']['tmp_name'],'images/product/'.$filename2);
                            @unlink("images/product/".$_POST['old2']);
                        }
                }
                if(!empty($_FILES['pro_image3']['name'])){
                    $pro_image3 = $_FILES['pro_image3'];
                    $tmp = explode('.',$pro_image3['name']);
                    $filetype = end($tmp);
                        if($filetype != 'jpeg' && $filetype != 'jpg' && $filetype != 'png' && $filetype != 'PNG'){
                            $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                        }else{
                            $filename3  = date('dmyHis').'2.'.$filetype;
                            move_uploaded_file($_FILES['pro_image3']['tmp_name'],'images/product/'.$filename3); 
                            @unlink("images/product/".$_POST['old3']);
                        }
                }

                $t_id = $_POST['t_id'];
                $s_id = $_POST['s_id'];
                 //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"UPDATE `tb_product` SET `pro_name`='$pro_name',`pro_image1`='$filename1',`pro_image2`='$filename2',`pro_image3`='$filename3',`pro_num`='$pro_num',`pro_price`='$pro_price',`pro_detail`='$pro_detail',`s_id`='$s_id',`t_id`='$t_id' WHERE pro_id = '".$_GET['editpro']."'");
                    header('location:show_product.php');
                }else{
                    $_SESSION['error'] = $er_mes;
                }
        }
        $rs_pro = mysqli_query($connect,"SELECT * FROM `tb_product` WHERE pro_id = '".$_GET['editpro']."' ");
        $show_pro = mysqli_fetch_array($rs_pro);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขสินค้า</title>
    <?php include ('head.php'); ?>
    <style>
        .bg{
            background : linear-gradient(to right,rgba(300,300,1,1),rgb(100,255,1,1));
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
                        <h1 class="fw-bold text-uppercase mb-5">แก้ไขสินค้า</h1>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-4 container" role="alert">
                                <?php echo $_SESSION['error'];?>
                            </div> 
                        <?php $_SESSION['error'] =''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="pro_name" class="form-control" placeholder="ชื่อสินค้า" value="<?php echo $show_pro['pro_name'] ;?>">
                                    <label>ชื่อสินค้า</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="pro_num" class="form-control" placeholder="จำนวนสินค้า" value="<?php echo $show_pro['pro_num'] ;?>">
                                    <label>จำนวนสินค้า</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="pro_price" class="form-control" placeholder="ราคาสินค้า" value="<?php echo $show_pro['pro_price'] ;?>">
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
                                            <input type="hidden" name="old1" value="<?php echo $show_pro['pro_image1'];?>">
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
                                            <input type="hidden" name="old2" value="<?php echo $show_pro['pro_image2'];?>">
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
                                            <input type="hidden" name="old3" value="<?php echo $show_pro['pro_image3'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                        <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="pro_detail" class="form-control" placeholder="รายละเอียดสินค้า" value="<?php echo $show_pro['pro_detail'] ;?>">
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
                        <div class="col-12 col-lg-4">
                            <select name="s_id" class="form-select form-select-lg">
                                <option value="">เลือกสถานะสินค้า :</option>
                                <option value="1">สินค้าใหม่</option>
                                <option value="2">สินค้าแนะนำ</option>
                                <option value="3">สินค้าลดราคา20%</option>
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

