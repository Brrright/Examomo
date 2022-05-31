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

  // sql for exam name
  $examfetch = "SELECT ExamName FROM exam WHERE ExamID = ".$_GET['id']."";
  $examresult = mysqli_query($con, $examfetch);
  while ($exam = mysqli_fetch_array($examresult)){
      $examname = $exam['ExamName'];
  }


  // sql for student details who took exam
  $studentfetch= "SELECT student.StudentID, student.StudentName, student.StudentEmail, class.ClassName, class.ClassID, exam_paper.PaperID, exam_paper.PaperName, module.ModuleName
                  FROM exam 
                  INNER JOIN student ON student.CompanyID = exam.CompanyID
                  INNER JOIN exam_class ON exam_class.ExamID = exam.ExamID
                  INNER JOIN class ON class.ClassID = exam_class.ClassID
                  INNER JOIN exam_paper ON exam.PaperID = exam_paper.PaperID
                  INNER JOIN module ON exam.ModuleID = module.ModuleID
                  WHERE exam.LecturerID = ".$_SESSION['userID']." AND exam.ExamID = ".$_GET['id']." AND student.ClassID = exam_class.ClassID";

  $isfetched = mysqli_query($con, $studentfetch);
  $numOfRow = mysqli_num_rows($isfetched);

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

    <title><?php echo $examname ?> - Student List</title>

  </head>
  <body>
  <?php require "common/header_lecturer.php"?>
  <center><h1 style="font-family: 'Caveat';"><?php echo $examname ?> - Student List</h1></center>
  <div class="profilecontainer my-4 shadow p-3 mb-5">
    <div class="d-flex flex-row justify-content-between mx-auto m-0">
        <div class="input-icons">
        <i class="bi bi-search icon"></i>
        <input class="input-field" type="text" placeholder="Search By Name" aria-label="Search" name="exam_name"  id="search-text">        
        </div>
        </div>
    </div>
    <div class="profilecontainer my-4 shadow p-3 mb-5">
      <table class="table table-hover mx-auto  table-striped align-middle " style="width:95%" id="table-app">
        <caption>List of Students taking the exam : <?php echo $numOfRow;?> in Total (all record)</caption>
        <thead>
            <tr>
              <th>Student Name & Email</th>
              <th>Class</th>
              <th>Exam Paper</th>
              <th>Module</th>
              <th>Action</th>
            </tr>
        </thead>
        <tbody id="table-body">
          <?php
          if ($numOfRow === 0) {
            echo '<tr>
                <td colspan="7" align="center">No student take this exam</td>
            </tr>';
            return;
            }
            while ($data2 = mysqli_fetch_array($isfetched)) {
            $row = '<tr>
                      <td>'.$data2["StudentName"].' <br> '.$data2["StudentEmail"].'</td>
                      <td>'.$data2["ClassName"].'</td>
                      <td>'.$data2["PaperName"].'</td>
                      <td>'.$data2["ModuleName"].'</td>
                      <td> <a href="lecturer_marking_main.php?id='.$data2["PaperID"].'&stuid='.$data2['StudentID'].'&eid='.$_GET['id'].'" class="stubtn">View</a></td>
                    </tr>';
                  echo $row;
            }
            ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php require "common/footer_lecturer.php" ?>

<script src="js/mingliangJS.js"></script>
<script>
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const p_id = urlParams.get('id');
    const input = document.getElementById('search-text')
    input.addEventListener('keyup', function(event) {
        var key = document.getElementById('search-text').value;
        updateTable("lecturer_completed_student_list_backend.php?student_name=" + key + "&p_id="+p_id,  'table-body')
    })

</script>
</body>
</html>