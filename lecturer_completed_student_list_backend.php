<?php
  require "common/conn.php";
  if (!isset($_SESSION["userID"])) {
    echo '<script>alert("Please login before you access this page.");
    window.location.href="guest_home_page.php";</script>';
  }

  if ($_SESSION["userRole"] != "lecturer") {
    echo '<script>alert("You have not access to this page.");
    window.location.href="guest_home_page.php";</script>';
  }


    if(isset($_GET['student_name'])) {
        $student_name = $_GET['student_name'];
    }
    if(isset($_GET['p_id'])) {
        $p_id = $_GET['p_id'];
    }


    // sql for student details who took exam
    $studentfetch= "SELECT student.StudentID, student.StudentName, student.StudentEmail, class.ClassName, class.ClassID, exam_paper.PaperName, module.ModuleName
                    FROM exam 
                    INNER JOIN student ON student.CompanyID = exam.CompanyID
                    INNER JOIN exam_class ON exam_class.ExamID = exam.ExamID
                    INNER JOIN class ON class.ClassID = exam_class.ClassID
                    INNER JOIN exam_paper ON exam.PaperID = exam_paper.PaperID
                    INNER JOIN module ON exam.ModuleID = module.ModuleID
                    WHERE exam.LecturerID = ".$_SESSION['userID']." AND exam.ExamID = ".$_GET['p_id']." AND student.ClassID = exam_class.ClassID AND student.StudentName LIKE'%$student_name%'";
  
    $isfetched = mysqli_query($con, $studentfetch);
    $numOfRow = mysqli_num_rows($isfetched);

    if ($numOfRow === 0) {
        echo '<tr>
            <td colspan="7" align="center">No data Found</td>
        </tr>';
        return;
    }

    while ($data = mysqli_fetch_array($isfetched)) {
        $row = '<tr>
                    <td>'.$data["StudentName"].' <br> '.$data["StudentEmail"].'</td>
                    <td>'.$data["ClassName"].'</td>
                    <td>'.$data["PaperName"].'</td>
                    <td>'.$data["ModuleName"].'</td>
                    <td> <a href="lecturer_marking_main.php?id='.$data2["PaperID"].'&stuid='.$data2['StudentID'].'&eid='.$_GET['id'].'" class="stubtn">View</a></td>
                </tr>';
        echo $row;
    }
  ?>