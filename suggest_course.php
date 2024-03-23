<?php
require "inc/init.php";
$conn = require "inc/db.php";

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối không thành công:");
}

Auth::requireLogin();

layouts();

// Lấy danh sách các khóa học và số lượng đã mua cho mỗi khóa học
$popular_courses = Course::popularCourses($conn);

echo "<pre>";
print_r($popular_courses);
echo "</pre>";

echo "<h1>Gợi ý khoá học dành cho bạn</h1>";
if (!empty($popular_courses)) {
    echo "<ul>";
    foreach ($popular_courses as $course) {
        echo "<li>";
        echo "Tên khoá học: " . $course['name'] . "<br>";
        echo "Mô tả: " . $course['description'] . "<br>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Không có khoá học được gợi ý</p>";
}
