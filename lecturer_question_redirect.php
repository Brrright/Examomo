<?php
    require "common/conn.php";
       // identify if user logged in
       if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }

    $paperid = $_GET['id'];
    $papertype = $_GET['type'];

    if ($papertype =="MCQ") {
        header("Location: lecturer_mcq_main.php?id=".$paperid);
    }
    else {
        header("Location: lecturer_structure_main.php?id=".$paperid);
    }
?>
