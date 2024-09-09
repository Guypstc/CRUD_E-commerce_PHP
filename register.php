<?php
session_start();
include('connect.php');
if (isset($_POST['btregis'])) {
    $er_mes = '';
    //Name
    if (!empty($_POST['m_name'])) {
        $m_name = $_POST['m_name'];
    } else {
        $er_mes .= 'กรุณากรอกชื่อจริง-นามสกุล';
    }
    //Pass
    if (!empty($_POST['m_pass']) && !empty($_POST['con_m_pass'])) {
        $m_pass = $_POST['m_pass'];
        $con_m_pass = $_POST['con_m_pass'];
        if ($m_pass != $con_m_pass) {
            $er_mes .= 'รหัสผ่านทั้งสองช่องไม่ตรงกัน';
        }
    } else {
        $er_mes .= 'กรุณากรอกรหัสผ่านทั้งสองช่อง';
    }
    //Email
    if (!empty($_POST['m_email'])) {
        $m_email = $_POST['m_email'];
        $chk_m_email = '/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+\.[a-zA-Z]+$/';
        if (!preg_match($chk_m_email, $m_email)) {
            $er_mes .= 'รูปแบบอีเมลไม่ถูกต้อง';
        }
        $rs_m_email = mysqli_query($connect, "SELECT COUNT(*) As m_email FROM tb_member WHERE m_email = '" . $m_email . "'  ");
        $show_m_email = mysqli_fetch_assoc($rs_m_email);
        if ($show_m_email['m_email'] > 0) {
            $er_mes .= 'อีเมลนี้มีอยู่ในระบบแล้ว';
        }
    } else {
        $er_mes .= 'กรุณากรอกอีเมล';
    }
    //Tel 
    if (!empty($_POST['m_tel'])) {
        $m_tel = $_POST['m_tel'];
        $chk_m_tel = '/^[0-9]{10}$/';
        if (!preg_match($chk_m_tel, $m_tel)) {
            $er_mes .= 'เบอร์โทรไม่ถูกต้อง';
        }
    } else {
        $er_mes .= 'กรุณากรอกเบอร์โทร';
    }

    //Insert
    if (empty($er_mes)) {
        mysqli_query($connect, "INSERT INTO `tb_member`( `m_name`, `m_email`, `m_pass`, `m_tel`, `m_image`, `m_level`) 
                    VALUES ('$m_name','$m_email','$m_pass','$m_tel','user.png','2')");

        $_SESSION['success'] = 'ทำการสมัครเสร็จสิ้น';
    } else {
        $_SESSION['errorregis'] = $er_mes;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    <!-- <style>
        @keyframes slideUpDown {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-50px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .img-fluid {
            animation: slideUpDown 5s infinite;
            /* กำหนดให้เคลื่อนไหวโดยไม่หยุด */
        }
    </style> -->
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

</head>

<body class="bg">
    <?php
    if (!empty($_SESSION['errorregis'])) {
        // แสดง SweetAlert ถ้ามีข้อความ errorlog
        echo "<script>
                            Swal.fire({
                              title: 'ล้มเหลว!',
                              text: '{$_SESSION['errorregis']}',
                              icon: 'error',
                              confirmButtonText: 'ตกลง'
                          });
                        </script>";
        $_SESSION['errorregis'] = '';
    }

    if (!empty($_SESSION['success'])) {
        echo "<script>
                Swal.fire({
                    title: 'สำเร็จ!',
                    text: 'ทำการสมัครเรียบร้อย',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                });
            </script>";
        $_SESSION['success'] = '';
    }
    ?>
    <div class="container py-3 text-dark">
        <section class="" style="">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card text-black"
                            style="border-radius : 1rem; background : hsla(0, 0%, 0%, 0.6); backdrop-filter : bulr(50px);">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <p class="text-white text-center h1 fw-bold mb-1 mx-1 mx-md-4">Sign up</p>
                                        <p class="text-center text-white-50 mb-0">กรุณากรอกข้อมูลให้ครบ</p>
                                        <p class="text-center text-white-50 mb-4">Please Enter All Information Compleately!
                                        </p>

                                        <form action="" id="myForm" method="post" enctype="multipart/form-data"
                                            class="mx-1 mx-md-4" onsubmit="return validateData()">

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="bi bi-person-fill me-3" style="font-size: 24px; color: white;"></i>
                                                <div class="col">
                                                    <div class="form-floating text-dark">
                                                        <input type="text" class="form-control" name="m_name"
                                                            id="m_name" placeholder="ชื่อผู้ใช้งาน">
                                                        <label>ชื่อจริง-นามสกุล</label>
                                                        <div id="nameError" class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- คำตอบของเฉลยเริ่มต้น -->
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="bi bi-envelope-fill me-3" style="font-size: 24px; color: white;"></i>
                                                <div class="col">
                                                    <div class="form-floating text-dark">
                                                        <input type="email" class="form-control" name="m_email"
                                                            id="m_email" placeholder="ชื่อผู้ใช้งาน">
                                                        <label>อีเมล</label>
                                                        <div id="emailError" class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- คำตอบของเฉลยสิ้นสุด -->
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="bi bi-telephone-fill me-3" style="font-size: 24px; color: white;"></i>
                                                <div class="col">
                                                    <div class="form-floating text-dark">
                                                        <input type="text" class="form-control" name="m_tel" id="m_tel"
                                                            placeholder="ชื่อผู้ใช้งาน">
                                                        <label>เบอร์โทร</label>
                                                        <div id="TelError" class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="bi bi-key-fill me-3" style="font-size: 24px; color: white;"></i>
                                                <div class="col">
                                                    <div class="form-floating text-dark">
                                                        <input type="password" class="form-control" name="m_pass"
                                                            id="m_pass" placeholder="ชื่อผู้ใช้งาน">
                                                        <label>รหัสผ่าน</label>
                                                        <div id="PassError" class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="bi bi-key-fill me-3" style="font-size: 24px; color: white;"></i>
                                                <div class="col">
                                                    <div class="form-floating text-dark">
                                                        <input type="password" class="form-control" name="con_m_pass"
                                                            id="con_m_pass" placeholder="ชื่อผู้ใช้งาน">
                                                        <label>ยืนยันรหัสผ่าน</label>
                                                        <div id="ConPassError" class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">


                                                <button type="submit" name="btregis"
                                                    class="btn btn-primary btn-animation-1">Registerd</button>

                                            </div>
                                            <div class="d-flex justify-content-center ">
                                                <span class="small" style="font-size: larger; color: white;">มีบัญชีผู้ใช้งานแล้ว
                                                    คุณสามารถ
                                                    <a href="login.php" class="text-primary"
                                                        style="text-decoration: none;">เข้าสู่ระบบ</a>
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
        function submitForm() {
            document.getElementById('myForm').submit();
        }
    </script>

    <script>
        function validateData() {
            var m_name = document.getElementById('m_name').value;
            var m_email = document.getElementById('m_email').value;
            var m_tel = document.getElementById('m_tel').value;
            var m_pass = document.getElementById('m_pass').value;
            var con_m_pass = document.getElementById('con_m_pass').value;
            var isValid = true;

            if (m_name.trim() === '') {
                isValid = false;
                document.getElementById('m_name').classList.add('is-invalid');
                document.getElementById('nameError').textContent = 'กรุณากรอกชื่อจริง และ นามสกุล';
            } else {
                document.getElementById('m_name').classList.remove('is-invalid');
                document.getElementById('nameError').textContent = '';
            }
            if (m_email.trim() === '') {
                isValid = false;
                document.getElementById('m_email').classList.add('is-invalid');
                document.getElementById('emailError').textContent = 'กรุณากรอกอีเมล';
            } else {
                document.getElementById('m_email').classList.remove('is-invalid');
                document.getElementById('emailError').textContent = '';
            }
            if (m_tel.trim() === '') {
                isValid = false;
                document.getElementById('m_tel').classList.add('is-invalid');
                document.getElementById('TelError').textContent = 'กรุณากรอกเบอร์โทร';
            } else {
                document.getElementById('m_tel').classList.remove('is-invalid');
                document.getElementById('TelError').textContent = '';
            }
            if (m_pass.trim() === '') {
                isValid = false;
                document.getElementById('m_pass').classList.add('is-invalid');
                document.getElementById('PassError').textContent = 'กรุณากรอกรหัสผ่าน';
            } else {
                document.getElementById('m_pass').classList.remove('is-invalid');
                document.getElementById('PassError').textContent = '';
            }
            if (con_m_pass.trim() === '') {
                isValid = false;
                document.getElementById('con_m_pass').classList.add('is-invalid');
                document.getElementById('ConPassError').textContent = 'กรุณากรอกยืนยันรหัสผ่าน';
            } else {
                document.getElementById('con_m_pass').classList.remove('is-invalid');
                document.getElementById('ConPassError').textContent = '';
            }

            if (!isValid) {
                // แสดง alert หรือข้อความบนหน้าจอ
                Swal.fire({
                    title: 'ล้มเหลว!',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            }

            return isValid;
        }
    </script>
</body>

</html>