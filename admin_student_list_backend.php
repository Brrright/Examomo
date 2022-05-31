<?php
    require  "common/conn.php";
    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }
if(isset($_GET['student_name'])) {
    $student_name = $_GET['student_name'];
}

$fetched = mysqli_query($con, "SELECT * FROM student WHERE CompanyID = ".$_SESSION['companyID']." AND StudentName LIKE'%$student_name%'");
$numOfRow = mysqli_num_rows($fetched);

if ($numOfRow === 0) {
    echo '<tr>
        <td colspan="7" align="center">No data Found</td>
    </tr>';
    return;
}
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