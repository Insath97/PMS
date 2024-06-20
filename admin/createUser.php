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
    $password = $_POST['password'];
    $dateCreated = date("Y-m-d");

    $qry_check = "SELECT * FROM `users` WHERE username = '$username'";
    $result_check = mysqli_query($conn, $qry_check);
    $check = mysqli_fetch_array($result_check);

    if ($check) {
        $errorScript = "
        console.log('This User already exists:', '$username');
        Swal.fire({
            icon: 'error',
            title: 'Can\'t Add User',
            text: 'This username already exists!',
            confirmButtonText: 'OK'
        });
        ";
    } else {
        $qry = "INSERT INTO `users` (`first_name`, `last_name`, `user_role`,`email`, `PhoneNumber`, `city`, `username`, `password`, `dateCreated`)
        VALUES ('$firstName','$lastName','$userrole','$email','$phoneNumber','$City','$username','$password','$dateCreated')";

        $result = mysqli_query($conn, $qry);

        if ($result) {
            $successScript = "
            Swal.fire({
                icon: 'success',
                title: 'User Added Successfully',
                text: 'New $userrole has been added successfully!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'createUser.php';
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
}
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
        window.location.href = 'createUser.php';
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
        window.location.href = 'createUser.php';
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
            <?php $page = "user";
            include("includes/sidebar.php"); ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New User</h4>

                            <form method="POST">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input class="form-control" type="text" name="firstName" placeholder="Fathima" autofocus required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Last Name</label>
                                        <input class="form-control" type="text" name="lastName" placeholder="Hana" required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect2">User Role</label>
                                        <select class="form-control" id="userrole" name="userrole">
                                            <option>Select User Role</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Employee">Employee</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="email" required name="em" placeholder="email@example.com" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">SL (+94)</span>
                                            <input type="number" name="phoneNumber" class="form-control" placeholder="123456789" required />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">City</label>
                                        <input type="text" class="form-control" name="City" placeholder="Sainthamaruthu" required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Username</label>
                                        <input type="text" class="form-control" required name="username" id="username" placeholder="NaN" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Password</label>
                                        <input type="text" class="form-control" name="password" placeholder="PWD 001" value="<?php echo "PWD" . rand(1234, 9999); ?>" readonly />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" name="submit" class="btn btn-primary me-2">Add User</button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="card-title">View Employees</h4>
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

    <script>
        // Function to generate a random number between min and max (inclusive)
        function getRandomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // Function to generate a random username for a role
        function generateRandomUsername(abbreviation) {
            var randomNumber = getRandomNumber(1000, 9999);
            return abbreviation + randomNumber;
        }

        // Initialize Select2
        $(document).ready(function() {
            $('.select2').select2();
        });

        // Add event listener to the select element
        $('#userrole').change(function() {
            // Get the selected value
            var selectedRole = $(this).val();

            // Map roles to corresponding abbreviations
            var roleAbbreviations = {
                'Admin': 'ADM',
                'Employee': 'EMP',
                // Add more roles as needed
            };

            // Generate a random username based on the selected role
            var randomUsername = generateRandomUsername(roleAbbreviations[selectedRole]);

            // Update the username field with the generated username
            $('#username').val(randomUsername);
        });
    </script>

    <!-- external script link -->
    <?php include("includes/script.php"); ?>
</body>

</html>