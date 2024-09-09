<?php include "connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "head.php"; ?>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row p-2">
            <div class="col-lg">
                <div class="card shadow md-4">
                    <div class="card-hader py-3">
                        <h4 class="m-0 font-weight-bold text-primary">ตอนที่ 1 ข้อมูลพื้นฐาน(เพศ)
                            <span class="float-end text-secondary">
                                <?php 
                                    $result = mysqli_query($connect, "SELECT count(id_person) as qty FROM tb_person");
                                    while($row = mysqli_fetch_array($result)){
                                        $count = $row['qty'];
                                    }
                                ?>
                            </span>
                        </h4>
                    </div>
                    <?php 
                    $result = mysqli_query($connect, "SELECT gender ,count(id_person) as qty FROM tb_person GROUP BY gender='ชาย' ");
                    $row = mysqli_fetch_array($result);

                    $result1 = mysqli_query($connect, "SELECT gender ,count(id_person) as qty FROM tb_person GROUP BY gender='หญิง' ");
                    $row1 = mysqli_fetch_array($result1);
                    ?>
                    <div class="card-body">
                        <h6 class="font-weight-bold text-dark">
                            <?php echo $row['gender']; ?>
                            <span class="float-end text-secondary">
                                จำนวน<?php echo $row['qty']; ?>คน
                            </span>
                        </h6>
                        <div class="progress">
                            <div class="progress-bar" style="width:<?php echo $row['qty'] * 5; ?>%"
                            aria-valuenow="<?php echo $row['qty'] * 5; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <h6 class="font-weight-bold text-dark">
                            <?php echo $row1['gender']; ?>
                            <span class="float-end text-secondary">
                                จำนวน<?php echo $row1['qty']; ?>คน
                            </span>
                        </h6>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width:<?php echo $row1['qty'] * 5; ?>%"
                            aria-valuenow="<?php echo $row1['qty'] * 5; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="card shadow md-4">
                    <div class="card-hader py-3">
                        <h4 class="m-0 font-weight-bold text-primary">ตอนที่ 1 ข้อมูลพื้นฐาน(อายุ)
                            <span class="float-end text-secondary">
                               
                            </span>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php 
                    $result = mysqli_query($connect, "SELECT age ,count(id_person) as qtyage FROM tb_person GROUP BY age ");
                    while($row = mysqli_fetch_array($result)){
                    ?>
                        <h6 class="font-weight-bold text-dark">
                            <?php echo $row['age']; ?>
                            <span class="float-end text-secondary">
                                จำนวน<?php echo $row['qtyage']; ?>คน
                            </span>
                        </h6>
                        <div class="progress">
                            <div class="progress-bar bg-dark" style="width:<?php echo $row['qtyage'] * 5; ?>%"
                            aria-valuenow="<?php echo $row['qtyage'] * 5; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="card shadow md-4">
                    <div class="card-hader py-3">
                        <h4 class="m-0 font-weight-bold text-primary">ตอนที่ 1 ข้อมูลพื้นฐาน(รายได้)
                            <span class="float-end text-secondary">
                                
                            </span>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php 
                    $result = mysqli_query($connect, "SELECT education ,count(id_person) as qtyeducation FROM tb_person GROUP BY education ");
                    while($row = mysqli_fetch_array($result)){
                    ?>
                        <h6 class="font-weight-bold text-dark">
                            <?php echo $row['education']; ?>
                            <span class="float-end text-secondary">
                                จำนวน<?php echo $row['qtyeducation']; ?>คน
                            </span>
                        </h6>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width:<?php echo $row['qtyeducation'] * 5; ?>%"
                            aria-valuenow="<?php echo $row['qtyeducation'] * 5; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="row p-2">
            <div class="col-lg-9">
                <div class="card shadow md-4">
                    <div class="card-hader py-3">
                        <h4 class="m-0 font-weight-bold text-primary">ตอนที่ 2 ความพึงพอใจในการใช้เว็ปไซต์
                            <span class="float-end text-secondary">
                                <?php 
                                    $result = mysqli_query($connect, "SELECT count(id_person) as qty FROM tb_person");
                                    while($row = mysqli_fetch_array($result)){
                                        $count = $row['qty'];
                                    }
                                ?>
                            </span>
                        </h4>
                    </div>
                    <?php 
                    $result = mysqli_query($connect, "SELECT tb_question.*,tb_answer.id_person, sum(tb_answer.score) as qtyscore ,count(tb_answer.id_person) as qtyperson FROM tb_answer LEFT JOIN tb_question ON tb_answer.id_question = tb_question.id_question WHERE tb_answer.id_question='1' ");
                    $row = mysqli_fetch_array($result);

                    $result1 = mysqli_query($connect, "SELECT tb_question.*,tb_answer.id_person, sum(tb_answer.score) as qtyscore ,count(tb_answer.id_person) as qtyperson FROM tb_answer LEFT JOIN tb_question ON tb_answer.id_question = tb_question.id_question WHERE tb_answer.id_question='2' ");
                    $row1 = mysqli_fetch_array($result1);

                    $result2 = mysqli_query($connect, "SELECT tb_question.*,tb_answer.id_person, sum(tb_answer.score) as qtyscore ,count(tb_answer.id_person) as qtyperson FROM tb_answer LEFT JOIN tb_question ON tb_answer.id_question = tb_question.id_question WHERE tb_answer.id_question='3' ");
                    $row2 = mysqli_fetch_array($result2);

                    $result3 = mysqli_query($connect, "SELECT tb_question.*,tb_answer.id_person, sum(tb_answer.score) as qtyscore ,count(tb_answer.id_person) as qtyperson FROM tb_answer LEFT JOIN tb_question ON tb_answer.id_question = tb_question.id_question WHERE tb_answer.id_question='4' ");
                    $row3 = mysqli_fetch_array($result3);

                    $result4 = mysqli_query($connect, "SELECT tb_question.*,tb_answer.id_person, sum(tb_answer.score) as qtyscore ,count(tb_answer.id_person) as qtyperson FROM tb_answer LEFT JOIN tb_question ON tb_answer.id_question = tb_question.id_question WHERE tb_answer.id_question='5' ");
                    $row4 = mysqli_fetch_array($result4);

                    $result5 = mysqli_query($connect, "SELECT tb_question.*,tb_answer.id_person, sum(tb_answer.score) as qtyscore ,count(tb_answer.id_person) as qtyperson FROM tb_answer LEFT JOIN tb_question ON tb_answer.id_question = tb_question.id_question WHERE tb_answer.id_question='6' ");
                    $row5 = mysqli_fetch_array($result5);

                    $resultA = mysqli_query($connect, "SELECT * FROM tb_question WHERE id_question='6' ");
                    $rowA = mysqli_fetch_array($resultA);
                    ?>
                <div class="card-body">
                    <h4 class="font-weight-bold text-dark">
                        <?php echo $row['question']; ?>
                        <span class="float-end text-secondary">
                            <?php echo number_format(($row['qtyscore'] / $row['qtyperson']),2); ?>
                            <?php $answer = (number_format(($row['qtyscore'] / $row['qtyperson']),2)); 
                            if($answer >= 4.50){
                                echo "มากที่สุด";
                            }else if($answer >= 3.50){
                                echo "มาก";
                            }else if($answer >= 2.50){
                                echo "ปานกลาง";
                            }else if($answer >= 1.50){
                                echo "น้อย";
                            }else{
                                echo "น้อยที่สุด";
                            }
                            ?>
                        </span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar md-4" style="width:<?php echo number_format(($row['qtyscore'] / $row['qtyperson'])*2*10); ?>%"
                        aria-valuenow="<?php echo number_format(($row['qtyscore'] / $row['qtyperson'])*2*10); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <h4 class="font-weight-bold text-dark">
                        <?php echo $row1['question']; ?>
                        <span class="float-end text-secondary">
                            <?php echo number_format(($row1['qtyscore'] / $row1['qtyperson']),2); ?>
                            <?php $answer = (number_format(($row1['qtyscore'] / $row1['qtyperson']),2)); 
                            if($answer >= 4.50){
                                echo "มากที่สุด";
                            }else if($answer >= 3.50){
                                echo "มาก";
                            }else if($answer >= 2.50){
                                echo "ปานกลาง";
                            }else if($answer >= 1.50){
                                echo "น้อย";
                            }else{
                                echo "น้อยที่สุด";
                            }
                            ?>
                        </span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar md-4" style="width:<?php echo number_format(($row1['qtyscore'] / $row1['qtyperson'])*2*10); ?>%"
                        aria-valuenow="<?php echo number_format(($row1['qtyscore'] / $row1['qtyperson'])*2*10); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <h4 class="font-weight-bold text-dark">
                        <?php echo $row2['question']; ?>
                        <span class="float-end text-secondary">
                            <?php echo number_format(($row2['qtyscore'] / $row2['qtyperson']),2); ?>
                            <?php $answer = (number_format(($row2['qtyscore'] / $row2['qtyperson']),2)); 
                            if($answer >= 4.50){
                                echo "มากที่สุด";
                            }else if($answer >= 3.50){
                                echo "มาก";
                            }else if($answer >= 2.50){
                                echo "ปานกลาง";
                            }else if($answer >= 1.50){
                                echo "น้อย";
                            }else{
                                echo "น้อยที่สุด";
                            }
                            ?>
                        </span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar md-4" style="width:<?php echo number_format(($row2['qtyscore'] / $row2['qtyperson'])*2*10); ?>%"
                        aria-valuenow="<?php echo number_format(($row2['qtyscore'] / $row2['qtyperson'])*2*10); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <h4 class="font-weight-bold text-dark">
                        <?php echo $row3['question']; ?>
                        <span class="float-end text-secondary">
                            <?php echo number_format(($row3['qtyscore'] / $row3['qtyperson']),2); ?>
                            <?php $answer = (number_format(($row3['qtyscore'] / $row3['qtyperson']),2)); 
                            if($answer >= 4.50){
                                echo "มากที่สุด";
                            }else if($answer >= 3.50){
                                echo "มาก";
                            }else if($answer >= 2.50){
                                echo "ปานกลาง";
                            }else if($answer >= 1.50){
                                echo "น้อย";
                            }else{
                                echo "น้อยที่สุด";
                            }
                            ?>
                        </span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar md-4" style="width:<?php echo number_format(($row3['qtyscore'] / $row3['qtyperson'])*2*10); ?>%"
                        aria-valuenow="<?php echo number_format(($row3['qtyscore'] / $row3['qtyperson'])*2*10); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <h4 class="font-weight-bold text-dark">
                        <?php echo $row4['question']; ?>
                        <span class="float-end text-secondary">
                            <?php echo number_format(($row4['qtyscore'] / $row4['qtyperson']),2); ?>
                            <?php $answer = (number_format(($row4['qtyscore'] / $row4['qtyperson']),2)); 
                            if($answer >= 4.50){
                                echo "มากที่สุด";
                            }else if($answer >= 3.50){
                                echo "มาก";
                            }else if($answer >= 2.50){
                                echo "ปานกลาง";
                            }else if($answer >= 1.50){
                                echo "น้อย";
                            }else{
                                echo "น้อยที่สุด";
                            }
                            ?>
                        </span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar md-4" style="width:<?php echo number_format(($row4['qtyscore'] / $row4['qtyperson'])*2*10); ?>%"
                        aria-valuenow="<?php echo number_format(($row4['qtyscore'] / $row4['qtyperson'])*2*10); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <?php if($rowA < 6){ ?>

                        <?php } else { ?>
                            <h4 class="font-weight-bold text-dark">
                        <?php echo $row5['question']; ?>
                        <span class="float-end text-secondary">
                            <?php echo number_format(($row5['qtyscore'] / $row5['qtyperson']),2); ?>
                            <?php $answer = (number_format(($row5['qtyscore'] / $row5['qtyperson']),2)); 
                            if($answer >= 4.50){
                                echo "มากที่สุด";
                            }else if($answer >= 3.50){
                                echo "มาก";
                            }else if($answer >= 2.50){
                                echo "ปานกลาง";
                            }else if($answer >= 1.50){
                                echo "น้อย";
                            }else{
                                echo "น้อยที่สุด";
                            }
                            ?>
                        </span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar md-4" style="width:<?php echo number_format(($row5['qtyscore'] / $row5['qtyperson'])*2*10); ?>%"
                        aria-valuenow="<?php echo number_format(($row5['qtyscore'] / $row5['qtyperson'])*2*10); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                            <?php } ?>
                </div>
            </div>
        </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="card p-3 shadow md-4">
                            <div class="card-body badge bg-danger rounded-3 p-2">
                                <h4 class="text-center">จำนวนคนตอบคำถาม</4>
                                <center><font style="font-size:180px"><?php echo $count; ?></font><center>
                                <b>คน</b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card p-3 shadow md-4">
                            <div class="card-body badge bg-danger rounded-3 p-2">
                                <h4 class="text-center"><a href="" class="link-light">คลิกเพื่อดูข้อเสนอเเนะ</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
</div>        
</body>
</html>