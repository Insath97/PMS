<?php
include("dbconn.php");

if(isset($_GET['deleteId'])){

    $delid = $_GET['deleteId'];

    $qry = "DELETE FROM `project` WHERE code='$delid'";
    $result = mysqli_query($conn,$qry);

    if($result){
        
        mysqli_query($conn,"DELETE FROM `teamhead` WHERE project_id='$delid'");
        mysqli_query($conn,"DELETE FROM `teamwrks` WHERE projectcode='$delid'");
        header("Location: ../viewProject.php?status=success");
        exit();      
    }
    else{
        header("Location: ../viewProject.php?status=error");
        exit(); 
    }
}
?>