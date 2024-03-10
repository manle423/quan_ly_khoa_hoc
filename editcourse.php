<?php

require 'inc/init.php';

$conn = require "inc/db.php";
$categories = Category::getCategory($conn);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $course = Course::getByID($conn, $id);
    if (!$course) {
        Dialog::show('Course not found');
        return;
    }
} else {
    Dialog::show('Input ID, please');
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //lấy thông tin (chỉnh sửa)

    $course->id = $_GET['id'];
    $course->name = $_POST['name'];
    $course->description = $_POST['description'];
    $course->video = $_POST['video'];
    $course->duration = $_POST['duration'];
    $course->category_id = $_POST['category_id'];
    print_r($course);
    // gọi cập nhật
    if ($course->updateCourse($conn)) {
        header("Location: courses_management.php");
    }
}




require 'inc/header.php';
?>

<div class="content">
    <form method='post' id='frmEDITCOURSE'>
        <fieldset>
            <legend>Edit course</legend>
            <p class='row'>
                <label for="name">Name: </label>
                <span class='error'>*</span>
                <input name="name" id="name" type="text" value='<?=htmlspecialchars($course->name)?>' />

            </p>
            <p class='row'>
                <label for="description">Description: </label>
                <input name="description" id="description" type="text" value='<?=htmlspecialchars($course->description)?>'/>
            </p>
            <p class='row'>
                <label for="price">Price: </label>
                <span class='error'>*</span>
                <input name="price" id="price" type="text" value='<?=htmlspecialchars($course->price)?>' />
            </p>
            <p class='row'>
                <label for="video">Video: </label>
                <span class='error'>*</span>
                <input name="video" id="video" type="text" value='<?=htmlspecialchars($course->video)?>' />
            </p>
            <p class='row'>
                <label for="duration">Price: </label>
                <span class='error'>*</span>
                <input name="duration" id="duration" type="text" value='<?=htmlspecialchars($course->duration)?>' />
            </p>
            <p class='row'>
                <label for='category_id'>Category: </label>
                <span class='error'>*</span>
                <select name='category_id'>
                    <?php foreach ($categories as $category) : ?>   
                        <option value=<?echo $category['id']?>><? echo $category['name'] ?></option>
                    <?php endforeach;?>
                </select>
            </p>
            <p class='row'>
                <input class='btn' type="submit" value="Update" />
                <input class='btn' type="reset" value="Cancel" />
            </p>
        </fieldset>
    </form>
</div>

<? require 'inc/footer.php' ?>