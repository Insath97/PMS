<?php
include("backend/dbconn.php");

if (isset($_POST['submit'])) {

    $n = rand(1234, 9999);
    $m = rand(1234, 9999);
    $projectcode = $_POST['projectcode'];
    $projectName = $_POST["projectName"];

    $projectHeadIds = isset($_POST["projectHead"]) ? $_POST["projectHead"] : array();
    $assignedEmployees = isset($_POST["emps"]) ? $_POST["emps"] : array();

    $startDate = date("Y-m-d", strtotime($_POST["startDate"]));
    $endDate = date("Y-m-d", strtotime($_POST["endDate"]));

    // image import
    $uploaddir = 'uploads/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    $flname = basename($_FILES["file"]["name"]);

    if (!empty($projectHeadIds)) {
        foreach ($projectHeadIds as $projectHeadId) {
            $teamHeadInsertQuery = "INSERT INTO `teamhead`(`headCall_id`, `emp`, `project_id`) VALUES ('$n','$projectHeadId','$projectcode')";
            mysqli_query($conn, $teamHeadInsertQuery);
        }
    }

    if (!empty($assignedEmployees)) {
        foreach ($assignedEmployees as $assigned_emp) {
            $team_emp = "INSERT INTO `teamwrks`(`call_ID`, `empid`, `projectcode`) VALUES ('$m','$assigned_emp','$projectcode')";
            mysqli_query($conn, $team_emp);
        }
    }

    // head calling
    $search_qry = "SELECT `Id`, `headCall_id`, `emp`, `project_id` FROM `teamhead` WHERE project_id='$projectcode'";
    $search_result = mysqli_query($conn, $search_qry);
    $head_fect = mysqli_fetch_array($search_result);
    $emp_head = $head_fect['headCall_id'];

    // employee Calling
    $search_emp_qry = "SELECT `Id`, `call_ID`, `empid`, `projectcode` FROM `teamwrks` WHERE projectcode='$projectcode'";
    $search_emp_result = mysqli_query($conn, $search_emp_qry);
    $assgn_emp_fect = mysqli_fetch_array($search_emp_result);
    $emp_wrk = $assgn_emp_fect['call_ID'];

    $qry = "INSERT INTO `project`(`code`, `project_name`, `emp_head`, `emp_wrks`, `start_date`, `end_date`, `attachment`) 
    VALUES ('$projectcode','$projectName','$emp_head','$emp_wrk','$startDate','$endDate','$flname')";

    $result = mysqli_query($conn, $qry);

    if ($result) {

        $successScript = "
            Swal.fire({
                icon: 'success',
                title: 'Project Added Successfully',
                text: 'New Project has been added successfully!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'createProject.php';
            });
            ";
    } else {
        $errorScript = "
            Swal.fire({
                icon: 'error',
                title: 'Can\'t Add User ',
                text: 'An error occurred!',
                confirmButtonText: 'OK'
            });
            ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- external header contents link -->
<?php include("includes/header.php"); ?>

<body>
    <a href="uploads/"></a>
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

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Project</h4>

                            <form method="POST" enctype="multipart/form-data">

                                <div class="row">

                                    <div class="mb-3 col-md-6">
                                        <label for="projectName" class="form-label">Project Code</label>
                                        <input class="form-control" type="text" name="projectcode" value="<?php echo "PRO " . rand(1234, 9999); ?>" readonly />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="projectName" class="form-label">Project Name</label>
                                        <input class="form-control" type="text" name="projectName" placeholder="Project Name" autofocus required />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="projectHead" class="form-label">Project Head</label>
                                        <?php
                                        $emp_head_qry = "SELECT * FROM `users` WHERE user_role ='Employee'";
                                        $emp_head_result = mysqli_query($conn, $emp_head_qry);
                                        $emp_counts = mysqli_num_rows($emp_head_result);
                                        if ($emp_counts > 0) {
                                            echo '<select class="form-control selectpicker" multiple name="projectHead[]">';
                                            while ($emp_row = mysqli_fetch_array($emp_head_result)) {
                                                echo ' <option value="' . $emp_row['Id'] . '">' . $emp_row['first_name'] . ' ' . $emp_row['last_name'] . '</option>';
                                            }
                                            echo ' </select>';
                                        }
                                        ?>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="projectHead" class="form-label">Assign Employees</label>
                                        <?php
                                        $emp_head_qry = "SELECT * FROM `users` WHERE user_role ='Employee'";
                                        $emp_head_result = mysqli_query($conn, $emp_head_qry);
                                        $emp_counts = mysqli_num_rows($emp_head_result);
                                        if ($emp_counts > 0) {
                                            echo '<select class="form-control selectpicker" name="emps[]" multiple>';
                                            while ($emp_row_head = mysqli_fetch_array($emp_head_result)) {
                                                echo ' <option value="' . $emp_row_head['Id'] . '">' . $emp_row_head['first_name'] . ' ' . $emp_row_head['last_name'] . '</option>';
                                            }
                                            echo ' </select>';
                                        }
                                        ?>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Start Date</label>
                                        <input class="form-control" type="Date" name="startDate" />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">End Date</label>
                                        <input type="Date" name="endDate" class="form-control" required />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="">Attachment</label>
                                        <input type="file" multiple class="form-control" name="file">
                                    </div>

                                </div>

                                <div class="mt-2">
                                    <button type="submit" name="submit" class="btn btn-primary me-2">Add Project</button>
                                </div>
                            </form>

                        </div>
                    </div>

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
                                                        <a href="backend/deleteProject.php?deleteId=<?php echo $row['code']; ?>" class="text-danger mx-2"><i class="fas fa-trash-alt fa-lg"></i></a>
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
    <?php include("includes/script.php"); ?>

    <script>
        $(document).ready(function() {
            $('#projectHeadSelect').select2();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@crlcu/multi-select@1.5.2/dist/js/multi-select.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

    <!-- Bootstrap Selectpicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

</body>

</html>