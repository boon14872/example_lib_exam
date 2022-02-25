<?php

class user {
    protected $db;

    public function __construct($dbconn) {
        $this->db = $dbconn;
    }

    public function register($id, $password, $name, $group, $address, $tell, $member_type) {
        $sql = 'SELECT id from user where id = ?';
        $tr_id = trim($id);
        $tr_password = trim($password);
        $check = $this->db->prepare($sql);
        $check->execute([$tr_id]);
        if ($check->rowCount() == 0) {
            $pass_hash = password_hash($tr_password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (id, password, name, member_group, address, tell, member_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $create = $this->db->prepare($sql);
            if ($create->execute([$tr_id, $pass_hash, $name, $group, $address, $tell, $member_type])) {
                return true;
            }
            else {
                return "Can't register";
            }
        }
        else {
            return "username already.";
        }
    }

    public function login($username, $password) {
        $tr_username = trim($username);
        $tr_password = trim($password);
        $sql = "SELECT * from user where id = ?";
        $check = $this->db->prepare($sql);
        $check->execute([$tr_username]);
        if ($check->rowCount() == 1) {
            $user = $check->fetch(PDO::FETCH_OBJ);            
            if (password_verify($tr_password, $user->password)) {
                $_SESSION['id'] = $user->id;
                $_SESSION['name'] = $username->name;
                return true;
            }
            else {
                return "Password incorrect.";
            }
        }
        else {
            return "Username not found.";
        }
    }

    public function find($id) {
        $uid = trim($id);
        $sql = "SELECT * from user where id = ?";
        $check = $this->db->prepare($sql);
        $check->execute([$uid]);
        if ($check->rowCount() == 1) {
            return $check->fetch(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }
    }
    public function findmember($id) {
        $uid = trim($id);
        $sql = "SELECT * from user where id = ? and member_type <> 0 and member_group <> 0";
        $check = $this->db->prepare($sql);
        $check->execute([$uid]);
        if ($check->rowCount() == 1) {
            return $check->fetch(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }
    }
    public function findofficer($id) {
        $uid = trim($id);
        $sql = "SELECT * from user where id = ? and member_type = 0 and member_group = 0";
        $check = $this->db->prepare($sql);
        $check->execute([$uid]);
        if ($check->rowCount() == 1) {
            return $check->fetch(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }
    }

    public function updatemember($id, $password, $name, $group, $address, $tell, $member_type) { 
        $uid = trim($id);
        $pass_hash = password_hash(trim($password),PASSWORD_DEFAULT);
        $sql = "UPDATE USER SET password = ?, name = ? , member_group = ?, address = ?, tell = ?, member_type = ? where id = ?";
        $updated = $this->db->prepare($sql);
        if ($updated->execute([$pass_hash, $name, $group, $address, $tell, $member_type, $uid])) {
            return true;
        }
        return false;
    }
    public function delmember($id) {
        $uid = trim($id);
        $sql = "DELETE FROM user WHERE id = ?";
        $del = $this->db->prepare($sql);
        if ($del->execute([$uid])) {
            return true;
        }
        return false;
    }
}

?>