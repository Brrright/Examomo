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

    $paperid = $_GET['id'];
    $papertype = $_GET['type'];

    if ($papertype =="MCQ") {
        header("Location: lecturer_mcq_main.php?id=".$paperid);
    }
    else {
        header("Location: lecturer_structure_main.php?id=".$paperid);
    }
?>
