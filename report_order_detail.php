<?php
include "connect.php";
$ids = $_GET['id'];
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

<body class="sb-nav-fixed">
    <?php include "menu_up.php"; ?>
    <?php include "menu.php"; ?>
            <div class="card-body">
                <h5>เลขที่ใบสั่งซื้อ
                    <?php echo $ids; ?>
                </h5>
                <?php
    $sql = "SELECT * FROM order_detail AS d 
        LEFT JOIN tb_product AS p ON d.pro_id = p.pro_id 
        LEFT JOIN tb_order AS o ON d.order_id = o.order_id 
        WHERE d.order_id = '$ids' 
        ORDER BY d.pro_id";
    $result = mysqli_query($connect, $sql);

    while ($rs = mysqli_fetch_array($result)) {
        $sum = $rs['total_price'];
        $img = $rs['slipe_image'];
        ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                        </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td>
                                <?php echo $rs['pro_id']; ?>
                            </td>
                            <td>
                                <?php echo $rs['pro_name']; ?>
                            </td>
                            <td>
                                <?php echo $rs['pro_price']; ?>
                            </td>
                            <td>
                                <?php echo $rs['quantity']; ?>
                            </td>
                            <td>
                                <?php echo $rs['total']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="row">
                    <div class="col-6 text-center">
            <b class="h3">ราคารวมสุทธิ
                <?php echo number_format($sum, 2); ?>
                บาท
            </b>
            </div>
            <div class="col-6 text-center">
            <img src="images/silpe/<?php echo $img;?>" width="500">
            </div>
    

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