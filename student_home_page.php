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
    <link rel="stylesheet" href="css/calwynCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css">
    <title>Student Homepage</title>
</head>
<body>
    <?php require "common/header_student.php";?>
    <div class="section-full d-flex flex-column">
        <div class="d-flex flex-row justify-content-between mx-auto mb-5" style="width:85%; height:40%">
            <div class="card-half">
                <p class="font-caveat fs-3 text-center">
                    profile
                </p>
                <div class="card mb-3 mx-auto" style="width:90%">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="img/icon/person.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Student details</h5>
                            <?php
                            while($row = mysqli_fetch_array($fetched)) {
                                echo "Student ID    :".$row['StudentID']."<br>";
                                echo "Student Name  :".$row['StudentName']."<br>";
                                echo "Class Name    :".$row['ClassName']."<br>";
                            }

                            // <p class="card-text">Class</p>
                            // <p class="card-text"><small class="text-muted">Asia pacific?</small></p>
                            ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-half">
                <p class="font-caveat fs-3 text-center">
                    calender
                </p>
                
            </div>
        </div>
        <div class="card-full p-3">
            <div class="d-flex flex-row mx-auto justify-content-betweeen align-items-center" style="width:80%">
                <p class="font-caveat fs-3 m-4"  style="width:40%">
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
    <?php require "common/footer_student.php";?>
</body>
</html>