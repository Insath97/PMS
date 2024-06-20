<?php
include("backend/dbconn.php");
?>
<?php

if (isset($_GET['status']) && $_GET['status'] == "success") {
    $successScript = "
    Swal.fire({
        icon: 'success',
        title: 'User Deleted',
        text: 'User has been deleted Successfully!',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'viewProject.php';
    });
    ";
}

if (isset($_GET['status']) && $_GET['status'] == "error") {
    $successScript = "
    Swal.fire({
        icon: 'error',
        title: 'Can't Deleted',
        text: 'An error Occurred!',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'viewProject.php';
    });
    ";
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- external header contents link -->
<?php include("includes/header.php"); ?>

<body>
    <div class="container-scroller">

        <!-- linked external navbar -->
        <?php include("includes/navbar.php"); ?>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- linked external sidebar -->
            <?php $page = "project";
            include("includes/sidebar.php"); ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                 

                <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="card-title">View Projects</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project Name</th>
                                            <th>Project Head</th>
                                            <th>Assigned Employees</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    // SELECT `code`, `project_name`, `emp_head`, `emp_wrks`, `start_date`, `end_date`, `attachment` FROM `project` WHERE 1
                                    $display_qry = "SELECT * FROM `project`";
                                    $display_result = mysqli_query($conn, $display_qry);
                                    if (mysqli_num_rows($display_result) > 0) {
                                        while ($row = mysqli_fetch_array($display_result)) {
                                    ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $row['code']; ?></td>
                                                    <td><?php echo $row['project_name']; ?></td>
                                                    <?php
                                                    $idhead = $row['code'];
                                                    $call_head_qry = mysqli_query($conn, "SELECT teamhead.Id, teamhead.emp, teamhead.project_id,users.first_name,users.last_name,project.code 
                                                                                            FROM teamhead 
                                                                                            INNER JOIN project ON project.code = teamhead.project_id 
                                                                                            INNER JOIN users ON users.Id = teamhead.emp
                                                                                            WHERE teamhead.project_id='$idhead'");

                                                    // Initialize an empty string to store project head names
                                                    $projectHeadNames = '';

                                                    while ($row_head = mysqli_fetch_array($call_head_qry)) {
                                                        // Concatenate project head names
                                                        $projectHeadNames .= $row_head['first_name'] . ' ' . $row_head['last_name'] . '<br><br>';
                                                    }
                                                    ?>
                                                    <td><?php echo $projectHeadNames; ?></td>

                                                    <?php
                                            
                                                    $call_emp_qry = mysqli_query($conn, "SELECT teamwrks.empid,teamwrks.projectcode,users.first_name,users.last_name,project.code 
                                                                                            FROM teamwrks 
                                                                                            INNER JOIN project ON project.code = teamwrks.projectcode 
                                                                                            INNER JOIN users ON users.Id = teamwrks.empid
                                                                                            WHERE teamwrks.projectcode='$idhead'");

                                                    // Initialize an empty string to store project head names
                                                    $projectEmployees = '';

                                                    while ($row_employee = mysqli_fetch_array($call_emp_qry)) {
                                                        // Concatenate project head names
                                                        $projectEmployees .= $row_employee['first_name'] . ' ' . $row_employee['last_name'] . '<br><br>';
                                                    }
                                                    ?>
                                                    <td><?php echo $projectEmployees; ?></td>
                                                    <td><?php echo $row['start_date']; ?></td>
                                                    <td><?php echo $row['end_date']; ?></td>
                                                    <td>
                                                        <a href="#" class="text-success mx-2"><i class="fas fa-edit fa-lg"></i></a>
                                                        <a href="backend/deletelead.php?deleteId=<?php echo $row['code']; ?>" class="text-danger mx-2"><i class="fas fa-trash-alt fa-lg"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>

                            </div>
                        </div>
                    </div>

            </div>


            <!-- external footer link -->
            <?php include("includes/footer.php"); ?>




        </div>

    </div>

    </div>

    <!-- external script link -->
    <?php include("includes/script.php"); ?>
</body>

</html>
            <!-- partial -->
            <div class="main-panel">
                <div class="card mt-5">
                    <div class="card-body">
                        <h4 class="card-title">View Projects</h4>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Project Head</th>
                                        <th>Assigned Employees</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>World War 3</td>
                                        <td>Zifan, Afsir</td>
                                        <td>1, 2, 3 ,4</td>
                                        <td>12/05/2023</td>
                                        <td>12/07/2023</td>
                                        <td>
                                            <a href="#" class="text-success mx-2"><i class="fas fa-edit fa-lg"></i></a>
                                            <a href="#" class="text-danger mx-2"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


            <!-- external footer link -->
            <?php include("includes/footer.php"); ?>




        </div>

    </div>

    </div>

    <!-- external script link -->
    <?php include("includes/script.php"); ?>
</body>

</html>