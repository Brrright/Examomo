<?php
    require "common/conn.php";

    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }

    // get user id and company id from session
    $id = $_SESSION['userID'];
    $comid = $_SESSION['companyID'];
    $fb_id = $_POST['fb-id'];
    $status = 1;

    // get current datetime
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_now = date('Y-m-d H:i:s');

    //insert student created
    $sql = "UPDATE feedback SET
    FeedbackStatus = $status,
    FeedbackReply = '$_POST[fb-reply]',
    RepliedDateTime = '$date_now',
    WHERE FeedbackID = '$fb_id'";

    // error message when no query found
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    //redirect after display message
    else {
    echo '<script>alert("Your feedback is created successfully.");
    window.location.href = "";
    </script>';
    }
?>