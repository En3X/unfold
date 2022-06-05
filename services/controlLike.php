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
        if ($user->hasLikedPost($pid,$mysqli)) {
            $sql = "
                delete from likes where pid=$pid and uid=$user->id
            ";
        }else{
            $sql = "
                insert into likes(pid,uid) values($pid,$user->id)
            ";  
        }

        $mysqli->query($sql);
        header('location: ../home.php');
    }
?>