<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    $adminID = $_SESSION['userID'];
    $companyID = $_SESSION['companyID'];

    $sql ="INSERT INTO student (StudentName, StudentGender, StudentEmail, StudentPassword, ClassID, CompanyID)
    VALUES('$_POST[studentName]', '$_POST[studentGender]', '$_POST[studentEmail]', '$_POST[studentPassword]', '$_POST[classID]', $companyID)";

    if(!mysqli_query($con, $sql)) {
        $response["error"] = 'Error:'.mysqli_error($con);
        echo json_encode($response);

    }
    else {
        $response["successStudent"] = "Student record inserted sucessfully";
        $studentID = mysqli_insert_id($con);
        
        // student@admin------------------------------------------------------------------------
        $sqlStudent_Admin = "INSERT INTO admin_student (AdminID, StudentID, CompanyID) VALUES ('$adminID','$studentID', $companyID)";
        if(!mysqli_query($con, $sqlStudent_Admin)) {
            $response["error"] = 'Error:'.mysqli_error($con);
            echo json_encode($response);

        }
        else {
            echo '<script>alert("Student created successfully.");
            window.location.href = "admin_add_student.php";
            </script>';
            } 
        }
?>