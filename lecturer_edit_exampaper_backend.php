<?php

    require "common/conn.php";

    // pass lecturer id and submission status
    $id = $_SESSION['userID'];
    $submit = $_POST['submit'];
    $company = $_SESSION['companyID'];

    // retrieve paper ID
    $paperid = $_POST['paperid'];

    // get current datetime
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_clicked = date('Y-m-d H:i:s');

    // condition to verify draft or publish
    if ($submit == "create") {
        $papername = "'$_POST[papername]'";
    }

    else if ($submit == "draft") {
        $papername = "'$_POST[papername] (drafted)'";
    }

    else {
        echo "Error occured. Please try again.";
        return;
    }

    $sql ="UPDATE exam_paper SET
    PaperName = $papername,
    DateCreated = '$date_clicked',
    PaperType = '$_POST[papertype]',
    LecturerID = $id,
    CompanyID = '$company',
    ModuleID ='$_POST[Moduleid]'
    WHERE PaperID = '$paperid'";
    
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Exam paper changes made successfully.");
    window.location.href = "lecturer_exampaper_page.php";
    </script>';
    }
?>