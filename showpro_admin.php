<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Product</title>
    <?php include("head.php"); ?>
</head>

<body class="bg-body-tertiary">
    <?php include("menu.php"); ?>
    <div class="container" style="margin-top: 20px;">
        <h2 class="fw-bold">ระบบจัดการสินค้า</h2>
        <div class="row g-5">
            <div class="col-mb-8 col-sm-12">
                <form action="showpro_admindb.php" method="post" enctype="multipart/form-data" onsubmit="return ProductData()">
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">ชื่อสินค้า</label>
                            <input type="text" name="pro_name" class="form-control" placeholder="กรุณากรอกชื่อสินค้า">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">ราคาสินค้า</label>
                            <input type="text" name="pro_price" class="form-control" placeholder="กรุณากรอกราคาสินค้า">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">จำนวนสินค้า</label>
                            <input type="text" name="pro_num" class="form-control" placeholder="กรุณากรอกราคาสินค้า">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-file">รูปสินค้า</label>
                            <input type="file" name="pro_image" class="form-control"  placeholder="กรุณากรอกชื่อสินค้า">
                        </div>
                        <div class="col-sm-6" row="2">
                            <label class="form-label">รายละเอียดสินค้า</label>
                            <textarea name="pro_detail" class="form-control" placeholder="กรุณากรอกรายละเอียดสินค้า"
                                rows="3"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">ตกลง</button>
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>

    <!-- เพิ่ม SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function ProductData() {
      var pro_name = document.getElementsByName('pro_name')[0].value;
      var pro_price = document.getElementsByName('pro_price')[0].value;
      var pro_num = document.getElementsByName('pro_num')[0].value;
      var pro_image = document.getElementsByName('pro_image')[0].value;
      var pro_detail = document.getElementsByName('pro_detail')[0].value;
      var isValid = true;

      if (pro_name.trim() === '') {
        isValid = false;
        document.getElementsByName('pro_name')[0].classList.add('is-invalid');
      } else {
        document.getElementsByName('pro_name')[0].classList.remove('is-invalid');
      }

      if (pro_price.trim() === '') {
        isValid = false;
        document.getElementsByName('pro_price')[0].classList.add('is-invalid');
      } else {
        document.getElementsByName('pro_price')[0].classList.remove('is-invalid');
      }
      if (pro_num.trim() === '') {
        isValid = false;
        document.getElementsByName('pro_num')[0].classList.add('is-invalid');
      } else {
        document.getElementsByName('pro_num')[0].classList.remove('is-invalid');
      }

      if (pro_image.trim() === '') {
        isValid = false;
        document.getElementsByName('pro_image')[0].classList.add('is-invalid');
      } else {
        document.getElementsByName('pro_image')[0].classList.remove('is-invalid');
      }

      if (pro_detail.trim() === '') {
        isValid = false;
        document.getElementsByName('pro_detail')[0].classList.add('is-invalid');
      } else {
        document.getElementsByName('pro_detail')[0].classList.remove('is-invalid');
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
