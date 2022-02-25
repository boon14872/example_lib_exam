<?php
include 'init.php';
$data = null;
if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case 'find':
            if(isset($_POST['id']) && $_POST['id'] != NULL) {
                $id = $_POST['id'];
                $book = $bookf->findbook($id);
                if (!$book) {
                    $error = 'Book not found!!';
                }
                else {
                    $data = $book;
                }
            }
            break;
        case 'del':
            if(isset($_POST['id']) && $_POST['id'] != NULL) {
                $id = $_POST['id'];
                $book = $bookf->delbook($id);
                if (!$book) {
                    $error = "Delete error!!";
                }
                else {
                    $success = "ลบสำเร็จ";
                }
            }
            break;
        case 'update':
            if (isset($_POST['id']) && isset($_POST['bookname']) && isset($_POST['author']) && isset($_POST['publisher']) && isset($_POST['price']) && isset($_POST['member_day']) && isset($_POST['officer_day']) && $_POST['id'] != NULL) {
                $book = $bookf->updatebook($_POST['id'], $_POST['bookname'], $_POST['author'], $_POST['publisher'], $_POST['price'], $_POST['member_day'], $_POST['officer_day']);
                if ($book) {
                    $success = "อัพเดทสำเร็จ";
                }
            }
            else {
                $error = "กรุณากรอกข้อมูลให้ครบ";
            }
            break;
        case 'add':
            if (isset($_POST['id']) && isset($_POST['bookname']) && isset($_POST['author']) && isset($_POST['publisher']) && isset($_POST['price']) && isset($_POST['member_day']) && isset($_POST['officer_day']) && $_POST['id'] != NULL) {
                $book = $bookf->addbook($_POST['id'], $_POST['bookname'], $_POST['author'], $_POST['publisher'], $_POST['price'], $_POST['member_day'], $_POST['officer_day']);
                if ($book) {
                    $success = "เพิ่มสำเร็จ";
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
    <title>BOOK</title>
</head>
<body style='color: #139487;'>
    <h1>ข้อมูลหนังสือ</h1>
    <form action="" method="post">
        <h5>รหัสหนังสือ : <input type="text" name="id" id="" value="<?php if ($data != null){ echo $data->book_id; } ?>"required><button type="submit" value="find" name="submit">ค้นหา</button></h5>
        <h5>ชื่อหนังสือ : <input type="text" name="bookname" id="" value="<?php if ($data != null){ echo $data->book_name; } ?>"></h5>
        <h5>ชื่อผู้แต่ง : <input type="text" name="author" id="" value="<?php if ($data != null){ echo $data->author; } ?>"></h5>
        <h5>สำนักพิมพ์ : <input type="text" name="publisher" id="" value="<?php if ($data != null){ echo $data->publisher; } ?>"></h5>
        <h5>ราคา : <input type="number" name="price" id="" value="<?php if ($data != null){ echo $data->price; } ?>"> บาท</h5>
        <h5>จำนวนวันที่สามารถยืมได้ : <input type="number" name="member_day" id="" value="<?php if ($data != null){ echo $data->member_day; } ?>"> วัน (สำหรับนักศึกษา)</h5>
        <h5>จำนวนวันที่สามารถยืมได้ : <input type="number" name="officer_day" id="" value="<?php if ($data != null){ echo $data->officer_day; } ?>"> วัน (สำหรับครูหรือเจ้าหน้าที่)</h5>
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