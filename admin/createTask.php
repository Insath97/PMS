<?php
include("backend/dbconn.php");

if (isset($_POST['submit'])) {

    $projectname = $_POST['projectname'];
    $taskname = $_POST['taskname'];
    $employees = $_POST['employees'];
    $startDate = date("Y-m-d", strtotime($_POST["startdate"]));
    $Requirements = $_POST['Requirements'];

    // image import
    $uploaddir = 'Task/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    $flname = basename($_FILES["file"]["name"]);

    $taststatus = $_POST['taststatus'];

    $qry = "INSERT INTO `task`(`project_name`, `task_name`, `task_employee`, `start_date`, `requirements`, `attachment`, `task_status`) 
        VALUES ('$projectname','$taskname','$employees','$startDate','$Requirements','$flname','$taststatus')";

    $result = mysqli_query($conn, $qry);

    if ($result) {
        $successScript = "
            Swal.fire({
                icon: 'success',
                title: 'Tssk Added Successfully',
                text: 'New Task has been added successfully!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'createTask.php';
            });
            ";
    } else {
        $errorScript = "
            Swal.fire({
                icon: 'error',
                title: 'Can\'t Add Lead ',
                text: 'An error occurred!',
                confirmButtonText: 'OK'
            });
            ";
    }
}
?>

<?php

if (isset($_GET['status']) && $_GET['status'] == "success") {
    $successScript = "
    Swal.fire({
        icon: 'success',
        title: 'Task Completed',
        text: 'User has been deleted Successfully!',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'viewTask.php';
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
        window.location.href = 'viewTask.php';
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
            <?php $page = "task";
            include("includes/sidebar.php"); ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Task</h4>

                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect2">Projects</label>
                                        <?php
                                        $qry_project = "SELECT * FROM `project`";
                                        $result_project = mysqli_query($conn, $qry_project);
                                        $count_project = mysqli_num_rows($result_project);
                                        if ($count_project > 0) {
                                            echo ' <select class="form-control" id="projectSelect" name="projectname">';
                                            echo ' <option>Select Project Name</option>';
                                            while ($row_project = mysqli_fetch_array($result_project)) {
                                                echo '<option value="' . $row_project['code'] . '">' . $row_project['project_name'] . '</option>';
                                            }
                                            echo ' 
                                            </select>';
                                        }
                                        ?>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect2">Task Name</label>
                                        <input class="form-control" type="text" name="taskname" placeholder="Task Name" required />
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="exampleFormControlSelect2">Assign Employees</label>
                                        <select class="form-control" id="employeesSelect" name="employees" disabled>
                                            <option value="">Select</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Start Date</label>
                                        <input class="form-control" type="Date" name="startdate" />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="Requirements" class="form-label">Requirements</label>
                                        <input class="form-control" type="text" name="Requirements" placeholder="Add Requirements" required />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="">Attachment</label>
                                        <input type="file" class="form-control" name="file">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect2">Tast Status</label>
                                        <select class="form-control" name="taststatus">
                                            <option>Select Task Status</option>
                                            <option value="Emergency">Emergency</option>
                                            <option value="Mid">Mid</option>
                                            <option value="Low">Low</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="mt-2">
                                    <button type="submit" name="submit" class="btn btn-primary me-2">Add Task</button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="card-title">View Tasks</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project Name</th>
                                            <th>Task Name</th>
                                            <th>Assigned Employee</th>
                                            <th>Start Date</th>
                                            <th>Requirements</th>
                                            <th>Document</th>
                                            <th>Task Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $n = 1;
                                    $select_qry = "SELECT task.Id,task.project_name,task.task_name,task.requirements,task.attachment,task.task_status,task.start_date,project.project_name,users.first_name,users.last_name
                                                   FROM task
                                                   INNER JOIN users ON users.Id = task.task_employee
                                                   INNER JOIN project ON project.code =task.project_name";
                                    $select_result = mysqli_query($conn, $select_qry);
                                    if (mysqli_num_rows($select_result) > 0) {
                                        while ($select_row = mysqli_fetch_array($select_result)) { ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $n; ?></td>
                                                    <td><?php echo $select_row['project_name']; ?></td>
                                                    <td><?php echo $select_row['task_name']; ?></td>
                                                    <td><?php echo $select_row['first_name'] . ' ' . $select_row['last_name']; ?></td>
                                                    <td><?php echo $select_row['start_date']; ?></td>
                                                    <td><?php echo $select_row['requirements']; ?></td>
                                                    <td><a href="#" id="downloadLink"><i class="fas fa-eye fa-lg text-dark mx-3"></i></a></td>

                                                    <script>
                                                        document.getElementById('downloadLink').addEventListener('click', function() {
                                                            // Assuming 'your_document.pdf' is the file you want to download
                                                            var fileUrl = 'Task/<?php echo $select_row['attachment']; ?>';

                                                            // Create a link element
                                                            var link = document.createElement('a');
                                                            link.href = fileUrl;
                                                            link.download = '<?php echo $select_row['project_name']; ?>'; // Specify the name for the downloaded file
                                                            document.body.appendChild(link);

                                                            // Trigger a click on the link to start the download
                                                            link.click();

                                                            // Remove the link from the document
                                                            document.body.removeChild(link);
                                                        });
                                                    </script>

                                                    <?php
                                                    $status = "Processing";

                                                    if ($select_row['task_status'] == "Emergency") { ?>
                                                        <td><label class="badge badge-danger "><?php echo $status; ?></label></td>
                                                    <?php
                                                    } else if ($select_row['task_status'] == "Mid") { ?>
                                                        <td><label class="badge" style="background-color: orange; color: white;"><?php echo $status; ?></label></td>
                                                    <?php
                                                    } else if ($select_row['task_status'] == "Low") { ?>
                                                        <td><label class="badge badge-warning "><?php echo $status; ?></label></label></td>
                                                    <?php
                                                    } else if ($select_row['task_status'] == "Complete") { ?>
                                                        <td><label class="badge badge-success">Task Completed</label></label></td>
                                                    <?php
                                                    } else if ($task_row['task_status'] == "Waiting For Approval") { ?>
                                                        <td><label class="badge badge-dark">Waiting For Approval</label></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td>
                                                        <a href="backend/approval.php?aprovalId=<?php echo $select_row['Id']; ?>" class="text-success mx-2"><i class="fas fa-check fa-lg"></i></a>
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
    <script>
        $(document).ready(function() {
            $('#projectSelect').change(function() {
                var projectId = $(this).val();
                if (projectId !== "") {

                    $('#projectHeadSelect, #employeesSelect').prop('disabled', false);

                    $.ajax({
                        type: 'POST',
                        url: 'backend/fetch_project_heads.php',
                        data: {
                            project_id: projectId
                        },
                        success: function(response) {
                            $('#projectHeadSelect').html(response);
                        }
                    });

                    // Fetch assigned employees
                    $.ajax({
                        type: 'POST',
                        url: 'backend/fetch_assigned_employees.php',
                        data: {
                            project_id: projectId
                        },
                        success: function(response) {
                            $('#employeesSelect').html(response);
                        }
                    });
                } else {

                    $('#projectHeadSelect, #employeesSelect').prop('disabled', true);

                    $('#projectHeadSelect, #employeesSelect').val('');
                }
            });
        });
    </script>



</body>

</html>