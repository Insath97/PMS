<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item  <?php if ($page == "project") {
                                    echo 'active';
                                } ?>">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="fas fa-file-powerpoint mr-3"></i>
                <span class="menu-title">Project</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="runningProjects.php">Running Project</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item <?php if ($page == "userviewTask") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="fas fa-tasks mr-3"></i>
                <span class="menu-title">Task</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="userviewTask.php">View Task</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item <?php if ($page == "user") {
                                echo 'active';
                            } ?>">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-tasks mr-3"></i>
                <span class="menu-title">Completed Task</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="completedTask.php">View Completed Task</a></li>
                </ul>
            </div>
        </li>





        <li class="nav-item mt-5">
            <a class="nav-link" href="#" onclick="confirmLogout()">
                <i class="fas fa-sign-out-alt mr-3"></i>
                <span class="menu-title">Logout</span>
            </a>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script>
                function confirmLogout() {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, logout!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "backend/logout.php";
                        }
                    });
                }
            </script>
        </li>
    </ul>
</nav>