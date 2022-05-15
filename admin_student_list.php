<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    // if (isset($_GET['action'])) {
    //     if ($_GET['action'] == "admin") {
    //         $action = "Admin";
    //         $fetched = mysqli_query($con, "SELECT * FROM admin");
    //     }
    //     else if ($_GET['action'] == "lecturer") {
    //         $action = "Lecturer";
    //         $fetched = mysqli_query($con, "SELECT * FROM lecturer");
    //     }
    //     else if($_GET['action'] == "student") {
            $action = "Student"; 
            $fetched = mysqli_query($con, "SELECT *FROM student WHERE CompanyID = ".$_SESSION['companyID']."");
    //     }
    //     else if($_GET['action'] == "module") {
    //         $action = "Module"; 
    //         $fetched = mysqli_query($con, "SELECT * FROM module");
    //     }
    //     else if($_GET['action'] == "class") {
    //         $action = "Class"; 
    //         $fetched = mysqli_query($con, "SELECT * FROM class");
    //     }
    // }
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
        <input class="form-control me-2" type="text" v-model="username" placeholder="Search By Name" aria-label="Search">        
        <div>
           <button class="btn btn-primary ms-3">Add new user</button>
        </div>
    </div>

    <table class="table table-light table-hover mx-auto align-middle " style="width:90%" id="table-app">
        <caption>List of <?php echo $action;?></caption>
        <thead class="table-dark">
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Student Gender</th>
                <th>Student Email</th>
                <th>Student Password</th>
                <th>Related Class</th>
                <th>Action</th>
            </tr>
        </thead>
        <!-- <table-list></table-list> -->
        <tbody>
            <?php 
            while ($data = mysqli_fetch_array($fetched)) {
                $row = '<tr>
                            <td>'.$data["StudentID"].'</td>
                            <td>'.$data["StudentName"].'</td>
                            <td>'.$data["StudentGender"].'</td>
                            <td>'.$data["StudentEmail"].'</td>
                            <td>'.$data["StudentPassword"].'</td>
                            <td>'.$data["ClassID"].'</td>
                            <td>
                                <button class="btn btn-primary" id="'.$data["StudentID"].'"><i class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-danger" id="'.$data["StudentID"].'"><i class="bi bi-trash"></i></button>
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