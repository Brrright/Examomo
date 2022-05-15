
<footer class="text-black text-center text-lg-start font-caveat fw-bold">
  <hr class="footer-line">
  <!-- Grid container -->
  <div class="footer-container  d-flex justify-content-center ">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col ">
        <img src="img/logo_big_no_text.png"
        class ="w-100"/>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col align-items-center" width ="20%">
        <h5 class="text-uppercase fw-bold" style="font-size:20px">Quick Links</h5>

        <ul class="list-unstyled mb-0">
          <li>
            <a href="guest_registration_page.php" class="text-blue">Get Started</a>
          </li>
          <li>
            <a href="login_page.php?role=admin" class="text-blue">Admin login</a>
          </li>
          <li>
            <a href="login_page.php?role=lecturer" class="text-blue">Lecturer login</a>
          </li>
          <li>
            <a href="login_page.php?role=student" class="text-blue">Student login</a>
          </li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md" width="20%">
        <h5 class="text-uppercase fw-bold align-items-center" style="font-size:20px">Social Media</h5>

        <section class="mb-4">
      <!-- Facebook -->
          <div class="fb hover-shadow" role="button">
            <a href="#" class="bi-facebook"></a> Examomo
          </div>
          <br>

      <!-- Instagram -->
          <div class="ig hover-shadow" role="button">
            <a href="#" class="bi-instagram"></a> Examomo
          </div>
          <br>

      <!-- Gmail -->
          <div class="gm hover-shadow" role="button">
            <a href="#" class="bi-google"></a> Examomo@gmail.com 
          </div>
          <br>

        </section>

      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-2 shadow-lg">
    
    <p class="copyright" style="color:black" >Copyright ©2022 Exammomo</a>

    <a style="margin-left: 10%; color:black" class="text-black hover-shadow" href="PrivacyPolicy.php">Privacy Policy</a>

    <a style="margin-left: 10%; color:black" class="text-black hover-shadow" href="TermAndCondition.php">Terms and Conditions</a>

  </div>
  <!-- Copyright -->
</footer>

<?php mysqli_close($con);?>

</html>
