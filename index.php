<?php
// require "config.php";
// require "classes/database.php";
// require "classes/user.php";

require "inc/init.php";
$conn = require "inc/db.php";
if ($conn) {
    echo "Kết nối thành công database<br>";
    $rs = User::authenticate($conn, "test7@example.com", "test7");
    if ($rs) {
        echo "Đăng nhập thành công";
    } else {
        die("Thông tin đăng nhập không đúng");
    }
}
?>