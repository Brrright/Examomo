<?php
require "common/conn.php"
?>


<!DOCTYPE html>
<html>

<head>
    <?php
        require "common/HeadImportInfo.php"
    ?>

    <link rel="stylesheet" href="css/StudentCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css">

<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Bootstrap CSS -->


<title>Student Homepage</title>

</head>

<body>
    <?php
        require "common/header_student.php"
    ?>

<div class="card m-2 p-1 card-style shadow fw-bold" style="width: 20vw; font-style: strong">
<?php
      include ('common/conn.php');
      $sql = "SELECT * FROM student WHERE StudentID = '1'";
      $result = mysqli_query($con, $sql);

      while($row = mysqli_fetch_array($result)) {
          echo "<br>"."Welcome, ";
          echo $row['StudentName']."."."<br>"."<br>";

      }
    ?>
</div>

  <!-- student details -->

<div class="d-flex flex-wrap justify-content-around" style="margin-top: 3rem; margin-bottom: 3rem;">
  
<div class="row-toppart gx-5">

    <div class="col-lg" alt="card-left" style="width: 50vw">
      <div class="col-6 mb-4">
          <div class="card shadow-0 rounded-3 mb-3" style="width: 40vw">
            <div class="row d-flex g-0">
              <div class="col-md responsive-img">
                <img
                  src="img/icon/person.png"
                  class="Profileicon"
                  style="width: 100px"
                />
              </div>
              <div class="col" >
                <div class="card px-1 pt-2"  style=" width: 40vw">
                  <h5 class="mb-3">Student Details</h5> 
                  <?php
                        include ('common/conn.php');
                        $sql = "SELECT * FROM student WHERE StudentID = '1'";
                        $result = mysqli_query($con, $sql);

                        while($row = mysqli_fetch_array($result)) {
                            echo "Student ID    :".$row['StudentID']."<br>";
                            echo "Student Name  :".$row['StudentName']."<br>";
                        }

                        include ('common/conn.php');
                        $sql = "SELECT * FROM class WHERE ClassID = '1'";
                        $result = mysqli_query($con, $sql);

                        while($row = mysqli_fetch_array($result)) {
                            echo "Class Name    :".$row['ClassName']."<br>";
                        }
                    ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg" alt="card-right" style="width: 50vw; margin-start: 20px">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Calender</h5>
                        <p class="card-text">
                            Sample Space
                        </p>
                    </div>  
            </div>
    </div>

</div>
</div>

<!-- This will be upcoming exams -->
<section class="section-full">
        <div class="shadow-lg rounded-3 bg-white-template d-flex flex-column mx-auto w-90 p-5">
        <h1 class="md" >Upcoming Exams</h1>
            <div class="d-flex flex-wrap justify-content-around mx-auto">
                <div class="card m-3 p-3 card-style shadow" style="width: 20vw">
                    <div class="card-body">
                        <p class= "card-text">
                        <?php
                            include ('common/conn.php');
                            $sql = "SELECT * FROM exam WHERE LecturerID = '1' AND isPublished LIKE 10 ORDER BY ExamStartDateTime";
                            $result = mysqli_query($con, $sql);

                            while($row = mysqli_fetch_array($result)) {
                                echo "exam      :".$row['ExamName']."<br>";
                                echo "Exam Time :".$row['ExamStartDateTime']." to ".$row['ExamEndDateTime']."<br>";
                            }
                        
                        ?>
                        </p>
                    </div>
                </div>
                <div class="card m-3 p-3 card-style shadow" style="width: 20vw">
                    <div class="card-body">
                        <p class= "card-text">
                        <?php
                            include ('common/conn.php');
                            $sql = "SELECT * FROM exam WHERE LecturerID = '1' AND isPublished LIKE 11 ORDER BY ExamStartDateTime";
                            $result = mysqli_query($con, $sql);

                            while($row = mysqli_fetch_array($result)) {
                                echo "exam      :".$row['ExamName']."<br>";
                                echo "Exam Time :".$row['ExamStartDateTime']." to ".$row['ExamEndDateTime']."<br>";
                            }
                        
                        ?>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <?php require "common/footer_student.php"?>

</body>
</html>