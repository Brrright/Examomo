<?php
    require "common/conn.php";

    $companyID = $_SESSION['companyID'];

    $sql ="INSERT INTO lecturer (LecturerName, LecturerGender, LecturerEmail, LecturerPassword, CompanyID)
    VALUES('$_POST[studentName]', '$_POST[studentGender]', '$_POST[studentEmail]', '$_POST[studentPassword]', $companyID)";
    
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("Student created successfully.");
    window.location.href = "admin_add_student.php";
    </script>';
    }
?>