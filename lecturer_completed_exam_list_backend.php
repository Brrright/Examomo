<?php
    require "common/conn.php";

    // identify if user logged in
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="logout.php";</script>';
    }

    if ($_SESSION["userRole"] != "lecturer") {
        echo '<script>alert("You have no access to this page.");
        window.location.href="logout.php";</script>';
    }

    function timeDiff($firstTime,$lastTime){
        // convert to unix timestamps
        $firstTime=strtotime($firstTime);
        $lastTime=strtotime($lastTime);
      
        // perform subtraction to get the difference (in seconds) between times
        $timeDiff=$lastTime-$firstTime;
      
        // return the difference
        return $timeDiff;
      }
      
      function durationformater($timeDiff){
         //Usage :
         // $difference = timeDiff($start,$end);
         $years = abs(floor($timeDiff / 31536000));
         $days = abs(floor(($timeDiff-($years * 31536000))/86400));
         $hours = abs(floor(($timeDiff-($years * 31536000)-($days * 86400))/3600));
         $mins = abs(floor(($timeDiff-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($difference / 60);
         // echo "<p>Time Passed: " . $days . " Days, " . $hours . " Hours, " . $mins . " Minutes.</p>";
         
                
            if ($years > 1) {
                $disyears =  $years . " years";
            }elseif ($years == 1){
                $disyears =  $years . " year";
            }else{
                $disyears = "";
            }

            if ($days > 1) {
                $disdays =  $days . " days";
            }elseif ($days == 1){
                $disdays =  $days . " day";
            }else{
                $disdays = "";
            }


            if ($hours > 1) {
                $dishours =  $hours . " hours";
            }elseif ($hours == 1){
                $dishours =  $hours . " hour";
            }else{
                $dishours = "";
            }

            if ($mins > 1) {
                $dismins =  $mins . " minutes";
            }elseif ($mins == 1){
                $dismins =  $mins . " minute";
            }else{
                $dismins = "";
            }


            $formattedDuration = $disyears ." ". $disdays . " " . $dishours . " " . $dismins ;
            return $formattedDuration;

      
      }

    if(isset($_GET['exam_name'])) {
        $exam_name = $_GET['exam_name'];
    }
    $fetched = mysqli_query($con, "SELECT * FROM exam WHERE CompanyID = ".$_SESSION['companyID']." AND LecturerID = ".$_SESSION['userID']." AND ExamEndDateTime < curtime() AND ExamName LIKE'%$exam_name%'");
    $numOfRow = mysqli_num_rows($fetched);
    if ($numOfRow === 0) {
        echo '<tr>
            <td colspan="7" align="center">No data Found</td>
        </tr>';
        return;
    }
    while ($data = mysqli_fetch_array($fetched)) {
        $start =  $data['ExamStartDateTime'];
        $end = $data['ExamEndDateTime'];

        $difference = timeDiff($start, $end);
        $value = durationformater($difference);
        $row = '<tr>
                    <td>'.$data["ExamName"].'</td>
                    <td>Start : '.$data["ExamStartDateTime"].'<br>End   : '.$data["ExamEndDateTime"].'</td>
                    <td>'.$value.'</td>
                    <td> <a href="lecturer_completed_student_list.php?id='.$data["ExamID"].'"><button class="btn stubtn">View</button></a></td>
                </tr>';
        echo $row;
    }
?>