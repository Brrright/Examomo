<?php
    require "common/conn.php";
    if(isset($_SESSION['userID'])){
		header('location:'.$_GET['role'].'_home_page.php');
	}
    // check role and set the variable
    if (isset($_GET['role'])) {
        if ($_GET['role'] == "admin") {
            $role = "Admin";
            $path = "guest_home_page.php";
        }
        else if ($_GET['role'] == "lecturer") {
            $role = "Lecturer";
            $path = "lecturer_home_page.php";
        }
        else if($_GET['role'] == "student") {
            $role = "Student"; 
            $path = "student_home_page.php";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "common/HeadImportInfo.php";
    ?>
    <link rel="stylesheet" href="css/commonCSS.css">
    <link rel="stylesheet" href="css/mingliangCSS.css">

    <title>Examomo | Login page</title>
</head>
<body>
    <div class="logo-style text-center p-4 m-3" style="font-size:4vw">
        <a href="guest_home_page.php" style="text-decoration:none; color:#2B5EA4;">
            <img src="img/logo_small_no_text.png" alt="logo" style="width:6vw; padding-bottom:10px;">
            Examomo - <?php echo $role;?> Login
        </a>
    </div>
    <form class="was-validated" id="login-form">
        <input type="hidden" value="<?php echo $_GET['role'];?>" name="role">
        <div class="d-flex flex-wrap mx-auto justify-content-around align-items-center section-full" style="width:90%">
            <div class="d-flex flex-column mx-auto">
                <img src="img/guest/login_person_icon.png" alt="login icon" >
                <p class="logo-style text-center"><?php echo $role;?> Login</p>
            </div>
            <div class="bg-white d-flex flex-column mx-auto p-5" style="width:60%; border-radius: 15px; box-shadow: 0px 4px 4px 4px #707b8b93;">
                <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                    Organizaiton Name
                </p>
                <div class="form-floating">
                    <input type="text" class="form-control shadow-sm sec-template" id="comNameInput" name="company_name" placeholder="Organization Name" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                    <label class="text-secondary" for="comNameInput">Organizaiton Name</label>
                    <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                    <div class="invalid-feedback">Please fill out this field with valid input.</div>
                </div>
                <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                    <?php echo $role;?> Email
                </p>
                <div class="form-floating">
                    <input  type="email" class="form-control shadow-sm sec-template" id="emailInput" name="email" placeholder="<?php echo $role;?> Email" required>
                    <label class="text-secondary" for="emailInput"><?php echo $role;?> Email</label>
                    <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                    <div class="invalid-feedback">Please fill out this field with valid input.</div>
                </div>
                <p class="text-uppercase fw-bold main-color m-2 font-caveat">
                    password
                </p>
                <div class="form-floating">
                    <input type="password" class="form-control shadow-sm sec-template" id="passwordInput" name="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required>
                    <label class="text-secondary" for="passwordInput">Password</label>
                    <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                    <div class="invalid-feedback">Please fill out this field with valid input.</div>
                </div>
                <button form="login-form" type="submit" class="btn third-bg-color font-caveat shadow mx-auto mt-3 fs-4" style="border-radius: 15px;">Login</button>
            </div>
        </div>
    </form>


    <script src="js/mingliangJS.js"></script>
    <script>
        const loginform = document.getElementById("login-form");
        loginform.noValidate = true;
        loginform.addEventListener("submit",function(event){
            event.preventDefault();
            if (!this.checkValidity()) {
                Swal.fire({
                    title: "Oops...input invalid.",
                    icon: "error",
                    text: "There is invalid or empty input, please make sure every input is valid."
                }) 
                return;
            }
            const form_data = Object.fromEntries(new FormData(event.target).entries());
            fetch ("login_backend.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(form_data)
            })
            .then(function(res) {
                return res.json()
            })
            .then(function(response) {
                if(!response.error) {
                    Swal.fire({
                        title: "Login Successfully",
                        icon: "success",
                        text: "Enjoy Examomo!",
                        showConfirmButton: false,
                        timer:1500
                    }).then(function() {
                        const queryString = window.location.search;
                        const urlParams = new URLSearchParams(queryString);
                        const role = urlParams.get('role');
                        window.location.href = role + "_home_page.php";
                    })
                }
                else {
                    Swal.fire({
                        title: "Oops...Login failed.",
                        icon: "error",
                        text: response.error
                    })
                    return;
                }
            })
        })
    </script>
    <?php 
        require "common/footer_guest.php";
    ?>
</body>
</html>