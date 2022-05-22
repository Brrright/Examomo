<?php
    require "common/conn.php";

    // identify if user logged in
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="guest_home_page.php";</script>';
    }

    $classid = $_GET['id'];

    $check ="SELECT ClassID FROM student WHERE ClassID = $classid";
    $checkrow = mysqli_query($con, $check);
    $checknow = mysqli_num_rows($checkrow);

    if ($checknow !== 0) {
        echo '<script>alert("Cannot delete class when students exist.");
        window.location.href = "admin_class_list.php";
        </script>';
        return;
    }
    
    else {
    $delete ="DELETE FROM class WHERE ClassID = '$classid'";

    $sql = mysqli_query($con, $delete);
    }
    if (!mysqli_query($con,$delete)) {
    die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("All class details deleted successfully.");
    window.location.href = "admin_class_list.php";
    </script>';
    }
?>