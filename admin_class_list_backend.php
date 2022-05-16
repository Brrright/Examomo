<?php
if (!isset($_SESSION["userID"])) {
    echo '<script>alert("Please login before you access this page.");
    window.location.href="guest_home_page.php";</script>';
}
require  "common/conn.php";
if(isset($_GET['class_name'])) {
    $class_name = $_GET['class_name'];
}
$fetched = mysqli_query($con, "SELECT * FROM class WHERE CompanyID = ".$_SESSION['companyID']." AND ClassName LIKE'%$class_name%'");
$numOfRow = mysqli_num_rows($fetched);

if ($numOfRow === 0) {
    echo '<tr>
        <td colspan="7" align="center">No data Found</td>
    </tr>';
    return;
}
while ($data = mysqli_fetch_array($fetched)) {
    $module_class = mysqli_query($con, "SELECT * FROM module_class WHERE CompanyID = ".$_SESSION['companyID']." AND ClassID = '.$data[ClassID].'");
    if(!$module_class) {
        echo 'Err' .mysqli_error($con);
        break;
    }

    $listOfModuleID = array();
    while ($data_for_module_class = mysqli_fetch_array($module_class)) {
        $ModuleID = $data_for_module_class["ModuleID"];
        array_push($listOfModuleID, $ModuleID);
    }

    $moduleRecord =  mysqli_query($con, "SELECT ModuleName FROM module WHERE CompanyID =  ".$_SESSION['companyID']."");
    if(!$moduleRecord) {
        echo 'Error:'.mysqli_error($con);
        break;
    }

    $moduleString = "";
    while ($dataModule = mysqli_fetch_array($moduleRecord)) {
        $moduleString = $moduleString.$dataModule["ModuleName"]."<br>" ;
    }

    $row = '<tr>
                <td>'.$data["ClassID"].'</td>
                <td>'.$data["ClassName"].'</td>
                <td> '.$moduleString.'</td>
                <td id="'.$data["ClassID"].'">
                    <button class="btn btn-primary" ><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </td>
            </tr>';
    echo $row;
}
?>