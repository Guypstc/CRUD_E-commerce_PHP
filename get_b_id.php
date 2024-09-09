<?php   
    session_start();
    require('connect.php');
    if(isset($_POST['t'])){
        $topic = $_POST['t'];
    }
    if(isset($_POST['d'])){
        $detail = $_POST['d'];
    }
     if(isset($_POST['e_id']) && isset($_SESSION['m_id'])){
        $e_id = $_POST['e_id'];
        $sql_b_run = mysqli_query($connect,"SELECT * FROM tb_board WHERE b_id = '$e_id'");
        $sql_b_check = mysqli_fetch_array($sql_b_run,MYSQLI_BOTH);
        $sql_b_count = mysqli_num_rows($sql_b_run);
        if($sql_b_count > 0){
            if($sql_b_check['m_id'] == $_SESSION['m_id'] || $_SESSION['m_level'] == 1){
                if(!empty($_POST['t']) || !empty($_POST['d'])){
                    if(!empty($_POST['t']) && empty($_POST['d'])){
                        mysqli_query($connect,"UPDATE tb_board SET b_topic = '$topic',b_time_update=SYSDATE() WHERE b_id = '$e_id'");
                    }elseif(!empty($_POST['d']) && empty($_POST['t'])){
                        mysqli_query($connect,"UPDATE tb_board SET b_detail = '$detail',b_time_update=SYSDATE() WHERE b_id = '$e_id'");
                    }elseif(!empty($_POST['d']) && !empty($_POST['t'])){
                        mysqli_query($connect,"UPDATE tb_board SET b_detail = '$detail',b_topic = '$topic',b_time_update=SYSDATE() WHERE b_id = '$e_id'");
                    }
                    echo "<script>alert('แก้ไขสำเร็จ');location='testviewboard.php?id=$e_id';</script>";
                }else{
                    $_SESSION['e_want'] = '';
                    echo "<script>location='board_edit.php?id=$e_id';</script>";
                }
            }else{
                header('location: index1.php');
             }
        }else{
            header('location: index1.php');
         }
     }else{
        header('location: index1.php');
     }
?>