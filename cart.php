<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "head.php"; ?>
    <title>Document</title>
    <style>
        /* เพิ่ม CSS สำหรับจัดข้อความให้อยู่ตรงกลางของ input */
        .form-floating label {
            position: absolute;
            pointer-events: none;
            padding: 1px 6px;
            transition: all .2s ease-in-out;
            z-index: 1;
            top: 15px;
            left: 20px;
        }

        /* เพิ่ม CSS สำหรับทำให้ข้อความชิดขวา */
        .text-end {
            text-align: end !important;
        }
    </style>
</head>

<body>
    <?php include "menu.php"; ?>
    <div class="container py-4">
        <div class="row-12 mb-4">
            <div class="col-md-6">
                <div class="alert alert-info" role="alert"><i class="bi bi-cart4 me-2"></i>
                    ตะกร้าสินค้า
                </div>
            </div>
        </div>
        <form action="" method="post" onsubmit="return validateData()">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="12">
                                    <div style="float:right">
                                        <a class="btn btn-primary" href="index.php" class="text-white"><i
                                                class="bi bi-cart-plus me-2"></i>เลือกสินค้าเพิ่ม</a>
                                    </div>
                                </th>
                            </tr>
                            <tr class="text-center">
                                <th>ลำดับที่</th>
                                <th>ชื่อสินค้า</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                                <!-- <th>เพิ่ม-ลดจำนวน</th> -->
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <?php
                        $Total = 0;
                        $sump = 0;
                        $m = 1;
                        for ($i = 0; $i <= (int) $_SESSION['chk_order']; $i++) {
                            if ($_SESSION['strProductID'][$i] != "") {
                                $sql1 = "select * from tb_product where pro_id = '" . $_SESSION["strProductID"][$i] . "' ";
                                $reslut1 = mysqli_query($connect, $sql1);
                                $row1 = mysqli_fetch_array($reslut1);

                                if ($row1['s_id'] == 3) {
                                    // ลดราคาสินค้า 20%
                                    $row1['pro_price'] = $row1['pro_price'] * 0.8;
                                }
                                $_SESSION["pro_price"] = $row1['pro_price'];
                                $Total = $_SESSION['strQty'][$i];
                                $sum = $Total * $row1['pro_price'];
                                $sump += $sum;
                                $_SESSION['sump'] = $sump;
                                ?>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            <?php echo $m ?>
                                        </td>
                                        <td>
                                            <img src="images/product/<?php echo $row1['pro_image1'] ?>" width="50">
                                            <?php echo $row1['pro_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($row1['pro_price'], 2); ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $chk_num = mysqli_query($connect, "SELECT pro_num FROM tb_product WHERE pro_id = '".$_SESSION['strProductID'][$i]."'");
                                                $row_num = mysqli_fetch_array($chk_num);
                                                if($_SESSION['strQty'][$i] > $row_num['pro_num']){
                                                    echo "<script>
                                                    Swal.fire({
                                                        position: 'center',
                                                        icon: 'error',                                                      
                                                        title: 'ล้มเหลว!',
                                                        text: 'สินค้ามีไม่เพียงพอ',
                                                        showConfirmButton: false,
                                                        timer: 2000
                                                    });
                                                    </script>";
                                                    $_SESSION['strQty'][$i] = $row_num['pro_num']; // กำหนดให้ค่าเท่ากับจำนวนสินค้าที่มีอยู่จริง
                                                }
                                            ?>
                                            <a href="order.php?id=<?php echo $row1['pro_id']; ?>" class="btn btn-outline-info me-3">+</a>
                                            <?php echo $_SESSION['strQty'][$i]; ?>
                                            <?php if ($_SESSION['strQty'][$i] > 1) { ?>
                                                <a href="order_del.php?id=<?php echo $row1['pro_id']; ?>" class="btn btn-outline-danger ms-3">-</a>
                                            <?php } ?>
                                        </td>     
                                        <td>
                                            <?php echo number_format($sum, 2); ?>
                                        </td>

                                        <td><a class="btn btn-outline-danger" style="border-radius : 1rem;"
                                                href="pro_delete.php?Line=<?php echo $i; ?>"><i class="bi bi-trash3"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $m++;
                            }
                        }
                        ?>
                            <tr>
                                <td class="text-start" colspan="4">รวมเป็นเงิน</td>
                                <td class="text-end text-center">
                                    <?php echo number_format($sump, 2); ?>
                                </td>
                                <td class="text-end text-center">บาท</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php

            //Address View
            $row_add = mysqli_query($connect, "SELECT * FROM tb_member WHERE m_id = '".$_SESSION['m_id']."' ");
            $re_add = mysqli_fetch_array($row_add);

            //Address Input
            $row_add = mysqli_query($connect, "SELECT * FROM tb_member");

            if (isset($_POST['bt_save'])) {
                $m_add = $_POST['m_add'];
                $m_sub = $_POST['m_sub'];
                $m_dis = $_POST['m_dis'];
                $m_pro = $_POST['m_pro'];
                $m_zip = $_POST['m_zip'];

                mysqli_query($connect, "UPDATE `tb_member` SET `m_add`='$m_add',`m_sub`='$m_sub',`m_dis`='$m_dis',`m_pro`='$m_pro',`m_zip`='$m_zip' WHERE m_id = '".$_SESSION['m_id']."' ");
                $_SESSION['success_cart'] = "บันทึกข้อมูลเรียบร้อย";
            }

            if (!empty($_SESSION['success_cart'])) {
    echo "<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: '{$_SESSION['success_cart']}',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'cart.php'; // ให้เด้งไปยังหน้า cart.php เมื่อหมดเวลา
    });
    </script>";
    $_SESSION['success_cart'] = '';
}
            ?>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="alert alert-primary" role="alert"><i class="bi bi-house-fill me-2"></i>
                        เพิ่มข้อมูลการจัดส่งสินค้า
                    </div>
                    <div class="row">
                        <div class="form-floating text-dark col-6 ">
                            <input type="text" name="m_sub" id="m_sub" value="<?php echo $re_add['m_sub'] ?>" class="form-control" placeholder="ตำบล">
                            <label>ตำบล</label>
                        </div>
                        <div class="form-floating text-dark col-6 ">
                            <input type="text" name="m_dis" id="m_dis" value="<?php echo $re_add['m_dis'] ?>" class="form-control" placeholder="อำเภอ">
                            <label>อำเภอ</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-floating text-dark col-6">
                            <input type="text" name="m_pro" id="m_pro" value="<?php echo $re_add['m_pro'] ?>" class="form-control" placeholder="จังหวัด">
                            <label>จังหวัด</label>
                        </div>
                        <div class="form-floating text-dark col-6">
                            <input type="text" name="m_zip" id="m_zip" value="<?php echo $re_add['m_zip'] ?>" class="form-control" placeholder="รหัสไปรษณีย์">
                            <label>รหัสไปรษณีย์</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                <div class="form-floating text-dark col-12">
    <textarea name="m_add" id="m_add" class="form-control" placeholder="ที่อยู่" rows="3"><?php echo $re_add['m_add']; ?></textarea>
    <label for="m_add">ที่อยู่</label>
