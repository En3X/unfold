<?php
    class User{
        public $id, $name, $email, $password;
        public $description,$img;
        function __construct($id,$name,$email,$password,$description,$img){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->description = $description;
            $this->img = $img;
        }


        public function hasLikedPost($pid,$mysqli){
            $sql = "select * from likes where pid=$pid and uid=$this->id";
            if ($data = $mysqli->query($sql)) {
                if ($data->num_rows > 0) {
                    return true;
                }
            }
            return false;
        }

        public function hasBookmarkPost($pid,$mysqli){
            $sql = "select * from bookmarks where pid=$pid and uid=$this->id";
            if ($data = $mysqli->query($sql)) {
                if ($data->num_rows > 0) {
                    return true;
                }
            }
            return false;
        }
    }
?>