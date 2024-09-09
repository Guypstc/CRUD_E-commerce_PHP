<?php
    require('connect.php');
    session_start();
    if(isset($_GET['id'])){
        $select_pro_id = $_GET['id'];
        $sql_pro_select_run = mysqli_query($connect,"SELECT * FROM tb_product WHERE pro_id='$select_pro_id'");
        $sql_select_pro_show = mysqli_fetch_array($sql_pro_select_run,MYSQLI_BOTH);
        $sql_pro_select_check = mysqli_num_rows($sql_pro_select_run);

        $sql_b_run = mysqli_query($connect,"SELECT* FROM tb_board b LEFT JOIN tb_member m ON b.m_id = m.m_id WHERE b.pro_id = '$select_pro_id' AND b.b_parent_id = 0");
        $sql_b_count = mysqli_num_rows($sql_b_run);
    }
?>
<?php if(isset($_GET['id'])){ ?>
        <?php if($sql_pro_select_check > 0){ ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <?php require('head.php') ?>
            </head>
            <body >
            <?php require('menu_up.php') ?>
            <?php require('menu.php') ?>
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="card p-2">
                                
                                <div class="carousel slide" id="promodal" data-bs-interval="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="images/product/<?php echo $sql_select_pro_show['pro_image1']; ?>" alt="" class="w-100 d-block" height="500">
                                        </div>
                                        <div class="carousel-item ">
                                            <img src="images/product/<?php echo  $sql_select_pro_show['pro_image2']; ?>" alt="" class="w-100 d-block" height="500">
                                        </div>
                                        <div class="carousel-item ">
                                            <img src="images/product/<?php echo $sql_select_pro_show['pro_image3']; ?>" alt="" class="w-100 d-block" height="500">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" data-bs-target="#promodal" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" data-bs-target="#promodal" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                            <div class=" p-2 border text-center mt-2">
                                <button class="btn" data-bs-slide-to="0" data-bs-target="#promodal">
                                    <img src="images/product/<?php echo $sql_select_pro_show['pro_image1']; ?>" alt="" height="50" width="50">
                                </button>
                                <button class="btn" data-bs-slide-to="1" data-bs-target="#promodal">
                                    <img src="images/product/<?php echo  $sql_select_pro_show['pro_image2']; ?>" alt="" height="50" width="50">
                                </button>
                                <button class="btn" data-bs-slide-to="2" data-bs-target="#promodal">
                                    <img src="images/product/<?php echo $sql_select_pro_show['pro_image3']; ?>" alt="" height="50" width="50">
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="list-group">
                                    <div class="list-group-item list-group-item-secondary">
                                        <h3 class="text-center">รายละเอียด</h3>
                                    </div>
                                    <div class="list-group-item overflow-auto" style="height: 495px">

                                        <hr>
                                        <span><b>ชื่อสินค้า: </b></span>
                                        <span><?php echo $sql_select_pro_show['pro_name'] ?></span>

                                        <hr>
                                        <?php if($sql_select_pro_show['s_id'] == 3){ ?>
                                            <?php
                                                $new = $sql_select_pro_show['pro_price'] - ($sql_select_pro_show['pro_price']*0.20);    
                                            ?>
                                            <span><b>ราคาสินค้า: </b></span>
                                            <span><?php echo $new ?> บาท</span>
                                            <span class="text-success">(SALE 20 %)</span>
                                        <?php }else{?>
                                            <span><b>ราคาสินค้า: </b></span>
                                            <span><?php echo $sql_select_pro_show['pro_price'] ?> บาท</span>
                                        <?php } ?>

                                        <hr>
                                        <?php if($sql_select_pro_show['pro_num'] > 0){ ?>
                                            <span><b>จำนวนคงเหลือ: </b></span>
                                            <span><?php echo $sql_select_pro_show['pro_num'] ?> ชิ้น</span>
                                        <?php }else{ ?>
                                            <span><b>จำนวนคงเหลือ: </b></span>
                                            <span class="text-danger">สิ้นค้าหมด</span>
                                        <?php } ?>

                                        <hr>
                                        <span><b>รายละเอียดสินค้า: </b></span>
                                        <span><?php echo $sql_select_pro_show['pro_detail']?></span>
                                    </div>
                                    <div class="list-group-item text-center bg-light" style="height: 55px">
                                        <?php if($sql_select_pro_show['pro_num'] > 0){ ?>
                                                <div class="text-end">
                                                    <?php if(empty($_SESSION['m_id'])){  ?>
                                                        <button type="button" class="text-dark btn btn-outline-warning" disabled>เพิ่มสินค้าลงตะกร้า</button>
                                                    <?php }else if($_SESSION['m_id'] == 1) { ?>
                                                        <button type="button" class="text-dark btn btn-outline-warning" disabled>เพิ่มสินค้าลงตะกร้า</button>
                                                        <?php }else{ ?>
                                                            <a class="btn btn-warning" href="order.php?id=<?php echo $sql_select_pro_show['pro_id'] ; ?>">เพิ่มสินค้าลงตะกร้า</a>  
                                                            <?php } ?> 
                                                </div>
                                        <?php }else{ ?>
                                                <b class="text-center text-muted">สินค้าหมด</b>
                                        <?php } ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card p-2 mt-3 float-bottom">
                        <div class="mb-3 text-end">
                            <?php if(!isset($_SESSION['m_id'])){ ?>
                                    <a href="login1.php" class="btn btn-outline-secondary">เข้าสู่ระบบ</a>
                            <?php }else{ ?>
                                    <a href="board_add.php?id=<?php echo $_GET['id'] ?>" class="btn btn-outline-success">เพิ่มคำถาม</a>
                            <?php } ?>
                        </div>
                        <?php if($sql_b_count > 0){ ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 50%">คำถาม</th>
                                        <th scope="col" class="text-center" style="width: 15%">ยอดดู</th>
                                        <th scope="col" class="text-center" style="width: 15%">ยอดตอบกลับ</th>
                                        <th scope="col" class="text-center" style="width: 20%">จัดการข้อความ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($sql_b_show = mysqli_fetch_array($sql_b_run,MYSQLI_BOTH)){ ?>
                                        <?php
                                            $rp_count_id = $sql_b_show['b_id'];
                                            $sql_rp_count_show = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_board WHERE b_parent_id = '$rp_count_id'"));
                                            
                                        ?>
                                            <tr>
                                                <td style="width: 50%">
                                                <span><a href="testviewboard.php?id=<?php echo $sql_b_show['b_id'] ?>"><?php echo $sql_b_show['b_topic'] ?></a></span>
                                                <?php if(isset($_SESSION['m_id'])){ ?>
                                                    <?php if($sql_b_show['read_status'] == 0 && $_SESSION['m_level'] == 1){ ?>
                                                        <span class="badge bg-danger rounded-pill">ใหม่</span>
                                                    <?php } ?>
                                                <?php } ?>
                                                <br>
                                                    <?php if(!isset($_SESSION['m_id'])){ ?>
                                                        <?php if( $sql_b_show['m_level'] == 1){ ?>
                                                                <b>ผู้โพส: ผู้ดูแลระบบ</b>
                                                        <?php }else{ ?>
                                                            <div>ผู้โพส: <?php echo $sql_b_show['m_name'] ?></div>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <?php if( $sql_b_show['m_level'] == 1){ ?>
                                                                <b>ผู้โพส: ผู้ดูแลระบบ</b>
                                                        <?php }else{ ?>
                                                            <?php if($_SESSION['m_id'] == $sql_b_show['m_id']){ ?>
                                                                    <b>ผู้โพส: คุณ</b>
                                                            <?php }else{ ?>
                                                            <div>ผู้โพส: <?php echo $sql_b_show['m_name'] ?></div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center" style="width: 15%"><?php echo $sql_b_show['b_views'] ?></td>
                                                <td class="text-center" style="width: 15%"><?php echo $sql_rp_count_show ?></td>
                                                <td class="text-center" style="width: 15%">
                                                    <?php if(!isset($_SESSION['m_id'])){ ?>
                                                            <h3>-</h3>
                                                    <?php }else{ ?>
                                                            <?php if($_SESSION['m_id'] == $sql_b_show['m_id'] || $_SESSION['m_level'] == 1){ ?>
                                                                    <span><a href="board_edit.php?b_id=<?php echo $sql_b_show['b_id'] ?>">แก้ไข</a></span>
                                                                    <span>/</span>
                                                                    <span><a href="del_board.php?id=<?php echo $sql_b_show['b_id'] ?>" onclick="return confirm('ต้องการลบคำถามนี้หรือไม่')">ลบข้อมูล</a></span>
                                                            <?php }else{ ?>
                                                                    <h3>-</h3>
                                                            <?php } ?>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php }else{ ?>
                                <b class="text-muted text-center">ไม่มีข้อความ</b>
                         <?php } ?>
                    </div>
                </div>
                <div class="modal fade" id="pro_modal">
                    <div class="modal-dialog">
                        <div class="modal-content modal-sm">
                            <div class="modal-header">
                                <div class="modal-title"><h6><?php echo $sql_select_pro_show['pro_name'] ?></h6></div>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>    
                            <div class="modal-body">
                                <div class="d-grid gap-2 p-3">
                                    <a href="" class="btn btn-outline-info">LAZADA</a>
                                    <a href="" class="btn btn-outline-warning">SHOPEE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require('footer.php'); ?>
            </body>
            </html>
        <?php }else{
           //header('location: index.php');
        } ?>
<?php }else{
    header("location: index.php");
} ?>