<?php
class Order
{
    private $id;
    private $user_id;
    private $course_id;
    private $total_amount;
    private $status;

    public function __construct($user_id, $course_id, $total_amount, $status)
    {
        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->total_amount = $total_amount;
        $this->status = $status;
    }

    // (sau này phải dùng validation form để xác nhận và bỏ hàm này)
    private function validate()
    {
        $rs = $this->user_id && $this->course_id && $this->total_amount && $this->status;
        return $rs;
    }

    // Thêm đơn đặt mua
    public function addOrder($conn)
    {
        if ($this->validate()) {
            $sql = "insert into orders(user_id,course_id,total_amount,status) 
                    values (:user_id,:course_id,:total_amount,:status)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);
            $stmt->bindValue(':course_id', $this->course_id, PDO::PARAM_STR);
            $stmt->bindValue(':total_amount', $this->total_amount, PDO::PARAM_INT);
            $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    // Truy vấn toàn bộ đơn mua
    public static function getAll($conn)
    {
        try {
            $sql = "select * from orders order by title asc";
            $stmt = $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            $stmt->execute();
            if ($stmt->execute()) {
                $courses = $stmt->fetchAll();
                return $courses;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    //Truy vấn bằng ID
    public function getByID($conn, $id)
    {
        try {
            $sql = "select * from orders where id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            if ($stmt->execute()) {
                $order = $stmt->fetch();
                return $order;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    // Hàm phân trang
    /*Chọn record cho trang thứ n: select * from db limit page_size, offset start
      Công thức tính start: start = (current_page - 1) * page_size */
      public static function getPaging($conn, $limit, $offset)
      {
          try {
              $sql = "select * from orders order by title asc, author asc
                        limit :limit
                        offset :offset";
              $stmt = $conn->prepare($sql);
              //limit: số record mỗi lần select
              $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
              //offset: select từ record thứ mấy
              $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
              $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
              $stmt->execute();
              if ($stmt->execute()) {
                  $books = $stmt->fetchAll();
                  return $books;
              }
          } catch (PDOException $e) {
              echo $e->getMessage();
              return null;
          }
      }

      // Sửa thông tin khóa học
    public function updateOrder($conn)
    {
        try {
            if ($this->validate()) {
                $sql = "update orders
                set user_id=:user_id, course_id=:course_id, 
                total_amount=:total_amount, status=:status
                where id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_STR);
                $stmt->bindValue(':course_id', $this->course_id, PDO::PARAM_STR);
                $stmt->bindValue(':total_amount', $this->total_amount, PDO::PARAM_INT);
                $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
                $stmt->bindValue(':id', $this->id, PDO::PARAM_STR);
                return $stmt->execute();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Xóa theo ID
    public function deleteByID($conn, $id)
    {
        try {
            $sql = "delete from orders where id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    //Hàm đếm số records
    public static function count($conn) {

        try {
            $sql = "select count(id) from orders";
            return $conn->query($sql)->fetchColumn();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return -1;
        }
    }


}
