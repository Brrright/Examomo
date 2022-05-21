<?php require
"common/conn.php";
// havent replied
$sentsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackDateTime, student.StudentName, student.StudentEmail 
            FROM feedback INNER JOIN student ON feedback.StudentID = student.StudentID 
            WHERE feedback.StudentID = ".$_SESSION["userID"]." AND feedback.CompanyID = ".$_SESSION["companyID"]." AND feedback.FeedbackStatus LIKE 0 ORDER BY feedback.FeedbackDateTime DESC";

$sentresult = mysqli_query($con, $sentsql);
$numOfRow = mysqli_num_rows($sentresult);

$repliedsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackReply , feedback.FeedbackDateTime, feedback.RepliedDateTime , student.StudentName, student.StudentEmail  
FROM feedback INNER JOIN student ON feedback.StudentID = student.StudentID 
WHERE feedback.StudentID = ".$_SESSION["userID"]." AND feedback.CompanyID = ".$_SESSION["companyID"]." AND feedback.FeedbackStatus LIKE 1 ORDER BY feedback.RepliedDateTime DESC";

$repliedresult = mysqli_query($con, $repliedsql);
$numOfRow2 = mysqli_num_rows($repliedresult);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
        <title>Student feedback</title>
    </head>
<body>      
  <?php require "common/header_student.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Write Feedback</h1></center>
    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" id="addFB" data-bs-toggle="dropdown" aria-expanded="false" style="display:block; margin-right: 15%; margin-left:auto;">Add New Feedback</button>
        <form class="dropdown-menu p-4 shadow p-3 mb-5" action="student_feedback_insert_backend.php" method="POST" aria-labelledby="addFB" style="width: 60%">
            <input type="text" class="form-control shadow-sm" id="adm-floatingInput" name="fb_content" placeholder="Enter feedback here...">
            <br>
            <div class= "d-flex flex-wrap justify-content-around">
            <button type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
            </div>
        </form>
    </div>
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
                                        echo '<br><span class="text-center fw-light ">No enquiries Found</span><br>';
                                    }
                                    echo '<p class="fw-bold text-center main-color mt-1">Replied</p>';

                                    //replied feedback will be displayed first
                                    while ($rfeedback = mysqli_fetch_array($repliedresult)) {
                                        $repliedEnquiryList = '<button class="list-group-item list-group-item-action py-3" id="list-id-'.$rfeedback["FeedbackID"].'" onclick="changeContent('.$rfeedback["FeedbackID"].')">
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                        <small class="text-muted"> Replied at '.$rfeedback["RepliedDateTime"].'</small>
                                        </div>
                                        <div class="d-flex w-100 align-items-center justify-content-between">
                                                <strong class="mb-1">Admin</strong>
                                        </div>
                                        <div class="col-10 mb-1 small text-nowrap" style="overflow: hidden;text-overflow: ellipsis;width: 90%;">'.$rfeedback["FeedbackReply"].'</div>
                                    </button>';
                                    echo $repliedEnquiryList;
                                    }

                                    echo '<p class="fw-bold text-center main-color mt-1">Sent (Haven\'t get replied)</p>';
                                    // unreplied feedback will be display afterwards
                                    while($sfeedback = mysqli_fetch_array($sentresult)){
                                        $enquirylist = '<button class="list-group-item list-group-item-action py-3" id="list-id-'.$sfeedback["FeedbackID"].'" onclick="changeContent('.$sfeedback["FeedbackID"].')">
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

                            
                    </div>
                </div>
            </div>
            <div class="col-sm-9">  
                <div class="enquirybox my-4 shadow p-3 mb-5" id="feedback-content">
                    <div class="chatbox">
                        <div class="row" id="student-feedback-content">
                            <div class="col-2">
                                <img src="img/admin/students.png" alt="...">
                            </div>
                            <div class="col-10">
                                <div style="width:80px;height:30px;" class="bg-light"> 
                                    
                                </div>
                                <br>
                                <div style="width:100%;height:40px;" class="bg-light">
                                    
                                </div>
                                <div>
                                <span class="time-right" >xx:xx</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chatbox">
                        <div class="row" id="admin-feedback-content">
                            <div class="col-2">
                                <img src="img/admin/admin.png" alt="...">
                            </div>
                            <div class="col-10">
                                <div style="width:80px;height:30px;" class="bg-light"> 
                                    
                                </div>
                                <br>
                                <div style="width:100%;height:40px;" class="bg-light">
                                    
                                </div>
                                <div>
                                <span class="time-right" >xx:xx</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "common/footer_student.php";?>
    <script src="js/mingliangJS.js"></script>
    <script>
        function changeContent(id) {
            var path = "student_feedback_onclick_backend.php?id=" +id;
            updateTable(path, 'feedback-content')
        }
    </script>
</body>
</html>