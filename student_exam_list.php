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

$req = "SELECT * FROM (((module 
INNER JOIN student ON module.CompanyID = student.CompanyID) 
INNER JOIN exam ON module.ModuleID = exam.ModuleID)
INNER JOIN exam_paper ON exam.PaperID = exam_paper.PaperID) 
WHERE StudentID =".$_SESSION['userID']." AND exam.isPublished = 1 ORDER BY exam.ExamEndDateTime DESC";
$fetched = mysqli_query($con,$req);
$numOfRow = mysqli_num_rows($fetched);

date_default_timezone_set('Asia/Kuala_Lumpur');
$date_now = date('Y-m-d H:i:s');
// echo $date_now;

function timeDiff($firstTime,$lastTime){
  // convert to unix timestamps
  $firstTime=strtotime($firstTime);
  $lastTime=strtotime($lastTime);

  // perform subtraction to get the difference (in seconds) between times
  $timeDiff=$lastTime-$firstTime;
  // echo $timeDiff;

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
<html>

<head>
    <?php
        require "common/HeadImportInfo.php"
    ?>

    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/commonCSS.css">

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
                  <th>Duration</th>
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
                    <td><button type="button"  id='.$data["ExamID"].' class="btn btn-secondary" onclick="toogleModal('.$data["ExamID"].', '.$data["PaperID"].', \''.$data["PaperType"].'\', false)" >
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
                    <td><button type="button"  id='.$data["ExamID"].' class="btn btn-warning" onclick="toogleModal('.$data["ExamID"].', '.$data["PaperID"].', \''.$data["PaperType"].'\', true)" >
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

<?php require "common/footer_student.php"?>
<script src="js/mingliangJS.js"></script>
    <script>
      function toogleModal(eid, pid, type, allow) {
        fetch("student_exam_list_details.php?id="+eid)
        .then(response => response.text())
        .then(function(response) {
                if(!response.error) {
                  if(allow == false) {
                    Swal.fire({
                      confirmButtonText: 'Back',
                      html: response,
                      width: 600,
                      padding: '3em',
                      background: '#fff url()',
                      backdrop: `
                        rgba(0,0,123,0.4)
                        url("img/PYh.gif")
                        left top
                        no-repeat
                      `,
                      imageUrl: 'img/logo_big_no_text',
                      imageWidth: 200,
                      imageHeight: 180,
                      imageAlt: 'Custom image',
                      title: '(Not able to take the exam now) Exam details (' + type + ')',
                      showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                      hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      }
                    })
                  }
                  else {
                    Swal.fire({
                    showCancelButton: true,
                    confirmButtonText: 'Take Exam',
                    cancelButtonText: 'Cancel',
                    html: response,
                    width: 600,
                    padding: '3em',
                    background: '#fff url()',
                    backdrop: `
                      rgba(0,0,0,0.4)
                      url("img/5Q0v.gif")
                      left bottom
                      no-repeat
                    `,
                    imageUrl: 'img/logo_big_no_text',
                    imageWidth: 200,
                    imageHeight: 180,
                    imageAlt: 'Custom image',
                    title: 'Exam details (' + type + ')',
                    showClass: {
                      popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                      popup: 'animate__animated animate__fadeOutUp'
                    }
                  }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href="student_question_redirect.php?type="+type+"&id="+pid+"&eid="+eid;
                      } 
                  })
                }
              }
            })
      }

      const input = document.getElementById('search-text');
      input.addEventListener('keyup', function(event) {
          var key = document.getElementById('search-text').value;
          updateTable("student_exam_list_backend.php?exam_name=" + key,  'table-body')
      })


      

    </script>
</body>

</html>
