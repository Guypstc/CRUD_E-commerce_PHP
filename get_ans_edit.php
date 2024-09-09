<?php
    session_start();
    require('connect.php');
    if(isset($_POST['btn_send'])){
        $e_ans_id = $_POST['id'];
        $text = $_POST['text'];
        $sql_ans_run = mysqli_query($connect,"SELECT * FROM tb_board WHERE b_id = '$e_ans_id' AND NOT b_parent_id = 0");
        $sql_ans_show = mysqli_fetch_array($sql_ans_run,MYSQLI_BOTH);
        $sql_ans_count = mysqli_num_rows($sql_ans_run); 
        if(isset($_SESSION['m_id']) && isset($_POST['id'])){
                if(($_SESSION['m_id'] == $sql_ans_show['m_id'] || $_SESSION['m_level'] == 1) && $sql_ans_count > 0 ){
                    if(!empty($_POST['text'])){
                            $parent_id = $sql_ans_show['b_parent_id'];
                            mysqli_query($connect,"UPDATE tb_board SET b_detail = '$text',b_time_update=SYSDATE() WHERE b_id = '$e_ans_id'");
                            echo"<script>alert('แก้ไขสำเร็จ');location='testviewboard.php?id=$parent_id';</script>";
                    }else{
                        echo"<script>alert('กรุณากรอกข้อความ');location='ans_edit.php?id=$e_ans_id';</script>";
                    }
                }else{
                    header('location: index.php');
                }
        }else{  
            header('location: index.php');
        }
    }else{
        header('location: index.php');
    }
?>