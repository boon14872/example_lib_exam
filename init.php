<?php
    include 'class/db.php';
    include 'class/user.php';
    include 'class/book.php';
    include 'class/borrow.php';
    $db = new dbconn();
    $dbconn = $db->connect();
    $userf = new user($dbconn);
    $bookf = new book($dbconn);
    $borrowf = new borrow($dbconn);
    session_start();
?>