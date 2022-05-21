<?php
    require "common/conn.php";

    // identify if user logged in
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "student") {
        echo '<script>alert("You have not access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    // get user id and company id from session
    $id = $_SESSION['userID'];
    $comid = $_SESSION['companyID'];
    $status = 0;

    // get current datetime
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_now = date('Y-m-d H:i:s');

    //insert student created
    $sql = "INSERT INTO feedback(FeedbackContent, FeedbackStatus, FeedbackReply, FeedbackDateTime, RepliedDateTime, StudentID, CompanyID)
            VALUES('$_POST[fb_content]', $status, NULL, '$date_now', NULL, $id , $comid)";

    // error message when no query found
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    //redirect after display message
    else {
    echo '<script>alert("Your feedback is created successfully.");
    window.location.href = "student_feedback_page.php";
    </script>';
    }
?>