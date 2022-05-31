<?php
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

    // get admin id from url
    $adminid = $_GET['id'];

    $sql = "SELECT AdminID, AdminName, AdminEmail, AdminPassword
            FROM admin WHERE AdminID = $adminid";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
    <title>Admin|Profile Edit</title>
</head>
<body>
<?php require "common/header_admin.php"?>
<center><h1 style="font-family: 'Caveat';">Edit Accounts</h1></center>
<div class="container">
    <form class ="was-validated" action="admin_edit_admin_backend.php" method="post">
    <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
    <div class="accountform">
    <div class="mx-auto" style="width:90%">
    <input type="hidden" name="adminid" value = "<?php echo $adminid; ?>"/>
        <p class="text-uppercase fw-bold main-color m-2">
        Admin name
        </p>
        <div class="form-floating">
        <input type="text" class="form-control is-invalid" id="floatingInput" name="adminname" placeholder="Admin Name" required value = "<?php echo $row['AdminName']?>">
        <label class="text-secondary" for="stu-floatingInput">Admin Name</label>
        </div>
    <p class="text-uppercase fw-bold main-color m-2">Admin Email</p>
    <input type="email" class="form-control shadow-sm" id="stu-email-floatingInput" name="adminmail" placeholder="Admin Email" required value = "<?php echo $row['AdminEmail']?>">
    <p class="text-uppercase fw-bold main-color m-2">Password</p>
    <input type="password" class="form-control shadow-sm" id="stu-pw-floatingInput" name="adminpass" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required value = "<?php echo $row['AdminPassword'] ?>">
    <br>
    <div class= "d-flex flex-wrap justify-content-around">
    <button type="submit" value="submit" class="stubtn" style="border:none;">Submit</button>
    </div>
</form>
</body>
</html>

<?php
}
?>