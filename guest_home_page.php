<?php
    require "common/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "common/HeadImportInfo.php";
    ?>
    <link rel="stylesheet" href="css/commonCSS.css">
    <link rel="stylesheet" href="css/mingliangCSS.css">

    <title>Examomo | Guest Home Page</title>
</head>
<body>
    <?php 
        require "common/header_guest.php";
        // require "common/header_admin.php";
        // require "common/header_lecturer.php";
        // require "common/header_student.php";
    ?>
    <br>
    <div class="d-flex flex-wrap justify-content-evenly mx-auto p-5 bg-white-template" style="margin-top:80px;">
        <img src="img/logo_big_with_text.png" class="p-3 responsive-img" alt="examomo logo" width="300px"; height="300px">
        <div class="d-flex flex-column justify-content-center text-center p-3 mt-4" style="width:350px; height:300px;">
            <p class="logo-style" style="font-size:4vw; margin-bottom:0px;">Examomo</p>
            <p class="text-justify pb-5" style="font-size:20px;">is an online examination platform that ensures the honesty of students’ work while providing the necessary functions to conduct examinations and sufficient quality-of-life features for the students. </p>
        </div>
        <div class="d-flex flex-column justify-content-center align-content-center mt-3 mb-3 p-3" style="width:300px; height:auto;">
            <button class="btn btn-primary main-bg-color text-white mb-5 fs-3 btn-hover">Get Started!</button>
            <div class="btn-group">
                <button  class="btn btn-primary main-bg-color text-white dropdown-toggle fs-3 btn-hover"  data-bs-toggle="dropdown">
                    <span style="width:30px; height:30px" class="bi bi-person-circle"></span>
                    Login as
                </button>
                <div class="dropdown-menu " style="width:100%; height:auto;">
                    <a href="" class="dropdown-item">Student</a>
                    <a href="" class="dropdown-item">Lecturer</a>
                    <a href="" class="dropdown-item">Admin</a>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <section class="section-full">
        <div class="d-flex container-fluid flex-wrap justify-content-around mx-auto align-items-center">
            <div class="d-flex flex-column me-5" style="width:60%">
                <h1 class="guest-ads-title font-caveat">Exam Functionalities</h1>
                <ul class="guest-ads-content">
                    <li>Support MCQ and structure question</li>
                    <li>Switch tab detection</li>
                    <li>Minimize browser detection</li>
                    <li>Constantly answer saving</li>
                </ul>
            </div>
            <img src="img/guest/guest_examination.png" alt="exam picture" class="responsive-img" width="300px"; height="300px";>
        </div>
    </section>
    <section class="section-full">
        <div class="d-flex container-fluid flex-wrap justify-content-around mx-auto align-items-center">
            <div class="d-flex flex-column me-5 " style="width:60%">
                <h1 class="guest-ads-title font-caveat">Admin Functionalities</h1>
                <ul class="guest-ads-content">
                    <li>Organization information management</li>
                    <li>Admin, lecturer, and student account management</li>
                    <li>Class and module management</li>
                    <li>Feedback management</li>
                </ul>
            </div>
            <img src="img/guest/guest_admin.png" alt="exam picture" class="responsive-img" width="300px"; height="300px";>
        </div>
    </section>
    <section class="section-full">
        <div class="d-flex container-fluid flex-wrap justify-content-around mx-auto align-items-center">
            <div class="d-flex flex-column me-5 " style="width:60%">
                <h1 class="guest-ads-title font-caveat">Lecturer Functionalities</h1>
                <ul class="guest-ads-content">
                    <li>Exam detail management</li>
                    <li>Exam paper management (MCQ/ Structured)</li>
                    <li>Paper marking</li>
                    <li>Personal profile</li>
                </ul>
            </div>
            <img src="img/guest/guest_lecturer.png" alt="exam picture" class="responsive-img" width="300px"; height="300px";>
        </div>
    </section>
    <section class="section-full">
        <div class="d-flex container-fluid flex-wrap justify-content-around mx-auto align-items-center">
            <div class="d-flex flex-column me-5 " style="width:60%">
                <h1 class="guest-ads-title font-caveat">Student Functionalities</h1>
                <ul class="guest-ads-content">
                    <li>List of Upcoming Exam (Calender view)</li>
                    <li>Take exam</li>
                    <li>Constantly answer saving</li>
                    <li>View result list</li>
                    <li>Personal profile</li>
                    <li>Provide feedback to admin</li>
                </ul>
            </div>
            <img src="img/guest/guest_student.png" alt="exam picture" class="responsive-img" width="300px"; height="300px";>
        </div>
    </section>
    <section class="section-full">
        <div class="shadow-lg rounded-3 bg-white-template d-flex flex-column mx-auto w-90 p-5">
            <h1 class="font-caveat text-center main-color" style="font-weight:bold;">3 Major Roles</h1>
            <div class="d-flex flex-wrap justify-content-around mx-auto">
                <div class="card m-3 p-3 card-style shadow" style="width: 25%">
                    <img src="img/guest/role_admin_icon.png" class="responsive-img mx-auto" alt="admin icon">
                    <div class="card-body">
                        <ul>
                            <li class="card-text">Organization management</li>
                            <li class="card-text">Admin, Lecturer, and student accounts management</li>
                            <li class="card-text">Class and module management</li>
                            <li class="card-text">Feedback management</li>
                        </ul>
                    </div>
                </div>
                <div class="card m-3 p-3 card-style shadow" style="width: 25%">
                    <img src="img/guest/role_lecturer_icon.png" class="responsive-img mx-auto" alt="lecturer icon">
                    <div class="card-body">
                        <ul>
                            <li class="card-text">Exam detail management</li>
                            <li class="card-text">Exam paper management (MCQ/ Structured)</li>
                            <li class="card-text">Paper marking</li>
                            <li class="card-text">Personal profile</li>
                        </ul>
                    </div>
                </div>
                <div class="card m-3 p-3 card-style shadow" style="width: 25%">
                    <img src="img/guest/role_student_icon.png" class="responsive-img mx-auto" alt="student icon">
                    <div class="card-body">
                        <ul>
                            <li class="card-text">List of Upcoming Exam (Calender view)</li>
                            <li class="card-text">Take exam</li>
                            <li class="card-text">Constantly answer saving</li>
                            <li class="card-text">View result list</li>
                            <li class="card-text">Personal profile</li>
                            <li class="card-text">Provide feedback to admin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-around align-items-center" style="margin-bottom:50px;">
        <h2 class="font-caveat"><b>Create your own company account</b></h2>
        <a href="#" class="btn btn-primary main-bg-color text-white font-caveat fs-5 rounded-pill" style="width:200px;">Get Started  <i class="ms-2 text-white bi bi-arrow-right-circle"></i> </a>
    </div>
    <?php 
        // require "common/footer_guest.php";
        // require "common/footer_admin.php";
        // require "common/footer_student.php";
        require "common/footer_lecturer.php";
    ?>
    <script src="https://unpkg.com/vue@3"></script>
</body>
</html>