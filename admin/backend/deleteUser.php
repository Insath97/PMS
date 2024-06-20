<?php
include("dbconn.php");

if(isset($_GET['deleteId'])){

    $delid = $_GET['deleteId'];

    $qry = "DELETE FROM `users` WHERE username='$delid'";
    $result = mysqli_query($conn,$qry);

    if($result){

        header("Location: ../createUser.php?status=success");
        exit();      
    }
    else{
        header("Location: ../createUser.php?status=error");
        exit(); 
    }
}
?>