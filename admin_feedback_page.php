<?php require
"common/conn.php";
    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }
    
// havent replied
$sentsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackDateTime, student.StudentName, student.StudentEmail 
FROM feedback INNER JOIN student ON feedback.StudentID = student.StudentID 
WHERE feedback.FeedbackStatus LIKE 0 AND feedback.CompanyID = ".$_SESSION["companyID"]." ORDER BY feedback.FeedbackDateTime DESC";
$sentresult = mysqli_query($con, $sentsql);
$numOfRow = mysqli_num_rows($sentresult);

$repliedsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackReply , feedback.FeedbackDateTime, feedback.RepliedDateTime , student.StudentName, student.StudentEmail
            FROM (feedback INNER JOIN student ON feedback.StudentID = student.StudentID)
            WHERE feedback.FeedbackStatus LIKE 1 AND feedback.CompanyID = ".$_SESSION["companyID"]." ORDER BY feedback.RepliedDateTime DESC";

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
  <?php require "common/header_admin.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Feedback From Student</h1></center>
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
                                // unreplied feedback will be display first
                                else{
                                echo '<p class="fw-bold text-center main-color m-1" style="background-color: #ddd;">New Feedback</p>';
                                while($sfeedback = mysqli_fetch_array($sentresult)){

                                    $enquirylist = '<button class="list-group-item list-group-item-action py-3" onclick="changeContent('.$sfeedback["FeedbackID"].')">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    
                                    <strong class="mb-1">'.$sfeedback["StudentName"].'</strong>
                                    
                                    <small class="text-muted">'.$sfeedback["FeedbackDateTime"].'</small>
                                    </div>
                                    <div class="col-10 mb-1 small text-nowrap" style="overflow: hidden;text-overflow: ellipsis;width: 90%;">'.$sfeedback["FeedbackContent"].'</div>
                                    </button>';
                                    
                                    echo $enquirylist;
                                }

                                //replied feedback will be displayed afterwards for admin
                                echo '<p class="fw-bold text-center main-color m-1" style="background-color: #ddd;">Replied</p>';
                                while ($rfeedback = mysqli_fetch_array($repliedresult)) {
                                    $repliedEnquiryList = '<button class="list-group-item list-group-item-action py-3" onclick="changeContent('.$rfeedback["FeedbackID"].')">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                    <small class="text-muted"> Replied at '.$rfeedback["RepliedDateTime"].'</small>
                                    </div>
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                            <strong class="mb-1">'.$rfeedback["StudentName"].'</strong>
                                    </div>
                                    <div class="col-10 mb-1 small text-nowrap" style="overflow: hidden;text-overflow: ellipsis;width: 90%;">'.$rfeedback["FeedbackReply"].'</div>
                                </button>';
                                
                                echo $repliedEnquiryList;
                                }}

                            ?>
                            </div>                        
                </div>
            </div>
        </div>
        <div class="col-sm-9">  
            <div class="enquirybox my-4 shadow p-3 mb-5" id="feedback-content">
                <div class="chatbox">
                    <div class="row">
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
                    <div class="row">
                        <div class="col-2">
                            <img src="img/admin/admin.png" alt="...">
                        </div>
                        <div class="col-10">
                        <form action="admin_feedback_insert_backend.php" method="POST" class="was-validated">
                            
                            <input type="text" class="form-control shadow-sm" name="fb_content" id="validationServer03 adm-floatingInput" aria-describedby="validationServer03Feedback" placeholder="Enter feedback here... (select a feedback first)" disabled>
                                <br>
                            <div class= "d-flex flex-wrap justify-content-around">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                            Please provide a valid input.
                            </div>
                            <button type="submit" value="submit" class="btn btn-primary" style="border:none;" disabled>Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php require "common/footer_admin.php"  ?>
    <script src="js/mingliangJS.js"></script>
    <script>
        function changeContent(id) {
            var path = "admin_feedback_onclick_backend.php?id=" +id;
            updateTable(path, 'feedback-content')
        }
    </script>
</body>
</html>