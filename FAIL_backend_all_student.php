<?php
    require("common/conn.php");
    $response = [];
    $studentSQL = "SELECT StudentID, StudentName, StudentGender, StudentEmail, StudentPassword, ClassID FROM student";
    $fetchedStudent = mysqli_query($con, $studentSQL);
    if(!$fetchedStudent) {
        $data = mysqli_fetch_array($fetchedStudent);
        $response['id'] = $data["StudentID"];
        $response['name'] = $data["StudentID"];
        $response['gender'] = $data["StudentID"];
        $response['email'] = $data["StudentID"];
        $response['password'] = $data["StudentID"];
    }
    echo json_encode($response);
?>