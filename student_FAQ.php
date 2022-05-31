<?php
require "common/conn.php";
if (!isset($_SESSION["userID"])) {
    echo '<script>alert("Please login before you access this page.");
    window.location.href="logout.php";</script>';
}

if ($_SESSION["userRole"] != "student") {
    echo '<script>alert("You have not access to this page.");
    window.location.href="logout.php";</script>';
  }
?>

<!DOCTYPE html>
<html>

<head>
    <?php
        require "common/HeadImportInfo.php"
    ?>
    <link rel="stylesheet" href="css/weestyle.css">
    <link rel="stylesheet" href="css/commonCSS.css">

<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Bootstrap CSS -->


<title>Student FAQ</title>

</head>

<body>
    
    <?php
        require "common/header_student.php"

    ?>

<div class="container" style="color: #2B5EA4">
<h2><strong>Frequently Asked Questions (FAQ)</strong></h2>
<h4>Here are some questions to be viewed when using our system :</h4>
</div>
<div class="profilecontainer my-4 shadow p-3 mb-5">
  <div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
        1.What are the system requirements to take the examinations?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
        <div class="accordion-body">
        For the system requirements, students will only need to their internet connections and wamp server to access their profile and take the exams. They would also need to have all recommended files in order for the examination system to work properly.  Any computer which can fulfil these two conditions will be able to take the exams that was set by their lecturers normally.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
        2. How do i change my credentials as a student?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
        <div class="accordion-body">
        As a student, you are unable to change any of your credentials on your own. If you found an misspelled of your name or your email was not the one you put, you can use the feedback function to communicate and relay your inquiries to the admins.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
        3. Am i able to take examinations using other devices than computer?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
        <div class="accordion-body">
        In the current version of this examination system, users are not able to access any of the files that is required to run the system through the use of cellular devices. Every view of the pages had been set so that running on any other devices than computer will greatly reduce the quality and the functionality of the interfaces.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
        4. What will happen if i were to switch tabs during the exam?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
        <div class="accordion-body">
        Students are not advisable to switch to other tabs during the examination process. This is because the system has an implementation whereby if a switch tab were to be detected in the process of the examination, it will give a warning to the user for the first attempt. If a second switch tab detection gets detected, the user will be forced to end their exams and will have their accounts banned.
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
        5. What happens if my account gets banned and how do I regain access?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
        <div class="accordion-body">
        Students who have their account banned will not be able to access the entire system. Students are required to contact their respective organization admin users to reactivate their account to gain access.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingSix">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
        6. How many attempts are available for each examination?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSix">
        <div class="accordion-body">
        Students are able to attempt the exam any number of times as long as the exam is ongoing. If a student were to exit the exam too early before they wanted to, they can take same exam and all their answers will still be present and editable.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
        7. What can i do when i encounter problems during exam?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSeven">
        <div class="accordion-body">
        The system will have a feedback function that is available for the students only. This function allows the students to communicate with the admin if there is any problems that they are facing when using the system. The students will only need to post their troubles to an admin and will get responses back in due time. These responses are all from admins and will not have an automatic responses built in. 
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingEight">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
        8.What happens if my internet connection is disrupted during an examination?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingEight">
        <div class="accordion-body">
        If the student’s internet connection were to be disrupted during the examination, we have a save feature where by a student’s answer will be saved every time they change questions. For example, after finishing question 1 and clicking next to question 2, the question 1’s answer will be saved to the database. Unfortunately, the timer for the examination will still proceed even though disconnection happened.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingNine">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseNine" aria-expanded="false" aria-controls="panelsStayOpen-collapseEight">
        9. Can i reschedule my exam?      </button>
      </h2>
      <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingNine">
        <div class="accordion-body">
        As a student, you are not able to reschedule any examination by yourself. The examinations are all set by time and are only changeable if the lecturer choose to. Only by contacting with your lecturer can a student request the change of time for any exam.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingTen">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTen" aria-expanded="false" aria-controls="panelsStayOpen-collapseNine">
        10. What happens if i were to miss an exam?      </button>
      </h2>
      <div id="panelsStayOpen-collapseTen" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTen">
        <div class="accordion-body">
        As a student, you are not able to reschedule any examination by yourself. The examinations are all set by time and are only changeable if the lecturer choose to. Only by contacting with your lecturer can a student request the change of time for any exam.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingEleven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseEleven" aria-expanded="false" aria-controls="panelsStayOpen-collapseTen">
        11. When can i receive my results after taking an exam?    </button>
      </h2>
      <div id="panelsStayOpen-collapseEleven" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingEleven">
        <div class="accordion-body">
        There are two types of results:
  a.	For MCQ or objective only exams, the results will be immediate, and you can straight view it after your done with any MCQ examinations.
  b.	For structure only exams, the results will only be viewable if the lecturer has finished marking and posted the results themselves.      </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php require "common/footer_student.php"?>

</body>
</html>