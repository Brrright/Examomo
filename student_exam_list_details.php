<?php
    if(!isset($_GET))
        return;

    require("common/conn.php");



    $fetch = "SELECT * FROM ((exam 
            INNER JOIN lecturer ON exam.LecturerID = lecturer.LecturerID) 
            INNER JOIN exam_paper ON exam.PaperID = exam_paper.PaperID) WHERE ExamID =$_GET[id]";
    $modaldetails = mysqli_query($con, $fetch);
    if(!$modaldetails) {
        echo 'Err'.mysqli_error($con);

    }
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $date_now = date('Y-m-d H:i:s');
    
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

    while ($details = mysqli_fetch_array($modaldetails)) {
        $start =  $details['ExamStartDateTime'];
        $end = $details['ExamEndDateTime'];

        $difference = timeDiff($start, $end);
        $value = durationformater($difference);  
    ?>

        <table class="table table-borderless text-start">
        <?php    
        echo    '<div class="text-start">
            <tr>
                <td>Exam Name</td>
                <td>'.$details["ExamName"].'</td>
            </tr>
            <tr>
                <td>Exam Description</td>
                <td>'.$details["ExamDescription"].'</td>
            </tr>
            <tr>
                <td>Exam Starts at</td>
                <td>'.$details["ExamStartDateTime"].'</td>
            </tr>
            <tr>
                <td>Exam Ends at</td>
                <td>'.$details["ExamEndDateTime"].'</td>
            </tr>
            <tr>
                <td>Duration</td>
                <td>'.$value.'</td>
            </tr>
            <tr>
                <td>Lecturer Name</td>
                <td>'.$details["LecturerName"].'</td>
            </tr>
            <tr>
                <td>Paper Type</td>
                <td><span id"paper-type">'.$details["PaperType"].'</span></td>
            </tr>
            </div>';
        }
        ?>
        </table>
