<?php
    require "common/conn.php";
    if(!$_POST)
    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have not access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    // get user id and company id from session
    $id = $_SESSION['userID'];
    $comid = $_SESSION['companyID'];
    $fbID = $_POST["fbID"];
    $status = 1;

    // get current datetime
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_now = date('Y-m-d H:i:s');

    //insert student created
    $sql = "UPDATE feedback SET FeedbackStatus = $status, FeedbackReply = '$_POST[content]', RepliedDateTime = '$date_now'
    WHERE FeedbackID = $fbID";

    // error message when no query found
    if (!mysqli_query($con,$sql)) {
        die('Error: '. mysqli_error($con));
    }

    //redirect after display message
    else {
    echo '<script>alert("Your feedback is created successfully.");
    window.location.href = "";
    </script>';
    }
?>