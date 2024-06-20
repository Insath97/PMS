<?php
include("backend/dbconn.php");
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
            <?php include("includes/sidebar.php"); ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="card-title">View User</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Employee Role</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>City</th>
                                            <th>Username</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    //  `first_name`, `last_name`, `user_role`, `PhoneNumber`, `city`, `username`, `password`, `dateCreated`
                                    $n = 1;
                                    $qry_select = "SELECT * FROM `users` LIMIT 3";
                                    $result_select = mysqli_query($conn, $qry_select);
                                    while ($row = mysqli_fetch_array($result_select)) {
                                    ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $n; ?></td>
                                                <td><?php echo $row['first_name']; ?></td>
                                                <td><?php echo $row['last_name']; ?></td>
                                                <td><?php echo $row['user_role']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td>+94<?php echo $row['PhoneNumber']; ?></td>
                                                <td><?php echo $row['city']; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['dateCreated']; ?></td>
                                                <td>
                                                    <a href="updateUser.php?updateId=<?php echo $row['username']; ?>" class="text-success mx-2"><i class="fas fa-edit fa-lg"></i></a>
                                                    <a href="backend/deleteUser.php?deleteId=<?php echo $row['username']; ?>" class="text-danger mx-2"><i class="fas fa-trash-alt fa-lg"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php $n++;
                                    } ?>
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