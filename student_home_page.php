<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "student") {
        echo '<script>alert("You have not access to this page.");
        window.location.href="guest_home_page.php";</script>';
      }

      // get current datetime
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_clicked = date('Y-m-d H:i:s');

    // sql for exam details
    $fetchexam ="SELECT exam.ExamName, exam.ExamStartDateTime, exam.ExamEndDateTime FROM student
                INNER JOIN exam_class ON student.ClassID = exam_class.ClassID
                INNER JOIN exam ON exam_class.ExamID = exam.ExamID
                WHERE student.StudentID = ".$_SESSION["userID"]." AND ExamStartDateTime >= '$date_clicked' AND isPublished LIKE 1 ORDER BY ExamStartDateTime DESC LIMIT 2";
    $examquery = mysqli_query($con, $fetchexam);
    $examrow = mysqli_num_rows($examquery);

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
                <center><p class="fs-3 main-color m-0" style="font-family:Poppins;">
                    Profile
                </p></center>
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="img/admin/students.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                        <div class="stubox mx-3">
                            <h5 class="card-title">Student details</h5>
                            <?php
                                $req = "SELECT * FROM student 
                                        INNER JOIN class ON student.ClassID = class.ClassID 
                                        WHERE student.StudentID = ".$_SESSION['userID']."";
                                $fetched = mysqli_query($con,$req);
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
            <div class="card-half p-3 shadow p-3 mb-5">
            <a href="student_view_result.php" style="text-decoration: none;">
                <div class="area">
                <?php
                    $req = "SELECT * FROM student 
                            -- INNER JOIN class ON student.ClassID = class.ClassID
                            INNER JOIN result ON student.StudentID = result.StudentID
                            -- INNER JOIN question_multiple_choice ON question_multiple_choice.PaperID = result.PaperID
                            -- INNER JOIN question_structure ON question_structure.PaperID = result.PaperID
                            WHERE student.StudentID = ".$_SESSION['userID']."";

                    $resultfetched = mysqli_query($con,$req);
                    $resultnumber = mysqli_num_rows($resultfetched);

                    if ($resultnumber === 0) {
                        $noresult = '<p class="fs-3 text-center" style="color:white;font-family:Poppins;">No Results Found</p>';
                        echo $noresult;
                    }
                    else{
                        while ($resultrow = mysqli_fetch_array($resultfetched)){
                            $totalmark = $resultrow['TotalMark'];
                            
                            $marks[] = $totalmark;
                        }
                        
                        $averagemark = array_sum($marks)/$resultnumber;
                        $resultpanel = '<p class="fs-3 text-center" style="color:white;font-family:Poppins;"">
                        Your Exam Performance<br><span>'.$averagemark.'%</span></p>';

                        echo $resultpanel;
                        
                    }
                    
                ?>

                <div class="pt-1 mb-1">
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="2" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="4" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="6" fill="#fff" />
                    </g>
                    </svg>
                </div>
                
                </div>
                <div class="progressbar mx-auto m-2">
                    <div style="width:<?php 
                     $req = "SELECT * FROM student 
                     -- INNER JOIN class ON student.ClassID = class.ClassID
                     INNER JOIN result ON student.StudentID = result.StudentID
                     -- INNER JOIN question_multiple_choice ON question_multiple_choice.PaperID = result.PaperID
                     -- INNER JOIN question_structure ON question_structure.PaperID = result.PaperID
                     WHERE student.StudentID = ".$_SESSION['userID']."";

                    $resultfetched = mysqli_query($con,$req);
                    $resultnumber = mysqli_num_rows($resultfetched);
                    
                    if ($resultnumber === 0) {
                        echo 0;
                    }
                    else{echo $averagemark;}?>%;"></div>
                    </div>
                </a>
    </div >
                
        </div>
        <div class="d-flex flex-row justify-content-between mx-auto mb-5" style="width:85%;">
        <div class="card-full p-4 shadow p-3 mb-5" style="width:100%;">
            <div class="d-flex flex-row mx-auto justify-content-betweeen align-items-center" style="width:70%">
                <p class="font-caveat fs-3 m-4 main-color"  style="width:40%">
                    Upcoming Exams
                </p>
                <div style="width:40%"></div>
                <a href="student_exam_list.php" style="text-decoration:none;"><button class="stubtn" style="width:100%; height:90%">View all</button></a>
            </div>
            <div class="d-flex flex-row justify-content-around m-3 mx-auto" style="width:80%; height:30%">
                <?php 
                    if ($examrow === 0) {
                        echo '<div class="main-bg-color exam-card p-4 text-white">
                                No upcoming exams available.
                            </div>';                   
                    }
                
                    while ($examrow = mysqli_fetch_array($examquery)){
                        echo '<div class="main-bg-color exam-card p-4 text-white">
                            Name: '.$examrow["ExamName"].'<br>
                            Start Time: '.$examrow["ExamStartDateTime"].'<br>
                            End Time: '.$examrow["ExamEndDateTime"].'<br>
                            </div>'; 
                    }
                ?>
            </div>
        </div>
        </div>
        
    </div>
    <?php require "common/footer_student.php";?>
</body>
</html>