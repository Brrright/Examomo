<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    $action = "Lecturer";
    $fetched = mysqli_query($con, "SELECT * FROM lecturer WHERE CompanyID = ".$_SESSION['companyID']."");
    $numOfRow = mysqli_num_rows($fetched);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "common/HeadImportInfo.php";
    ?>
    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/commonCSS.css">
    <link rel="stylesheet" href="css/mingliangCSS.css">
    <title><?php echo $action;?> | <?php echo $action;?> List</title>
</head>
<body>
    <?php require "common/header_admin.php";?>
    <h1 class="text-center font-caveat fw-bold mb-3"><?php echo $action;?> List</h1>
    <div class="container p-0">
        <div class="row g-0">
            <div class="col-sm-2">
                <div class="profilecontainer my-4 shadow p-3 mb-5 font-caveat">
                    <div class="pill-nav">
                        <a class="active">View Lecturer List</a>
                        <br>
                        <a href="#news">Add Lecturers</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-10">
                <div class="profilecontainer my-4 shadow p-3 mb-5">
                    <div class="d-flex flex-row justify-content-between mx-auto m-0" style="width:80%">
                        <input class="form-control me-2" type="text" placeholder="Search By Name" aria-label="Search" name="admin_name"  id="search-text">        
                    </div>
                <br>
                <table class="table table-hover mx-auto align-middle " style="width:95%">
                    <caption>List of <?php echo $action;?> : <?php echo $numOfRow;?> in Total (all record)</caption>
                    <thead>
                        <tr>
                            <th>Lecturer ID</th>
                            <th>Lecturer Name</th>
                            <th>Lecturer Gender</th>
                            <th>Lecturer Email</th>
                            <th>Lecturer Password</th>
                            <th>Related Module</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    <?php 
                        while ($data = mysqli_fetch_array($fetched)) {
                            // GET LECTURER-MODULE RECORD (BY USING LEC ID)
                            $module_lecturer = mysqli_query($con, "SELECT * FROM lecturer_module WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerID = ".$data['LecturerID']."");
                            if(!$module_lecturer) {
                                echo 'Error:'.mysqli_error($con);
                                break;
                            }

                            // GET LECTURER-MODULE RECORD (GET MODULE ID)
                            $listOfModuleID = array();

                            while ($data2 = mysqli_fetch_array($module_lecturer)) {
                                $moduleID = $data2["ModuleID"];
                                array_push($listOfModuleID, $moduleID); //PUSHING ID INTO ARRAY
                            }
                                // print_r($listOfModuleID);

                            // USING MODULE ID FETCHED, GET EACH MODULE NAME
                            $moduleRecord = mysqli_query($con, "SELECT ModuleName FROM module WHERE CompanyID =  ".$_SESSION['companyID']."");
                            if(!$moduleRecord) {
                                echo 'Error:'.mysqli_error($con);
                                break;
                            }

                            // CONCATENATE MODULE NAME IN A STRING
                            // echo $numOfModule;
                            $moduleString = "";
                            while ($dataModule = mysqli_fetch_array($moduleRecord)) {
                                $moduleString = $moduleString.$dataModule["ModuleName"]."<br>" ;
                            }
                                $row = '<tr>
                                <td>'.$data["LecturerID"].'</td>
                                <td>'.$data["LecturerName"].'</td>
                                <td>'.$data["LecturerGender"].'</td>
                                <td>'.$data["LecturerEmail"].'</td>
                                <td>'.$data["LecturerPassword"].'</td>
                                <td> '.$moduleString.'</td>
                                <td id="'.$data["LecturerID"].'">
                                    <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                                </tr>';
                                echo $row;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <?php require "common/footer_admin.php";?>

    <script src="js/mingliangJS.js"></script>
    <script>
        const input = document.getElementById('search-text')
        input.addEventListener('keyup', function(event) {
            var key = document.getElementById('search-text').value;
            updateTable("admin_lecturer_list_backend.php?lecturer_name=" + key, 'table-body')
        })

    </script>
</body>
</html>