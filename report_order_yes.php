<?php
include "connect.php";
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

<body class="sb-nav-fixed">
    <?php include "menu_up.php"; ?>
    <?php include "menu.php"; ?>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            เเสดงข้อมูลการขาย(ชำระเงินเเล้ว)
            <div>
            <br>
                <a href="report_order.php" class="btn btn-primary">เช็คการชำระเงิน</a>
                <a href="report_order_yes.php" class="btn btn-success">ชำระเงินเเล้ว</a>
                <a href="report_order_no.php" class="btn btn-danger">ยกเลิก</a>
            </div>
            <br>
            <form name="form1" method="post" action="report_order_yes.php">
                <div class="row">
                    <div class="col-sm-2">
                        <input type="date" name="dt1" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <input type="date" name="dt2" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-success" type="submit">ค้นหา</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table id="datatablesSimple"  class="table table-striped">
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
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $date1=@$_POST['dt1'];
                    $date2=@$_POST['dt2'];
                    if(($date1 != "") && ($date2 != "") ){
                        echo "ค้นหาจากวันที่ $date1 ถึง $date2";
                        $sql = "select * from tb_order  where order_status='2' and date BETWEEN '$date1' and '$date2' ORDER BY date DESC ";
                    }else{
                        $sql =  "select * from tb_order where order_status='2'  order by date DESC";
                    }
                    $result = mysqli_query($connect,$sql);
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
                            <img src="images/slipe/<?php echo $rs['slipe_image'] ?>" width="50">
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
    </div>
    </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>