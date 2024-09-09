<?php
    $sql_s_run = mysqli_query($connect,"SELECT * FROM tb_slide ORDER BY s_id DESC");
    $sql_t_run = mysqli_query($connect,"SELECT * FROM tb_type");
    $sql_s_max_show = mysqli_fetch_array(mysqli_query($connect,"SELECT MAX(s_id) FROM tb_slide"));
?>
<div class="container my-3">
    <div class="row gx-3">
        <div class="col-3">
            <div class="p-2 border">
                <div class="overflow-auto" style="height: 300px">
                    <div class="list-group">
                        <a  class="list-group-item list-group-item-success">
                            <b>ประเภทสินค้า</b>
                            (Product type)
                        </a>
                        <?php while($sql_t_show = mysqli_fetch_array($sql_t_run,MYSQLI_BOTH)){ ?>
                            <?php
                                $count_type_id = $sql_t_show['t_id'];
                                $sql_couunt_type_show =mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_product WHERE t_id='$count_type_id' "))    
                            ?>
                            <a href="index.php?t_id=<?php echo $sql_t_show['t_id'] ?>" class="list-group-item list-group-item-action d-flex align-items-start justify-content-between">
                                <div class="fw-bold">
                                    <?php echo $sql_t_show['t_name'] ?>
                                    <div class="text-muted"><?php echo $sql_t_show['t_name_eng'] ?></div>
                                </div>
                                <span class="badge rounded-pill bg-success"><?php echo $sql_couunt_type_show ?></span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="p-2 border">
                <div class="carousel slide" id="sliding" data-bs-slide="carousel">
                    <div class="carousel-inner">
                        <?php while($sql_s_show = mysqli_fetch_array($sql_s_run,MYSQLI_BOTH)){ ?>
                           <?php if($sql_s_show['t_id'] != 0){ ?>
                                <?php if($sql_s_show['s_id'] == $sql_s_max_show[0]){ ?>
                                    <a href="index.php?t_id=<?php echo $sql_s_show['t_id'] ?>" class="carousel-item active">
                                        <img src="images/slide/<?php echo $sql_s_show[1] ?>" alt="" class="d-block w-100" height="300">
                                    </a>
                                <?php }else{ ?>
                                    <a href="index.php?t_id=<?php echo $sql_s_show['t_id'] ?>" class="carousel-item ">
                                        <img src="images/slide/<?php echo $sql_s_show[1] ?>" alt="" class="d-block w-100" height="300">
                                    </a>
                                <?php } ?>
                            <?php }else{ ?>
                                    <?php if($sql_s_show['s_id'] == $sql_s_max_show[0]){ ?>
                                        <a href="index.php?s_id=<?php echo $sql_s_show['s_id'] ?>" class="carousel-item active">
                                            <img src="images/slide/<?php echo $sql_s_show[1] ?>" alt="" class="d-block w-100" height="300">
                                        </a>
                                    <?php }else{ ?>
                                        <a href="index.php?s_id=<?php echo $sql_s_show['s_id'] ?>" class="carousel-item">
                                            <img src="images/slide/<?php echo $sql_s_show[1] ?>" alt="" class="d-block w-100" height="300">
                                        </a>
                                    <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" data-bs-target="#sliding" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" data-bs-target="#sliding" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>