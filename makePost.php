<?php
    session_start();
    require './linkServices.php';

    if (!isLoggedIn()) {
        header("location: ./login.php?msg=Please login to continue");
    }
    $user = unserialize($_SESSION['user']);
    if (isset($_POST['isPostMade'])) {
        $postTitle = $_POST['postTitle'];
        $postBody = $_POST['postBody'];
        $tags = $_POST['finalTags'];
        if ($tags == "") {
            $tags = null;
        }
        $months = array (1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
        $monthReq = $months[(int)date('m')];
        $date = date('d')." ".$monthReq.", ".date('Y');
        $sql = "
            insert into post(title,body,tag,uid,uname,postDate)
            values('$postTitle','$postBody','$tags','$user->id','$user->name','$date')
        ";
        if ($mysqli->query($sql)) {
            header("location: home.php?msg=Post created successfully");
        }else{
            header("location: home.php?msg=There was an issue creating the post");
        }
    }

?>