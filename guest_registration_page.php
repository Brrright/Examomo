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
    <link rel="stylesheet" href="css/mingliangCSS.css">

    <title>Examomo | Registration page</title>
</head>
<body>
    <div class="logo-style text-center p-4 m-3" style="font-size:4vw">
        <a href="guest_home_page.php" style="text-decoration:none;">
            <img src="img/logo_small_no_text.png" alt="logo" style="width:6vw; padding-bottom:10px;">
            Examomo - Registration
        </a>
    </div>
    <form class="was-validated" id="registration-form">
        <section class="section-full" id="part1">
            <div class="bg-white-template d-flex mx-auto align-items-center flex-column p-5 m-5">
                <nav class="m-3">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" onclick="page(1, false)">1</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(2, false)">2</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(3, false)">3</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(4, false)">4</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(5, false)">5</a></li>
                    </ul>
                </nav>
                <div class="progress" style="height: 10px; width:80%">
                    <div class="progress-bar" style="width: 1%;"></div>
                </div>
                <div class="sec-template m-5 p-5 d-flex flex-column" style="width:90%">
                    <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                        Step 1 - Organization Details & Admin Account Creation
                    </p>
                    <div class="mx-auto" style="width:90%">
                        <p class="text-uppercase main-color m-2 font-caveat">
                            organization name
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm" id="org-floatingInput" name="organizationName" placeholder="Organization Name" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                            <label class="text-secondary" for="org-floatingInput">Organization Name</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i></div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase main-color m-2 font-caveat">
                            Institution Type
                        </p>
                        <select name="institution" class="form-select fw-light shadow-sm" style="height:58px;" required>
                            <option value="">Please select your Institution Type</option>
                            <option value="Preschool">Preschool</option>
                            <option value="Elementary school">Elementary school</option>
                            <option value="High secondary schools">High secondary school</option>
                            <option value="University">University</option>
                            <option value="Others">Others</option>
                        </select>
                        <div class="invalid-feedback">Please select one of the option.</div>
                    </div>
                    <hr>
                    <div class="mx-auto" style="width:90%">
                        <p class="text-uppercase main-color m-2 font-caveat">
                        admin name
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm" id="adm-floatingInput" name="adminName" placeholder="Admin Name" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                            <label class="text-secondary" for="adm-floatingInput">Admin Name</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase main-color m-2 font-caveat">
                            admin email
                        </p>
                        <div class="form-floating">
                            <input type="email" class="form-control shadow-sm" id="adm-email-floatingInput" name="adminEmail" placeholder="Admin Email" required>
                            <label class="text-secondary" for="adm-email-floatingInput">Admin Email</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase main-color m-2 font-caveat">
                            password
                        </p>
                        <div class="form-floating">
                            <input type="password" class="form-control shadow-sm" id="adm-pw-floatingInput" name="adminPassword" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required>
                            <label class="text-secondary" for="adm-pw-floatingInput">Password</label>
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
                        <p class="text-center text-dark m-3 font-caveat fs-3">more admin account can be created later on :)</p>
                    </div>
                    <button type="button" class="btn third-bg-color font-caveat shadow mx-auto mt-3" style="width:6vw" onclick="page(2, true)">Next</button>
                    <div class="position-fixed bottom-0 end-0 p-3" id="part1-msg"></div>
                </div>
            </div>
        </section>
        <section class="section-full" id="part2">
            <div class="bg-white-template d-flex mx-auto align-items-center flex-column p-5 m-5">
                <nav class="m-3">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" onclick="page(1, false)">1</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(2, false)">2</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(3, false)">3</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(4, false)">4</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(5, false)">5</a></li>
                    </ul>
                </nav>
                <div class="progress" style="height: 8px; width:80%">
                    <div class="progress-bar" style="width: 25%;"></div>
                </div>
                <div class="sec-template m-5 p-5 d-flex flex-column" style="width:90%">
                    <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                        Step 2 - Module Creation
                    </p>
                    <div class="mx-auto" style="width:90%">
                        <p class="text-uppercase main-color m-2 font-caveat">
                            module name
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm" id="mod-floatingInput" name="moduleName" placeholder="Module Name" pattern="[a-zA-Z][a-zA-Z0-9-]{5,}" required>
                            <label class="text-secondary" for="mod-floatingInput">Module Name</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-center text-dark m-3  font-caveat fs-3">more module can be created later on :)</p>
                    </div>
                    <button type="button" class="btn third-bg-color font-caveat shadow mx-auto mt-3" style="width:6vw" onclick="page(3, true)">Next</button>
                    <div class="position-fixed bottom-0 end-0 p-3" id="part2-msg"></div>
                </div>
            </div>
        </section>
        
        <section class="section-full" id="part3">
            <div class="bg-white-template d-flex mx-auto align-items-center flex-column p-5 m-5">
                <nav class="m-3">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" onclick="page(1, false)">1</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(2, false)">2</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(3, false)">3</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(4, false)">4</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(5, false)">5</a></li>
                    </ul>
                </nav>
                <div class="progress" style="height: 8px; width:80%">
                    <div class="progress-bar" style="width: 50%;"></div>
                </div>
                <div class="sec-template m-5 p-5 d-flex flex-column" style="width:90%">
                    <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                        Step 3 - Class Creation
                    </p>
                    <div class="mx-auto" style="width:90%">
                        <p class="text-uppercase main-color m-2 font-caveat">
                            class name
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm" id="cls-floatingInput" name="className" placeholder="Class Name" pattern="[a-zA-Z][a-zA-Z ]{2,}" required>
                            <label class="text-secondary" for="cls-floatingInput">Class Name</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase main-color m-2 font-caveat">
                            RELATED MODULE
                        </p>
                        <select id="module-selection" class="form-select fw-light shadow-sm" style="height:58px;" required>
                            <option value="">Please select the related module</option>
                            
                        </select>
                        <p class="text-center text-dark m-3 font-caveat fs-3">more class can be created later on :)</p>
                    </div>
                    <button type="button" class="btn third-bg-color font-caveat shadow mx-auto mt-3" style="width:6vw" onclick="page(4, true)">Next</button>
                    <div class="position-fixed bottom-0 end-0 p-3" id="part3-msg"></div>
                </div>
            </div>
        </section>
    
        <section class="section-full" id="part4">
            <div class="bg-white-template d-flex mx-auto align-items-center flex-column p-5 m-5">
                <nav class="m-3">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" onclick="page(1, false)">1</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(2, false)">2</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(3, false)">3</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(4, false)">4</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(5, false)">5</a></li>
                    </ul>
                </nav>
                <div class="progress" style="height: 8px; width:80%">
                    <div class="progress-bar" style="width: 75%;"></div>
                </div>
                <div class="sec-template m-5 p-5 d-flex flex-column" style="width:90%">
                    <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                        Step 4 - Lecturer Account Creation
                    </p>
                    <div class="mx-auto" style="width:90%">
                        <p class="text-uppercase main-color m-2 font-caveat">
                            lecturer name
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm" id="lec-floatingInput" name="lecturerName" placeholder="Lecturer Name" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                            <label class="text-secondary" for="lec-floatingInput">Lecturer Name</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase main-color m-2 font-caveat">
                            Gender
                        </p>
                        <fieldset id="lecturer-gender-radio">
                            <div class="d-flex justify-content-around mb-3">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="lecturerGender" value="male" id="check-male" required></input>
                                    <label class="form-check-label" for="check-male">Male</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="lecturerGender" value="female" id="check-female" required></input>
                                    <label class="form-check-label" for="check-female">Female</label>
                                </div>
                            </div>
                        </fieldset>
                        <p class="text-uppercase main-color m-2 font-caveat">
                            lecturer email
                        </p>
                        <div class="form-floating">
                            <input type="email" class="form-control shadow-sm" id="lec-email-floatingInput" name="lecturerEmail" placeholder="Lecturer Email" required>
                            <label class="text-secondary" for="lec-email-floatingInput">Lecturer Email</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase main-color m-2 font-caveat">
                            password
                        </p>
                        <div class="form-floating">
                            <input type="password" class="form-control shadow-sm" id="lec-pw-floatingInput" name="lecturerPassword" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,32}$" required>
                            <label class="text-secondary" for="lec-pw-floatingInput">Password</label>
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
                        <p class="text-uppercase main-color m-2 font-caveat">
                            RELATED CLASS
                        </p>
                        <select id="class-selection" class="form-select fw-light shadow-sm" style="height:58px;" required>
                            <option value="">Please select the related class</option>
    
                        </select>
                        <p class="text-center text-dark m-3 font-caveat fs-3">more class can be linked later on :)</p>
                        <p class="text-center text-dark m-3 font-caveat fs-3">more account can be created later on :)</p>
                    </div>
                    <button type="button" class="btn third-bg-color font-caveat shadow mx-auto mt-3" style="width:6vw" onclick="page(5, true)">Next</button>
                    <div class="position-fixed bottom-0 end-0 p-3" id="part4-msg"></div>
                </div>
            </div>
        </section>
        
        <section class="section-full" id="part5">
            <div class="bg-white-template d-flex mx-auto align-items-center flex-column p-5 m-5">
                <nav class="m-3">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" onclick="page(1, false)">1</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(2, false)">2</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(3, false)">3</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(4, false)">4</a></li>
                        <li class="page-item"><a class="page-link" onclick="page(5, false)">5</a></li>
                    </ul>
                </nav>
                <div class="progress" style="height: 8px; width:80%">
                    <div class="progress-bar" style="width: 99%;"></div>
                </div>
    
                <div class="sec-template m-5 p-5 d-flex flex-column" style="width:90%">
                    <p class="fs-3 fw-bold font-caveat main-color m-3 p-3 text-center" style="text-shadow:0px 2px #707b8b93;">
                        Step 5 - Student Account Creation
                    </p>
                    <div class="mx-auto" style="width:90%">
                        <p class="text-uppercase main-color m-2 font-caveat">
                        Student name
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control shadow-sm" id="stu-floatingInput" name="studentName" placeholder="Student Name" pattern="[a-zA-Z][a-zA-Z ]{5,}" required>
                            <label class="text-secondary" for="stu-floatingInput">Student Name</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase main-color m-2 font-caveat">
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
                        <p class="text-uppercase main-color m-2 font-caveat">
                            student email
                        </p>
                        <div class="form-floating">
                            <input type="email" class="form-control shadow-sm" id="stu-email-floatingInput" name="studentEmail" placeholder="Student Email" required>
                            <label class="text-secondary" for="stu-email-floatingInput">Student Email</label>
                            <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                            <div class="invalid-feedback">Please fill out this field with valid input.</div>
                        </div>
                        <p class="text-uppercase main-color m-2 font-caveat">
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
                        <p class="text-uppercase main-color m-2 font-caveat">
                            RELATED CLASS
                        </p>
                        <select id="class-selection-stu" class="form-select fw-light shadow-sm" style="height:58px;" required>
                            <option value="">Please select the related class</option>
    
                        </select>
                        <p class="text-center text-dark m-3 font-caveat fs-3">more account can be created later on :)</p>
                    </div>

                    <button form="registration-form" type="submit" class="btn third-bg-color font-caveat shadow mx-auto mt-3" style="width:6vw">Submit</button>
                </div>
            </div>
        </section>
    </form>
    <script src="js/mingliangJS.js"></script>
<?php 
    // require "common/footer_admin.php";
    // require "common/footer_student.php";
    // require "common/footer_lecturer.php";
    require "common/footer_guest.php";
?>
</body>
</html>