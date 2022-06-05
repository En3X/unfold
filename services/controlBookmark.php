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
    if (isset($_GET['post'])) {
        $pid = $_GET['post'];
        if ($user->hasBookmarkPost($pid,$mysqli)) {
            $sql = "
                delete from bookmarks where pid=$pid and uid=$user->id
            ";
        }else{
            $sql = "
                insert into bookmarks(pid,uid) values($pid,$user->id)
            ";  
        }
        $mysqli->query($sql);
    }
    header("location: ../home.php?home");

?>