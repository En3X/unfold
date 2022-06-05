<?php
    class Post{
        public $id,$title,$body,$tag,$uid,$uname,$date;
        function __construct(
            $id,$title,$body,$tag,$uid,$uname,$date
        ){
            $this->id = $id;
            $this->title = $title;
            $this->body = $body;
            $this->tag = $tag;
            $this->uid = $uid;
            $this->uname = $uname;
            $this->date = $date;
        }

        public function getNumLikes($mysqli){
            $sql = "select * from likes where pid=$this->id";
            if ($data=$mysqli->query($sql)) {
                if ($data->num_rows > 0) {
                    return $data->num_rows;
                }
            }
            return 0;
        }
    }
?>