<?php
include("dbconn.php");

if (isset($_POST['project_id'])) {
    $projectId = $_POST['project_id'];

    $qry_head = "SELECT teamhead.Id, teamhead.emp, teamhead.project_id,users.first_name,users.last_name,project.code 
                    FROM teamhead 
                    INNER JOIN project ON project.code = teamhead.project_id 
                    INNER JOIN users ON users.Id = teamhead.emp
                    WHERE teamhead.project_id='$projectId'";

    $result_head = mysqli_query($conn, $qry_head);

    $options = '<option value="">Select Project Head Name</option>';
    while ($row_head = mysqli_fetch_array($result_head)) {
        $options .= '<option value="' . $row_head['emp'] . '">' . $row_head['first_name'] .' '.$row_head['last_name']. '</option>';
    }
    echo $options;
}
