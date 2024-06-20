<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="dashboard.php"><img src="assests/pics/logo.png" alt="logo" style="height: 80px; width:80px;" /><span>PMS</span> </a>
        <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="assests/pics/logo.png" alt="logo" /></a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="assests/pics/admin.png">

                </a>
                <?php
                if (isset($_SESSION['user_name'])) {
                    $user_name = $_SESSION['user_name'];
                }
                ?>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item">
                        <i class="ti-settings text-primary"></i>
                        <?php echo $user_name; ?>
                    </a>
                    <a class="dropdown-item" href="#" onclick="confirmLogout()">
                        <i class="ti-power-off text-primary"></i>
                        Logout
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
                </div>
            </li>

        </ul>

    </div>
</nav>