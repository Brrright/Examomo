<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    $action = "Class"; 
    $fetched = mysqli_query($con, "SELECT * FROM class WHERE CompanyID = ".$_SESSION['companyID']."");
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
                        <a class="active">View Class List</a>
                        <br>
                        <a href="admin_add_class.php">Add Classes</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-10">
                <div class="profilecontainer my-4 shadow p-3 mb-5">
                    <div class="d-flex flex-row justify-content-between mx-auto m-0" style="width:80%">
                        <input class="form-control me-2" type="text" placeholder="Search By Name" aria-label="Search" name="class_name"  id="search-text">
                    </div>
                <br>
                <table class="table table-hover mx-auto align-middle " style="width:95%" id="table-app">
                    <caption>List of <?php echo $action;?> : <?php echo $numOfRow;?> in Total (all record)</caption>
                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 35%;">
                            <col span="1" style="width: 35%;">
                            <col span="1" style="width: 20%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Class ID</th>
                                <th>Class Name</th>
                                <th>Related Module</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- <table-list></table-list> -->
                        <tbody id="table-body">
                            <?php 
                            while ($data = mysqli_fetch_array($fetched)) {
                                $module_class = mysqli_query($con, "SELECT * FROM module_class WHERE CompanyID = ".$_SESSION['companyID']." AND ClassID = '.$data[ClassID].'");
                                if(!$module_class) {
                                    echo 'Err' .mysqli_error($con);
                                    break;
                                }

                                $listOfModuleID = array();
                                while ($data_for_module_class = mysqli_fetch_array($module_class)) {
                                    $ModuleID = $data_for_module_class["ModuleID"];
                                    array_push($listOfModuleID, $ModuleID);
                                }

                                $moduleRecord =  mysqli_query($con, "SELECT ModuleName FROM module WHERE CompanyID =  ".$_SESSION['companyID']."");
                                if(!$moduleRecord) {
                                    echo 'Error:'.mysqli_error($con);
                                    break;
                                }

                                $moduleString = "";
                                while ($dataModule = mysqli_fetch_array($moduleRecord)) {
                                    $moduleString = $moduleString.$dataModule["ModuleName"]."<br>" ;
                                }

                                $row = '<tr>
                                            <td>'.$data["ClassID"].'</td>
                                            <td>'.$data["ClassName"].'</td>
                                            <td> '.$moduleString.'</td>
                                            <td id="'.$data["ClassID"].'">
                                                <button class="btn btn-primary" ><i class="bi bi-pencil-fill"></i></button>
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
            updateTable("admin_class_list_backend.php?class_name=" + key, 'table-body')
        })

    </script>
    <script src="js/jquery.tabledit.js"></script>
</body>
</html>