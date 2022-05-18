<?php
    if(!isset($_POST))
    return;

    require("common/conn.php");

    $data_received = json_decode(file_get_contents("php://input"), true);
    $data = array();

    
    if($data_received -> query !='') {
        $query = "SELECT * FROM lecturer WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerName LIKE '%".$data_received->query."%' ORDER BY LecturerID DESC";
    }
    else {
        $query = "SELECT * FROM lecturer WHERE CompanyID = ".$_SESSION['companyID']." ORDER BY LecturerID DESC";
    }

    $moduleString = "";
    $fetched = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($fetched)) {
        // GET LECTURER-MODULE RECORD (BY USING LEC ID)
        $module_lecturer = mysqli_query($con, "SELECT * FROM lecturer_module WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerID = ".$row['LecturerID']."");
        if(!$module_lecturer) {
            $data["error"] =  'Error:'.mysqli_error($con);
            break;
        }

        // GET LECTURER-MODULE RECORD (GET MODULE ID)
        $listOfModuleID = array();
        // $numOfLec_Mod = mysqli_num_rows($module_lecturer);
        // echo $numOfLec_Mod;
        while ($data2 = mysqli_fetch_array($module_lecturer)) {
            $moduleID = $data2["ModuleID"];
            array_push($listOfModuleID, $moduleID); //PUSHING ID INTO ARRAY
        }
        // print_r($listOfModuleID);

        // USING MODULE ID FETCED, GET EACH MODULE NAME
        $moduleRecord = mysqli_query($con, "SELECT ModuleName FROM module WHERE CompanyID =  ".$_SESSION['companyID']."");
        if(!$moduleRecord) {
            $data["error"] = 'Error:'.mysqli_error($con);
            break;
        }
        
        while ($dataModule = mysqli_fetch_array($moduleRecord)) {
            $moduleString = $moduleString.$dataModule["ModuleName"]."<br>" ;
        }
        $data[] = $row;
    }
    
    echo json_encode($moduleString);
    echo json_encode($data);
?>