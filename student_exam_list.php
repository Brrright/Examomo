<?php
require "common/conn.php";
if (!isset($_SESSION["userID"])) {
    echo '<script>alert("Please login before you access this page.");
    window.location.href="guest_home_page.php";</script>';
}

$req = "SELECT * FROM ((module INNER JOIN student ON module.CompanyID = student.CompanyID) INNER JOIN exam ON module.ModuleID = exam.ModuleID) WHERE StudentID =".$_SESSION['userID']."";
$fetched = mysqli_query($con,$req);

?>

<script>
    $(document).ready(funtion(){
        $('button').click(funtion(){

            $.ajax({url: "studentselectexam.php", 
            method:"post",
            success: function(result){
            $("#div1").html(result);
            }});

            $('#staticBackdrop').show();
        })

    })
</script>

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


<title>Student Exam List</title>

</head>

<body>
    <?php
        require "common/header_student.php"
    ?>

<div class="card-body">Exam List
</div>
    <table class="table table-hover mx-auto align-middle " style="width:95%" id="table-app">
        <thead>
            <tr>
                <th>Exam ID</th>
                <th>Exam Name</th>
                <th>Exam Start Time</th>
                <th>Exam End Time</th>
                <th>Status</th>
 
            </tr>
        </thead>

        <tbody id="table-body">
            <?php 
            // if (!$fetched) {
            //     printf("Error: %s\n", mysqli_error($con));
            //     exit();
            // }else{
            //    while($row = mysqli_fetch_array($fetched)){
                
            //    }
            // }


            while ($data = mysqli_fetch_array($fetched)) {
                if ($data["isPublished"] == 0 ){
                $row = '<tr>
                            <td>'.$data["ExamID"].'</td>
                            <td>'.$data["ExamName"].'</td>
                            <td>'.$data["ExamStartDateTime"].'</td>
                            <td>'.$data["ExamEndDateTime"].'</td>
                            <td><button type="button"  id='.$data["ExamID"].' class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Ongoing
                          </button></td>
                        
                        </tr>';
                echo $row;
                }elseif($data["isPublished"] == 1){
                    $row = '<tr>
                    <td>'.$data["ExamID"].'</td>
                    <td>'.$data["ExamName"].'</td>
                    <td>'.$data["ExamStartDateTime"].'</td>
                    <td>'.$data["ExamEndDateTime"].'</td>
                    <td><button type="button"  id='.$data["ExamID"].' class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Completed
                          </button></td>
                
                </tr>';
                echo $row;
                }
            }
            ?>
        </tbody>
    </table>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Exam Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Take Exam</button>
      </div>
    </div>
  </div>
</div>

<?php require "common/footer_student.php"?>
</body>

</html>
