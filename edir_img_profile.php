<?php
include("connect.php");
if(!empty($_POST['iii'])){
        if(!empty($_FILES['imgprofile']['name'])){
            $imgprofile = $_FILES['imgprofile'];
            $tmp = explode('.',$imgprofile['name']);
            $filetype = end($tmp);
                if($filetype != 'jpeg' && $filetype != 'jpg' && $filetype != 'png'){
                    $er_mes .= 'รูปแบบไฟล์ไม่ถูกต้อง<br/>';
                }else{
                    $filename  = date('dmyHis').'.'.$filetype; 
                    move_uploaded_file($_FILES['imgprofile']['tmp_name'],'images/member/'.$filename);
                    @unlink("images/member/".$_POST['oldimg']);
                }
        }
            mysqli_query($connect,"UPDATE `tb_member` SET `m_image`='$filename',
             WHERE m_id = '".$_GET['edituser']."' "); 
                header('location:pro_file.php');
        }else{
            $_SESSION['error'] = $er_mes;
        }

?>