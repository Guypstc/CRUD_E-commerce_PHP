<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบประเมินออนไลน์</title>
    <?php include "head.php"; ?>
</head>
<body>
    <div class="container">
        <form class="form-control" method="post" action="testsave.php">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><b>ตอนที่1</b>ข้อมูลพื้นฐาน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>เพศ</td>
                        <td>
                            <div class="form-group">
                                <input class="form-check-input" type="radio" name="rdo_gender" value="ชาย" required>
                                <label class="form-check-label">ชาย</label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" type="radio" name="rdo_gender" value="หญิง" required>
                                <label class="form-check-label">หญิง</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>อายุ</td>
                        <td>
                            <label>
                                <input class="form-check-input" name="rdo_age" type="radio" value="อายุต่ำกว่า 20 ปี" required>
                                อายุต่ำกว่า 20 ปี</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_age" type="radio" value="อายุระหว่าง 20-30 ปี" required>
                                อายุระหว่าง 20-30 ปี</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_age" type="radio" value="อายุระหว่าง 30-40 ปี" required>
                                อายุระหว่าง 30-40 ปี</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_age" type="radio" value="อายุระหว่าง 40-50 ปี" required>
                                อายุระหว่าง 40-50 ปี</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_age" type="radio" value="อายุระหว่าง 50-60 ปี" required>
                                อายุระหว่าง 50-60 ปี</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_age" type="radio" value=" อายุสูงกว่า 60 ปี" required>
                                อายุสูงกว่า 60 ปี</label>
                            </br>
                        </td>
                    </tr>
                    <tr>
                        <td>รายได้</td>
                        <td>
                            <label>
                                <input class="form-check-input" name="rdo_income" type="radio" value=" รายได้ต่ำกว่า 10,000 บาท" required>
                                รายได้ต่ำกว่า 10,000 บาท</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_income" type="radio" value=" รายได้ระหว่าง 10,000-20,000 บาท" required>
                                รายได้ระหว่าง 10,000-20,000 บาท</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_income" type="radio" value="รายได้ระหว่าง 20,000-30,000 บาท" required>
                                รายได้ระหว่าง 20,000-30,000 บาท</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_income" type="radio" value="รายได้ระหว่าง 30,000-40,000 บาท" required>
                                รายได้ระหว่าง 30,000-40,000 บาท</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_income" type="radio" value=" รายได้ระหว่าง 40,000-50,000 บาท" required>
                                รายได้ระหว่าง 40,000-50,000 บาท</label>
                            </br>
                            <label>
                                <input class="form-check-input" name="rdo_income" type="radio" value=" รายได้สูงกว่า 50,000 บาท" required>
                                รายได้สูงกว่า 50,000 บาท</label>
                            </br>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th scope="col"><b>ตอนที่ 2</b>ความพึงพอใจในการใช้เว็ปไซต์</th>
                    </tr>
                    <tr>
                        <th scope="col">รายการ</th>
                        <th scope="col">มากที่สุด</th>
                        <th scope="col">มาก</th>
                        <th scope="col">ปานกลาง</th>
                        <th scope="col">น้อย</th>
                        <th scope="col">น้อยที่สุด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include "connect.php"; 
                    $sql = "SELECT * FROM tb_question";
                    $result = mysqli_query($connect,$sql);
                    $i = 1;
                    while($row = mysqli_fetch_array($result)){
                        $id = $row['id_question'];
                        $name = $row['question'];
                    ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><input class="form-check-input" name="radioNo<?php echo $i; ?>" id="radioNo<?php echo $i; ?>_1" type="radio" value="5" required></td>
                        <td><input class="form-check-input" name="radioNo<?php echo $i; ?>" id="radioNo<?php echo $i; ?>_2" type="radio" value="4" required></td>
                        <td><input class="form-check-input" name="radioNo<?php echo $i; ?>" id="radioNo<?php echo $i; ?>_3" type="radio" value="3" required></td>
                        <td><input class="form-check-input" name="radioNo<?php echo $i; ?>" id="radioNo<?php echo $i; ?>_4" type="radio" value="2" required></td>
                        <td><input class="form-check-input" name="radioNo<?php echo $i; ?>" id="radioNo<?php echo $i; ?>_5" type="radio" value="1" required></td>
                    </tr>
                    <?php $i++;} ?>
                </tbody>
            </table>
            <div class="form-group">
                <label>ข้อเสนอเเนะอื่นๆ</label>
                <textarea class="form-control" name="rdo_status" type="text" palceholder="ข้อเสนอเเนะอื่นๆ" required></textarea>
            </div> 
            <center><input class="form-control" name="hdnRow" value="<?php echo $i-1; ?>" type="hidden"></center>
            <center><input class="btn btn-primary"  type="submit" value="ส่งเเบบประเมิน"></center>
        </form>
    </div>
    
</body>
</html>