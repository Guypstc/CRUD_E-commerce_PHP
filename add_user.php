<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['btadduser'])){
            $er_mes = '';
                //User
                if(!empty($_POST['m_user'])){
                    $m_user = $_POST['m_user'];
                    $chk_m_user = '/^[a-zA-Z0-9]{4,20}$/';
                        if(!preg_match($chk_m_user,$m_user)){
                            $er_mes .= 'ชื่อผู้ใช้งานต้องมีขนาด 4-20 ตัวอักษร<br/>';
                        }
                    $rs_m_user = mysqli_query($connect,"SELECT COUNT(*) As m_user FROM tb_member WHERE m_user = '".$m_user."'  ");
                    $show_m_user = mysqli_fetch_assoc($rs_m_user);
                        if($show_m_user['m_user'] > 0){
                            $er_mes .= 'ชื่อผู้ใช้งานนี้มีอยู่ในระบบแล้ว<br/>';
                        }
                }else{
                    $er_mes .= 'กรุณากรอกชื่อผู้ใช้งาน<br/>';
                }
                //Pass
                if(!empty($_POST['m_pass']) && !empty($_POST['con_m_pass'])){
                    $m_pass = $_POST['m_pass'];
                    $con_m_pass = $_POST['con_m_pass'];
                        if($m_pass != $con_m_pass){
                            $er_mes .= 'รหัสผ่านทั้งสองช่องไม่ตรงกัน<br/>';
                        }
                }else{
                    $er_mes .= 'กรุณากรอกรหัสผ่านทั้งสองช่อง<br/>';
                }
                //Name
                if(!empty($_POST['m_name'])){
                    $m_name = $_POST['m_name'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อจริง-นามสกุล<br/>';
                }
                //Email
                if(!empty($_POST['m_email'])){
                    $m_email = $_POST['m_email'];
                    $chk_m_email = '/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+\.[a-zA-Z]+$/';
                        if(!preg_match($chk_m_email,$m_email)){
                            $er_mes .= 'รูปแบบอีเมลไม่ถูกต้อง<br/>';
                        }
                    $rs_m_email = mysqli_query($connect,"SELECT COUNT(*) As m_email FROM tb_member WHERE m_email = '".$m_email."'  ");
                    $show_m_email = mysqli_fetch_assoc($rs_m_email);
                        if($show_m_email['m_email'] > 0){
                            $er_mes .= 'อีเมลนี้มีอยู่ในระบบแล้ว<br/>';
                        }
                }else{
                    $er_mes .= 'กรุณากรอกอีเมล<br/>';
                }
                //Tel 
                if(!empty($_POST['m_tel'])){
                    $m_tel = $_POST['m_tel'];
                    $chk_m_tel = '/^[0-9]{10}$/';
                        if(!preg_match($chk_m_tel,$m_tel)){
                            $er_mes .= 'เบอร์โทรไม่ถูกต้อง<br/>';
                        }
                }else{
                    $er_mes .= 'กรุณากรอกเบอร์โทร<br/>';
                }
                //Address
                if(!empty($_POST['m_add'])){
                    $m_add = $_POST['m_add'];
                }else{
                    $er_mes .= 'กรุณากรอกที่อยู่<br/>';
                }
                //Subdistict
                if(!empty($_POST['m_sub'])){
                    $m_sub = $_POST['m_sub'];
                }else{
                    $er_mes .= 'กรุณากรอกตำบล<br/>';
                }
                //Distict
                if(!empty($_POST['m_dis'])){
                    $m_dis = $_POST['m_dis'];
                }else{
                    $er_mes .= 'กรุณากรอกอำเภอ<br/>';
                }
                //Province
                if(!empty($_POST['m_pro'])){
                    $m_pro = $_POST['m_pro'];
                }else{
                    $er_mes .= 'กรุณากรอกจังหวัด<br/>';
                }
                //Zipcode
                if(!empty($_POST['m_zip'])){
                    $m_zip = $_POST['m_zip'];
                }else{
                    $er_mes .= 'กรุณากรอกรหัสไปรษณีย์<br/>';
                }
                //Image
                if(!empty($_FILES['m_image'])){
                    $m_image = $_FILES['m_image'];
                    $tmp = explode('.',$m_image['name']);
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
                    mysqli_query($connect,"INSERT INTO `tb_member`( `m_user`, `m_email`, `m_pass`, `m_level`, `m_name`, `m_tel`, `m_image`, `Address`, `Subdistrict`, `District`, `Province`, `Zipcode`, ) 
                    VALUES ('$m_user','$m_email','$m_pass','2','$m_name','$m_tel','$filename','$m_add','$m_sub','$m_dis','$m_pro','$m_zip')");
                        if(!empty($filename)){
                            move_uploaded_file($m_image['tmp_name'],'images/member/'.$filename);
                        }
                        echo '<script type="text/Javascript">  ';
                        echo 'alert("เพิ่มผู้ใช้งานเรียบร้อย"); window.location="show_user.php" ;</script>';
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
    <?php include ('head.php'); ?>
    <style>
        .bg {
            background: linear-gradient(to right, rgba(255, 0, 0, 0.9), rgba(37, 117, 252, 0.9));

            background-size: 150% auto;
            animation: gradient 13s linear infinite;
        }
        
    </style>
</head>
<body class="bg">
<?php include ('chk_id.php'); include ('menu.php'); ?>
    <div class="container py-4">
        <div class="row d-flex justify-conntent-center align-item-center">
            <div class="card cascading-right" style="border-radius : 1rem; background : hsla(0,0%,100%,0.55); backdrop-filter : bulr(50px);">
                <div class="card-body p-5 text-center">  
                    <div class="m-mt-5 pb-5">
                        <h2 class="fw-bold text-uppercase mb-4">เพิ่มสมาชิก</h2>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-4 container" role="alert">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                        <?php $_SESSION['error'] = ''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row mb-4">
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="m_user" placeholder="ชื่อผู้ใช้งาน">
                                        <label>ชื่อผู้ใช้งาน</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="password" class="form-control" name="m_pass" placeholder="รหัสผ่าน">
                                        <label>รหัสผ่าน</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="password" class="form-control" name="con_m_pass" placeholder="ยืนยันรหัสผ่าน">
                                        <label>ยืนยันรหัสผ่าน</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="m_name" placeholder="ชื่อ-นามสกุล/Fullname">
                                        <label>ชื่อ-นามสกุล/Fullname</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="email" class="form-control" name="m_email" placeholder="อีเมล/Email">
                                        <label>อีเมล/Email</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="m_tel" placeholder="เบอร์โทร/Tel">
                                        <label>เบอร์โทร/Tel</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="m_add" placeholder="บ้านเลขที่/Address">
                                        <label>บ้านเลขที่/Address</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="m_sub" placeholder="ตำบล/Subdistict">
                                        <label>ตำบล/Subdistict</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="m_dis" placeholder="อำเภอ/Distict">
                                        <label>อำเภอ/Distict</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="m_pro" placeholder="จังหวัด/Province">
                                        <label>จังหวัด/Province</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-floating text-dark">
                                        <input type="text" class="form-control" name="m_zip" placeholder="รหัสไปรษณีย์/Zipcode">
                                        <label>รหัสไปรษณีย์/Zipcode</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                   <div class="form-control">
                                        <div class="row p-1">
                                            <div class="col-3">รูปภาพ</div>
                                            <div class="col-9">
                                                <input type="file" name="m_image" class="form-control"> 
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                            <input type="submit" name="btadduser" class="btn btn-outline-success  btn-lg px-5" value="เพิ่มสมาชิก">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>