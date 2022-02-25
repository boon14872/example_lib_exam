<?php
include 'init.php';
if (isset($_POST['usname']) && $_POST['usname'] != NULL && isset($_POST['psswd']) && $_POST['psswd'] != NULL) {
    $usname = $_POST['usname'];
    $psswd = $_POST['psswd'];
    $user = $userf->login($usname, $psswd);
    if ($user === true) {
        header('Location:home.php');
        $error = $user;
    }
    else {
        $error = $user;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>เข้าสู่ระบบ</h1>
    <form action="" method="post">
        <h5>Username : <input type="text" name="usname" id="" required></h5>
        <h5>Password : <input type="password" name="psswd" id="" required></h5>
        <button type="submit">Login</button>
    </form>
    <?php
    if (isset($error)) {
        echo "<h1 style='color:red'>$error</h1>";
    }
    ?>
</body>
</html>