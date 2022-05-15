<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    $action = "Class"; 
    $fetched = mysqli_query($con, "SELECT * FROM class WHERE CompanyID = ".$_SESSION['companyID']."");
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "common/HeadImportInfo.php";
    ?>
    <link rel="stylesheet" href="css/commonCSS.css">
    <link rel="stylesheet" href="css/mingliangCSS.css">
    <title>Admin | <?php echo $action;?> List</title>
</head>
<body>
    <?php require "common/header_admin.php";?>
    <h1 class="text-center font-caveat fw-bold mb-3"><?php echo $action;?> List</h1>
    <div class="d-flex flex-row justify-content-between mx-auto m-5" style="width:80%">
        <input class="form-control me-2" type="text" v-model="username" placeholder="Search" aria-label="Search">        
        <div>
           <button class="btn btn-primary ms-3">Add new user</button>
        </div>
    </div>

    <table class="table table-light table-hover mx-auto align-middle " style="width:90%" id="table-app">
        <thead>
            <tr>
                <th>Module ID</th>
                <th>Module Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <!-- <table-list></table-list> -->
        <tbody>
            <?php 
            while ($data = mysqli_fetch_array($fetched)) {
                $module_class1 = mysqli_query($con, "");
                $row = '<tr>
                            <td>'.$data["ModuleID"].'</td>
                            <td>'.$data["ModuleName"].'</td>
                            <td>
                                <button class="btn btn-primary" id="'.$data["ModuleID"].'"><i class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-danger" id="'.$data["ModuleID"].'"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>';
                echo $row;
            }
            ?>
        </tbody>
    </table>

    <?php require "common/footer_admin.php";?>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/mingliangJS.js"></script>
</body>
</html>