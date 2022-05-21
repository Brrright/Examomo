<?php
    "common/conn.php";
   
      // identify if user logged in
      if (!isset($_SESSION["userID"])) {
          echo '<script>alert("Please login before you access this page.");
          window.location.href="guest_home_page.php";</script>';
          return;
      }
    
      if ($_SESSION["userRole"] != "student") {
          echo '<script>alert("You have not access to this page.");
          window.location.href="guest_home_page.php";</script>';
          return;
      }
      //use post to get the module ID selected
      if(isset($_GET['id'])) {
        $feedbackID = $_GET['id'];
      }
      else {
        echo '<script>alert("Please enter this page by using correct path.");
        window.location.href="guest_home_page.php";</script>';
        return;
      }

    // havent replied
    $sentsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackReply , feedback.FeedbackDateTime, feedback.RepliedDateTime , student.StudentName, student.StudentEmail
                    FROM feedback INNER JOIN student ON feedback.StudentID = student.StudentID 
                    WHERE feedback.StudentID = ".$_SESSION["userID"]." AND feedback.FeedbackID = ".$feedbackID." AND feedback.CompanyID = ".$_SESSION["companyID"]."";
    
    $sentresult = mysqli_query($con, $sentsql);
    $numOfRow = mysqli_num_rows($sentresult);
    
   
    if ($numOfRow==0) {
        echo "Something went wrong, no record OwO";
        return;
    }

    while ($rfeedback = mysqli_fetch_array($sentresult)) {

        $content = '<div class="chatbox">
                        <div class="row" id="student-feedback-content">
                            <div class="col-2">
                                <img src="img/admin/students.png" alt="...">
                            </div>
                            <div class="col-10">
                                <div> 
                                    <p>'.$rfeedback["StudentName"].'</p>
                                </div>
                                <div>
                                    <p>'.$rfeedback["FeedbackContent"].'</p>
                                </div>
                                <div>
                                    <span class="time-right">'.$rfeedback["FeedbackDateTime"].'</span>
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
                                <div> 
                                    <p>ADMIN</p>
                                </div>
                                <div>
                                    <p>'.$rfeedback["FeedbackReply"].'</p>
                                </div>
                                <div>
                                    <span class="time-right">'.$rfeedback["RepliedDateTime"].'</span>
                                </div>
                            </div>
                        </div>
                    </div>';
        echo $content;
    }
    
?>