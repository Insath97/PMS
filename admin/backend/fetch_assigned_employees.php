<?php
include("dbconn.php");

if (isset($_POST['project_id'])) {
    $projectId = $_POST['project_id'];

    $qry_employees = "SELECT teamwrks.empid,teamwrks.projectcode,users.first_name,users.last_name,project.code 
    FROM teamwrks 
    INNER JOIN project ON project.code = teamwrks.projectcode 
    INNER JOIN users ON users.Id = teamwrks.empid
    WHERE teamwrks.projectcode='$projectId'";

    $result_employees = mysqli_query($conn, $qry_employees);

    $options = '<option value="">Assigned Employee Name</option>';
    while ($row_employee = mysqli_fetch_array($result_employees)) {
        $options .= '<option value="' . $row_employee['empid'] . '">' . $row_employee['first_name'] .' '. $row_employee['last_name'].'</option>';
    }

    echo $options;
}
?>