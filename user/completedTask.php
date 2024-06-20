<?php
session_start();
include("backend/dbconn.php");

if (isset($_SESSION['userId'])) {
    $user_id = $_SESSION['userId'];
}

if (isset($_GET['subtask'])) {
    $subtask = $_GET['subtask'];
}
?>

<?php

if (isset($_GET['status']) && $_GET['status'] == "success") {
    $successScript = "
    Swal.fire({
        icon: 'success',
        title: 'Task Complete',
        text: 'Wainting For Admin Approval!',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'userviewSubtask.php';
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
        window.location.href = 'userviewSubtask.php';
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
            <?php $page = "userviewtask";
            include("includes/sidebar.php"); ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">



                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="card-title">Completed Projects</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project Code</th>
                                            <th>Project Name</th>
                                            <th>Task Name</th>
                                            <th>Completed Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $n = 1;
                                            $select_qry = "SELECT project.code, project.project_name,task.task_name,task.dateCreated
                                                            FROM project
                                                            LEFT JOIN task ON project.code = task.project_name
                                                            WHERE (project.emp_head = '$user_id' OR task.task_employee = '$user_id') AND task.active ='1'";

                                        $select_result = mysqli_query($conn, $select_qry);
                                        if (mysqli_num_rows($select_result) > 0) {
                                            while ($select_row = mysqli_fetch_array($select_result)) { ?>
                                                <tr>
                                                    <td><?php echo $n; ?></td>
                                                    <td><?php echo $select_row['code']; ?></td>
                                                    <td><?php echo $select_row['project_name']; ?></td>
                                                    <td><?php echo $select_row['task_name']; ?></td>
                                                    <?php
                                                    if($select_row['dateCreated'] == ''){ ?>
                                                        <td><label class="badge badge-dark">Waiting For Approval</label></td>
                                                    <?php
                                                    }else{ ?> 
                                                     <td><?php echo $select_row['dateCreated']; ?></td>
                                                    <?php                                                       
                                                    }
                                                    ?>
                                                   
                                                </tr>
                                            <?php
                                                $n++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center" style="font-size: 20px;">No data found</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
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