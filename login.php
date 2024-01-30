<?php
require "inc/init.php";
layouts("header");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST["identifier"];
    // $email = $_POST["email"];
    $password = $_POST["password"];

    if ($identifier != '' && $password != '') {
        $conn = require "inc/db.php";
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $rs = User::authenticatebyemail($conn, $identifier, $password);
        } else {
            $rs = User::authenticatebyphone($conn, $identifier, $password);
        }

        if ($rs) {
            Auth::login();
            $_SESSION["user_id"] = $identifier;
            echo "Đăng nhập thành công";
        } else {
            echo "Sai tài khoản hoặc mật khẩu";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <title>Quan ly khoa hoc</title>
</head>

<body>
    <h2>Login Page</h2>
    <form id="frmLOGIN" name="frmLOGIN" action="" method="post">
        <fieldset>
            <legend>Login Page</legend>
            <p>
                <label for="identifier">Email or Phone number:</label>
                <input name="identifier" id="identifier" type="text" placeholder="Email or Phone number">
            </p>
            <p>
                <label for="password">Password:</label>
                <input name="password" id="password" type="password" placeholder="Password">
            </p>
            <p>
                <input class="submitbtn" type="submit" value="Đăng nhập">
            </p>
            <p>
                <a class="forgot" href="forgot_password.php">Quên mật khẩu?</a>
            </p>
            <p>
                <a class="forgot" href="register.php">Chưa có tài khoản? Đăng ký</a>
            </p>
        </fieldset>
    </form>
</body>

</html>

<?
layouts("footer");
?>