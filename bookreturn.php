<?php
include 'init.php';
$data_user = null;
$data_book = null;
$data_officer = null;
$savebook = false;
$havelist = false;
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
        if(isset($_POST['officer_id_return']) && $_POST['officer_id_return'] != NULL) {
            $id = $_POST['officer_id_return'];
            $officer = $userf->findofficer($id);
            if (!$officer) {
                $officer_text = 'Officer not found!!';
            }
            else {
                $data_officer = $officer;
                $officer_text = $data_officer->name;
            }
        }
        if (isset($_POST['member_id']) && $_POST['member_id'] != NULL && isset($_POST['book_id']) && $_POST['book_id'] != NULL) {
            $brr_name = $borrowf->borrow_officer_name($_POST['member_id'], $_POST['book_id']);
            if ($brr_name) {
                $book_officer_borrow_name = $brr_name->name;
                $havelist = true;
            }
            else {
                $error = "ไม่พบรายการยืม";
            }
        }
    }
    if ($_POST['submit'] == 'return') {
        if (isset($_POST['member_id']) && isset($_POST['book_id']) && isset($_POST['date_return']) && isset($_POST['officer_id_return'])) {
            $borrow = $borrowf->return_book($_POST['member_id'], $_POST['book_id'], $_POST['date_return'], $_POST['officer_id_return']);
            if ($borrow === true) {
                $success = "เพิ่มข้อมูลสำเร็จ";
            }
            else {
                $error = $borrow;
            }
        }
    }
    if ($data_user != null && $data_book != null && $data_officer != null && $havelist == true) {
        $savebook = true;
    }
    
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
    <h1>ข้อมูลการคืนหนังสือ</h1>
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
        <h5>วันที่คืน : <input type="date" name="date_return" id="" value="<?php echo date('Y-m-d');?>"></h5>
        <h5>ชื่อผู้ให้ยืม : <?php
            if (isset($book_officer_borrow_name) && $book_officer_borrow_name != null) {
                echo $book_officer_borrow_name;
            }  
            ?></h5>
        <h5>รหัสผู้รับคืน : <input type="text" name="officer_id_return" id="" value="<?php 
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
        <button type="submit" value="return" name="submit" <?php if (!$savebook) { echo "disabled";} ?>>บันทึก</button>
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