</div>
                </div>
            </div>
            <button type="submit" name="bt_save" class="btn btn-primary mb-5"><i
                    class="bi bi-floppy-fill me-2"></i>บันทึกที่อยู่</button>
                    </form>

                    <div style="float:right">
    <!-- โค้ดฟอร์ม -->
    <button type="submit" name="bt_save_cart" class="btn btn-success mb-5" onclick="confirmOrder()">ยืนยันการสั่งซื้อสินค้า</button>
</div>

<script>
    function confirmOrder() {
        Swal.fire({
            title: 'ยืนยันการสั่งซื้อสินค้า',
            text: 'คุณแน่ใจว่าต้องการทำรายการนี้?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ไปยังหน้าอื่นๆ ที่ต้องการ
                window.location.href = 'insert_chart.php';
            }
        });
        return false; // ต้องใส่ return false เพื่อไม่ให้ฟอร์ม submit ทันที
    }
</script>


    <script>
        function validateData() {
            var m_sub = document.getElementById('m_sub').value;
            var m_dis = document.getElementById('m_dis').value;
            var m_pro = document.getElementById('m_pro').value;
            var m_zip = document.getElementById('m_zip').value;
            var m_add = document.getElementById('m_add').value;
            var isValid = true;

            if (m_sub.trim() === '') {
                isValid = false;
                document.getElementById('m_sub').classList.add('is-invalid');
            } else {
                document.getElementById('m_sub').classList.remove('is-invalid');
            }

            if (m_dis.trim() === '') {
                isValid = false;
                document.getElementById('m_dis').classList.add('is-invalid');
            } else {
                document.getElementById('m_dis').classList.remove('is-invalid');
            }

            if (m_pro.trim() === '') {
                isValid = false;
                document.getElementById('m_pro').classList.add('is-invalid');
            } else {
                document.getElementById('m_pro').classList.remove('is-invalid');
            }

            if (m_zip.trim() === '') {
                isValid = false;
                document.getElementById('m_zip').classList.add('is-invalid');
            } else {
                document.getElementById('m_zip').classList.remove('is-invalid');
            }
            if (m_add.trim() === '') {
                isValid = false;
                document.getElementById('m_add').classList.add('is-invalid');
            } else {
                document.getElementById('m_add').classList.remove('is-invalid');
            }



            if (!isValid) {
                // แสดง alert หรือข้อความบนหน้าจอ
                Swal.fire({
                    title: 'ล้มเหลว!',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            }
            return isValid;
        }
    </script>
</body>

</html>
