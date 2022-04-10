


<style>
  .footer-container{
    position: static;
    bottom: 0;
    display: flex;
    flex-wrap: wrap;
  }


  .fa {
  padding: 5px;
  font-size: 20px;
  width: 30px;
  text-align: center;
  text-decoration: none;
  border-radius: 50%;
  }

  .fa-facebook {
  background: #3B5998;
  color: white; 
  } 

  .fa-instagram {
  background: #ac2bac;
  color: white; 
  } 

  .fa-google {
  background: #dd4b39;
  color: white; 
  } 
}
</style>
<!-- style="background-color: #c5f2b8" -->
<footer class="text-black text-center text-lg-start" >
  <!-- Grid container -->
  <div class="footer-container  d-flex justify-content-evenly">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col ">
        <img src="img/logo_big_no_text.png"
        class ="w-100"/>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div style = "margin-left: 17%" class="col">
        <h5 class="text-uppercase" style="font-size:20px">Quick Links</h5>

        <ul class="list-unstyled mb-0">
          <li>
            <a href="#!" class="text-blue">Get Started</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Admin login</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Lecturer login</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Student login</a>
          </li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md">
        <h5 class="text-uppercase" style="font-size:20px">Social Media</h5>

        <section class="mb-4">
      <!-- Facebook -->
        <div class="fb" role="button">
        <a href="#" class="fa fa-facebook"></a>Examomo


        </div><br>

      <!-- Instagram -->
      <div class="ig" role="button">
      <a href="#" class="fa fa-instagram"></a>Examomo

      </div><br>

      <!-- Gmail -->
      <div class="gm" role="button">
      <a href="#" class="fa fa-google"></a>Examomo@gmail.com 

      </div><br>

      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3">
    
    <a class="text-black" href="*">Copyright ©2020 Exammomo</a>

    <a style="margin-left: 10%" class="text-black" href="common/PrivacyPolicy.php">Privacy Policy</a>

    <a style="margin-left: 10%" class="text-black" href="common/TermAndCondition.php">Terms and Conditions</a>

  </div>
  <!-- Copyright -->
</footer>

<?php mysqli_close($con);?>

</html>
