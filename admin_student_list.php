<?php
    require "common/conn.php";
     // identify if user logged in
     if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }
    $action = "Student"; 
    $fetched = mysqli_query($con, "SELECT *FROM student WHERE CompanyID = ".$_SESSION['companyID']."");
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
                        <a class="active">View Student List</a>
                        <br>
                        <a href="admin_add_student.php">Add Students</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-10">
                <div class="profilecontainer my-4 shadow p-3 mb-5">
                    <div class="d-flex flex-row justify-content-between mx-auto m-0" style="width:80%">
                        <input class="form-control me-2" type="text" placeholder="Search By Name" aria-label="Search" name="student_name"  id="search-text">        
                    </div>
                <br>
                <table class="table table-hover mx-auto align-middle " style="width:95%" id="table-app">
                    <caption>List of <?php echo $action;?> : <?php echo $numOfRow;?> in Total (all record)</caption>
                    <thead>
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
                    <tbody id="table-body">
                    <?php 
                        while ($data = mysqli_fetch_array($fetched)) {
                            $className = mysqli_query($con, "SELECT ClassName FROM class WHERE ClassID =".$data['ClassID']."");
                            if (!$className) {
                                echo 'Err '. mysqli_error($con);
                                break;
                            }
                            $classNameFetched = mysqli_fetch_array($className);
                            $row = '<tr>
                                        <td>'.$data["StudentID"].'</td>
                                        <td>'.$data["StudentName"].'</td>
                                        <td>'.$data["StudentGender"].'</td>
                                        <td>'.$data["StudentEmail"].'</td>
                                        <td>'.$data["StudentPassword"].'</td>
                                        <td>'.$classNameFetched["ClassName"].'</td>
                                        <td>
                                            <a href="admin_edit_student.php?id='.$data["StudentID"].'"<button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="admin_delete_student.php?id='.$data["StudentID"].'"<button class="btn btn-danger delete-confirm"><i class="bi bi-trash"></i></button></a>
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
            updateTable("admin_student_list_backend.php?student_name=" + key, "table-body")
        })

    </script>
    <!-- javascript to display confirmation when click delete button -->
    <script type="text/javascript">
        var elems = document.getElementsByClassName('delete-confirm');
        var confirmIt = function (e) {
            if (!confirm('Are you sure to delete this Student Account?')) e.preventDefault();
        };
        for (var i = 0, l = elems.length; i < l; i++) {
            elems[i].addEventListener('click', confirmIt, false);
        }
    </script>
</body>
</html>