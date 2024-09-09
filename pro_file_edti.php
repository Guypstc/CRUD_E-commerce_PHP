<?php
    require('connect.php');
    session_start();
    if(isset($_SESSION['m_id'])){
        $sql_user_run = mysqli_query($connect,"SELECT * FROM tb_member WHERE m_id = '".$_SESSION['m_id']."'");
        $sql_user_show = mysqli_fetch_array($sql_user_run,MYSQLI_BOTH);
        $sql_user_count = mysqli_num_rows($sql_user_run);

    }

        if(!empty($_POST['btregis'])){
            $er_mes = '';
                //User
             
                $m_email = $_POST['m_email'];
                $m_pass = $_POST['m_pass'];
                $m_name = $_POST['m_name'];
                $m_add = $_POST['m_add'];
                $m_sub = $_POST['m_sub'];
                $m_dis = $_POST['m_dis'];
                $m_pro = $_POST['m_pro'];
                $m_zip = $_POST['m_zip'];
                $m_tel = $_POST['m_tel'];
 
                //Insert
                if(empty($er_mes)){
                    mysqli_query($connect,"UPDATE `tb_member` SET `m_user`='$m_user',`m_email`='$m_email',`m_pass`='$m_pass',`m_name`='$m_name',`m_tel`='$m_tel',`Address`='$m_add',`Subdistrict`='$m_sub',`District`='$m_dis',`Province`='$m_pro',`Zipcode`='$m_zip' 
                    WHERE m_id = '".$_GET['edituser']."' ");
                        if(!empty($filename)){
                            move_uploaded_file($m_image['tmp_name'],'images/member/'.$filename);
                        }
                    header("location:pro_file.php");
                }else{
                    $_SESSION['error'] = $er_mes;
                }
        }
        $rs_profile = mysqli_query($connect,"SELECT * FROM `tb_member` WHERE  m_id = '".$_GET['edituser']."'");
        $show_profile = mysqli_fetch_array($rs_profile);
?>
<?php if(isset($_SESSION['m_id'])){ ?>
    <?php if($_SESSION['m_id'] == $sql_user_show['m_id'] && $sql_user_count > 0){ ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <?php require('head.php') ?>
        </head>
        <body>
            <?php require('menu_up.php') ?>
            <?php require('menu.php') ?>
            <div class="container my-3">
                <div class="shadow">
                    <div class="list-group-item list-group-item-secondary">
                        <h3 class="text-center">ข้อมูลของคุณ</h3>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="list-group-item p-5">
                        <div class="row">
                            <div class="col-3">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <img src="images/member/<?php echo $sql_user_show['m_image']; ?>" alt="" class="card-img-top" height="200">
                                    </div>
                                    <div class="list-group-item bg-light">
                                        <div class="input-group">
                                            <input type="file" name="" id="" class="form-control">
                                            <input type="submit" value="แก้ไข" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-9">
                                <div class="list-group-item overflow-auto" style="height: 450px">
                                    <span><b>ชื่อ: </b></span>
                                    <span><input type="text" name="m_name" class="form-control" value="<?php echo $show_profile['m_name']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                   
                                    <span><b>Password: </b></span>
                                    <span><input type="text" name="m_pass" class="form-control" value="<?php echo $show_profile['m_pass']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>อีเมล์: </b></span>
                                    <span><input type="text" name="m_email" class="form-control" value="<?php echo $show_profile['m_email']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>เบอร์โทรศัพท์: </b></span>
                                    <span><input type="text" name="m_tel" class="form-control" value="<?php echo $show_profile['m_tel']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>บ้านเลขที่: </b></span>
                                    <span><input type="text" name="Address" class="form-control" value="<?php echo $show_profile['m_add']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>ตำบล: </b></span>
                                    <span><input type="text" name="Subdistrict" class="form-control" value="<?php echo $show_profile['m_sub']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>อำเภอ: </b></span>
                                    <span><input type="text" name="District" class="form-control" value="<?php echo $show_profile['m_dis']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>จังหวัด: </b></span>
                                    <span><input type="text" name="Province" class="form-control" value="<?php echo $show_profile['m_pro']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>รหัสไปรษณีย์: </b></span>
                                    <span><input type="text" name="Zipcode" class="form-control" value="<?php echo $show_profile['m_zip']; ?>"></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                </div>
                                <div class="list-group-item text-end bg-light">
                                    <input type="submit" class="btn btn-success" name="btregis" value="แก้ไข">
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </body>
        </html>
    <?php }else{
        echo 56456454;
        //header('location: index.php');
    } ?>
<?php }else{
    echo 444444;
    //header('location: index.php');
} ?>