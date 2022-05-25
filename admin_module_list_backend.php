<?php
if (!isset($_SESSION["userID"])) {
    echo '<script>alert("Please login before you access this page.");
    window.location.href="guest_home_page.php";</script>';
}

if ($_SESSION["userRole"] != "admin") {
    echo '<script>alert("You have no access to this page.");
    window.location.href="guest_home_page.php";</script>';
}
require  "common/conn.php";
if(isset($_GET['module_name'])) {
    $module_name = $_GET['module_name'];
}
$fetched = mysqli_query($con, "SELECT * FROM module WHERE CompanyID = ".$_SESSION['companyID']." AND ModuleName LIKE'%$module_name%'");
$numOfRow = mysqli_num_rows($fetched);

if ($numOfRow === 0) {
    echo '<tr>
        <td colspan="7" align="center">No data Found</td>
    </tr>';
    return;
}
while ($data = mysqli_fetch_array($fetched)) {
    $module_class = mysqli_query($con, "SELECT * FROM module_class WHERE CompanyID = ".$_SESSION['companyID']." AND ModuleID = ".$data['ModuleID']."");
    if(!$module_class) {
        echo 'Err' .mysqli_error($con);
        break;
    }

    $listOfClassID = array();
    while ($data_for_module_class = mysqli_fetch_array($module_class)) {
        $classID = $data_for_module_class["ClassID"];
        array_push($listOfClassID, $classID);
    }

    $classRecord = mysqli_query($con, "SELECT * FROM class WHERE CompanyID =  ".$_SESSION['companyID']."");
    if(!$classRecord) {
        echo 'Error:'.mysqli_error($con);
        break;
    }
    
    $classString = "";
    $numberOfRecord = count($listOfClassID);
    while ($dataClass = mysqli_fetch_array($classRecord)) {
        for ($x= 0; $x < $numberOfRecord; $x++) {
            if($dataClass["ClassID"] == $listOfClassID[$x]) {
                $classString = $classString.$dataClass["ClassName"]."<br>";
            }
        }
    }
    if ($classString == "") {
        $classString = "(No related class)";
    }
    $row = '<tr>
                <td>'.$data["ModuleID"].'</td>
                <td>'.$data["ModuleName"].'</td>
                <td> '.$classString.'</td>
                <td>
                    <a href = "admin_edit_module.php?id='.$data["ModuleID"].'"<button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button></a>
                    <a href ="admin_delete_module_backend?id='.$data["ModuleID"].'"<button class="btn btn-danger delete-confirm"><i class="bi bi-trash"></i></button></a>
                </td>
            </tr>';
    echo $row;
}
?>