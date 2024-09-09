<?php
    require("connect.php");
    session_start();
    $sql_type_run = mysqli_query($connect,"SELECT * FROM tb_type");
    $sql_modal_pro_run = mysqli_query($connect,"SELECT * FROM tb_product");

    $key = '';
    if(!empty($_POST['key'])){
      $key = $_POST['key'];
    }

    if(isset($_GET['t_id'])){
        $focus_t_id = $_GET['t_id'];
        $sql_focus_t_run = mysqli_query($connect,"SELECT * FROM tb_product WHERE t_id = '$focus_t_id' ");
        $sql_focus_t_count = mysqli_num_rows($sql_focus_t_run);
    }
    if(isset($_GET['s_id'])){
        $focus_s_id = $_GET['s_id'];
        $sql_focus_s_run = mysqli_query($connect,"SELECT * FROM tb_product WHERE s_id = '$focus_s_id'");
        $sql_focus_s_count = mysqli_num_rows($sql_focus_s_run);
    }
    if(isset($_POST['key'])){
        $search = $_POST['key'];
        $search_show = mysqli_query($connect,"SELECT * FROM tb_product WHERE tb_product.pro_name LIKE '%".$key."%' ");
        $search_count = mysqli_num_rows($search_show);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php require("head.php") ?>
    <style>
        section:hover{
            scale: 1.03;
            transition: 200ms;
            background-color: lightgray;
        }

        section{
            transition: 200ms;
        }
    </style>
</head>
<body>
<?php require("menu_up.php") ?>
<?php require("menu.php") ?>
<?php require("slide.php") ?>
        <?php if(isset($_GET['s_id'])){ ?>
            <?php if($sql_focus_s_count > 0){ ?>
                <div class="container">
                    <div class="row">
                        <?php while($sql_focus_s_show = mysqli_fetch_array($sql_focus_s_run,MYSQLI_BOTH)){ ?>
                            <section class="card p-2 m-1" style="width: 20rem" onclick="redirectToProductDetails('<?php echo $sql_focus_s_show['pro_id'] ?>')">
                                <div class="position-relative">
                                    <?php if($sql_focus_s_show['s_id'] == 1){ ?>
                                        <span class="badge rounded position-absolute end-0 top-0 bg-warning">NEW</span>
                                    <?php }else if($sql_focus_s_show['s_id'] == 3){ ?>
                                        <span class="badge rounded position-absolute end-0 top-0 bg-success">SALE 20%</span>
                                    <?php }else if($sql_focus_s_show['s_id'] == 2){ ?>
                                        <span class="badge rounded position-absolute end-0 top-0 bg-danger">HOT</span>   
                                    <?php } ?>
                                    <img src="images\product<?php echo $sql_focus_s_show['pro_image1']; ?>"  class="card-img-top" height="200">
                                </div>
                                <div class="card-body" style="width: 18rem; height: 200px">
                                        <h3 class="text-center"><?php echo $sql_focus_s_show['pro_name'] ?></h3>
                                        <?php if($sql_focus_s_show['s_id'] == 3){ ?>
                                            <del>ราคาเดิม: <?php echo $sql_focus_s_show['pro_price'] ?> บาท</del>
                                            <?php
                                                $new = $sql_focus_s_show['pro_price'] - ($sql_focus_s_show['pro_price'] * 0.2);    
                                            ?>
                                            <h5>ราคาใหม่: <?php echo number_format($new) ?> บาท</h5>    
                                        <?php }else{ ?>
                                            <h5>ราคา: <?php echo number_format($sql_focus_s_show['pro_price']) ?> บาท</h5>
                                        <?php } ?>
                                        <?php if($sql_focus_s_show['pro_num'] > 0){ ?>
                                            <h5>จำนวนทั้งหมด: <?php echo $sql_focus_s_show['pro_num'] ?> ชิ้น</h5>
                                        <?php }else{ ?>
                                                <span class="h5">จำนวนทั้งหมด: </span>
                                                <span class="h5 text-danger">สิ้นค้าหมด</span>
                                        <?php } ?>
                                </div>
                                <div class="align-bottom text-center">
                                    <a href="#" onclick="redirectToProductDetails('<?php echo $sql_focus_s_show['pro_id'] ?>')" class="btn btn-primary">ดูรายละเอียด</a>
                                    <?php if($sql_focus_s_show['pro_num'] > 0){ 
                                        $reslut = mysqli_query($conn,"SELECT * FROM tb_product");
                                            if(!empty($_SESSION['m_id'] == 1 )){ ?>
                                              <button type="button" class="text-dark btn btn-outline-warning" disabled>สั่งซื้อสินค้า</button>
                                       
                                    <?php }else if(empty($_SESSION['m_id'])){ ?>
                                        <button type="button" class="text-dark btn btn-outline-warning" disabled>สั่งซื้อสินค้า</button>
                                       
                                    <?php }else{ ?>
                                        <button class="text-dark btn btn-outline-warning" data-bs-target="#pro_<?php echo $sql_focus_s_show['pro_id'] ?>" data-bs-toggle="modal">สั่งซื้อสินค้า</button>
                                <?php } ?>
                                </div>
                            </section>
                        <?php } }?>
                    </div>
                </div>
            <?php }else{?>
                <div class="text-center">
                    <b class="text-muted ">ไม่พบสินค้า</b>
                </div>
            <?php } ?>
        <?php }else if(isset($_POST['key'])){ ?>
                        <?php
                            $sql_secrch_run = mysqli_query($connect,"SELECT DISTINCT t_id FROM tb_product WHERE tb_product.pro_name LIKE '%".$_POST['key']."%' ");
                            $sql_secrch_show = mysqli_num_rows($sql_secrch_run);    
                        ?>
            <?php while($sql_secrch_show_all = mysqli_fetch_array($sql_secrch_run,MYSQLI_BOTH)){ ?>
                        <?php
                            $sql_type_s_run = mysqli_query($connect,"SELECT * FROM tb_type WHERE t_id = '".$sql_secrch_show_all[0]."'");
                            $sql_type_s_show = mysqli_fetch_array($sql_type_s_run);
                            $sql_pro_in_type_run = mysqli_query($connect,"SELECT * FROM tb_product WHERE tb_product.pro_name LIKE '%".$_POST['key']."%' AND t_id = '$sql_secrch_show_all[0]' ");
                        ?>
                                <div class="container">
                                    <b><?php echo $sql_type_s_show['t_name'] ?></b>
                                    <div class="text-muted">(<?php echo $sql_type_s_show['t_name_eng'] ?>)</div>
                                    <div class="row">
                                        <?php while($sql_pro_in_type_show = mysqli_fetch_array($sql_pro_in_type_run,MYSQLI_BOTH)){ ?>
                                            <section class="card p-2 m-1" style="width: 20rem" onclick="redirectToProductDetails('<?php echo $sql_pro_in_type_show['pro_id'] ?>')">
                                                <div class="position-relative">
                                                    <?php if($sql_pro_in_type_show['s_id'] == 1){ ?>
                                                        <span class="badge rounded position-absolute end-0 top-0 bg-warning">NEW</span>
                                                    <?php }else if($sql_pro_in_type_show['s_id'] == 3){ ?>
                                                        <span class="badge rounded position-absolute end-0 top-0 bg-success">SALE 20%</span>
                                                    <?php }else if($sql_pro_in_type_show['s_id'] == 2){ ?>
                                                        <span class="badge rounded position-absolute end-0 top-0 bg-danger">HOT</span>   
                                                    <?php } ?>
                                                    <img src="images/product/<?php echo $sql_pro_in_type_show['pro_image1']; ?>"  class="card-img-top" height="200">
                                                </div>
                                                <div class="card-body" style="width: 18rem; height: 200px">
                                                        <h3 class="text-center"><?php echo $sql_pro_in_type_show['pro_name'] ?></h3>
                                                        <?php if($sql_pro_in_type_show['s_id'] == 3){ ?>
                                                            <del>ราคาเดิม: <?php echo $sql_pro_in_type_show['pro_price'] ?> บาท</del>
                                                            <?php
                                                                $new = $sql_pro_in_type_show['pro_price'] - ($sql_pro_in_type_show['pro_price'] * 0.2);    
                                                            ?>
                                                            <h5>ราคาใหม่: <?php echo number_format($new) ?> บาท</h5>    
                                                        <?php }else{ ?>
                                                            <h5>ราคา: <?php echo number_format($sql_pro_in_type_show['pro_price']) ?> บาท</h5>
                                                        <?php } ?>
                                                        <?php if($sql_pro_in_type_show['pro_num'] > 0){ ?>
                                                            <h5>จำนวนทั้งหมด: <?php echo $sql_pro_in_type_show['pro_num'] ?> ชิ้น</h5>
                                                        <?php }else{ ?>
                                                                <span class="h5">จำนวนทั้งหมด: </span>
                                                                <span class="h5 text-danger">สิ้นค้าหมด</span>
                                                        <?php } ?>
                                                </div>
                                                <div class="align-bottom text-center">
                                                    <a href="#" onclick="redirectToProductDetails('<?php echo $sql_pro_in_type_show['pro_id'] ?>')" class="btn btn-outline-primary">ดูรายละเอียด</a>
                                                    <?php if($sql_pro_in_type_show['pro_num'] > 0){ ?>                                                       
                                                        <a href="order.php?id=<?php echo $sql_pro_in_type_show['pro_id'] ?>" class="text-dark btn btn-outline-warning"><i class="bi bi-cart-plus me-2"></i>หยิบใส่ตะกร้า</a>
                                                        <?php ?>
                                                        <?php } ?>
                                                </div>
                                            </section>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                </div>
                <?php } ?>
        <?php }else if (isset($_GET['t_id'])){ ?>
            <?php  if($sql_focus_t_count > 0){ ?>
                <div class="container">
                    <div class="row">
                        <?php while($sql_focus_t_show = mysqli_fetch_array($sql_focus_t_run,MYSQLI_BOTH)){ ?>
                            <section class="card p-2 m-1" style="width: 20rem" onclick="redirectToProductDetails('<?php echo $sql_focus_t_show['pro_id'] ?>')">
                                <div class="position-relative">
                                    <?php if($sql_focus_t_show['s_id'] == 1){ ?>
                                        <span class="badge rounded position-absolute end-0 top-0 bg-warning">NEW</span>
                                    <?php }else if($sql_focus_t_show['s_id'] == 3){ ?>
                                        <span class="badge rounded position-absolute end-0 top-0 bg-success">SALE 20%</span>
                                    <?php }else if($sql_focus_t_show['s_id'] == 2){ ?>
                                        <span class="badge rounded position-absolute end-0 top-0 bg-danger">HOT</span>   
                                    <?php } ?>
                                    <img src="images/product/<?php echo $sql_focus_t_show['pro_image1']; ?>"  class="card-img-top" height="200">
                                </div>
                                <div class="card-body" style="width: 18rem; height: 200px">
                                        <h3 class="text-center"><?php echo $sql_focus_t_show['pro_name'] ?></h3>
                                        <?php if($sql_focus_t_show['s_id'] == 3){ ?>
                                            <del>ราคาเดิม: <?php echo $sql_focus_t_show['pro_price'] ?> บาท</del>
                                            <?php
                                                $new = $sql_focus_t_show['pro_price'] - ($sql_focus_t_show['pro_price'] * 0.2);    
                                            ?>
                                            <h5>ราคาใหม่: <?php echo number_format($new) ?> บาท</h5>    
                                        <?php }else{ ?>
                                            <h5>ราคา: <?php echo number_format($sql_focus_t_show['pro_price']) ?> บาท</h5>
                                        <?php } ?>
                                        <?php if($sql_focus_t_show['pro_num'] > 0){ ?>
                                            <h5>จำนวนทั้งหมด: <?php echo $sql_focus_t_show['pro_num'] ?> ชิ้น</h5>
                                        <?php }else{ ?>
                                                <span class="h5">จำนวนทั้งหมด: </span>
                                                <span class="h5 text-danger">สิ้นค้าหมด</span>
                                        <?php } ?>
                                </div>
                                <div class="align-bottom text-center">
                                    <a href="#" onclick="redirectToProductDetails('<?php echo $sql_focus_t_show['pro_id'] ?>')" class="btn btn-primary">ดูรายละเอียด</a>
                                    <?php if($sql_focus_t_show['pro_num'] > 0){ ?>
                                        <button class="btn btn-success" data-bs-target="#pro_<?php  echo $sql_focus_t_show['pro_id'] ?>" data-bs-toggle="modal">สั่งซื้อสินค้า</button>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php } ?>
                    </div>
                </div>
            <?php }else{?>
                <div class="text-center">
                    <b class="text-muted ">ไม่พบสินค้า</b>
                </div>
            <?php } ?>
        <?php }else{ ?>
            <?php while($sql_type_show = mysqli_fetch_array($sql_type_run,MYSQLI_BOTH)){ ?>
                        <?php
                            $pro_in_type_id = $sql_type_show['t_id'];
                            $sql_pro_in_type_run = mysqli_query($connect,"SELECT * FROM tb_product WHERE t_id = '$pro_in_type_id' ");
                            $sql_pro_in_type_count = mysqli_num_rows($sql_pro_in_type_run);    
                        ?>
                        <?php if($sql_pro_in_type_count > 0 ){ ?>
                                <div class="container">
                                    <b><?php echo $sql_type_show['t_name'] ?></b>
                                    <div class="text-muted">(<?php echo $sql_type_show['t_name_eng'] ?>)</div>
                                    <div class="row">
                                        <?php while($sql_pro_in_type_show = mysqli_fetch_array($sql_pro_in_type_run,MYSQLI_BOTH)){ ?>
                                            <section class="card p-2 m-1" style="width: 20rem" onclick="redirectToProductDetails('<?php echo $sql_pro_in_type_show['pro_id'] ?>')">
                                                <div class="position-relative">
                                                    <?php if($sql_pro_in_type_show['s_id'] == 1){ ?>
                                                        <span class="badge rounded position-absolute end-0 top-0 bg-warning">NEW</span>
                                                    <?php }else if($sql_pro_in_type_show['s_id'] == 3){ ?>
                                                        <span class="badge rounded position-absolute end-0 top-0 bg-success">SALE 20%</span>
                                                    <?php }else if($sql_pro_in_type_show['s_id'] == 2){ ?>
                                                        <span class="badge rounded position-absolute end-0 top-0 bg-danger">HOT</span>   
                                                    <?php } ?>
                                                    <img src="images/product/<?php echo $sql_pro_in_type_show['pro_image1']; ?>"  class="card-img-top" height="200">
                                                </div>
                                                <div class="card-body" style="width: 18rem; height: 200px">
                                                        <h3 class="text-center"><?php echo $sql_pro_in_type_show['pro_name'] ?></h3>
                                                        <?php if($sql_pro_in_type_show['s_id'] == 3){ ?>
                                                            <del>ราคาเดิม: <?php echo $sql_pro_in_type_show['pro_price'] ?> บาท</del>
                                                            <?php
                                                                $new = $sql_pro_in_type_show['pro_price'] - ($sql_pro_in_type_show['pro_price'] * 0.2);    
                                                            ?>
                                                            <h5>ราคาใหม่: <?php echo number_format($new) ?> บาท</h5>    
                                                        <?php }else{ ?>
                                                            <h5>ราคา: <?php echo number_format($sql_pro_in_type_show['pro_price']) ?> บาท</h5>
                                                        <?php } ?>
                                                        <?php if($sql_pro_in_type_show['pro_num'] > 0){ ?>
                                                            <h5>จำนวนทั้งหมด: <?php echo $sql_pro_in_type_show['pro_num'] ?> ชิ้น</h5>
                                                        <?php }else{ ?>
                                                                <span class="h5">จำนวนทั้งหมด: </span>
                                                                <span class="h5 text-danger">สิ้นค้าหมด</span>
                                                        <?php } ?>
                                                </div>
                                                <div class="align-bottom text-center">
                                                    <a href="#" onclick="redirectToProductDetails('<?php echo $sql_pro_in_type_show['pro_id'] ?>')" class="btn btn-outline-primary">ดูรายละเอียด</a>
                                                    <?php if($sql_pro_in_type_show['pro_num'] > 0){ ?>    
                                                        <?php if(empty($_SESSION['m_id']) || !empty($_SESSION['m_id'] == 1) ){  ?>                                                   
                                                       
                                                    <?php }else{ ?>
                                                        <a href="order.php?id=<?php echo $sql_pro_in_type_show['pro_id'] ?>" class="text-dark btn btn-outline-warning"><i class="bi bi-cart-plus me-2"></i>หยิบใส่ตะกร้า</a>
                                                    <?php } }?>
                                                </div>
                                            </section>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                </div>
                        <?php } ?>
                <?php } ?>
        <?php } ?>
        <?php while($sql_modal_pro_show = mysqli_fetch_array($sql_modal_pro_run,MYSQLI_BOTH)){ ?>
            <div class="modal fade" id="pro_<?php echo $sql_modal_pro_show['pro_id'] ?>">
                <div class="modal-dialog  modal-lg">
                   <div class="modal-content">
                   <div class="modal-header">
                        <div class="modal-title">
                            <h4><?php echo $sql_modal_pro_show['pro_name'] ?></h4>
                        </div>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-outline-info" href="https:www.lazada.co.th">LAZADA</a>
                        <a class="btn btn-outline-warning" href="https:www.shopee.co.th">SHOPEE</a>
                        </div>
                   </div>
                </div>
            </div>
        <?php } ?>

<script>
    function redirectToProductDetails(productId) {
        window.location.href = "show_pro.php?id=" + productId;
    }
</script>

<?php require('footer.php'); ?>
</body>
</html>
