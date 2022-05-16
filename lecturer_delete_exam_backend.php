<?php
    require "common/conn.php";
    $examid = $_GET['id'];
    $delete ="DELETE FROM exam WHERE ExamID = $examid";
    $sql = mysqli_query($con, $delete);

    mysqli_close($con);
    echo '<script>alert("Exam deleted successfully.");
    window.location.href = "lecturer_exam_page.php";
    </script>';
?>