<?php
session_start();
include "connect.php";
$result = mysqli_query($connect, "SELECT * FROM `tb_order` WHERE order_id='" . $_SESSION['order_id'] . "' ");
$rs = mysqli_fetch_array($result);
$total = $rs['total_price'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "head.php" ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info h4 text-center md-4">
                    การสั่งซื้อเสร็จสมบูรณ์
                </div>
                เลขที่การสั่งซื้อ :
                <?php echo $rs['order_id']; ?> <br>
                ชื่อ-นามสกุล :
                <?php echo $rs['cus_name']; ?> <br>
                เบอร์โทรศัพท์ :
                <?php echo $rs['phone']; ?> <br>
                ที่อยู่ :
                <?php echo $rs['address']; ?> <br>
                ตำบล :
                <?php echo $rs['subdistrict']; ?> <br>
                อำเภอ :
                <?php echo $rs['district']; ?> <br>
                จังหวัด :
                <?php echo $rs['province']; ?> <br>
                รหัสไปรษณีย์ :
                <?php echo $rs['zipcode']; ?> <br>
                <br>
                <table class="table">
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
                        <?php
                        $result1 = mysqli_query($connect, "select * from order_detail d,tb_product p where d.pro_id=p.pro_id and d.order_id='" . $_SESSION['order_id'] . "' ");
                        while ($rs1 = mysqli_fetch_array($result1)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $rs1['pro_id'] ?>
                                </td>
                                <td>
                                    <?php echo $rs1['pro_name'] ?>
                                </td>
                                <td>
                                    <?php echo $rs1['order_price'] ?>
                                </td>
                                <td>
                                    <?php echo $rs1['quantity'] ?>
                                </td>
                                <td>
                                    <?php echo $rs1['total'] ?>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
                <h6 class="text-end">ราคารวม
                    <?php echo number_format($total, 2); ?>บาท
                </h6>
            </div>
        </div>
        <br>
        <div>
            <?php
           if(!empty($_FILES['pro_image1']['name'])){
            $pro_image1 = $_FILES['pro_image1'];
            $tmp = explode('.',$pro_image1['name']);
            $filetype = end($tmp);
                if($filetype != 'jpeg' && $filetype != 'jpg' && $filetype != 'png'){
                    $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                }else{
                    $filename1  = date('dmyHis').'0.'.$filetype; 
                }
        } else {
            $filename1 = '';
        }
        
            if (empty($er_mes)) {
                mysqli_query($connect, "UPDATE `tb_order` SET `slipe_image`='$filename1' WHERE  order_id='" . $_SESSION['order_id'] . "'");
        
                if(!empty($filename1)){
                    move_uploaded_file($pro_image1['tmp_name'],'images/silpe/'.$filename1);
                }  
            } else {
                $_SESSION['error'] = $er_mes;
            }
            ?>
            <?php if (!empty($_SESSION['error'])) { ?>
                <div class="alert alert-danger col-4 container" role="alert">
                    <?php echo $_SESSION['error']; ?>
                </div>
                <?php $_SESSION['error'] = '';
            } ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-4">
                    <div class="col-12 col-lg-4">
                        <div class="form-control text-dark">
                            <div class="row p-1">
                                <div class="col-3">
                                    <label>แนบสลิป</label>
                                </div>
                                <div class="col-9">
                                    <input type="file" name="pro_image1" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" name="btpro" class="btn btn-outline-success btn-lg px-5" value="เพิ่มslipeสินค้า">
            </form>
        </div>
        <br>
        <br>
        <br>
        <a href="index.php" class="btn btn-danger">กลับไปหน้าสินค้า</a>
        <button onclick="window.print()" class="btn btn-success">ดาวโหลดใบเสร็จ</button>
    </div>
</body>

</html>