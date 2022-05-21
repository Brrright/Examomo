<?php

  require "common/conn.php";
  if (!isset($_SESSION["userID"])) {
    echo '<script>alert("Please login before you access this page.");
    window.location.href="guest_home_page.php";</script>';
  }

  if ($_SESSION["userRole"] != "lecturer") {
    echo '<script>alert("You have not access to this page.");
    window.location.href="guest_home_page.php";</script>';
  }
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Lecturer Home Page</title>

  </head>
  <body>

  <!-- header -->
  <?php require "common/header_lecturer.php"?>

  <!-- welcome message -->
  <div class = "welcomemessage">
    <!-- identify lecturer gender and name -->
    <?php
      $sql = "SELECT LecturerName, LecturerGender FROM lecturer WHERE LecturerID = '".$_SESSION["userID"]."'";          
      $result = mysqli_query($con, $sql);

      while($row = mysqli_fetch_array($result)) {
        if ($row["LecturerGender"] == "male") {
          echo "<br>"."Welcome, Mr. ";
          echo $row['LecturerName']."."."<br>"."<br>";
        }
        else {
          echo "<br>"."Welcome, Mrs. ";
          echo $row['LecturerName']."."."<br>"."<br>";
        }
      }
    ?>
  </div>

  <!-- Main function carousel -->
  <section class="carousel-section">
    <div class="container carousel">
      <div id="carouselIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
  
          <!-- Exam slide -->
          <div class="carousel-item active" data-interval="8000ms">
            <div class="overlay-image" style="background-image:url(img/lecturer/exam.jpg);"></div>
            <div class="container-carousel">
            <h2>Examinations</h2>
            <p>Create and Organize your Examinations in Examomo</p>
            <a href ="lecturer_exam_page.php" class="btn btn-lg btn-primary">
              Manage Exams
            </a>
            </div>
          </div>
  
          <!-- Exam Paper slide -->
          <div class="carousel-item" data-interval="8000ms">
            <div class="overlay-image" style="background-image:url(img/lecturer/exampaper.jpg);"></div>
            <div class="container-carousel">
            <h2>Exam Papers</h2>
            <p>Create and Manage your Exam Papers in Multiple Choice or Structured Format</p>
            <a href ="lecturer_exampaper_page.php" class="btn btn-lg btn-primary">
              Manage Exam papers
            </a>
            </div>
          </div>
  
          <!-- Completed exam slide -->
          <div class="carousel-item" data-interval="8000ms">
            <div class="overlay-image" style="background-image:url(img/lecturer/completedexam.jpg);"></div>
            <div class="container-carousel">
              <h2>Completed Exams</h2>
              <p>Manage your Completed Exams and Review Students' Exam Papers here</p>
              <a href ="#" class="btn btn-lg btn-primary">
                Check Completed Exams
              </a>
              </div>
          </div>
        </div>
  
        <!-- navigation arrows -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <br>
    </div>
    </section>
    <br>

    <!-- Exam function card -->
    <section>
    <center><h2 style="font-family: 'Caveat'; font-weight: bold; color: #2B5EA4;">Your Most Recent</h2></center> 
    <br>
    <div class= "d-flex flex-wrap justify-content-around" style="min-height: 20rem;"> 
      <!-- Exam card -->
      <div class= "col-sm-6" style= "width: 25rem; margin-bottom: 40px;">
        <div class="card-lecturerhp">
          <div class="card-body-lecturerhp">
            <h3 class="card-title-lecturerhp"><i class="bi bi-calendar3-event"></i> Published Exam</h3>
            <p class="card-text-lecturerhp" style="color: #2B5EA4;">
              
              <!-- retrieve exam details based on lecturer id -->
              <?php
                $sql = "SELECT ExamName, ExamStartDateTime, ExamEndDateTime, ExamDescription FROM exam WHERE LecturerID = '".$_SESSION["userID"]."' AND isPublished LIKE 1 ORDER BY ExamID DESC LIMIT 1";   
                $result = mysqli_query($con, $sql);
  
                while ($row = mysqli_fetch_array($result)) {
  
                  echo "<br>"."Exam Name: ";
                  echo $row['ExamName']."<br>"."<br>";
  
                  echo "Start Date & Time: ";
                  echo $row['ExamStartDateTime']."<br>"."<br>";
  
                  echo "End Date & Time: ";
                  echo $row['ExamEndDateTime']."<br>"."<br>";
  
                  echo "Description: ";
                  echo $row['ExamDescription']."<br>"."<br>";
                  
              }
                
              ?>
            </p>
            <div style="text-align: center;">
              <a href="lecturer_exam_page.php" class="btn btn-primary">View All Exams</a>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Drafted exam card -->
      <div class= "col-sm-6" style= "width: 25rem; margin-bottom: 40px;">
        <div class="card-lecturerhp">
          <div class="card-body-lecturerhp">
            <h3 class="card-title-lecturerhp"><i class="bi bi-file-earmark"></i> Drafted Exam</h3>
            <p class="card-text-lecturerhp" style="color: #2B5EA4;">
            <?php
                $sql = "SELECT ExamName, ExamStartDateTime, ExamEndDateTime, ExamDescription FROM exam WHERE LecturerID = '".$_SESSION["userID"]."' AND isPublished LIKE 0 ORDER BY ExamID DESC LIMIT 1";   
                $result = mysqli_query($con, $sql);
  
                while ($row = mysqli_fetch_array($result)) {
  
                  echo "<br>"."Exam Name: ";
                  echo $row['ExamName']."<br>"."<br>";
  
                  echo "Start Date & Time: ";
                  echo $row['ExamStartDateTime']."<br>"."<br>";

                  echo "End Date & Time: ";
                  echo $row['ExamEndDateTime']."<br>"."<br>";
  
                  echo "Description: ";
                  echo $row['ExamDescription']."<br>"."<br>";
                  
              }
                
              ?>
            </p>
            <div style="text-align: center;">
              <a href="lecturer_exam_page.php" class="btn btn-primary cardbtn" >View All Exams</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Completed exam card -->
      <div class= "col-sm-6" style= "width: 25rem; margin-bottom: 40px;">
        <div class="card-lecturerhp">
          <div class="card-body-lecturerhp">
            <h3 class="card-title-lecturerhp"><i class="bi bi-check2-square"></i> Completed Exam</h3>
            <p class="card-text-lecturerhp" style="color: #2B5EA4;">
            <?php
                // get current datetime
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $date_clicked = date('Y-m-d H:i:s');
                $sql = "SELECT * FROM exam WHERE ExamEndDateTime <= '$date_clicked' AND LecturerID = '".$_SESSION["userID"]."' AND isPublished LIKE 1 ORDER BY ExamID DESC LIMIT 1";  
                $result = mysqli_query($con, $sql);
  
                while ($row = mysqli_fetch_array($result)) {

                  echo "<br>"."Exam Name: ";
                  echo $row['ExamName']."<br>"."<br>";
  
                  echo "Exam started at: ";
                  echo $row['ExamStartDateTime']."<br>"."<br>";
  
                  echo "Exam ended at: ";
                  echo $row['ExamEndDateTime']."<br>"."<br>";
                  
                }
                
                ?>
            </p>
            <div style="text-align: center;">
              <a href="#" class="btn btn-primary" id ="cardbutton">View All Completed Exams</a>
            </div>
          </div>
        </div>
      </div>

            <!-- Exam paper card -->
            <div class= "col-sm-6" style= "width: 25rem; margin-bottom: 40px;">
        <div class="card-lecturerhp">
          <div class="card-body-lecturerhp">
            <h3 class="card-title-lecturerhp"><i class="bi bi-list-ul"></i> Exam Paper</h3>
            <p class="card-text-lecturerhp" style="color: #2B5EA4;">
            <?php
                $sql = "SELECT exam_paper.PaperName, exam_paper.DateCreated, module.ModuleName, exam_paper.PaperType FROM exam_paper INNER JOIN module ON exam_paper.ModuleID = module.ModuleID WHERE exam_paper.LecturerID = '".$_SESSION["userID"]."' ORDER BY exam_paper.DateCreated DESC LIMIT 1";  
                $result = mysqli_query($con, $sql);
  
                while ($row = mysqli_fetch_array($result)) {

                  echo "<br>"."Paper Name: ";
                  echo $row['PaperName']."<br>"."<br>";
  
                  echo "Creation Date: ";
                  echo $row['DateCreated']."<br>"."<br>";
  
                  echo "Module Name: ";
                  echo $row['ModuleName']."<br>"."<br>";
                  
                  echo "Type: ";
                  echo $row['PaperType']."<br>"."<br>";
                  
                }
                
                ?>
            </p>
            <div style="text-align: center;">
              <a href="lecturer_exampaper_page.php" class="btn btn-primary" id ="cardbutton">View All Exam Papers</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <br><br>

    


<!-- footer -->
<?php include "./common/footer_lecturer.php" ?>
</body>
    
</html>