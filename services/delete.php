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
    if ($_GET['postId']) {
       $pid = $_GET['postId'];
       if ($user->owns($pid,$mysqli)) {
           $sql = "delete from post where pid=$pid and uid=$user->id";
           $deletecmtsql = "delete from comment where pid=$pid";
           $deletelikesql = "delete from likes where pid=$pid";
           $deletebookmarksql = "delete from bookmarks where pid=$pid";

           $mysqli->query($sql);
           $mysqli->query($deletecmtsql);
           $mysqli->query($deletebookmarksql);
           $mysqli->query($deletelikesql);
       }else{
        echo "You do not own the post you are trying to delete";
       }
       header('location: ../home.php');

    }

?>