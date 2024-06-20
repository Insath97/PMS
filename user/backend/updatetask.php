<?php
include("dbconn.php");

if(isset($_GET['updateid'])){

    $apId = $_GET['updateid'];

    $qry = "UPDATE `task` SET `task_status`='Waiting For Approval' WHERE Id='$apId'";
    $result = mysqli_query($conn,$qry);

    if($result){

        header("Location: ../userviewSubtask.php?status=success");
        exit();      
    }
    else{
        header("Location: ../userviewSubtask.php?status=error");
        exit(); 
    }
}
?>