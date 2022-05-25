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

$req = "SELECT * FROM ((module INNER JOIN student ON module.CompanyID = student.CompanyID) INNER JOIN exam ON module.ModuleID = exam.ModuleID) WHERE StudentID =".$_SESSION['userID']."";
$fetched = mysqli_query($con,$req);
$numOfRow = mysqli_num_rows($fetched);

date_default_timezone_set('Asia/Kuala_Lumpur');
$date_now = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html>

<head>
    <?php
        require "common/HeadImportInfo.php"
    ?>

    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/commonCSS.css">

<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Bootstrap CSS -->


<title>Student Exam List</title>

</head>

<body>
    <?php require "common/header_student.php"?>
    <center><h1 style="font-family: 'Caveat';">Exam List</h1></center>
    <div class="profilecontainer my-4 shadow p-3 mb-5">
      <div class="d-flex flex-row justify-content-between mx-auto m-0">
        <div class="input-icons">
          <i class="bi bi-search icon"></i>
          <input class="input-field" type="text" placeholder="Search By Name" aria-label="Search" name="exam_name"  id="search-text">        
        </div>
      </div>
    </div>
    <div class="profilecontainer my-4 shadow p-3 mb-5">
      <table class="table table-hover mx-auto align-middle " style="width:95%" id="table-app">
        <caption>List of Exams : <?php echo $numOfRow;?> in Total (all record)</caption>
          <thead>
              <tr>
                  <th>Exam Name</th>
                  <th>Exam Start Time</th>
                  <th>Exam End Time</th>
                  <th>Status</th>
              </tr>
          </thead>

        <tbody id="table-body">
            <?php 
            if ($numOfRow === 0) {
              echo '<tr>
                  <td colspan="4" align="center">No data Found</td>
              </tr>';
              return;
            }
            while ($data = mysqli_fetch_array($fetched)) {
              $examid = $data['ExamID'];
                if ($data["ExamEndDateTime"] < $date_now ){
                $row = '<tr>
                            <td>'.$data["ExamName"].'</td>
                            <td>'.$data["ExamStartDateTime"].'</td>
                            <td>'.$data["ExamEndDateTime"].'</td>
                            <td><button type="button"  id='.$data["ExamID"].' class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Completed
                          </button></td>
                        
                        </tr>';
                echo $row;
                }elseif($data["ExamStartDateTime"] > $date_now){
                    $row = '<tr>
                    <td>'.$data["ExamName"].'</td>
                    <td>'.$data["ExamStartDateTime"].'</td>
                    <td>'.$data["ExamEndDateTime"].'</td>
                    <td><button type="button"  id='.$data["ExamID"].' class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Not Started
                          </button></td>
                
                </tr>';
                echo $row;
                }else{
                  $row = '<tr>
                    <td>'.$data["ExamName"].'</td>
                    <td>'.$data["ExamStartDateTime"].'</td>
                    <td>'.$data["ExamEndDateTime"].'</td>
                    <td><button type="button"  id='.$data["ExamID"].' class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Ongoing
                          </button></td>
                
                </tr>';
                echo $row;
                }
            }
            ?>
        </tbody>
      </table>
    </div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Exam Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body" action = "student_examdetails_onload.php">
      <form method="get">
        <?php

        $fetch = "SELECT * FROM ((exam INNER JOIN lecturer ON exam.LecturerID = lecturer.LecturerID) INNER JOIN exam_paper ON exam.PaperID = exam_paper.PaperID) WHERE ExamID =$examid";
        $modaldetails = mysqli_query($con, $fetch);


        while ($details = mysqli_fetch_array($modaldetails)) {
        $modal = '  <p class="fw-bold m-2">
                      Exam Name : '.$details["ExamName"].'
                    </p>
                    <p class="fw-bold m-2">
                      Exam Description : '.$details["ExamDescription"].'
                    </p>
                    <p class="fw-bold m-2">
                      Exam Starts at : '.$details["ExamStartDateTime"].'
                    </p>
                    <p class="fw-bold m-2">
                      Exam Ends at : '.$details["ExamEndDateTime"].'
                    </p>
                    <p class="fw-bold m-2">
                      Lecturer Name : '.$details["LecturerName"].'
                    </p>
                    <p class="fw-bold m-2">
                      Paper Type : '.$details["PaperType"].'
                    </p>';
                  
                    echo $modal;
        }
        ?>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary main-bg-color">Take Exam</button>
    </div>
    </div>
  </div>
</div>

<?php require "common/footer_student.php"?>
<script src="js/mingliangJS.js"></script>
    <script>
        const input = document.getElementById('search-text')
        input.addEventListener('keyup', function(event) {
            var key = document.getElementById('search-text').value;
            updateTable("student_exam_list_backend.php?exam_name=" + key,  'table-body')
        })

    </script>
</body>

</html>
