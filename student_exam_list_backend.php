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
$req = "SELECT * FROM (((module 
INNER JOIN student ON module.CompanyID = student.CompanyID) 
INNER JOIN exam ON module.ModuleID = exam.ModuleID)
INNER JOIN exam_paper ON exam.PaperID = exam_paper.PaperID) 
WHERE StudentID =".$_SESSION['userID']." AND ExamName LIKE'%$exam_name%' ORDER BY exam.ExamEndDateTime DESC";
$fetched = mysqli_query($con,$req);
$numOfRow = mysqli_num_rows($fetched);

date_default_timezone_set('Asia/Kuala_Lumpur');
$date_now = date('Y-m-d H:i:s');

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
   // echo "<p>Time Passed: " . $days . " Days, " . $hours . " Hours, " . $mins . " Minutes.</p>";
   
    if ($years > 1) {
      $disyears =  $years . " years";
    }elseif ($years == 1){
        $disyears =  $years . " year";
    }else{
        $disyears = "";
    }

    if ($days > 1) {
        $disdays =  $days . " days";
    }elseif ($days == 1){
        $disdays =  $days . " day";
    }else{
        $disdays = "";
    }


    if ($hours > 1) {
        $dishours =  $hours . " hours";
    }elseif ($hours == 1){
        $dishours =  $hours . " hour";
    }else{
        $dishours = "";
    }

    if ($mins > 1) {
        $dismins =  $mins . " minutes";
    }elseif ($mins == 1){
        $dismins =  $mins . " minute";
    }else{
        $dismins = "";
    }


    $formattedDuration = $disyears ." ". $disdays . " " . $dishours . " " . $dismins ;
    return $formattedDuration;

}

if ($numOfRow === 0) {
    echo '<tr>
        <td colspan="4" align="center">No data Found</td>
    </tr>';
    return;
  }
  while ($data = mysqli_fetch_array($fetched)) {
    $examid = $data['ExamID'];
    $start =  $data['ExamStartDateTime'];
    $end = $data['ExamEndDateTime'];

    $difference = timeDiff($start, $end);
    $value = durationformater($difference);  
      if ($data["ExamEndDateTime"] < $date_now ){
      $row = '<tr>
                  <td>'.$data["ExamName"].'</td>
                  <td>'.$start.'</td>
                  <td>'.$end.'</td>
                  <td>'.$value.'</td>
                  <td><button type="button"  id='.$data["ExamID"].' class="btn btn-success" onclick="toogleModal('.$data["ExamID"].','.$data["PaperID"].', \''.$data["PaperType"].'\' , false)" >
                  Completed
                  </button></td>
              
              </tr>';
      echo $row;
      }elseif($data["ExamStartDateTime"] > $date_now){
          $row = '<tr>
          <td>'.$data["ExamName"].'</td>
          <td>'.$start.'</td>
          <td>'.$end.'</td>
          <td>'.$value.'</td>
          <td><button type="button"  id='.$data["ExamID"].' class="btn btn-secondary" onclick="toogleModal('.$data["ExamID"].','.$data["PaperID"].', \''.$data["PaperType"].'\' , false)" >
          Not Started
          </button></td>

      </tr>';
      echo $row;
      }else{
        $row = '<tr>
          <td>'.$data["ExamName"].'</td>
          <td>'.$start.'</td>
          <td>'.$end.'</td>
          <td>'.$value.'</td>
          <td><button type="button"  id='.$data["ExamID"].' class="btn btn-warning" onclick="toogleModal('.$data["ExamID"].','.$data["PaperID"].', \''.$data["PaperType"].'\' , true)" >
          Ongoing
          </button></td>

      </tr>';
      echo $row;
      }
  }
  
  ?>
  