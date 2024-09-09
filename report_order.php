<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <?php include ('head.php'); ?>
</head>

<body >
<?php include ('menu_up.php'); ?>
<?php require("menu.php") ?>

        <div class="container py-3">
            <table id="datatablesSimple"  class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>เลขที่ใบสั่งซื้อ</th>
                        <th>ลูกค้า</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>ราคาสุทธิ</th>
                        <th>slipe</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>สถานะการสั่งซื้อ</th>
                        <th>รายละเอียด</th>
                        <th>ปรับสถานะ</th>
                        <th>ยกเลิกการสั่งซื้อ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($connect, "select * from tb_order  order by date DESC");
                    while ($rs = mysqli_fetch_array($result)) {
                        $status = $rs['order_status'];
                        ?>

                        <tr>
                            <td>
                                <?php echo $rs['order_id']; ?>
                            </td>
                            <td>
                                <?php echo $rs['cus_name']; ?>
                            </td>
                            <td>
                            <?php echo $rs['address']; ?>
                            <?php echo $rs['subdistrict']; ?>
                            <?php echo $rs['district']; ?>
                            <?php echo $rs['province']; ?>
                            <?php echo $rs['zipcode']; ?>
                            </td>
                            <td>
                                <?php echo $rs['phone']; ?>
                            </td>
                            <td>
                                <?php echo $rs['total_price']; ?>
                            </td>
                            <td>
                            <img src="images/silpe/<?php echo $rs['slipe_image'] ?>" width="50">
                            </td>
                            <td>
                                <?php echo $rs['date']; ?>
                            </td>
                            <td>
                                <?php 
                                if($status == 1){
                                    echo  "<b style='color:blue'>ยังไม่ชำระเงิน</b>";
                                }else if($status == 2){
                                    echo  "<b style='color:green'>ชำระเงินเรียบร้อยเเล้ว</b>";
                                }else{
                                    echo  "<b style='color:red'>ยกเลิกใบสั่งซื้อ</b>";
                                }
                                ?>
                            </td>
                            <td><a href="report_order_detail.php?id=<?php echo $rs['order_id']; ?>" class="btn btn-primary">รายละเอียด</a></td>
                            <td><a href="chang_order.php?id=<?php echo $rs['order_id']; ?>" class="btn btn-success">ปรับสถานะ</a></td>
                            <td><a href="cancel_order.php?id=<?php echo $rs['order_id']; ?>" class="btn btn-danger">ยกเลิก</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    
    </div>
    </main>
    </div>
    </div>

</body>

</html>