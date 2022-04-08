<?php
    require "common/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "common/HeadImportInfo.php";
    ?>
    <link rel="stylesheet" href="css/commonCSS.css">
    <title>Examomo | Guest Home Page</title>
</head>
<body>
    <?php 
        require "common/header_guest.php";
        // require "common/header_admin.php";
        // require "common/header_lecturer.php";
        // require "common/header_student.php";
    ?>
    <div class="d-flex flex-row justify-content-around mx-auto p-3 bg-white-template">
        <div style="width:30%">
            <img src="img/logo_big_with_text.png" alt="examomo logo" >
        </div>
        <div style="width:30%">
            x
        </div>
        <div style="width:30%">
            x
        </div>
    </div>


</body>
</html>