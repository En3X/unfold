<?php
    $mysqli = new mysqli('localhost','root','','unfold');
    if ($mysqli) {
        echo "<script>console.log('Connection to database successful')</script>";
    }else{
        die("Database connection failed. ".$mysqli->error);
    }
?>