<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "student") {
        echo '<script>alert("You have not access to this page.");
        window.location.href="logout.php";</script>';
    }

    $paperid = $_GET['id'];
    $papertype = $_GET['type'];
    $examid = $_GET['eid'];

    if ($papertype =="MCQ") {
        header("Location: student_mcq_main.php?id=".$paperid."&eid=".$examid);
    }
    else {
        header("Location: student_structure_main.php?id=".$paperid."&eid=".$examid);
    }
?>
