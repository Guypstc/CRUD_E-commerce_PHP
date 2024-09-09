<?php 
    if(empty($_SESSION['m_id'])){
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'danger',
            title: 'กรุณาเข้าสู่ระบบ',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'cart.php'; // ให้เด้งไปยังหน้า cart.php เมื่อหมดเวลา
        });
        </script>";
    }

?>