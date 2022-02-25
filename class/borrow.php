<?php
class borrow {
    protected $db;
    public function __construct($dbconn) {
        $this->db = $dbconn;
    }

    public function borrow_book($member_id, $book_id, $date_barrow, $officer_id, $date_exp) {
        $tr_member = trim($member_id);
        $tr_book = trim($book_id);
        $tr_office = trim($officer_id);
        $sql = "SELECT status from book where book_id = ?";
        $check = $this->db->prepare($sql);
        $check->execute([$tr_book]);
        if ($check->rowcount() == 1) {
            $sql2 = "INSERT INTO book_barrow(`book_id`, `barrow_date`, `member_id`, `officer_id_barrow`, `exp_date`)  values (?, ?, ?, ?, ?)";
            $barrow = $this->db->prepare($sql2);
            if ($barrow->execute([$tr_book, $date_barrow, $tr_member,$tr_office, $date_exp])) {
                $sql_update = "UPDATE BOOK SET status = 1 where book_id = ?";
                $last = $this->db->prepare($sql_update);
                if($last->execute([$tr_book])) {
                    return true;
                }
                
                return "book status not update!!";
            }
            return "ไม่สามารถยืมหนังสือได้";
        }   
        else {
            return "หนังสือถูกยืมแล้วหรือไม่สามารถยืมได้";
        }
    }

    public function borrow_officer_name($member_id, $book_id) {
        $tr_member = trim($member_id);
        $tr_book = trim($book_id);
        $sql = "SELECT name from book_barrow join user on book_barrow.member_id = user.id where book_barrow.member_id = ? and book_barrow.book_id = ?";
        $check = $this->db->prepare($sql);
        if ($check->execute([$tr_member, $tr_book])) {
            if ($check->rowcount() == 0) {
                return false;
            }
            return $check->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
    public function return_book($member_id, $book_id, $datereturn, $officer_id) {
        $tr_member = trim($member_id);
        $tr_book = trim($book_id);
        $tr_officer = trim($officer_id);
        $sql = "UPDATE book_barrow set return_date = ?, office_id_return = ? where member_id = ? and book_id = ?";
        $check = $this->db->prepare($sql);
        if ($check->execute([$datereturn, $tr_officer, $tr_member, $tr_book])) {
            $sql2 = "UPDATE book set status = 1 where book_id = ?";
            $update = $this->db->prepare($sql2);
            if ($update->execute([$tr_book])) {
                return true;
            }
            return "ไม่สามารถอัพเดทหนังสือได้";
        }
        else {
            return "ไม่สามารถคืนได้";
        }
    }
    
    public function book_borrow_history($book_id) {
        $tr_book = trim($book_id);
        $sql = "SELECT * from book_barrow where book_id = ?";
        $book = $this->db->prepare($sql);
        if ($book->execute([$tr_book])) {
            return $book->fetchAll(PDO::FETCH_OBJ);
        }
        return false;
    }

}

?>