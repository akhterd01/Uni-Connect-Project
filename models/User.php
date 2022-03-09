<?php

require_once "../libraries/Database.php";

class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function checkExistingUsernameOrEmail($username, $email) {
        $this->db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
        $this->db->bindValue(":username", $username);
        $this->db->bindValue(":email", $email);
        $row = $this->db->fetch();

        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function registerUser($data) {
        $this->db->prepare("INSERT INTO users (firstname, lastname, username, password, university, email) VALUES
        (:firstname, :lastname, :username, :password, :university, :email)");
        $this->db->bindValue(":firstname", $data["fname"]);
        $this->db->bindValue(":lastname", $data["lname"]);
        $this->db->bindValue(":username", $data["username"]);
        $this->db->bindValue(":password", $data["password"]);
        $this->db->bindValue(":university", $data["university"]);
        $this->db->bindValue(":email", $data["email"]);
        
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword($password, $email) {
        $this->db->prepare("UPDATE users SET password = :password WHERE email = :email");
        $this->db->bindValue(":password", $password);
        $this->db->bindValue(":email", $email);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyAccount($email) {
        $this->db->prepare("UPDATE users SET verified_email = 'verified' WHERE email = :email");
        $this->db->bindValue(":email", $email);
        
        if($this->db->execute()) {
            $_SESSION["email_verified"] = 'verified';
            return true;
        } else {
            return false;
        }
    }

    public function insertProfilePicture($file_name, $currentTime, $username) {
        $profile_photo = $currentTime."_".$file_name;
        $this->db->prepare("UPDATE users SET profile_photo = :profile_photo WHERE username = :username");
        $this->db->bindValue(":profile_photo", $profile_photo);
        $this->db->bindValue(":username", $username);

        if($this->db->execute()) {
            $_SESSION["profile_photo"] = $profile_photo;
            return true;
        } else {
            return false;
        }
    }   

    public function updateProfilePostsPicture($file_name, $currentTime, $username) {
        $profile_photo = $currentTime."_".$file_name;
        $this->db->prepare("UPDATE profileposts SET post_image = :post_image WHERE postusername = :postusername");
        $this->db->bindValue(":post_image", $profile_photo);
        $this->db->bindValue(":postusername", $username);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePostsRepliesPicture($file_name, $currentTime, $username) {
        $profile_photo = $currentTime."_".$file_name;
        $this->db->prepare("UPDATE profileposts_replies SET reply_image = :reply_image WHERE reply_username = :reply_username");
        $this->db->bindValue(":reply_image", $profile_photo);
        $this->db->bindValue(":reply_username", $username);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePostsResponsePicture($file_name, $currentTime, $username) {
        $profile_photo = $currentTime."_".$file_name;
        $this->db->prepare("UPDATE replies_responses SET response_image = :response_image WHERE response_username = :response_username");
        $this->db->bindValue(":response_image", $profile_photo);
        $this->db->bindValue(":response_username", $username);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfileSettings($fname, $lname, $dateofbirth, $bio, $course, $id) {
        $this->db->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, dateofbirth = :dateofbirth,
        bio = :bio, course = :course WHERE id = :id");
        $this->db->bindValue(":firstname", $fname);
        $this->db->bindValue(":lastname", $lname);
        $this->db->bindValue(":dateofbirth", $dateofbirth);
        $this->db->bindValue(":bio", $bio);
        $this->db->bindValue("course", $course);
        $this->db->bindValue("id", $id);

        if($this->db->execute()) {
            $_SESSION["fname"] = $fname;
            $_SESSION["lname"] = $lname;
            $_SESSION["dateofbirth"] = $dateofbirth;
            $_SESSION["bio"] = $bio;
            $_SESSION["course"] = $course;
            return true;
        } else {
            return false;
        }
    }

    public function deleteAccount($id) {
        $this->db->prepare("DELETE FROM users WHERE id=$id");
        $this->db->execute();
        $this->db->prepare("DELETE FROM profileposts WHERE post_user_id=$id");
        $this->db->execute();
        $this->db->prepare("DELETE FROM profileposts_replies WHERE reply_user_id=$id");
        $this->db->execute();
    }   
}