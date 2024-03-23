<? 
if (!isset($_SESSION['courses_management_access'])) {
    header("Location: index.php");
}

?>

<h1>Quản lý khoá học</h1>
<?php if (!empty($courses)) : ?>
    <table>
        <thead>
            <tr>
                <th class="shortcell">Tên</th>
                <th class="shortcell">Mô tả</th>
                <th class="shortcell">Giá</th>
                <th class="shortcell">Hình ảnh</th>
                <th class="shortcell">Thời lượng</th>
                <th class="shortcell">Loại khóa học</th>
                <th class="shortcell">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course) : ?>
                <tr>
                    <td><?php echo $course['name']; ?></td>
                    <td><?php echo $course['description']; ?></td>
                    <td><?php echo $course['price']; ?></td>
                    <td>
                        <? if ($course['image'] && file_exists("uploads/" . $course['image'])) : ?>
                            <img src="uploads/<? echo $course['image'] ?>" width="80" height="80">
                        <? else : ?>
                            <img src="images/noimage.png" width="80" height="80">
                        <? endif; ?>
                    </td>
                    <td class='shortcell'><?php echo $course['duration']; ?></td>
                    <td class='shortcell'><?php echo $course['category_name']; ?></td>
                    <td class='shortcell'>
                        <button value="<? echo $course['id'] ?>" name="id" id="btnChangeCourse" class='btnCRUD'>Sửa khoá học</button>
                        <button value="<? echo $course['id'] ?>" name="id" id="btnDeleteCourse" class='btnCRUD'>Xoá khoá học</button>
                        <button value="<? echo $course['id'] ?>" name="id" id="btnEditImage" class='btnCRUD'>Sửa hình</button>
                        <?php if ($course['deleted'] == false) : ?>
                            <button value="<?php echo $course['id']; ?>" name="id" id="btnHideCourse" class='btnCRUD'>Ẩn khóa học</button>
                        <?php else : ?>
                            <button value="<?php echo $course['id']; ?>" name="id" id="btnShowCourse" class='btnCRUD'>Hiện khóa học</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>Không tìm thấy kết quả phù hợp</p>
<?php endif; ?>