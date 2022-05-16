<?php
if (!isset($_SESSION["userID"])) {
    echo '<script>alert("Please login before you access this page.");
    window.location.href="guest_home_page.php";</script>';
}
require  "common/conn.php";
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