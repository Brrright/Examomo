<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <!-- Some link need to use if else statement to do, will add on soon (to check session, knowing which role) -->
        <a class="navbar-brand logo-style ms-2" href="lecturer_home_page.php" style="font-weight: bold; font-family: 'Caveat'; font-size: 32px; color: #2B5EA4; text-shadow: 0px 2px #707b8b93;">
            <img class="navbar-brand" src="img/logo_small_no_text.png" alt="Examomo logo" width="50px" height="50px" >
            Examomo
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu" >
            <ul class="navbar-nav ms-auto mb-2 me-5 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" style="color:#2B5EA4;" href="lecturer_home_page.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#2B5EA4;" href="lecturer_exam_page.php"><i class="bi bi-calendar3-event"></i> Manage Exam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#2B5EA4;" href="lecturer_exampaper_page.php"><i class="bi bi-newspaper"></i> Manage Exam Paper</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative" style="color:#2B5EA4;" href="lecturer_completed_exam_list">
                        Paper to be mark
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#2B5EA4;" href="lecturer_profile_page"><span style="width:30px; height:30px" class="bi bi-person-circle"></span>Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn" id="logoutbtn" style="color:#2B5EA4">Logout</a>
                </li>
            </ul>
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

