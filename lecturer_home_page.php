<?php
    require "common/conn.php";
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <link rel="stylesheet" href="css/lecturer_hp_css.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <title>Lecturer Home Page</title>

  </head>
  <body>

    <!-- header -->
    <?php require "common/header_lecturer.php"?>

  <!-- welcome message -->
  <div class = "welcomemessage">
    <!-- identify lecturer gender and name -->
    <?php
      include ('common/conn.php');
      $sql = "SELECT LecturerName, LecturerGender FROM lecturer WHERE LecturerID = '123'";          
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

  <!-- Exam function card -->

  <h5 style = "text-decoration: underline;">Most Recent: <br><br></h5>
  <div class= "d-flex flex-wrap justify-content-around"> 
    <!-- Exam card -->
    <div class= "col-sm-6" style= "width: 25rem; height: 20rem; min-height: 30rem;">
      <div class="card-lecturerhp">
        <div class="card-body-lecturerhp">
          <h3 class="card-title-lecturerhp"><i class="bi bi-calendar3-event"></i> Exam</h3>
          <p class="card-text-lecturerhp">
            
            <!-- retrieve exam details based on lecturer id -->
            <?php
              include ('common/conn.php');
              $sql = "SELECT examModule, ExamStartDateTime, ExamDescription FROM exam WHERE LecturerID = '123' AND isPublished LIKE 1 ORDER BY ExamID DESC LIMIT 1";   
              $result = mysqli_query($con, $sql);

              while ($row = mysqli_fetch_array($result)) {

                echo "<br>"."Module: ";
                echo $row['examModule']."<br>"."<br>";

                echo "Start Date & Time: ";
                echo $row['ExamStartDateTime']."<br>"."<br>";

                echo "Description: ";
                echo $row['ExamDescription']."<br>"."<br>";
                
            }
              
            ?>
          </p>
          <a href="#" class="btn btn-primary">View All Exams</a>
        </div>
      </div>
    </div>

    <!-- Exam paper card -->
    <div class= "col-sm-6" style= "width: 25rem; height: 20rem; min-height: 30rem;">
      <div class="card-lecturerhp">
        <div class="card-body-lecturerhp">
          <h3 class="card-title-lecturerhp"><i class="bi bi-list-ul"></i> Exam Paper</h3>
          <p class="card-text-lecturerhp">
          <?php
              include ('common/conn.php');
              $sql = "SELECT PaperName, DateCreated, PaperModule, PaperType FROM exam_paper WHERE LecturerID = '123' ORDER BY DateCreated DESC LIMIT 1";  
              // WHERE ExamStartDateTime IN (SELECT max(ExamStartDateTime) FROM exam) 
              $result = mysqli_query($con, $sql);
              // $num_row = mysqli_fetch_rows($result);

              while ($row = mysqli_fetch_array($result)) {
                // if ($num_row > 0) {
                echo "<br>"."Name: ";
                echo $row['PaperName']."<br>"."<br>";

                echo "Creation Date: ";
                echo $row['DateCreated']."<br>"."<br>";

                echo "Module: ";
                echo $row['PaperModule']."<br>"."<br>";
                
                echo "Type: ";
                echo $row['PaperType']."<br>"."<br>";

            }
              
            ?>
          </p>
          <a href="#" class="btn btn-primary" id ="cardbutton">View All Exam Papers</a>
        </div>
      </div>
    </div>

    <!-- Completed exam card -->
    <div class= "col-sm-6" style= "width: 25rem; height: 20rem; min-height: 30rem;">
      <div class="card-lecturerhp">
        <div class="card-body-lecturerhp">
          <h3 class="card-title-lecturerhp"><i class="bi bi-file-earmark"></i> Drafted Exam</h3>
          <p class="card-text-lecturerhp">
          <?php
              include ('common/conn.php');
              $sql = "SELECT examModule, ExamStartDateTime, ExamDescription, isPublished FROM exam WHERE LecturerID = '123' AND isPublished LIKE 0 ORDER BY ExamID DESC LIMIT 1";   
              $result = mysqli_query($con, $sql);

              while ($row = mysqli_fetch_array($result)) {

                echo "<br>"."Module: ";
                echo $row['examModule']."<br>"."<br>";

                echo "Start Date & Time: ";
                echo $row['ExamStartDateTime']."<br>"."<br>";

                echo "Description: ";
                echo $row['ExamDescription']."<br>"."<br>";
                
            }
              
            ?>
          </p>
          <a href="#" class="btn btn-primary">View All Exams</a>
        </div>
      </div>
    </div>

  </div>
  <br><br>

  <!-- Main function carousel -->
  <div id="carouselIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">

        <!-- Exam slide -->
        <div class="carousel-item active" data-interval="8000ms">
          <div class="overlay-image" style="background-image:url(./img/lecturer/exam.jpg);"></div>
          <div class="container-carousel">
          <h2>Examinations</h2>
          <p>Create and Organize your Examinations in Examomo</p>
          <a href ="#" class="btn btn-lg btn-primary">
            Manage Exams
          </a>
          </div>
        </div>

        <!-- Exam Paper slide -->
        <div class="carousel-item" data-interval="8000ms">
          <div class="overlay-image" style="background-image:url(./img/lecturer/exampaper.jpg);"></div>
          <div class="container-carousel">
          <h2>Exam Papers</h2>
          <p>Create and Manage your Exam Papers in Multiple Choice or Structured Format</p>
          <a href ="#" class="btn btn-lg btn-primary">
            Manage Exam papers
          </a>
          </div>
        </div>

        <!-- Completed exam slide -->
        <div class="carousel-item" data-interval="8000ms">
          <div class="overlay-image" style="background-image:url(./img/lecturer/completedexam.jpg);"></div>
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

    


<!-- footer -->
<?php include "./common/footer_lecturer.php" ?>
</body>
    
</html>