<?php
    require "common/conn.php";
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