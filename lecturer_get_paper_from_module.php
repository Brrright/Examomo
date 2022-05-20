<?php
  require "common/conn.php";
  $paperoption = '<option value="">Please select an Exam paper <b>[select a module to activate]</b></option>';
  if ($_GET["moduleID"] == "nodata"){
    echo $paperoption;
    return;
  }

  // identify if user logged in
  if (!isset($_SESSION["userID"])) {
      echo '<script>alert("Please login before you access this page.");
      window.location.href="guest_home_page.php";</script>';
      return;
  }

  if ($_SESSION["userRole"] != "lecturer") {
      echo '<script>alert("You have not access to this page.");
      window.location.href="guest_home_page.php";</script>';
      return;
  }
  //use post to get the module ID selected
  if(isset($_GET['moduleID'])) {
    $mod_id = $_GET['moduleID'];
  }
  else {
    echo '<script>alert("Please enter this page by using correct path.");
    window.location.href="guest_home_page.php";</script>';
    return;
  }

  // fetch all the paper that relates to the module selected
  $sql = "SELECT PaperID, PaperName, PaperType FROM exam_paper WHERE ModuleID = $mod_id";
  $result = mysqli_query($con, $sql);

  if (!mysqli_query($con,$sql)) {
    echo "Error.".mysqli_error($con);
    return;
  }
  // display the option by doing this this
  while ($paperdata = mysqli_fetch_array($result)) {
      $paperoption = $paperoption.'<option value ="'.$paperdata["PaperID"].'">'.$paperdata["PaperName"].' - '.$paperdata["PaperType"].'</option>';
    }
    echo $paperoption;
?>