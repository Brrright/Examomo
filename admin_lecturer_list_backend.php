<?php
require  "common/conn.php";
    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "admin") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }
if(isset($_GET['lecturer_name'])) {
    $lecturer_name = $_GET['lecturer_name'];
}
$fetched = mysqli_query($con, "SELECT * FROM lecturer WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerName LIKE'%$lecturer_name%'");
$numOfRow = mysqli_num_rows($fetched);
if ($numOfRow === 0) {
    echo '<tr>
        <td colspan="7" align="center">No data Found</td>
    </tr>';
    return;
}
while ($data = mysqli_fetch_array($fetched)) {
    // GET LECTURER-MODULE RECORD (BY USING LEC ID)
    $module_lecturer = mysqli_query($con, "SELECT * FROM lecturer_module WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerID = ".$data['LecturerID']."");
    if(!$module_lecturer) {
        echo 'Error:'.mysqli_error($con);
        break;
    }

    // GET LECTURER-MODULE RECORD (GET MODULE ID)
    $listOfModuleID = array();

    while ($data2 = mysqli_fetch_array($module_lecturer)) {
        $moduleID = $data2["ModuleID"];
        array_push($listOfModuleID, $moduleID); //PUSHING ID INTO ARRAY
    }
        // print_r($listOfModuleID);

    // USING MODULE ID FETCHED, GET EACH MODULE NAME
    $moduleRecord = mysqli_query($con, "SELECT * FROM module WHERE CompanyID =  ".$_SESSION['companyID']."");
    if(!$moduleRecord) {
        echo 'Error:'.mysqli_error($con);
        break;
    }

    // CONCATENATE MODULE NAME IN A STRING
    // echo $numOfModule;
    $moduleString = "";
    $numberOfRecord = count($listOfModuleID);
    $numOfModule = mysqli_num_rows($moduleRecord);
    while ($dataModule = mysqli_fetch_array($moduleRecord)) {
        for ($x= 0; $x < $numberOfRecord; $x++) {
            if($dataModule["ModuleID"] == $listOfModuleID[$x]) {

                $moduleString = $moduleString.$dataModule["ModuleName"]."<br>" ;
            }
        }
    }
        $row = '<tr>
        <td>'.$data["LecturerID"].'</td>
        <td>'.$data["LecturerName"].'</td>
        <td>'.$data["LecturerGender"].'</td>
        <td>'.$data["LecturerEmail"].'</td>
        <td>'.$data["LecturerPassword"].'</td>
        <td> '.$moduleString.'</td>
        <td id="'.$data["LecturerID"].'">
            <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
        </td>
        </tr>';
        echo $row;
}
?>