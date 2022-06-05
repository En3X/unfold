<?php
    session_start();
    include './checkLogin.php';
    include '../entity/User.php';
    if (!isLoggedIn()) {
        header("location: ./login.php?msg=Please login to continue");
    }

    $user = $_SESSION['user'];
    $user = unserialize($user);

    include './connection.php';

    if (isset($_POST['isCommentPosted'])) {
        $cmt = $_POST['cmt'];
        $pid = $_POST['postid'];
        $uid = $user->id;
        $uname = $user->name;
        $months = array (1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
        $monthReq = $months[(int)date('m')];
        $date = date('d')." ".$monthReq.", ".date('Y');

        $sql = $mysqli->prepare("
            insert into comment(comment,uid,uname,date,pid) 
            values(?,?,?,?,?)
        ");

        $sql->bind_param('sissi',$cmt,$uid,$uname,$date,$pid);
        $sql->execute();
        header("location: ../home.php?fullpost&pid=$pid");
    }
?>