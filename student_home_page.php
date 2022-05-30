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
                WHERE student.StudentID = ".$_SESSION["userID"]." AND ExamEndDateTime >= '$date_clicked' AND isPublished LIKE 1 ORDER BY ExamStartDateTime DESC LIMIT 1";
    $examquery = mysqli_query($con, $fetchexam);
    $examrow = mysqli_num_rows($examquery);

    function timeDiff($firstTime,$lastTime){
        // convert to unix timestamps
        $firstTime=strtotime($firstTime);
        $lastTime=strtotime($lastTime);
     
        // perform subtraction to get the difference (in seconds) between times
        $timeDiff=$lastTime-$firstTime;
     
        // return the difference
        return $timeDiff;
     }
     
     function durationformater($timeDiff){
         //Usage :
         // $difference = timeDiff($start,$end);
         $years = abs(floor($timeDiff / 31536000));
         $days = abs(floor(($timeDiff-($years * 31536000))/86400));
         $hours = abs(floor(($timeDiff-($years * 31536000)-($days * 86400))/3600));
         $mins = abs(floor(($timeDiff-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
         //     $formattedDuration = "Time Passed: " . $years . " Years, ". $days . " Days, " . $hours . " Hours, " . $mins . " Minutes.";
         
     
         if ($years > 1) {
             $disyears =  $years . "years";
         }elseif ($years == 1){
             $disyears =  $years . "year";
         }else{
             $disyears = "";
         }
     
         if ($days > 1) {
             $disdays =  $days . "days";
         }elseif ($days == 1){
             $disdays =  $days . "day";
         }else{
             $disdays = "";
         }
     
     
         if ($hours > 1) {
             $dishours =  $hours . "hours";
         }elseif ($hours == 1){
             $dishours =  $hours . "hour";
         }else{
             $dishours = "";
         }
     
         if ($mins > 1) {
             $dismins =  $mins . "minutes";
         }elseif ($mins == 1){
             $dismins =  $mins . "minute";
         }else{
             $dismins = "";
         }
     
     
         $formattedDuration = $disyears ." ". $disdays . " " . $dishours . " " . $dismins ;
         return $formattedDuration;
        }
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
    <div class="d-flex flex-column">
        <div class="d-flex flex-row justify-content-between mx-auto" style="width:85%; height:40%">
            <div class="card-half p-0 shadow p-3 mb-3">
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
                        <div class="row g-0 m-0">
                            <div class="col-md-6">
                            <center><a href="student_exam_list.php" class="stubtn"><span>View Exams</span></a></center>
                            </div>
                            <br>
                            <div class="col-md-6">
                            <center><a href="student_view_result.php" class="stubtn"><span>View Results</span></a></center>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
            <div class="card-half p-0 shadow p-3 mb-3">
            <div class="row">
                        <div class="col-sm-6">
                            <p class="fs-3 main-color mx-auto" style="text-align: center; font-family:Poppins;">
                                Upcoming Exams
                            </p>
                        </div>
                    </div>
                <center>
                    <a href="student_exam_list.php" style="text-decoration:none; height:80%">
                    <?php 
                        if ($examrow === 0) {
                            echo '<div class=" p-4 ">
                                    No upcoming exams available.
                                </div>';                   
                        }
                    
                        while ($examrow = mysqli_fetch_array($examquery)){

                            $start =  $examrow['ExamStartDateTime'];
                            $end = $examrow['ExamEndDateTime'];
                            
                            $diffre = timeDiff($start, $end);
                            $value = durationformater($diffre);
                            echo '<div class="main-bg-color p-3 m-0 text-white shadow" style="border-radius:15px;">
                            <table style="width:100%;height:80%;">
                            <tr>
                                <th>Name</th>
                                <td>: '.$examrow["ExamName"].'</td>
                            </tr>
                            
                            <tr>
                                <th>Start Time</th>
                                <td>: '.$examrow["ExamStartDateTime"].'</td>
                            </tr>
                            <tr>
                                <th>End Time</th>
                                <td>: '.$examrow["ExamEndDateTime"].'</td>
                            </tr>
                            <tr>
                                <th>Duration</th> 
                                <td>: '.$value.'</td>
                            </tr>
                            </table>    
                            </div>
                                ';
                        }
                    ?>
                    </a></center>
                    <br>
                    <div class="row">
                            <center><a href="student_exam_list.php" style="text-decoration:none;"><button class="stubtn">View all</button></a></center>
                        </div>
                </div>
    </div >
                
        </div>
        <div class="d-flex flex-row justify-content-between mx-auto mb-5" style="width:90%;">
            <div class="profilecontainer p-4 shadow p-3 mb-5" style="width:100%;">
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
                        Your Exam Performance<br><span>'.round($averagemark,2).'%</span></p>';

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
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
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
                    else{echo(round($averagemark,2));}?>%;">
                    </div>
                </div>
                </a>

                    

        </div>
        </div>
        
    </div>
    <?php require "common/footer_student.php";?>
</body>
</html>