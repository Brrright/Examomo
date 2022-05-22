<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    $req = "SELECT * FROM student INNER JOIN class ON student.ClassID = class.ClassID WHERE StudentID =".$_SESSION['userID']."";
    $fetched = mysqli_query($con,$req);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "common/HeadImportInfo.php"
    ?>
    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/calwynCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css">
    <title>Student Homepage</title>
</head>
<body>
    <?php require "common/header_student.php";?>
    <div class="section-full d-flex flex-column">
        <div class="d-flex flex-row justify-content-between mx-auto" style="width:85%; height:40%">
            <div class="card-half p-4 shadow p-3 mb-5">
                <p class="font-caveat fs-3 text-center main-color">
                    profile
                </p>
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="img/admin/students.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                        <div class="stubox mx-3">
                            <h5 class="card-title">Student details</h5>
                            <?php
                            $row = mysqli_fetch_array($fetched);
                                echo "Student ID    :".$row['StudentID']."<br>";
                                echo "Student Name  :".$row['StudentName']."<br>";
                                echo "Class Name    :".$row['ClassName']."<br>";
                            ?>
                        </div>
                        <br>
                        <div class="row g-0 mx-3">
                            <div class="col-md-6">
                            <button href="#" class="stubtn"><span>View Exams</span></button>
                            </div>
                            <br>
                            <div class="col-md-6">
                            <button href="#" class="stubtn"><span>View Results</span></button>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
            <div class="card-half p-4 shadow p-3 mb-5">
                <p class="font-caveat fs-3 text-center main-color">
                    calender
                </p>
                
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between mx-auto mb-5" style="width:85%;">
        <div class="card-full p-4 shadow p-3 mb-5" style="width:100%;">
            <div class="d-flex flex-row mx-auto justify-content-betweeen align-items-center" style="width:70%">
                <p class="font-caveat fs-3 m-4 main-color"  style="width:40%">
                    Upcoming Exams
                </p>
                <div style="width:40%"></div>
                <button class="btn btn-primary" style="width:20%; height:90%">View all</button>
            </div>
            <div class="d-flex flex-row justify-content-around m-3 mx-auto" style="width:80%; height:30%">
                <div class="main-bg-color exam-card p-4 text-white">
                    XXX <br>
                    DATE
                </div>
                <div class="main-bg-color exam-card p-4 text-white">
                    XXX <br>
                    DATE
                </div>
            </div>
        </div>
        </div>
        
    </div>
    <?php require "common/footer_student.php";?>
</body>
</html>