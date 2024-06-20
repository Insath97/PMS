<?php
session_start();
include("backend/dbconn.php");

if(isset($_SESSION['userId'])){
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
    <?php include("includes/sidebar.php"); ?>


      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h2 class="font-weight-bold">Welcome PMS</h3>

                </div>

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