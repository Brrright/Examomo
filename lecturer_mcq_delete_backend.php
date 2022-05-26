<?php
    require "common/conn.php";
    $paperid = $_GET['paper'];
    $questionid = $_GET['id'];
    $delete ="DELETE FROM question_multiple_choice WHERE MQuestionID = $questionid";
    $sql = mysqli_query($con, $delete);

    mysqli_close($con);
    echo '<script>alert("One Mcq question deleted successfully.");
    window.location.href = "lecturer_mcq_main.php?id='.$paperid.'";
    </script>';
?>