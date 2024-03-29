<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <!-- Some link need to use if else statement to do, will add on soon (to check session, knowing which role) -->
        <a class="navbar-brand logo-style ms-2" href="admin_home_page.php" style="font-weight: bold; font-family: 'Caveat'; font-size: 32px; color: #2B5EA4; text-shadow: 0px 2px #707b8b93;">
            <img class="navbar-brand" src="img/logo_small_no_text.png" alt="Examomo logo" width="50px" height="50px">
            Examomo
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu" >
            <ul class="navbar-nav ms-auto mb-2 me-5 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" style="color:#2B5EA4;" href="admin_home_page.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative" style="color:#2B5EA4;" href="admin_feedback_page.php">
                        Feedback 
                        <?php
                            $fetchFeedbackStatus0 = mysqli_query($con, "SELECT * FROM feedback WHERE FeedbackStatus = 0 AND CompanyID = ".$_SESSION['companyID']."");
                            $numberGained = mysqli_num_rows($fetchFeedbackStatus0);

                            $gotnoti = '<span id="" class="position-absolute top-0 start-100 translate-middle badge bg-warning rounded-pill text-dark">'.$numberGained.'</span>';

                            if ($numberGained > 0){
                                echo $gotnoti;
                            }
                        ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#2B5EA4;" href="admin_module_list.php">Manage Module</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#2B5EA4;" href="admin_class_list.php">Manage Class</a>
                </li>
                
                <!-- Drop down Nav Item -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#2B5EA4;">
                        Manage Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="admin_student_list.php">Student</a></li>
                        <li><a class="dropdown-item" href="admin_lecturer_list.php">Lecturer</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="admin_account_list.php">Admin</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" style="color:#2B5EA4;" id="logoutbtn">Logout</a>
                </li>
            </ul>

            <!-- Search bar -->
            <!-- <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>
<script> 
const logoutBtn = document.getElementById("logoutbtn");
logoutBtn.addEventListener("click", function(event) {
    Swal.fire({
        title: 'Do you wanted to logout?',
        text: "You will be redirect back to guest home page",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "logout.php"
        }
      })
})
</script>

