<?php
if (!isset($_SESSION["userID"])) {
    echo '<script>alert("Please login before you access this page.");
    window.location.href="guest_home_page.php";</script>';
}
require  "common/conn.php";
if(isset($_GET['admin_name'])) {
    $admin_name = $_GET['admin_name'];
}
$fetched = mysqli_query($con, "SELECT * FROM admin WHERE CompanyID = ".$_SESSION['companyID']." AND AdminName LIKE'%$admin_name%'");
$numOfRow = mysqli_num_rows($fetched);

if ($numOfRow === 0) {
    echo '<tr>
        <td colspan="7" align="center">No data Found</td>
    </tr>';
    return;
}
while ($data = mysqli_fetch_array($fetched)) {
    $row = '<tr>
                <td>'.$data["AdminID"].'</td>
                <td>'.$data["AdminName"].'</td>
                <td>'.$data["AdminEmail"].'</td>
                <td>'.$data["AdminPassword"].'</td>
                <td>
                    <a href ="admin_edit_account.php?id='.$data["AdminID"].'" <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button></a>
                    <a href ="admin_delete_account_backend?id='.$data["AdminID"].'"<button class="btn btn-danger delete-confirm"><i class="bi bi-trash"></i></button></a>
                </td>
            </tr>';
    echo $row;
}
?>