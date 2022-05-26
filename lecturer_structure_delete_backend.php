<?php
    require "common/conn.php";
    $paperid = $_GET['paper'];
    $questionid = $_GET['id'];
    $delete ="DELETE FROM question_structure WHERE SQuestionID = $questionid";
    $sql = mysqli_query($con, $delete);

    mysqli_close($con);
    echo '<script>alert("One Structure question deleted successfully.");
    window.location.href = "lecturer_structure_main.php?id='.$paperid.'";
    </script>';
?>