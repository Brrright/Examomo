<?php
  require "common/conn.php";
     // identify if user logged in
     if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }
  $fetched = mysqli_query($con, "SELECT * FROM exam INNER JOIN exam_paper ON exam.PaperID = exam_paper.PaperID WHERE exam.CompanyID = ".$_SESSION['companyID']." AND exam.LecturerID = ".$_SESSION['userID']." AND exam.ExamEndDateTime < curtime() ORDER BY exam.ExamEndDateTime DESC");
  $numOfRow = mysqli_num_rows($fetched);

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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
        require "common/HeadImportInfo.php" 
    ?>

    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/bryanCSS.css">
    <link rel="stylesheet" href="css/commonCSS.css"> 

    <title>Lecturer Completed Exam List</title>

  </head>
  <body>
  <?php require "common/header_lecturer.php"?>
  <div style="min-height: 80vh">

  <center><h1 style="font-family: 'Caveat';">Completed Exam</h1></center>
  <div class="profilecontainer my-4 shadow p-3 mb-5">
    <div class="d-flex flex-row justify-content-between mx-auto m-0">
        <div class="input-icons">
        <i class="bi bi-search icon"></i>
        <input class="input-field" type="text" placeholder="Search By Name" aria-label="Search" name="exam_name"  id="search-text">        
        </div>
        </div>
    </div>
        <div class="profilecontainer my-4 shadow p-3 mb-5">
          <table class="table table-hover table-striped mx-auto align-middle" style="width:95%;" id="table-app">
                      <caption>List of Completed Exams : <?php echo $numOfRow;?> in Total (all record)</caption>
                      <thead>
                          <tr>
                              <th>Exam Type</th>
                              <th>Exam Name</th>
                              <th>Exam Dates</th>
                              <th>Exam Duration</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody id="table-body">
                      <?php
                      if ($numOfRow === 0) {
                        echo '<tr>
                            <td colspan="7" align="center">No data Found</td>
                        </tr>';
                        return;
                    }
                    while ($data = mysqli_fetch_array($fetched)) {
                        $start =  $data['ExamStartDateTime'];
                        $end = $data['ExamEndDateTime'];
          
                        $difference = timeDiff($start, $end);
                        $value = durationformater($difference);
                        $row = '<tr>
                                <td>'.$data["PaperType"].'</td>
                                <td>'.$data["ExamName"].'</td>
                                <td>Start : '.$data["ExamStartDateTime"].'<br>End   : '.$data["ExamEndDateTime"].'</td>
                                <td>'.$value.'</td>
                                <td> <a href="lecturer_completed_student_list.php?id='.$data["ExamID"].'"><button class="btn stubtn">View</button></a></td>
                              </tr>';
                            echo $row;
                    }
                        ?>
                        </tbody>
          </table>
        </div>
</div>


<?php include "./common/footer_lecturer.php" ?>
<script src="js/mingliangJS.js"></script>
    <script>
        const input = document.getElementById('search-text')
        input.addEventListener('keyup', function(event) {
            var key = document.getElementById('search-text').value;
            updateTable("lecturer_completed_exam_list_backend.php?exam_name=" + key,  'table-body')
        })

    </script>
</body>
</html>