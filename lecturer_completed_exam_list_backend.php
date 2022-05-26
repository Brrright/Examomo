<?php
    require "common/conn.php";

    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if(isset($_GET['exam_name'])) {
        $exam_name = $_GET['exam_name'];
    }
    $fetched = mysqli_query($con, "SELECT * FROM exam WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerID = ".$_SESSION['userID']." AND ExamEndDateTime > curtime() AND ExamName LIKE'%$exam_name%'");
    $numOfRow = mysqli_num_rows($fetched);
    if ($numOfRow === 0) {
        echo '<tr>
            <td colspan="7" align="center">No data Found</td>
        </tr>';
        return;
    }
    while ($data = mysqli_fetch_array($fetched)) {
        $row = '<tr>
                    <td>'.$data["ExamName"].'</td>
                    <td>Start : '.$data["ExamStartDateTime"].'<br>End   : '.$data["ExamEndDateTime"].'</td>
                    <td> <a href="lecturer_completed_student_list.php?id='.$data["ExamID"].'"><button class="btn stubtn">View</button></a></td>
                </tr>';
        echo $row;
    }
?>