<?
if (!isset($_SESSION['courses_management_access'])) {
    header("Location: index.php");
}
?>

<h1>Các khoá học hiện hành</h1>
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
                <th>Mua khóa học</th>
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
                        <button value="<? echo $course['id'] ?>" name="id" id="btnBuyCourse" class='btnCRUD'>Mua khoá học</button>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>
        <? if (!isset($_GET['search'])) : ?>
            <tfoot>
                <tr>
                    <th colspan=4 style="text-align:center;">Tổng số khóa học: </td>
                    <td colspan=3 style=><? echo $config['total'] ?></td>
                </tr>

            </tfoot>
        <? endif; ?>
    </table>
<?php else : ?>
    <p>Không tìm thấy kết quả phù hợp</p>
<?php endif; ?>