<?php
include("backend/dbconn.php");

if (isset($_POST['submit'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userrole = $_POST['userrole'];
    $email = $_POST['em'];
    $phoneNumber = $_POST['phoneNumber'];
    $City = $_POST['City'];
    $username = $_POST['username'];
 

    $qry = "UPDATE `users` SET `first_name`='$firstName',`last_name`='$lastName',`user_role`='$userrole',`email`='$email',`PhoneNumber`='$phoneNumber',`city`='$City' WHERE username='$username'";

    $result = mysqli_query($conn, $qry);

    if ($result) {
        $successScript = "
            Swal.fire({
                icon: 'success',
                title: 'User Update Successfully',
                text: '$userrole has been updated successfully!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'viewUser.php';
            });
            ";
    } else {
        $errorScript = "
            Swal.fire({
                icon: 'error',
                title: 'Can\'t Update User ',
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
    <div class="container-scroller">

        <!-- linked external navbar -->
        <?php include("includes/navbar.php"); ?>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- linked external sidebar -->
            <?php $page = "user";
            include("includes/sidebar.php"); ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New User</h4>
                            <?php
                            //  `first_name`, `last_name`, `user_role`, `PhoneNumber`, `city`, `username`, `password`, `dateCreated`                                
                            $id = $_GET['updateId'];
                            $qry_select = "SELECT * FROM `users` WHERE username = '$id'";
                            $result_select = mysqli_query($conn, $qry_select);
                            while ($row = mysqli_fetch_array($result_select)) {
                            ?>
                                <form method="POST">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input class="form-control" type="text" name="firstName" value="<?php echo $row['first_name']; ?>" autofocus required />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="firstName" class="form-label">Last Name</label>
                                            <input class="form-control" type="text" name="lastName" value="<?php echo $row['last_name'];; ?>" required />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="exampleFormControlSelect2">User Role</label>
                                            <select class="form-control" id="userrole" name="userrole">
                                                <option value="<?php echo $row['user_role'];; ?>"><?php echo $row['user_role'];; ?></option>
                                                <option>Select User Role</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Employee">Employee</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="email" required name="em" value="<?php echo $row['email'];; ?>" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">SL (+94)</span>
                                                <input type="number" name="phoneNumber" class="form-control" value="<?php echo $row['PhoneNumber'];; ?>" required />
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">City</label>
                                            <input type="text" class="form-control" name="City" value="<?php echo $row['city'];; ?>" required />
                                        </div>
                                        <input type="hidden" class="form-control" required name="username" id="username" value="<?php echo $row['username'];; ?>" readonly />

                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" name="submit" class="btn btn-primary me-2">Update User</button>
                                    </div>
                                </form>
                            <?php } ?>
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