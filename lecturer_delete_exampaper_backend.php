<?php
    require "common/conn.php";
    $paperid = $_GET['id'];
    $delete ="DELETE FROM exam_paper WHERE PaperID = $paperid";
    $sql = mysqli_query($con, $delete);


    if (!$sql){
        echo '<script>alert("Unable to delete. There are questions inside this paper.");
        window.location.href = "lecturer_exampaper_page.php";
        </script>';
    
    }else{

    mysqli_close($con);
    echo '<script>alert("Exam paper deleted successfully.");
    window.location.href = "lecturer_exampaper_page.php";
    </script>';
    }
?>