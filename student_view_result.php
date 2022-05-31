<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "student") {
        echo '<script>alert("You have not access to this page.");
        window.location.href="logout.php";</script>';
      }

      // get current datetime
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_clicked = date('Y-m-d H:i:s');

    // sql for exam details
    $fetchexam ="SELECT exam.ExamName, exam.ExamEndDateTime, exam.ExamEndDateTime FROM student
                INNER JOIN exam_class ON student.ClassID = exam_class.ClassID
                INNER JOIN exam ON exam_class.ExamID = exam.ExamID
                WHERE student.StudentID = ".$_SESSION["userID"]." AND ExamEndDateTime <= '$date_clicked' AND isPublished LIKE 1 ORDER BY ExamEndDateTime DESC LIMIT 2";
    $examquery = mysqli_query($con, $fetchexam);
    $examrow = mysqli_num_rows($examquery);

    $req = "SELECT * FROM student 
            -- INNER JOIN class ON student.ClassID = class.ClassID
            INNER JOIN result ON student.StudentID = result.StudentID
            INNER JOIN exam ON exam.ExamID = result.ExamID
            -- INNER JOIN question_multiple_choice ON question_multiple_choice.PaperID = result.PaperID
            -- INNER JOIN question_structure ON question_structure.PaperID = result.PaperID
            WHERE student.StudentID = ".$_SESSION['userID']." AND ExamEndDateTime <= '$date_clicked'";

    $resultfetched = mysqli_query($con,$req);
    $resultnumber = mysqli_num_rows($resultfetched);

    if ($resultnumber === 0) {
        echo 0;
    }
    else{
        while ($resultrow = mysqli_fetch_array($resultfetched)){
            $totalmark = $resultrow['TotalMark'];
            
            $marks[] = $totalmark;
        }
        
        $averagemark = array_sum($marks)/$resultnumber;
            
        $piemark = $averagemark*1.8;}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "common/HeadImportInfo.php"
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/calwynCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css">
    <title>View Results</title>

<style>
.circle-wrap .circle .mask.full,
.circle-wrap .circle .fill {
  animation: fill ease-in-out 3s;
  transform: rotate(<?php echo $piemark?>deg);
}

    @keyframes fill {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(<?php echo $piemark?>deg);
  }
}
</style>
</head>
<body>
    <?php require "common/header_student.php";?>
    <section>
    <div class="container">
    <div class="profilecontainer my-4 shadow p-2 mb-5">
        <div class="container" style="border-radius:15px;">
            <?php 
                $req2 = "SELECT StudentName FROM student 
                WHERE StudentID = ".$_SESSION['userID']."";

                $resultfetched2 = mysqli_query($con,$req2);
                $resultnumber = mysqli_num_rows($resultfetched2);
                $resultrow = mysqli_fetch_array($resultfetched2);
                
                $test = '<center>
                            <p class="fs-3 main-color m-0 " style="font-family:Poppins;">'.$resultrow["StudentName"].' - Results Page</p>
                        </center>';
                echo $test; 
            ?>
        </div>
    </div>
    </div>
    </section>
    <div class="container" style="width:85%; height:80%;">
        <div class="row">
            <div class="col-xl-6 mx-auto  mb-5">
                <div class="card p-3 shadow p-3" style="height:100%; overflow: scroll;">
                    <center><p class="fs-3 main-color m-0" style="font-family:Poppins;">Exam Results</p></center>
                <?php
                    $fetching = "SELECT * FROM result INNER JOIN exam ON result.ExamID =  exam.ExamID WHERE result.StudentID = ".$_SESSION['userID']." AND ExamEndDateTime <= '$date_clicked'";
                    $resultquery = mysqli_query($con, $fetching);
                    $resultnumber2 = mysqli_num_rows($resultquery);
                    if ($resultnumber2 === 0) {
                        echo '<center><p class="fs-5 m-0" style="font-family:Poppins; color:black;">No Results Found...</p></center>';
                    }
                        while ($result = mysqli_fetch_array($resultquery)){
                            $resultlist = '<div class="profilecontainer m-1 p-1" style="background-color:#2B5EA4;">
                            <span class="fs-4 m-1" style="font-family:Poppins;color:white;">'.$result["ExamName"].'</span><span class="profilecontainer main-color p-1 m-0 fs-4" style="font-family:Poppins;float:right;">'.$result["TotalMark"].'%</span>
                            </div>';
                            echo $resultlist;
                        }
                    ?>        
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card p-3 shadow p-3 mb-0" style="width:100%; border-radius:15px;height:100%; overflow:hidden;">
                    <center><p class="fs-3 main-color m-0" style="font-family:Poppins;">Average Performance</p></center>
                        <div class="colorpanel" style="border-radius:15px;height:100%;max-height:100%; overflow:hidden;">
                            <div class="area">
                                <div class="pie">
                                    <div class="circle-wrap my-auto">
                                        <div class="circle">
                                            <div class="mask full">
                                                <div class="fill"></div>
                                            </div>
                                            <div class="mask half">
                                                <div class="fill"></div>
                                            </div>
                                            <div class="inside-circle">
                                                <span class="count" style="font-family:Poppins;">
                                                <?php echo(round($averagemark,2));?>%
                                                </span>
                                            </div>

                                        </div>       
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <svg class="waves mb-0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
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
                </div>
            </div>
        </div>
    </div>
        
<?php require "common/footer_student.php";?>
</body>
</html>