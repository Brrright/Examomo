<?php
    require("common/conn.php");

    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];

    // get user id and company id from session
    $id = $_SESSION['userID'];
    $comid = $_SESSION['companyID'];
    $status = 0;
    $content = $_POST['content'];

    // get current datetime
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_now = date('Y-m-d H:i:s');

    //insert student created
    $sql = "INSERT INTO feedback(FeedbackContent, FeedbackStatus, FeedbackReply, FeedbackDateTime, RepliedDateTime, StudentID, CompanyID)
            VALUES('$content', $status, NULL, '$date_now', NULL, $id , $comid)";

    // error message when no query found
    if (!mysqli_query($con,$sql)) {
        $response["error"] = 'Error: ' . mysqli_error($con);
    }

    echo json_encode($response);
?>