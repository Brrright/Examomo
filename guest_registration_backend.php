<?php
    if(!isset($_POST))
        return;

    require("common/conn.php");

    $body = json_decode(file_get_contents("php://input"), true);
    $response = [];

    // company
    $sqlCompany = "INSERT INTO company (CompanyName, InstitutionType) VALUES('$body[organizationName]','$body[institution]')";
    if (!mysqli_query($con, $sqlCompany)) {
        $response["error"] = 'Error:'.mysqli_error($con);
        echo json_encode($response);

    }
    else {
        $response["successCompany"]= "successful inserted company record";
        $companyID = mysqli_insert_id($con);
        $response["companyid"] = $companyID;



        // admin
        $sqlAdmin = "INSERT INTO admin (AdminName, AdminEmail, AdminPassword, CompanyID) VALUES('$body[adminName]', '$body[adminEmail]', '$body[adminPassword]', $companyID)";
        if (!mysqli_query($con, $sqlAdmin)) {
            $response["error"] = 'Error:'.mysqli_error($con);
            echo json_encode($response);

        }
        else {
            $response["successAdmin"] = "Admin record inserted sucessfully";
            $adminID = mysqli_insert_id($con);
    


            // module
            $sqlModule = "INSERT INTO module (ModuleName) VALUE ('$body[moduleName]')";
            if(!mysqli_query($con, $sqlModule)) {
                $response["error"] = 'Error:'.mysqli_error($con);
                echo json_encode($response);

            }
            else {
                $response["successModule"] = "Module record inserted sucessfully";
                $moduleID = mysqli_insert_id($con);

                // module + admin
                $sqlModule_Admin = "INSERT INTO admin_module (AdminID, ModuleID) VALUES ('$adminID', '$moduleID')";
                if(!mysqli_query($con, $sqlModule_Admin)) {
                    $response["error"] = 'Error:'.mysqli_error($con);
                    echo json_encode($response);

                }
                else {
                    // $response ["adminid"] = $adminID;
                    // $response ["moduleid"] = $moduleID;
                    $response["successModule@admin"] = "Module@admin record inserted sucessfully";



                    // class
                    $sqlClass = "INSERT INTO class (ClassName) VALUE ('$body[moduleName]')";
                    if(!mysqli_query($con, $sqlClass)) {
                        $response["error"] = 'Error:'.mysqli_error($con);
                        echo json_encode($response);
        
                    }
                    else {
                        $response["successClass"] = "Class record inserted sucessfully";
                        $classID = mysqli_insert_id($con);

                        // class + admin
                        $sqlClass_Admin = "INSERT INTO admin_class (AdminID, ClassID) VALUES ('$adminID', '$classID')";
                        if(!mysqli_query($con, $sqlClass_Admin)) {
                            $response["error"] = 'Error:'.mysqli_error($con);
                            echo json_encode($response);
            
                        }
                        else {
                            $response["seccuessClass@Admin"] = "Class@Admin record inserted sucessfully";

                            // module + class
                            $sqlClass_Module = "INSERT INTO module_class (ModuleID, ClassID) VALUES ('$moduleID', '$classID')";
                            if(!mysqli_query($con, $sqlClass_Module)) {
                                $response["error"] = 'Error:'.mysqli_error($con);
                                echo json_encode($response);
                
                            }
                            else {
                                $response["sucessModule@Class"] = "Module@Class record inserted sucessfully";



                                // lecturer
                                $sqlLecturer = "INSERT INTO lecturer (LecturerName, LecturerGender, LecturerEmail, LecturerPassword) VALUES ('$body[lecturerName]', '$body[lecturerGender]', '$body[lecturerEmail]', '$body[lecturerPassword]')";
                                if(!mysqli_query($con, $sqlLecturer)) {
                                    $response["error"] = 'Error:'.mysqli_error($con);
                                    echo json_encode($response);
                    
                                }
                                else {
                                    $response["sucesslecturer"] = "Lecturer record inserted sucessfully";
                                    $lecturerID  = mysqli_insert_id($con);

                                    // lecturer + admin
                                    $sqlLecturer_Admin = "INSERT INTO admin_lecturer (AdminID, LecturerID) VALUES ('$adminID','$lecturerID')";
                                    if(!mysqli_query($con, $sqlLecturer_Admin)) {
                                        $response["error"] = 'Error:'.mysqli_error($con);
                                        echo json_encode($response);
                        
                                    }
                                    else {
                                        $response["successLecturer@admin"] = "Lecturer@admin record inserted sucessfully";

                                        // lecturer + module
                                        $sqlLecturer_Module = "INSERT INTO lecturer_module (LecturerID, ModuleID) VALUES ('$lecturerID','$moduleID')";
                                        if(!mysqli_query($con, $sqlLecturer_Module)) {
                                            $response["error"] = 'Error:'.mysqli_error($con);
                                            echo json_encode($response);
                            
                                        }
                                        else {
                                            $response["successLecturer@module"] = "Lecturer@module record inserted sucessfully";



                                            // student
                                            $sqlStudent = "INSERT INTO student (StudentName, StudentGender, StudentEmail, StudentPassword, ClassID)
                                            VALUES ('$body[studentName]', '$body[studentGender]', '$body[studentEmail]', '$body[studentPassword]', '$classID')";
                                            if(!mysqli_query($con, $sqlStudent)) {
                                                $response["error"] = 'Error:'.mysqli_error($con);
                                                echo json_encode($response);
                                
                                            }
                                            else {
                                                $response["successStudent"] = "Student record inserted sucessfully";
                                                $studentID = mysqli_insert_id($con);
                                                
                                                // student@admin
                                                $sqlStudent_Admin = "INSERT INTO admin_student (AdminID, StudentID) VALUES ('$adminID','$studentID')";
                                                if(!mysqli_query($con, $sqlStudent_Admin)) {
                                                    $response["error"] = 'Error:'.mysqli_error($con);
                                                    echo json_encode($response);
                                    
                                                }
                                                else {
                                                    $response["successStudent@Admin"] = "Student@admin record inserted sucessfully";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    echo json_encode($response);
?>