<?php
    if(!isset($_POST))
        return;

    require("common/conn.php");

    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];

    $role = $body["role"];
    $companyName = $body["company_name"];
    $email = $body["email"];
    $password = $body["password"];

    if($role == "student") {
        $colID = "StudentID";
        $colEmail = "StudentEmail";
        $colPass = "StudentPassword";
    }
    else if($role == "lecturer") {
        $colID = "LecturerID";
        $colEmail = "LecturerEmail";
        $colPass = "LecturerPassword";
    }
    else if($role == "admin") {
        $colID = "AdminID";
        $colEmail = "AdminEmail";
        $colPass = "AdminPassword";
    }
    else {
        $response["error"] = "role not found";
    }

    //check company
    $sqlCompany = "SELECT CompanyID, CompanyName FROM company WHERE CompanyName = '$companyName'";
    $companyRecord = mysqli_query($con, $sqlCompany);
    if(mysqli_num_rows($companyRecord) == 0){
        $response["error"] = 'Error: Company name not found';
        echo json_encode($response);
        return;
    }
    if(!$companyRecord) {
        $response["error"] = 'Error:'.mysqli_error($con);
        echo json_encode($response);
        return;
    }
    else {
        $sqlEmailAndPassword = "SELECT * FROM $role WHERE $colEmail = '$email' AND $colPass = '$password'";
        $result = mysqli_query($con, $sqlEmailAndPassword);
        if(!$result) {
            $response["error"] = 'Error:'.mysqli_error($con);
            echo json_encode($response);
            return;
        }
        else{
            if(mysqli_num_rows($result) > 0) {

                // Data matched, now start set session
                $fetchedCompany = mysqli_fetch_array($companyRecord);
                $data = mysqli_fetch_array($result);
                // Set session with USER ID - adminid/stdentid/lecturerID
                $_SESSION['companyID'] = $fetchedCompany["CompanyID"];
                $_SESSION['companyName'] = $companyName;
                $_SESSION['userRole'] = $role;
                $_SESSION['userID'] = $data["$colID"];
                $response["success"] = "Login successful";
            }
            else{
                $response["error"] = "No record is found, username or password incorrect";
            }
        }
    }
    echo json_encode($response);
?>