<?php
include("dbconn.php");

if(isset($_GET['aprovalId'])){

    $apId = $_GET['aprovalId'];
    $datecreate = date("Y-m-d");

    $qry = "UPDATE `task` SET `task_status`='Complete',`active`='1',`dateCreated`='$datecreate' WHERE Id='$apId'";
    $result = mysqli_query($conn,$qry);

    if($result){

        header("Location: ../viewTask.php?status=success");
        exit();      
    }
    else{
        header("Location: ../viewTask.php?status=error");
        exit(); 
    }
}
?>