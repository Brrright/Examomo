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
  $fetched = mysqli_query($con, "SELECT * FROM exam WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerID = ".$_SESSION['userID']." AND ExamEndDateTime > curtime()");
  $numOfRow = mysqli_num_rows($fetched);
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
          <table class="table table-hover mx-auto align-middle" style="width:95%" id="table-app">
                      <caption>List of Completed Exams : <?php echo $numOfRow;?> in Total (all record)</caption>
                      <thead>
                          <tr>
                              <th>Exam Name</th>
                              <th>Exam Duration</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody id="table-body">
                      <?php
                      if ($numOfRow === 0) {
                        echo '<tr>
                            <td colspan="3" align="center">No data Found</td>
                        </tr>';
                        return;
                        }
                        while ($data = mysqli_fetch_array($fetched)) {
                        $row = '<tr>
                                  <td>'.$data["ExamName"].'</td>
                                  <td>Start : '.$data["ExamStartDateTime"].'<br>End   : '.$data["ExamEndDateTime"].'</td>
                                  <td> <a href="lecturer_completed_student_list.php?id='.$data["ExamID"].'"><button class="btn stubtn">View</button></a></td>
                                </tr>';
                              echo $row;
                        }
                        ?>
                        </tbody>
          </table>
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