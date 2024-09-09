<?php
    session_start();
    include ('connect.php');
        if(!empty($_POST['btlog'])){
            $er_mes = '';
                if(!empty($_POST['m_user']) && !empty($_POST['m_pass'])){
                    $m_user = $_POST['m_user'];
                    $m_pass = $_POST['m_pass'];
                    $rs_log = mysqli_query($connect,"SELECT m_id,m_name,m_level FROM tb_member WHERE m_user = '".$m_user."' AND m_pass = '".$m_pass."' ");
                    $show_log = mysqli_fetch_array($rs_log);
                        if(empty($show_log['m_id'])){
                            $er_mes .= 'ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง<br/>';
                        }else{
                            $_SESSION['m_id'] = $show_log['m_id']; 
                            $_SESSION['m_name'] = $show_log['m_name']; 
                            $_SESSION['m_level'] = $show_log['m_level']; 
                        }
                }else{
                    $er_mes .= 'กรุณากรอกชื่อผู้ใช้งาน และ รหัสผ่าน<br/>';
                }
                if(empty($er_mes)){
                    header('location:index.php');
                }else{
                    $_SESSION['errorlog'] = $er_mes;
                }
        }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- เพิ่ม Bootstrap CSS -->
  <?php include ("head.php"); ?>
  <link rel="stylesheet" href="css/styles.css">
  <style>
        .bg{
            background : linear-gradient(to right,rgba(255,49,49,1),rgba(32,127,255,1));
        }
    </style>
</head>
<body class="bg">
<div class="container py-5 text-dark">
        <div class="row d-flex justify-content-center align-item-center">
            <div class="col-12 col-mb-8 col-lg-6 col-xl-5">
                <div class="card-body bg-dark" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-4 mt-md-5 pb-5">
                            <h2 class="fw-bold text-uppercase text-white">Login</h2>
                            <p class="text-white-50 mb-0">กรุณากรอกชื่อผู้ใช้งาน และ รหัสผ่าน</p>
                            <p class="text-white-50 mb-4">Please Enter Username And Password!</p>
                            <?php if(!empty($_SESSION['errorlog'])){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_SESSION['errorlog']; ?>
                                </div>
                                <?php $_SESSION['errorlog'] = ''; } ?>

                                <form action="" id="myForm" method="post" enctype="multipart/form-data">
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control" name="m_user" id="m_user" placeholder="ชื่อผู้ใช้งาน">
                                                <label>ชื่อผู้ใช้งาน</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <div class="form-floating ">
                                                <input type="password" class="form-control" name="m_pass" id="m_pass" placeholder="รหัสผ่าน">
                                                <label>รหัสผ่าน</label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="small"><a href="" class="text-white-50" data-bs-toggle="" data-bs-target="">ลืมรหัสผ่าน/Froget PAssword?</a></span>
                                    <button type="button" name="btlog" class="btn btn-success btn-lg px-5" onclick="validateData()">Login/เข้าสู่ระบบ</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function validateData() {
    // รายการช่องที่ต้องตรวจสอบ
    var inputFields = ['m_user', 'm_pass'];
    var isValid = true;

    // ตรวจสอบทุกช่อง
    inputFields.forEach(function(fieldId) {
      var inputData = document.getElementById(fieldId).value;
      if (inputData.trim() === '') {
        // แสดงเเจ้งเตือน
        Swal.fire({
          title: 'ผิดพลาด',
          text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
          icon: 'error',
          confirmButtonText: 'ตกลง'
        });

        // เพิ่ม class ของ Bootstrap สำหรับเน้นแจ้งเตือน
        document.getElementById(fieldId).classList.add('is-invalid');
        isValid = false;
      } else {
        // ลบ class ของ Bootstrap สำหรับเน้นแจ้งเตือน (ถ้ามี)
        document.getElementById(fieldId).classList.remove('is-invalid');
      }
    });

    // กระทำเพิ่มเติมเมื่อข้อมูลถูกต้องทุกช่อง
    if (isValid) {
      // กระทำเพิ่มเติมเมื่อข้อมูลถูกต้องทุกช่อง
      // ตัวอย่าง: ส่งข้อมูลไปที่เซิร์ฟเวอร์
      console.log('กรุณากรอกข้อมูลให้ครบถ้วน');
    }
  }
</script>

<!-- เพิ่ม Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>
</html>