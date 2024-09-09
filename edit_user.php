<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['btedit'])){
            $er_mes = '';
                //User
                if(!empty($_POST['m_user'])){
                    $m_user = $_POST['m_user'];
                    $chk_m_user = '/^[a-zA-Z0-9]{4,20}$/';
                        if(!preg_match($chk_m_user,$m_user)){
                            $er_mes .= 'ชื่อผู้ใช้งานต้้องมีขนาด 4-20 ตัวอักษร<br/>'; 
                        }
                }else{
                    $er_mes .= 'กรุณากรอกชื่อผู้ใช้งาน<br/>'; 
                }

                //Name
                if(!empty($_POST['m_name'])){
                    $m_name = $_POST['m_name'];
                }else{
                    $er_mes .= 'กรุณากรอกชื่อจริง<br/>'; 
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
                //Email
                if(!empty($_POST['m_email'])){
                    $m_email = $_POST['m_email'];
                    $chk_m_email = '/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+\.[a-zA-Z]+$/';
                        if(!preg_match($chk_m_email,$m_email)){
                            $er_mes .= 'รูปแบบอีเมลไม่ถูกต้อง<br/>'; 
                        }
                }else{
                    $er_mes .= 'กรุณากรอกอีเมล<br/>'; 
                }
                //m_add
                if(!empty($_POST['m_add'])){
                    $m_add = $_POST['m_add'];
                }else{
                    $er_mes .= 'กรุณากรอกที่อยู่<br/>'; 
                }
                //m_sub
                if(!empty($_POST['m_sub'])){
                    $m_sub = $_POST['m_sub'];
                }else{
                    $er_mes .= 'กรุณากรอกตำบล<br/>'; 
                }
                //m_dis
                if(!empty($_POST['m_dis'])){
                    $m_dis = $_POST['m_dis'];
                }else{
                    $er_mes .= 'กรุณากรอกอำเภอ<br/>'; 
                }
                //m_pro
                if(!empty($_POST['m_pro'])){
                    $m_pro = $_POST['m_pro'];
                }else{
                    $er_mes .= 'กรุณากรอกจังหวัด<br/>'; 
                }
                //Image
                if(!empty($_FILES['m_image']['name'])){
                    $m_image = $_FILES['m_image'];
                    $tmp = explode('.',$m_image['name']);
                    $filetype = end($tmp);
                        if($filetype != 'jpeg' && $filetype != 'jpg' && $filetype != 'png'){
                            $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                        }else{
                            $filename  = date('dmyHis').'.'.$filetype; 
                            move_uploaded_file($_FILES['m_image']['tmp_name'],'images/member/'.$filename);
                            @unlink("images/member/".$_POST['oldimg']);
                        }
                }
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"UPDATE `tb_member` SET ``m_image`='$filename',
                     WHERE m_id = '".$_GET['edituser']."' "); 
                        header('location:show_user.php');
                }else{
                    $_SESSION['error'] = $er_mes;
                }
        }
        $rs_member = mysqli_query($connect,"SELECT * FROM `tb_member` WHERE m_id = '".$_GET['edituser']."'  ");
        $show_member = mysqli_fetch_array($rs_member);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้ใช้งาน</title>
    <?php include ('head.php'); ?>
    <style>
        .bg{
            background : linear-gradient(to top,rgba(300,300,1,1),rgb(100,255,1,1));
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
                        <h1 class="fw-bold text-uppercase mb-5">เพิ่มผู้ใช้งาน</h1>

                        <?php if(!empty($_SESSION['error'])){ ?>
                            <div class="alert alert-danger col-4 container" role="alert">
                                <?php echo $_SESSION['error'];?>
                            </div> 
                        <?php $_SESSION['error'] =''; } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="m_user" class="form-control" placeholder="ชื่อผู้ใช้งาน" value="<?php echo $show_member['m_user']; ?>">
                                    <label>ชื่อผู้ใช้งาน</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="m_name" class="form-control" placeholder="ชื่อจริง-นามสุกล" value="<?php echo $show_member['m_name']; ?>">
                                    <label>ชื่อจริง-นามสุกล</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="m_tel" class="form-control" placeholder="เบอร์โทร" value="<?php echo $show_member['m_tel']; ?>" >
                                    <label>เบอร์โทร</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="m_email" class="form-control" placeholder="อีเมล" value="<?php echo $show_member['m_email']; ?>">
                                    <label>อีเมล</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="m_add" class="form-control" placeholder="บ้านเลขที่" value="<?php echo $show_member['Address']; ?>">
                                    <label>บ้านเลขที่</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="m_sub" class="form-control" placeholder="ตำบล" value="<?php echo $show_member['Subdistrict']; ?>">
                                    <label>ตำบล</label>
                                </div>
                        </div>
                        <div class="row mb-4">
                            
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="m_dis" class="form-control" placeholder="อำเภอ" value="<?php echo $show_member['District']; ?>">
                                    <label>อำเภอ</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-floating text-dark">
                                    <input type="text" name="m_pro" class="form-control" placeholder="จังหวัด" value="<?php echo $show_member['Province']; ?>">
                                    <label>จังหวัด</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-control text-dark">
                                    <div class="row p-1">
                                        <div class="col-3">
                                            <label>รูปภาพ</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="file" name="m_image" class="form-control">
                                            <input type="hidden" name="oldimg" value="<?php echo $show_member["m_image"];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="btedit" class="btn btn-outline-success btn-lg px-5" value="เพิ่มผู้ใช้งาน">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>