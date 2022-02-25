<?php

include 'init.php';
$data = null;
if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case 'find':
            if(isset($_POST['id']) && $_POST['id'] != NULL) {
                $id = $_POST['id'];
                $user = $userf->findmember($id);
                if (!$user) {
                    $error = 'User not found!!';
                }
                else {
                    $data = $user;
                }
            }
            break;
        case 'del':
            if(isset($_POST['id']) && $_POST['id'] != NULL) {
                $id = $_POST['id'];
                $user = $userf->delmember($id);
                if (!$user) {
                    $error = "Delete error!!";
                }
                else {
                    $success = "ลบสำเร็จ";
                }
            }
            break;
        case 'update':
            if (isset($_POST['id']) && isset($_POST['psswd']) && isset($_POST['name']) && isset($_POST['group']) && isset($_POST['member_type']) && isset($_POST['address']) && isset($_POST['tell']) && $_POST['id'] != NULL && $_POST['psswd'] != NULL) {
                $user = $userf->updatemember($_POST['id'], $_POST['psswd'], $_POST['name'], $_POST['group'], $_POST['address'], $_POST['tell'], $_POST['member_type']);
                if ($user === true) {
                    $success = "อัพเดทสำเร็จ";
                }
            }
            else {
                $error = "กรุณากรอกข้อมูลให้ครบ";
            }
            break;
        case 'add':
            if (isset($_POST['id']) && isset($_POST['psswd']) && isset($_POST['name']) && isset($_POST['group']) && isset($_POST['member_type']) && isset($_POST['address']) && isset($_POST['tell']) && $_POST['id'] != NULL && $_POST['psswd'] != NULL) {
                $user = $userf->register($_POST['id'], $_POST['psswd'], $_POST['name'], $_POST['group'], $_POST['address'], $_POST['tell'], $_POST['member_type']);
                if ($user === true) {
                    $success = "เพิ่มสำเร็จ";
                }
                else {
                    $error = $user;
                }
            }
            else {
                $error = "กรุณากรอกข้อมูลให้ครบ";
            }
            break;
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member</title>
</head>
<body style='color: #E04DB0;'>
    <h1>ข้อมูลสมาชิก</h1>
    <form action="" method="post">
        <h5>รหัสนักศึกษา : <input type="text" name="id" id="" value="<?php if ($data != null){ echo $data->id; } ?>"required><button type="submit" value="find" name="submit">ค้นหา</button></h5>
        <h5>รหัสผ่าน : <input type="password" name="psswd" id=""></h5>
        <h5>ชื่อ-สกุล : <input type="text" name="name" id="" value="<?php if ($data != null){ echo $data->name; } ?>"></h5>
        <h5>กลุ่ม : <input type="number" name="group" id="" value="<?php if ($data != null){ echo $data->member_group; } ?>"></h5>
        <h5>ที่อยู่ : <input type="text" name="address" id="" value="<?php if ($data != null){ echo $data->address; } ?>"></h5>
        <h5>เบอร์โทรศัพท์ : <input type="tel" name="tell" id="" value="<?php if ($data != null){ echo $data->tell; } ?>"></h5>
        <h5>ประเภทสมาชิก : <input type="number" name="member_type" id="" value="<?php if ($data != null){ echo $data->member_type; } ?>"></h5>
        <button type="submit" value="add" name="submit" >เพิ่ม</button>
        <button type="submit" value="update" name="submit">แก้ไข</button>
        <button type="submit" value="del" name="submit" onclick="return confirm('are you sure you want to delete?')">ลบ</button>
    </form>
    <?php
        if (isset($error)) {
            echo "<h1 style='color:red'>$error</h1>";
        }
        if (isset($success)) {
            echo "<h1 style='color:green'>$success</h1>";
        }
    ?>
    <h2><a href="home.php">เมนูหลัก</a></h2>
</body>
</html>