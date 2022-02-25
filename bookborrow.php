<?php
include 'init.php';
$data_user = null;
$data_book = null;
$data_officer = null;
$savebook = false;

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'check') {
        if(isset($_POST['member_id']) && $_POST['member_id'] != NULL) {
            $id = $_POST['member_id'];
            $user = $userf->find($id);
            if (!$user) {
                $member_text = 'User not found!!';
            }
            else {
                $data_user = $user;
                $member_text = $data_user->name;
            }
        }
        if(isset($_POST['book_id']) && $_POST['book_id'] != NULL) {
            $id = $_POST['book_id'];
            $book = $bookf->findbook($id);
            if (!$book) {
                $book_text = 'Book not found!!';
            }
            else {
                $data_book = $book;
                $book_text = $data_book->book_name;
            }
        }
        if(isset($_POST['officer_id']) && $_POST['officer_id'] != NULL) {
            $id = $_POST['officer_id'];
            $officer = $userf->findofficer($id);
            if (!$officer) {
                $officer_text = 'Officer not found!!';
            }
            else {
                $data_officer = $officer;
                $officer_text = $data_officer->name;
            }
        }
    }
    if ($_POST['submit'] == 'add') {
        if (isset($_POST['member_id']) && isset($_POST['book_id']) && isset($_POST['date_borrow']) && isset($_POST['exp_date']) && isset($_POST['officer_id'])) {
            $borrow = $borrowf->borrow_book($_POST['member_id'], $_POST['book_id'], $_POST['date_borrow'], $_POST['officer_id'], $_POST['exp_date']);
            if ($borrow === true) {
                $success = "เพิ่มข้อมูลสำเร็จ";
            }
            else {
                $error = $borrow;
            }
        }
        else {
            $error = "กรุณากรอกข้อมูลให้ครบ";
        }
    }
    
}
if ($data_user != null && $data_book != null && $data_officer != null) {
    $savebook = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>borrow</title>
</head>
<body style='color: #139487;'>
    <h1>ข้อมูลการยืมหนังสือ</h1>
    <form action="" method="post">
        <h5>รหัสนักศึกษา : <input type="text" name="member_id" id="" value="<?php 
            if ($data_user != null){ echo $data_user->id; 
            }
        ?>">
        <?php 
            if (isset($member_text) && $member_text != null){ 
                echo $member_text; 
            }
        ?></h5>
        <h5>รหัสหนังสือ : <input type="text" name="book_id" id="" value="<?php 
            if ($data_book != null){ 
                echo $data_book->book_id; 
            } 
        ?>">
        <?php 
            if (isset($book_text) && $book_text != null){ 
                echo $book_text; 
            } 
        ?></h5>
        <h5>วันที่ยืม : <input type="date" name="date_borrow" id="" value="<?php echo date('Y-m-d');?>"></h5>
        <input type="date" name="exp_date" id="" hidden value="<?php
            if ($data_book != NULL && $data_user != NULL) {
                if ($data_user->member_type == 0) {
                    $day = $data_book->officer_day;
                }
                else {
                    $day = $data_book->member_day;
                }
                $date_now = date('Y-m-d');
                $expdate = date('Y-m-d', strtotime($date_now.'+ '.$day.' days'));
                echo $expdate;
            }
        ?>">
        <h5>วันที่ครบกำหนดคืน : <input type="date" name="" id="" disabled value="<?php echo $expdate;?>"></h5>
        <h5>รหัสผู้ให้ยืม : <input type="text" name="officer_id" id="" value="<?php 
            if ($data_officer != null) {
                echo $data_officer->id; 
            }
            ?>">
        <?php
            if (isset($officer_text) && $officer_text != null) {
                echo $officer_text; 
            }    
        ?></h5>
        <button type="submit" value="check" name="submit">ตรวจสอบ</button>
        <button type="submit" value="add" name="submit" <?php if (!$savebook) { echo "disabled";} ?>>บันทึก</button>
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