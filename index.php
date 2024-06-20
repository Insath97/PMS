<?php
session_start();
include("admin/backend/dbconn.php");

if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  // `Id`, `first_name`, `last_name`, `user_role`, `email`, `PhoneNumber`, `city`, `username`, `password`, `dateCreated` 
  $qry = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $qry);
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result);

  if ($count > 0) {
    if ($row['user_role'] == "Admin") {

      $_SESSION['adminId'] = $row['Id'];
      $_SESSION['admin_username'] =  $row['username'];
      $_SESSION['admin_name'] = $row['first_name'].' '.$row['last_name'];

      header("location:admin/dashboard.php");

    } else if ($row['user_role'] == "Employee") {

      $_SESSION['userId'] = $row['Id'];
      $_SESSION['user_username'] =  $row['username'];
      $_SESSION['user_name'] = $row['first_name'].' '.$row['last_name'];

      header("location:user/dashboard.php");

    }
  } else {
    $errorScript = "
    Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        text: 'User Data Not Found!',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'index.php';
    });
    ";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PMS</title>


  <link rel="stylesheet" href="admin/assests/vendors/feather/feather.css">
  <link rel="stylesheet" href="admin/assests/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="admin/assests/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="admin/assests/css/vertical-layout-light/style.css">
  <!-- sweet alert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <!-- scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <center>
                  <!-- Add Logo Here -->
                  <img src="admin/assests/pics/logo.png" alt="logo">
                </center>
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>

              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="submit">SIGN IN</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


  <script src="assests/vendors/js/vendor.bundle.base.js"></script>
  <script src="assests/js/off-canvas.js"></script>
  <script src="assests/js/hoverable-collapse.js"></script>
  <script src="assests/js/template.js"></script>
  <script src="assests/js/settings.js"></script>
  <script src="assests/js/todolist.js"></script>

  <!-- alert popup -->
  <?php if (isset($successScript)) : ?>
    <script>
      <?php echo $successScript; ?>
    </script>
  <?php endif; ?>

  <?php if (isset($errorScript)) : ?>
    <script>
      <?php echo $errorScript; ?>
    </script>
  <?php endif; ?>

</body>

</html>