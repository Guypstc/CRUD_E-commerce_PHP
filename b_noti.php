<?php
    require('connect.php');
    session_start();
    $sql_board_noti_run = mysqli_query($connect,"SELECT * FROM tb_board b LEFT JOIN tb_product p ON p.pro_id = b.pro_id WHERE b.b_parent_id = 0 ORDER BY b.b_id DESC" );
?>
<?php if(isset($_SESSION['m_id'])){ ?>
    <?php if($_SESSION['m_level'] == 1){ ?>
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
              <div class="container mt-3">
                <div class="list-group">
                    <div class="list-group-item list-group-item-secondary">
                        <h3 class="text-center">รายงานกระทู้</h3>
                    </div>
                    <div class="list-group-item">
                            <div class="">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 25%">สินค้า</th>
                                                <th class="text-center" style="width: 50%">คำถาม</th>
                                                <th class="text-center" style="width: 25%">จำนวนการตอบ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($sql_board_noti_show = mysqli_fetch_array($sql_board_noti_run,MYSQLI_BOTH)){ ?>
                                            <?php
                                                $count_rp_id = $sql_board_noti_show['b_id'];
                                                $sql_count_rp_b = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_board WHERE b_parent_id = '$count_rp_id'"))    
                                            ?>
                                                <tr>
                                                    <td style="width: 25%" >
                                                        <span><a href="show_pro.php?pro_id=<?php echo $sql_board_noti_show['pro_id'] ?>"><?php echo $sql_board_noti_show['pro_name'] ?></a></span>
                                                    </td>
                                                    <td style="width: 50%">
                                                        <span><a href="testviewboard.php?id=<?php echo $sql_board_noti_show['b_id'] ?>"><?php echo $sql_board_noti_show['b_topic'] ?></a></span>
                                                        <?php if($sql_board_noti_show['read_status'] == 0){ ?>
                                                            <span class="badge rounded-pill bg-danger">ใหม่</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="width: 25%" class="text-center">
                                                        <?php echo $sql_count_rp_b ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
              </div>
    </body>
    </html>
<?php }else{
    header('location: index.php');
} ?>
<?php } ?>