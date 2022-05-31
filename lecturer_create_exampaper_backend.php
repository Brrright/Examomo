<?php

    require "common/conn.php";

        // identify if user logged in
        if (!isset($_SESSION["userID"])) {
            echo '<script>alert("Please login before you access this page.");
            window.location.href="logout.php";</script>';
        }
    
        if ($_SESSION["userRole"] != "lecturer") {
            echo '<script>alert("You have no access to this page.");
            window.location.href="logout.php";</script>';
        }

    // pass lecturer id and submission status
    $id = $_SESSION['userID'];
    $submit = $_POST['submit'];
    $company = $_SESSION['companyID'];

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

    else if ($_POST['submit'] =="addques") {
        $papername = "'$_POST[papername] (drafted)'";
    }

    else {
        echo "Error occured. Please try again.";
        return;
    }

    $sql ="INSERT INTO exam_paper (PaperName, DateCreated, PaperType, LecturerID, CompanyID, ModuleID) 
    VALUES($papername, '$date_clicked', '$_POST[papertype]', $id, $company, '$_POST[Moduleid]')";
    
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Exam paper created successfully.");
    window.location.href = "lecturer_exampaper_page.php";
    </script>';
    }

    // pass newest paper id to question creation
    $getid ="SELECT PaperID FROM exam_paper WHERE LecturerID = $id ORDER BY PaperID DESC LIMIT 1";
    $result = mysqli_query($con,$getid);
    while ($row = mysqli_fetch_array($result)) {
        
        // redirect to add questions page
        if ($_POST['submit'] =="addques" ) {
            if($_POST['papertype'] == 'MCQ'){
                header("Location: lecturer_mcq_main.php?id=".$row['PaperID']);
            }
            else {
                header("Location: lecturer_structure_main.php?id=".$row['PaperID']);
            }
        }
    }
?>
