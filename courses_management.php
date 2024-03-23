<?
require "inc/init.php";
$conn = require "inc/db.php";

$_SESSION['courses_management_access'] = true;

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối không thành công:");
}

Auth::requireLogin();

layouts();

$conn = require 'inc/db.php';
$total = $_SESSION['role_id'] == 1 ? Course::countAll($conn) : Course::count($conn);
$limit = PAGE_SIZE;
$currentpage = $_GET['page'] ?? 1;
$config = [
    'total' => $total,
    'limit' => $limit,
    'full' => false,

];
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $search = $_GET['search'];
    $courses = Course::searchCoursePaging($conn, $search, $limit, ($currentpage - 1) * $limit);
    // $courses = Course::searchCourse($conn, $search);
} else {
    $courses = $_SESSION['role_id'] == 1 ?
        Course::popularCoursesAll($conn, $limit, ($currentpage - 1) * $limit) :
        Course::popularCourses($conn, $limit, ($currentpage - 1) * $limit);
}
?>
<form action="" method="get">
    <input type="text" name="search" id="search" placeholder="Tìm kiếm khóa học">
    <button type="submit" class='btnSubmit'>Tìm kiếm</button>
</form>

<?php
if (Auth::isAdmin()) {
    require 'courses_admin.php';
} else {
    require 'courses_user.php';
}
?>


<div class='content'>
    <?php
    $page = new Pagination($config);
    echo $page->getPagination1();
    ?>
</div>


<?php
Database::close($conn);
layouts("footer");
?>