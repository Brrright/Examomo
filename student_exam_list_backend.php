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
  if(isset($_GET['exam_name'])) {
    $exam_name = $_GET['exam_name'];
}
$req = "SELECT * FROM ((module INNER JOIN student ON module.CompanyID = student.CompanyID) INNER JOIN exam ON module.ModuleID = exam.ModuleID) WHERE StudentID =".$_SESSION['userID']." AND ExamName LIKE'%$exam_name%'";
$fetched = mysqli_query($con,$req);
$numOfRow = mysqli_num_rows($fetched);

date_default_timezone_set('Asia/Kuala_Lumpur');
$date_now = date('Y-m-d H:i:s');

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