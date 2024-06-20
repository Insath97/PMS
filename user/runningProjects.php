<?php
session_start();
include("backend/dbconn.php");

if (isset($_SESSION['userId'])) {
    $user_id = $_SESSION['userId'];
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
                                            <th>Project Code</th>
                                            <th>Project Name</th>
                                            <th>Project Head Name</th>
                                            <th>Start Date</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $n = 1;
                                    $qry = "SELECT DISTINCT project.code, project.project_name, project.emp_head, project.emp_wrks, project.start_date,users.first_name,users.last_name
                                            FROM project
                                            LEFT JOIN teamhead ON teamhead.project_id = project.code
                                            LEFT JOIN teamwrks ON teamwrks.projectcode = project.code
                                            INNER JOIN users ON users.Id = '$user_id'
                                            WHERE teamhead.emp = '$user_id' OR teamwrks.empid = '$user_id'";

                                    $result = mysqli_query($conn, $qry);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) { ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $n; ?></td>
                                                    <td><?php echo $row['code']; ?></td>
                                                    <td><?php echo $row['project_name']; ?></td>
                                                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                                    <td><?php echo $row['start_date']; ?></td>
                                                </tr>
                                            </tbody>
                                        <?php
                                            $n++;
                                        }
                                    } else { ?>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-center" style="font-size: 20px;">No data found</td>

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
                <!-- external footer link -->
                <?php include("includes/footer.php"); ?>

            </div>

        </div>
    </div>
    <!-- external script link -->
    <?php include("includes/script.php"); ?>
</body>

</html>