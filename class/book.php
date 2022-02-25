<?php
class book {
    protected $db;
    public function __construct($dbconn) {
        $this->db = $dbconn;
    }
    public function addbook($id, $name, $author, $publisher, $price, $member, $officer) {
        $sql = 'SELECT book_id from user where book_id = ?';
        $tr_id = trim($id);
        $check = $this->db->prepare($sql);
        $check->execute([$tr_id]);
        if ($check->rowCount() == 0) {
            $sql = "INSERT INTO book (`book_id`, `book_name`, `author`, `publisher`, `price`, `member_day`, `officer_day`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $create = $this->db->prepare($sql);
            if ($create->execute([$tr_id, $name, $author, $publisher, $price, $member, $officer])) {
                return true;
            }
            else {
                return "Can't added";
            }
        }
        else {
            return "book id already.";
        }
    }


    public function findbook($id) {
        $bid = trim($id);
        $sql = "SELECT * from book where book_id = ?";
        $check = $this->db->prepare($sql);
        $check->execute([$bid]);
        if ($check->rowCount() == 1) {
            return $check->fetch(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }
    }


    public function updatebook($id, $name, $author, $publisher, $price, $member, $officer) { 
        $bid = trim($id);
        $sql = "UPDATE book SET book_name = ?, author = ? , publisher = ?, price = ?, member_day = ?, officer_day = ? where id = ?";
        $updated = $this->db->prepare($sql);
        if ($updated->execute([$name, $author, $publisher, $price, $member, $officer, $bid])) {
            return true;
        }
        return false;
    }
    public function delbook($id) {
        $bid = trim($id);
        $sql = "DELETE FROM book WHERE book_id = ?";
        $del = $this->db->prepare($sql);
        if ($del->execute([$bid])) {
            return true;
        }
        return false;
    }
}
?>