<?php
        require "common/conn.php";

if(!isset($_POST)) {
    '<script>
window.location.href = "logout.php";
</script>';
}
if(!isset($_POST["reason"])) {
    '<script>
window.location.href = "logout.php";
</script>';
}
if(isset($_POST["reason"]) != "break_rule") {
    '<script>
window.location.href = "logout.php";
</script>';
}


$response = [];
// pass company id
$comid = $_SESSION['companyID'];

// retrive id from form
$studentid = $_SESSION['userID'];

$sql ="UPDATE student SET
    isBanned = 1
    WHERE StudentID = '$studentid'";


if (!mysqli_query($con,$sql)) {
    $response["error"] = 'Error: ' . mysqli_error($con);
}

echo json_encode($response);

?>
