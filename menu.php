<?php
$server_index = "/webweb/index.php";
$server_noti = "/webweb/b_noti.php";
$sql_count_board = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM tb_board WHERE read_status = 0 AND b_parent_id = 0"));
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" data-bs-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php"
                        class="nav-link <?php if ($_SERVER['PHP_SELF'] == $server_index) { ?>  active <?php } ?> ?> ">หน้าหลัก</a>
                </li>
                <?php if (!isset($_SESSION['m_id'])) { ?>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">เข้าสู่ระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">สมัครสมาชิก</a>
                    </li>
                    
                <?php } else { ?>
                    <?php if ($_SESSION['m_level'] == 1) { ?>
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">จัดการระบบ</a>
                            <ul class="dropdown-menu">
                                <li><a href="show_user.php" class="dropdown-item">จัดการผู้ใช้งาน</a></li>
                                <li><a href="show_type.php" class="dropdown-item">จัดการประเภทสินค้า</a></li>
                                <li><a href="show_product.php" class="dropdown-item">จัดการสินค้า</a></li>
                                <li><a href="show_slide.php" class="dropdown-item">จัดการประชาสัมพันธ์</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="report_order.php" class="nav-link" >จัดการการชำระเงิน</a>
                        </li>
                        <li class="nav-item">
                            <a href="b_noti.php"
                                class="nav-link <?php if ($_SERVER['PHP_SELF'] == $server_noti) { ?>  active <?php } ?> position-relative">แจ้งเตือนกระทู้
                                <?php if ($sql_count_board > 0) { ?>
                                    <span class="position-absolute top-30 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $sql_count_board ?>
                                    </span>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a href="pro_file.php" class="nav-link">บัญชีของฉัน</a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php" class="nav-link">ตะกร้า</a>
                        </li>

                    <?php } ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showConfirmation()">ออกจากระบบ</a>
                        <script>
                            function showConfirmation() {
                                Swal.fire({
                                    title: "แจ้งเตือน!",
                                    text: "คุณต้องการออกจากระบบหรือไม่?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "ตกลง",
                                    cancelButtonText: "ยกเลิก"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'logout.php'; // เพิ่มลิงก์ logout.php ที่นี่
                                    }
                                });
                            }
                        </script>

                    </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="" method="post">
                        <div class="input-group">

                            <?php $key = '';
                            if (!empty($_POST['key'])) {
                                $key = $_POST['key'];
                            }
                            ?>
                            <input type="text" name="key" value="<?php echo $key; ?>"
                                class="form-control bg-light text-dark border border-secondary" placeholder="ค้นหา">
                            <input type="submit" value="ค้นหา" class="btn btn-outline-secondary">
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>