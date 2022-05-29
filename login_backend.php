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
        $companycheck ="CompanyID";

        $checkBan = "SELECT isBanned FROM student WHERE StudentEmail = '$email'";
        $checkBanExe = mysqli_query($con, $checkBan);
        if(!$checkBanExe) {
            $response["error"] = 'Error:'.mysqli_error($con);
            echo json_encode($response);
            return;
        }
        else{
            if(mysqli_num_rows($checkBanExe) > 0) {
                $banData = mysqli_fetch_array($checkBanExe);
                if($banData["isBanned"] == 1){
                    $response["error"] = 'Oh no! Your account has been banned! Please contact your school admin for any inquiries.';
                    echo json_encode($response);
                    return;
                }
            }
        }
    }
    else if($role == "lecturer") {
        $colID = "LecturerID";
        $colEmail = "LecturerEmail";
        $colPass = "LecturerPassword";
        $companycheck ="CompanyID";
    }
    else if($role == "admin") {
        $colID = "AdminID";
        $colEmail = "AdminEmail";
        $colPass = "AdminPassword";
        $companycheck ="CompanyID";
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
        $sqlEmailAndPassword = "SELECT * FROM $role 
                                INNER JOIN company ON $role.CompanyID = company.CompanyID
                                WHERE $role.$colEmail = '$email' AND $role.$colPass = '$password' AND company.CompanyName = '$companyName'";
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