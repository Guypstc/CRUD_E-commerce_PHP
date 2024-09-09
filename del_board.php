<?php
    require('connect.php');
    session_start();
    if(isset($_GET['id']) && isset($_SESSION['m_id'])){
        $del_id = $_GET['id'];
        $del_check_run = mysqli_query($connect,"SELECT * FROM tb_board  WHERE b_id = '$del_id' AND b_parent_id = 0 ");
        $del_check_show = mysqli_fetch_array($del_check_run,MYSQLI_BOTH);
        $del_check_count = mysqli_num_rows($del_check_run);
        $pro_id = $del_check_show['pro_id'];
        if(($del_check_show['m_id'] == $_SESSION['m_id'] || $_SESSION['m_level'] == 1) && $del_check_count > 0){
            mysqli_query($connect,"DELETE FROM tb_board WHERE b_parent_id = '$del_id'");
            mysqli_query($connect,"DELETE FROM tb_board WHERE b_id = '$del_id' AND b_parent_id = 0");
            echo "<script>alert('ลบคำถามสำเร็จ');location='show_pro.php?id=$pro_id'</script>";
        }else{
            header("location: index.php");
        }
    }else{
        header("location: index.php");
    }
?>