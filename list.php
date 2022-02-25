<?php
include 'init.php';
$book_data = NULL;
$list_data = NULL;
if (isset($_POST['submit'])) {
    if (isset($_POST['book_id']) && $_POST['book_id'] != NULL) {
        $book_id = $_POST['book_id'];
        $book_data = $bookf->findbook($book_id);
        $list_data = $borrowf->book_borrow_history($book_id);
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
    <style>
        table.listdata, table.listdata td, table.listdata th{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <form action="" method="post">
    <center>
        <h1>กรุณากรอกรหัสหนังสือที่ต้องการค้นหา :
            <input type="search" name="book_id" id="">
            <button type="submit" name="submit" value="submit">ค้นหา</button>
        </h1>
        <h1>ประวัติการยืม-คืนหนังสือ</h1>
        <table width="50%" style="text-align: center;">
            <tr>
                <th>รหัสหนังสือ</th>
                <th>ชื่อหนังสือ</th>
                <th>ชื่อผู้แต่ง</th>
            </tr>
            <tr>
                <?php
                    if ($book_data != NULL) {
                        echo "<td>$book_data->book_id</td>";
                        echo "<td>$book_data->book_name</td>";
                        echo "<td>$book_data->author</td>";
                    }
                ?>
            </tr>
        </table>
        <table width="70%" style="text-align: center;">
            <tr>
                <th>สำนักพิมพ์</th>
                <th>ราคา</th>
                <th>จำนวนวันยืม/นักศึกษา</th>
                <th>จำนวนวันยืม/ครู-เจ้าหน้าที่</th>
            </tr>
            <tr>
            <?php
                    if ($book_data != NULL) {
                        echo "<td>$book_data->publisher</td>";
                        echo "<td>$book_data->price</td>";
                        echo "<td>$book_data->member_day</td>";
                        echo "<td>$book_data->officer_day</td>";
                    }
                ?>
            </tr>
        </table>
        <br>
        <table width="90%" style="text-align: center;" class="listdata">
            <tr>
                <th>วันที่ยืม</th>
                <th>วันที่คืน</th>
                <th>รหัสผู้ยืม</th>
                <th>รหัสผู้ให้ยืม</th>
                <th>รหัสผู้รับคืน</th>
            </tr>
            <?php
                    if ($list_data != NULL) {
                        foreach ($list_data as $ldata) {
                            echo "<tr><td>$ldata->barrow_date</td>";
                            if ($ldata->return_date != NULL) {
                                echo "<td>$ldata->return_date</td>";
                            }
                            else {
                                echo "<td>ยังไม่คืน</td>";
                            }
                            echo "<td>$ldata->member_id</td>";
                            echo "<td>$ldata->officer_id_barrow</td>";
                            if ($ldata->office_id_return != NULL) {
                                echo "<td>$ldata->office_id_return</td>";
                            }
                            else {
                                echo "<td>ยังไม่คืน</td></tr>";
                            }
                        }
                    }
                ?>
        </table>
    </center>
    </form>
    <h2><a href="home.php">เมนูหลัก</a></h2>
</body>
</html>
