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

              <?php
              $name_qry = "SELECT * FROM `project` WHERE code='$subtask'";
              $name_result = mysqli_query($conn, $name_qry);
              $name_row = mysqli_fetch_array($name_result);
              ?>
              <h4 class="card-title"><?php echo $name_row['project_name'] ?></h4>

              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Task Name</th>
                      <th>Requirements</th>                   
                      <th>Start Date</th> 
                      <th>Task Status</th>                 
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php
                  $n = 1;
                  // `Id`, `project_name`, `task_name`, `task_employee`, `start_date`, `requirements`, `attachment`, `task_status`, `active`
                  $task_qry = "SELECT * FROM `task` WHERE task_employee='$user_id' AND project_name='$subtask' AND active ='0'";
                  $task_result = mysqli_query($conn, $task_qry);
                  $task_count = mysqli_num_rows($task_result);
                  if ($task_count > 0) {
                    while ($task_row = mysqli_fetch_array($task_result)) { ?>
                      <tbody>
                        <tr>
                          <td><?php echo $n; ?></td>
                          <td><?php echo $task_row['task_name']; ?></td>
                          <td><?php echo $task_row['requirements']; ?></label></td>
                          <td><?php echo $task_row['start_date']; ?></td>
                          <?php
                          $status = "Processing";

                          if ($task_row['task_status'] == "Emergency") { ?>
                            <td><label class="badge badge-danger "><?php echo $status; ?></label></td>
                          <?php
                          } else if ($task_row['task_status'] == "Mid") { ?>
                            <td><label class="badge" style="background-color: orange; color: white;"><?php echo $status; ?></label></td>
                          <?php
                          } else if ($task_row['task_status'] == "Low") { ?>
                            <td><label class="badge badge-warning "><?php echo $status; ?></label></td>
                          <?php
                          } else if ($task_row['task_status'] == "Waiting For Approval"){ ?> 
                            <td><label class="badge badge-dark">Waiting For Approval</label></td>
                          <?php
                          }
                          ?>                    
                          <td>                          
                            <a href="backend/updatetask.php?updateid=<?php echo $task_row['Id']; ?>" class="text-primary mx-2"><i class="fa fa-check-square fa-2x"></i></a>
                          </td>
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