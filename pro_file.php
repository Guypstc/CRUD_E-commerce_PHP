<?php
    require('connect.php');
    session_start();
    if(isset($_SESSION['m_id'])){
        $sql_user_run = mysqli_query($connect,"SELECT * FROM tb_member WHERE m_id = '".$_SESSION['m_id']."'");
        $sql_user_show = mysqli_fetch_array($sql_user_run,MYSQLI_BOTH);
        $sql_user_count = mysqli_num_rows($sql_user_run);

    }



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
                    <div class="list-group-item p-5">
                        <div class="row">
                            <div class="col-3">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <img src="images/member/<?php echo $sql_user_show['m_image']; ?>" alt="" class="card-img-top" height="250">
                                    </div>
                                    <form action="edir_img_profile.php" method="post"  enctype="multipart/form-data">
                                    <div class="list-group-item bg-light">
                                        <div class="input-group">
                                            <input type="file" name="imgprofile" id="" class="form-control">
                                            <input type="submit" name="iii" value="แก้ไขรูป" class="btn btn-success">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="list-group-item overflow-auto" style="height: 450px">
                                    <span><b>ชื่อ: </b></span>
                                    <span><?php echo $sql_user_show['m_name'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>อีเมล์: </b></span>
                                    <span><?php echo $sql_user_show['m_email'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>Password: </b></span>
                                    <span><?php echo $sql_user_show['m_pass'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                  
                                    <!-------------------------------------------------------->
                                    <span><b>เบอร์โทรศัพท์: </b></span>
                                    <span><?php echo $sql_user_show['m_tel'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>บ้านเลขที่: </b></span>
                                    <span><?php echo $sql_user_show['m_add'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>ตำบล: </b></span>
                                    <span><?php echo $sql_user_show['m_sub'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>อำเภอ: </b></span>
                                    <span><?php echo $sql_user_show['m_dis'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>จังหวัด: </b></span>
                                    <span><?php echo $sql_user_show['m_pro'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                    <span><b>รหัสไปรษณีย์: </b></span>
                                    <span><?php echo $sql_user_show['m_zip'] ?></span>
                                    <hr>
                                    <!-------------------------------------------------------->
                                </div>
                                <div class="list-group-item text-end bg-light">
                                    <a class="btn btn-success" href="pro_file_edti.php?edituser=<?php echo $sql_user_show['m_id']; ?>">แก้ไข</a>
                                </div>
                            </div>
                        </div>
                    </div>
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