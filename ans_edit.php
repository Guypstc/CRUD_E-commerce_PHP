<?php
    require('connect.php');
    session_start();
    if(isset($_GET['id'])){
        $e_ans_id = $_GET['id'];
        $sql_board_e_ans_run = mysqli_query($connect,"SELECT * FROM tb_board WHERE b_id = '$e_ans_id' AND NOT b_parent_id = 0");
        $sql_board_e_ans_count = mysqli_num_rows($sql_board_e_ans_run);
        $sql_board_e_ans_show = mysqli_fetch_array($sql_board_e_ans_run,MYSQLI_BOTH);
    }
?>
<?php if(isset($_GET['id']) && isset($_SESSION['m_id'])){ ?>
            <?php if($sql_board_e_ans_count > 0 && ($sql_board_e_ans_show['m_id'] == $_SESSION['m_id'] || $_SESSION['m_level'] == 1 )){ ?>
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
                        <div class="list-group">
                            <div class="list-group-item list-group-item-secondary">
                                <h3 class="text-center">แก้ไขคำตอบ</h3>
                            </div>
                            <form action="get_ans_edit.php" method="post">
                                <div class="list-group-item p-2">
                                    <label for="">แก้ไขข้อความคำตอบ</label>
                                    <textarea name="text" id="" cols="30" rows="10" class="form-control"><?php echo $sql_board_e_ans_show['b_detail']?></textarea> 
                                    <input type="hidden" name="id" value="<?php echo $sql_board_e_ans_show['b_id'] ?>">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                </div>
                               <div class="list-group-item text-center bg-light">
                               <input class="btn btn-success" type="submit" value="ยืนยัน" name="btn_send">
                                <a href="" class="btn btn-danger">ยกเลิก</a>
                               </div>
                            </form>
                        </div>
                        </div>
                        <?php require('footer.php') ?>
                    </body>
                    </html>
            <?php }else{
            header('location: index.php');
    } ?>
<?php }else{
    header('location: index.php');
} ?>