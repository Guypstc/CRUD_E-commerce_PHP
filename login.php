<?php
session_start();
include('connect.php');

if (isset($_POST['btlog'])) {
  $er_mes = '';
  if (!empty($_POST['m_email']) && !empty($_POST['m_pass'])) {
    $m_email = $_POST['m_email'];
    $m_pass = $_POST['m_pass'];
    $rs_log = mysqli_query($connect, "SELECT * FROM tb_member WHERE m_email = '" . $m_email . "' AND m_pass = '" . $m_pass . "' ");
    $show_log = mysqli_fetch_array($rs_log);
    if (empty($show_log['m_id'])) {
      $er_mes = 'ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง';
    } else {
      $_SESSION['m_id'] = $show_log['m_id'];
      $_SESSION['m_name'] = $show_log['m_name'];
      $_SESSION['m_tel'] = $show_log['m_tel'];
      $_SESSION['m_add'] = $show_log['m_add'];
      $_SESSION['m_sub'] = $show_log['m_sub'];
      $_SESSION['m_dis'] = $show_log['m_dis'];
      $_SESSION['m_pro'] = $show_log['m_pro'];
      $_SESSION['m_zip'] = $show_log['m_zip'];
      $_SESSION['m_level'] = $show_log['m_level'];
    }
  }
  if (empty($er_mes)) {
    $_SESSION['success_log'] = "เข้าระบบเรียบร้อย";
  } else {
    $_SESSION['errorlog'] = $er_mes;
  }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <?php include('head.php'); ?>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .bg {
            background: linear-gradient(to right, rgba(255, 0, 0, 0.9), rgba(37, 117, 252, 0.9));

            background-size: 150% auto;
            animation: gradient 13s linear infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            padding-top: 20px;
        }
    </style>
    <style>
        body {
            background: lightblue;
            text-align: center;
            box-sizing: border-box;
            font-family: "Lato", Sans-serif;
            /*   position:relative; */
        }

        .box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .btn-primary {
            background: #0000ff;

        }

        .btn {
            text-decoration: none;
            text-transform: uppercase;
            position: relative;
            top: 0;
            left: 0;
            padding: 20px 40px;
            border-radius: 100px;
            display: inline-block;
            transition: all .5s;
        }

        .btn:hover {
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }

        .btn:active {
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2) transform:translateY(-1px);
        }

        .btn-bottom-animation-1 {
            animation: comeFromBottom 1s ease-out .8s;
        }

        .btn::after {
            content: "";
            text-decoration: none;
            text-transform: uppercase;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border-radius: 100px;
            display: inline-block;
            z-index: -1;
            transition: all .5s;
        }


        .btn-primary::after {
            background: #0000ff;
        }

        .btn-animation-1:hover::after {
            transform: scaleX(1.4) scaleY(1.6);
            opacity: 0;
        }

        @keyframes comeFromBottom {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
    </style>
    <style>
        a.text-white:hover {
            color: yellow; /* เปลี่ยนเป็นสีเหลืองเมื่อ hover */
        }
    </style>


</head>

<body class="bg">
    <div class="container py-5 text-dark">
        <section class="" style="">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card text-black"
                            style="border-radius : 1rem; background : hsla(0, 0%, 0%, 0.6); backdrop-filter : bulr(50px);">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <p class="text-white text-center h1 fw-bold mb-1 mx-1 mx-md-4">Login</p>
                                        <p class="text-center text-white-50 mb-0">กรุณากรอกชื่อผู้ใช้งาน และ รหัสผ่าน</p>
                                        <p class="text-center text-white-50 mb-4">Please Enter Username And Password!
                                        </p>
                                        <?php
                                            if (!empty($_SESSION['errorlog'])) {
                                                // แสดง SweetAlert ถ้ามีข้อความ errorlog
                                                echo "<script>
                                                            Swal.fire({
                                                            title: 'Error!',
                                                            text: '{$_SESSION['errorlog']}',
                                                            icon: 'error',
                                                            confirmButtonText: 'ตกลง'
                                                        });
                                                        </script>";
                                                $_SESSION['errorlog'] = '';
                                            }

                                            if (!empty($_SESSION['success_log'])) {
                                                echo "<script>
                                                Swal.fire({
                                                    title: 'Success!',
                                                    text: 'เข้าระบบเรียบร้อย',
                                                    icon: 'success',
                                                    confirmButtonText: 'ตกลง'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = 'index.php';
                                                    }
                                                });
                                            </script>";
                                                $_SESSION['success'] = '';
                                            }
                                            ?>

                                        <form action="" id="myForm" method="post" enctype="multipart/form-data"
                                            class="mx-1 mx-md-4" onsubmit="return validateData()">


                                            <!-- คำตอบของเฉลยเริ่มต้น -->
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="bi bi-envelope-fill me-3" style="font-size: 24px; color: white;"></i>
                                                <div class="col">
                                                    <div class="form-floating text-dark">
                                                    <input type="email" class="form-control" name="m_email" id="m_email" placeholder="อีเมล">
                      <label for="m_email">อีเมล</label>
                      <div id="emailError" class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- คำตอบของเฉลยสิ้นสุด -->
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="bi bi-key-fill me-3" style="font-size: 24px; color: white;"></i>
                                                <div class="col">
                                                    <div class="form-floating text-dark">
                                                    <input type="password" class="form-control" name="m_pass" id="m_pass" placeholder="รหัสผ่าน">
                      <label for="m_pass">รหัสผ่าน</label>
                      <div id="passError" class="invalid-feedback"></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center mx-4 mb-5 mb-lg-4">


                                                <button type="submit" name="btlog"
                                                    class="btn btn-primary btn-animation-1">Login</button>

                                            </div>
                                            <div class="d-flex justify-content-center ">
                                                <span class="small" style="font-size: larger; color: white;">ยังไม่มีบัญชีผู้ใช้งาน?
                    คุณสามารถ
                                                    <a href="register.php" class="text-primary"
                                                        style="text-decoration: none;">สมัครสมาชิก</a>
                                                        
                                                </span>
                                            </div>

                                            <div class="d-flex justify-content-center py-3">
                                               <a href="index.php" class="text-white" style="text-decoration: none; font-size: 1.2em;">
                                                    กลับหน้าหลัก
                                                </a>
                                            </div>



                                        </form>

                                    </div>
                                    <div
                                        class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="images\regist.png" class="img-fluid">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>


    <script>
    function validateData() {
      var m_email = document.getElementById('m_email').value;
      var m_pass = document.getElementById('m_pass').value;
      var isValid = true;

      if (m_email.trim() === '') {
        isValid = false;
        document.getElementById('m_email').classList.add('is-invalid');
        document.getElementById('emailError').textContent = 'กรุณากรอกชื่อผู้ใช้งาน';
      } else {
        document.getElementById('m_email').classList.remove('is-invalid');
        document.getElementById('emailError').textContent = '';
      }

      if (m_pass.trim() === '') {
        isValid = false;
        document.getElementById('m_pass').classList.add('is-invalid');
        document.getElementById('passError').textContent = 'กรุณากรอกรหัสผ่าน';
      } else {
        document.getElementById('m_pass').classList.remove('is-invalid');
        document.getElementById('passError').textContent = '';
      }

      if (!isValid) {
        // แสดง alert หรือข้อความบนหน้าจอ
        Swal.fire({
          title: 'ล้มเหลว!',
          text: 'กรุณากรอกชื่อผู้ใช้ และ รหัสผ่าน',
          icon: 'error',
          confirmButtonText: 'ตกลง'
        });
      }

      return isValid;
    }
  </script>
</body>

</html>