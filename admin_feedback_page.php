<?php require
"common/conn.php";
// havent replied
$sentsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackDateTime, student.StudentName, student.StudentEmail 
FROM feedback INNER JOIN student ON feedback.StudentID = student.StudentID 
WHERE feedback.FeedbackStatus LIKE 0 AND feedback.CompanyID = ".$_SESSION["companyID"]." ORDER BY feedback.FeedbackDateTime DESC";
$sentresult = mysqli_query($con, $sentsql);
$numOfRow = mysqli_num_rows($sentresult);

$repliedsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackReply , feedback.FeedbackDateTime, feedback.RepliedDateTime , student.StudentName, student.StudentEmail, admin.AdminName
            FROM ((feedback INNER JOIN student ON feedback.StudentID = student.StudentID) INNER JOIN admin ON feedback.CompanyID = admin.CompanyID)
            WHERE feedback.FeedbackStatus LIKE 1 AND feedback.CompanyID = ".$_SESSION["companyID"]." AND admin.AdminID = ".$_SESSION["userID"]." ORDER BY feedback.RepliedDateTime DESC";

$repliedresult = mysqli_query($con, $repliedsql);
$numOfRow2 = mysqli_num_rows($repliedresult);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
        <title>Admin feedback</title>
    </head>
<body>      
  <?php require "common/header_student.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Reply Feedback</h1></center>
    <div class="container">
    <div class="row g-0">
            <div class="col-sm-3">
                <div class="enquirybox my-4 shadow p-3 mb-5">
                    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white py-1" style="width: 100%;max-height: 60vh;">
                        <div class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                        <span class="fs-5 fw-semibold">Enquiries</span> 
                        </div>
                            <div class="list-group list-group-flush border-bottom scrollarea">
                                <?php
                                    if ($numOfRow+$numOfRow2 === 0) {
                                        echo '<br><span class="text-center fw-light">No enquiries Found</span><br>';
                                    }

                                    //replied feedback will be displayed first
                                    while ($rfeedback = mysqli_fetch_array($repliedresult)) {
                                        $repliedEnquiryList = '<button class="list-group-item list-group-item-action py-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                        <small class="text-muted"> Replied at '.$rfeedback["RepliedDateTime"].'</small>
                                        </div>
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                                <strong class="mb-1">'.$rfeedback["StudentName"].'</strong>
                                        </div>
                                        <div class="col-10 mb-1 small text-nowrap" style="overflow: hidden;text-overflow: ellipsis;width: 90%;">'.$rfeedback["FeedbackReply"].'</div>
                                    </button>';
                                    echo $repliedEnquiryList;
                                    }

                                    // unreplied feedback will be display afterwards
                                    while($sfeedback = mysqli_fetch_array($sentresult)){
                                        $enquirylist = '<button href="#" class="list-group-item list-group-item-action py-3">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                        
                                        <strong class="mb-1">'.$sfeedback["StudentName"].'</strong>
                                        
                                        <small class="text-muted">'.$sfeedback["FeedbackDateTime"].'</small>
                                        </div>
                                        <div class="col-10 mb-1 small text-nowrap" style="overflow: hidden;text-overflow: ellipsis;width: 90%;">'.$sfeedback["FeedbackContent"].'</div>
                                    </button>';
                                    echo $enquirylist;
                                    }
                                ?>
                                </div>
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
            <div class="col-sm-9">  
                    <div class="enquirybox my-4 shadow p-3 mb-5">
                        <div class="chatbox">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/admin/students.png" alt="...">
                                </div>
                                <div class="col-10">
                                    <div> 
                                        <p>Student Name</p>
                                    </div>
                                    <br>
                                    <div>
                                        <p>Feedback here</p>
                                    </div>
                                    <div>
                                    <span class="time-right">11:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chatbox">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/admin/admin.png" alt="...">
                                </div>
                                <div class="col-10">
                                <form action="admin_feedback_insert_backend.php" method="POST">
                                    <input type="text" class="form-control shadow-sm" id="adm-floatingInput" name="fb_content" placeholder="Enter feedback here...">
                                        <br>
                                    <div class= "d-flex flex-wrap justify-content-around">
                                    <button type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>