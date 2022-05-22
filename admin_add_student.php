<?php 
  require "common/conn.php";
?>

<?php
    // get module info
    $classid ="SELECT ClassID, ClassName FROM class WHERE CompanyID =".$_SESSION['companyID']."";
    $result = mysqli_query($con, $classid);
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
    </head>
<body>      
  <?php require "common/header_admin.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Add Student Account</h1></center>
  <div class="container">
    <div class="row g-0">
      <div class="col-sm-2">
        <div class="profilecontainer my-4 shadow p-3 mb-5 font-caveat">
          <div class="pill-nav">
            <a href="admin_student_list.php">View Student List</a>
              <br>
            <a class="active">Add Students</a>
          </div>
        </div>
      </div>
      <div class="col-sm-10">
      <form class="was-validated" action ="admin_add_student_backend.php" method ="post">
        <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
        <div class="studentform">
        <div class="mx-auto" style="width:90%">
                        <p class="text-uppercase fw-bold main-color m-2">
                        Student name
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm" id="stu-floatingInput" name="studentName" placeholder="Student Name" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                            <label class="text-secondary" for="stu-floatingInput">Student Name</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase fw-bold main-color m-2">
                            Gender
                        </p>
                        <fieldset id="stu-gender-radio">
                            <div class="d-flex justify-content-around mb-3">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="studentGender" value="male" id="stu-check-male" required></input>
                                    <label class="form-check-label" for="stu-check-male">Male</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="studentGender" value="female" id="stu-check-female" required></input>
                                    <label class="form-check-label" for="stu-check-female">Female</label>
                                </div>
                            </div>
                        </fieldset>
                        <p class="text-uppercase fw-bold main-color m-2">
                            student email
                        </p>
                        <div class="form-floating" id="email-field">
                            <input type="email" v-model="email" @keyup="checkEmail()" class="form-control shadow-sm" id="stu-email-floatingInput" name="studentEmail" placeholder="Student Email" required>
                            <label class="text-secondary" for="stu-email-floatingInput">Student Email</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                            <span class="text-danger" v-bind:id="[isAvailable?'notavailable':'available']">{{responseMessage}}</span>
                        </div>
                        <p class="text-uppercase fw-bold main-color m-2">
                            password
                        </p>
                        <div class="form-floating">
                            <input type="password" class="form-control shadow-sm" id="stu-pw-floatingInput" name="studentPassword" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required>
                            <label class="text-secondary" for="stu-pw-floatingInput">Password</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <ul class="fw-light">
                            <li>At least one digit</li>
                            <li>At least one lowercase character</li>
                            <li>At least one uppercase character</li>
                            <li>At least one special character</li>
                            <li>At least 8 characters in length, but no more than 32.</li>
                        </ul>
                        <p class="text-uppercase fw-bold main-color m-2">
                            RELATED CLASS
                        </p>
                        <select name="classID" id="class-selection-stu" class="form-select fw-light shadow-sm" style="height:58px;" required>
                            <option value="">Please select the related class</option>
                            <?php
                                while ($data = mysqli_fetch_array($result)) {
                                    $classlist ='<option value ='.$data["ClassID"].'>'.$data["ClassName"].'</option>';
                                    echo $classlist;
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class= "d-flex flex-wrap justify-content-around">
                    <button id="submit-btn" type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
                    </div>
                  </div>
            </div>
        </section>
    </form>
        </div>
      </div>
    </div>
  </div>
  <?php require "common/footer_admin.php"  ?>
  <script src="https://unpkg.com/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/mingliangJS.js"></script>
    <script>
        var app = new Vue({
            el: '#email-field',
            data: {
                email: '',
                isAvailable: 0,
                responseMessage: ''
            },
            methods: {
                checkEmail: function(){
                    var email = this.email.trim();
                    if(email != ''){
                
                    axios.get('backend_check_email.php?role=student', {
                        params: {
                            email: email
                        }
                    })
                    .then(function (response) {
                        app.isAvailable = response.data;
                        if(response.data == 0){
                        app.responseMessage = "";
                        document.getElementById("submit-btn").disabled = false;
                        }else{
                        app.responseMessage = "Email Has been used.";
                        }
                    })
                    .then(function() {
                      var checkEmail = document.getElementById("notavailable");
                      if (checkEmail != null) {
                        document.getElementById("submit-btn").disabled = true;
                      }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    }else{
                        this.responseMessage = "";
                        
                    }
                }
            }
        })
    </script>
</body>
</html>