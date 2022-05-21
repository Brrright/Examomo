<?php
    require "common/conn.php";

    //get id from clicking list
    // $fb_id = $_['id']; // use this for implementation
    // $fb_id = 2; //test purpose id

    //display data after student click selected list for unreplied feedback, sort by newest creation datetime
    $sentsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackDateTime, student.StudentName, student.StudentEmail 
                FROM feedback INNER JOIN student ON feedback.StudentID = student.StudentID 
                WHERE feedback.StudentID = ".$_SESSION["userID"]." AND feedback.CompanyID = ".$_SESSION["companyID"]." AND feedback.FeedbackStatus LIKE 0 ORDER BY feedback.FeedbackDateTime DESC";
                
    $sentresult = mysqli_query($con, $sentsql);
    while($sfeedback = mysqli_fetch_array($sentresult)){

        //unread feedback details
        echo "$sfeedback[FeedbackID]";
        echo "$sfeedback[FeedbackContent]";
        echo "$sfeedback[FeedbackStatus]";
        echo "$sfeedback[FeedbackDateTime]";

        //Student details
        echo "$sfeedback[StudentName]";
        echo "$sfeedback[StudentEmail]";
        echo "<br>";
    }


    //display data after student click selected list for replied feedback, sorted by reply newest datetime
    $repliedsql = "SELECT feedback.FeedbackID, feedback.FeedbackContent, feedback.FeedbackStatus, feedback.FeedbackReply , feedback.FeedbackDateTime, feedback.RepliedDateTime , student.StudentName, student.StudentEmail  
            FROM feedback INNER JOIN student ON feedback.StudentID = student.StudentID 
            WHERE feedback.StudentID = ".$_SESSION["userID"]." AND feedback.CompanyID = ".$_SESSION["companyID"]." AND feedback.FeedbackStatus LIKE 1 ORDER BY feedback.RepliedDateTime DESC";
                

    $repliedresult = mysqli_query($con, $repliedsql);
    while($isreplied = mysqli_fetch_array($repliedresult)){

        //replied feedback details
        echo "$isreplied[FeedbackID]";
        echo "$isreplied[FeedbackContent]";
        echo "$isreplied[FeedbackStatus]";
        echo "$isreplied[FeedbackDateTime]";
        echo "$isreplied[FeedbackReply]";
        echo "$isreplied[RepliedDateTime]";

        //Student details
        echo "$isreplied[StudentName]";
        echo "$isreplied[StudentEmail]";
        echo "<br>";

    }

?>