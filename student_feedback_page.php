<?php require
"common/conn.php";
$sentsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackDateTime, student.StudentName, student.StudentEmail 
FROM feedback INNER JOIN student ON feedback.StudentID = student.StudentID 
WHERE feedback.StudentID = ".$_SESSION["userID"]." AND feedback.CompanyID = ".$_SESSION["companyID"]." AND feedback.FeedbackStatus LIKE 0 ";

$sentresult = mysqli_query($con, $sentsql);
$numOfRow = mysqli_num_rows($sentresult);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    </head>
<body>      
  <?php require "common/header_admin.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Manage Feedback</h1></center>
    <div class="container">
        <div class="row g-0">
            <div class="col-sm-3">
                <div class="enquirybox my-4 shadow p-3 mb-5">
                    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white py-1" style="width: 100%;max-height: 60vh;">
                        <a class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                        <span class="fs-5 fw-semibold">Enquiries</span>
                        </a>
                            <div class="list-group list-group-flush border-bottom scrollarea">
                                <?php
                                    if ($numOfRow === 0) {
                                        echo '<span>No enquiries Found</span>';
                                        return;}
                                    
                                    while($sfeedback = mysqli_fetch_array($sentresult)){
                                    $enquirylist = 
                                    '<a href="#" class="list-group-item list-group-item-action py-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                        <strong class="mb-1">'.$sfeedback["StudentName"].'</strong>
                                        <small class="text-muted">'.$sfeedback["FeedbackDateTime"].'</small>
                                        </div>
                                        <div class="col-10 mb-1 small text-nowrap" style="overflow: hidden;text-overflow: ellipsis;width: 90%;">'.$sfeedback["FeedbackContent"].'</div>
                                    </a>';
                                    echo $enquirylist;
                                    }
                                ?>
                                <!-- unread feedback details
                                echo "$sfeedback[FeedbackID]";
                                echo "$sfeedback[FeedbackContent]";
                                echo "$sfeedback[FeedbackStatus]";
                                echo "$sfeedback[FeedbackDateTime]";

                                //Student details
                                echo "$sfeedback[StudentName]";
                                echo "$sfeedback[StudentEmail]";
                                echo "<br>";}

                                this is active class if needed

                                <a href="#" class="list-group-item list-group-item-action active py-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <strong class="mb-1">$sfeedback[FeedbackContent]</strong>
                                    <small>Wed</small>
                                </div>
                                <div class="col-10 mb-1 small">Some placeholder content in a paragraph below the heading and date.</div>
                                </a> -->
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">  
                    <div class="enquirybox my-4 shadow p-3 mb-5" style="height:90%">
                        <div class="chatbox">
                                <div class="row g-0">
                                    <img src="img/admin/students.png" alt="...">
                                    <p>Student Name</p>
                                </div>
                                <div class="row g-0">
                                    <p>Feedback here</p>
                                    <span class="time-right">11:00</span>
                                </div>
                        </div>
                        <form action="student_feedback_backend.php" method="POST">
                            <input type="text" class="form-control shadow-sm" id="adm-floatingInput" name="fb-content" placeholder="Enter feedback here...">
                            <br>
                            <div class= "d-flex flex-wrap justify-content-around">
                            <button type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</body>