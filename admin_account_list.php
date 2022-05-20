<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    $action = "Admin";
    $fetched = mysqli_query($con, "SELECT * FROM admin WHERE CompanyID = ".$_SESSION['companyID']."");
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
                        <a class="active">View Admin List</a>
                        <br>
                        <a href="admin_add_admin.php">Add Admins</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-10">
                <div class="profilecontainer my-4 shadow p-3 mb-5">
                    <div class="d-flex flex-row justify-content-between mx-auto m-0" style="width:80%">
                        <input class="form-control me-2" type="text" placeholder="Search By Name" aria-label="Search" name="admin_name"  id="search-text">        
                    </div>
                <br>
                <table class="table table-hover mx-auto align-middle " style="width:95%" id="table-app">
                    <caption>List of <?php echo $action;?> : <?php echo $numOfRow;?> in Total (all record)</caption>
                    <colgroup>
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 20%;">
                        <col span="1" style="width: 25%;">
                        <col span="1" style="width: 20%;">
                        <col span="1" style="width: 20%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>Admin Name</th>
                            <th>Admin Email</th>
                            <th>Admin Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- <table-list></table-list> -->
                    <tbody id="table-body">
                        <?php 
                        while ($data = mysqli_fetch_array($fetched)) {
                            $row = '<tr>
                                        <td>'.$data["AdminID"].'</td>
                                        <td>'.$data["AdminName"].'</td>
                                        <td>'.$data["AdminEmail"].'</td>
                                        <td>'.$data["AdminPassword"].'</td>
                                        <td>
                                            <button class="btn btn-primary" id="'.$data["AdminID"].'"><i class="bi bi-pencil-fill"></i></button>
                                            <button class="btn btn-danger" id="'.$data["AdminID"].'"><i class="bi bi-trash"></i></button>
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
            updateTable("admin_account_list_backend.php?admin_name=" + key,  'table-body')
        })

    </script>
</body>
</html>