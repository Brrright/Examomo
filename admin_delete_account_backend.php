<?php
    require "common/conn.php";

    // identify if user logged in
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

    $adminid = $_GET['id'];

    if ($adminid == $_SESSION['userID'] ){
        echo '<script>alert("You cannot delete your own account.");
        window.location.href = "admin_account_list.php";</script>';
        return;
    }
    else{
    $delete ="DELETE FROM admin WHERE AdminID = '$adminid'";

    $sql = mysqli_query($con, $delete);
    }
    if (!mysqli_query($con,$delete)) {
    die('Error: ' . mysqli_error($con));
    }

    else {
    echo '<script>alert("All admin details deleted successfully.");
    window.location.href = "admin_account_list.php";
    </script>';
    }
?>