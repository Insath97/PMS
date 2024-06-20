<?php
include("backend/dbconn.php");
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
                                                   INNER JOIN project ON project.code =task.project_name
                                                   WHERE task.active='0'";
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
                                                        } else if ($select_row['task_status'] == "Waiting For Approval") { ?>
                                                            <td><label class="badge badge-dark">Waiting For Approval</label></td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td>
                                                            <a href="backend/approval.php?aprovalId=<?php echo $select_row['Id']; ?>" class="text-success mx-2"><i class="fas fa-check fa-lg"></i></a>
                                                            <!-- <a href="" class="text-primary mx-4"><i class="fas fa-edit fa-lg"></i></a>
                                                            <a href="" class="text-danger "><i class="fas fa-trash-alt fa-lg"></i></a> -->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php
                                            }
                                        } else { ?>
                                            <tbody>
                                                <tr>
                                                    <td colspan="9" class="text-center" style="font-size: 20px;">No data found</td>

                                                </tr>
                                            </tbody>
                                        <?php
                                        }
                                        ?>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- external footer link -->
                <?php include("includes/footer.php"); ?>

            </div>

        </div>

        <!-- external script link -->
        <?php include("includes/script.php"); ?>
</body>

</html>