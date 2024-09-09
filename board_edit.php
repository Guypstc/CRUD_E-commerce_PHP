<?php
    require('connect.php');
    session_start();
    if(isset($_GET['b_id']) || isset($_GET['id'])){
        if(isset($_GET['b_id'])){
            $e_id = $_GET['b_id'];
        }
        if(isset($_GET['id'])){
            $e_id = $_GET['id'];
        }
        $sql_b_check_run = mysqli_query($connect,"SELECT * FROM tb_board WHERE b_parent_id = 0 AND b_id='$e_id'");
        $sql_b_check_show = mysqli_fetch_array($sql_b_check_run,MYSQLI_BOTH);
        $sql_b_check_count = mysqli_num_rows($sql_b_check_run);
    }
?>
<?php if(isset($_SESSION['m_id']) && (!isset($_GET['b_id']) || !isset($_GET['id']))){ ?>
        <?php if(  $sql_b_check_count > 0 && ( $sql_b_check_show['m_id'] == $_SESSION['m_id'] || $_SESSION['m_level'] == 1 ) && ( isset($_GET['b_id']) || isset($_GET['id']) )  ){ ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <?php require("head.php") ?>
            </head>
            <body>
                <?php require("menu_up.php") ?>
                <?php require("menu.php") ?>
                <form action="get_b_edit.php" method="post">
                    <div class="container mt-3">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-secondary">
                                <h3 class="text-center">แก้ไขคำภาม</h3>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group">
                                    <label for="">หัวข้อ</label>
                                    <input type="text" name="t" id="" class="form-control" value="<?php echo $sql_b_check_show['b_topic'] ?>">
                                    <label for="">ข้อความ</label>
                                    <textarea name="d" id="" cols="30" rows="10" class="form-control"><?php echo $sql_b_check_show['b_detail'] ?></textarea>
                                    <input type="hidden" name="e_id" value="<?php echo $sql_b_check_show['b_id'] ?>">
                                    <?php if(isset($_GET['b_id'])){ ?>
                                        <input type="hidden" name="b_id" value="<?php echo $sql_b_check_show['b_id'] ?>">
                                    <?php }else if(isset($_GET['id'])){ ?>
                                        <input type="hidden" name="id" value="<?php echo $sql_b_check_show['b_id'] ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="list-group-item bg-light align-bottom text-center">
                                    <input type="submit" value="แก้ไข" class="btn btn-success" >
                                    <?php if(isset($_GET['b_id'])){ ?>
                                        <a href="show_pro.php?id=<?php echo $sql_b_check_show['pro_id'] ?>" class="btn btn-danger">ยกเลิก</a>
                                    <?php }else if(isset($_GET['id'])){ ?>
                                        <a href="testviewboard?id=<?php echo $sql_b_check_show['b_id'] ?>" class="btn btn-danger">ยกเลิก</a>
                                    <?php } ?>
                                </div>
                        </div>
                    </div>
                </form>
                <?php require('footer.php') ?>
            </body>
            </html>            
        <?php }else{ 
            header("location: index.php");
            } ?>
<?php }else{
    header("location: index.php");
} ?>