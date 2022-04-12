<style>
  .footer-container{

    bottom: 0;
    display: flex;
    flex-wrap: wrap;
    box-shadow:  0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding: 30px;
    font-size: 20px;
  }


  .bi-google {
  color: #FF7F50;
  } 


</style>


<footer class="text-black text-center text-lg-start font-caveat fw-bold" >
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
      <div style = "margin-left: 17%" class="col" width ="20%">
        <h5 class="text-uppercase fw-bold" style="font-size:20px">Quick Links</h5>

        <ul class="list-unstyled mb-0">
          <li>
            <a href="#!" class="text-blue">Exams</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Results</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Feedback</a>
          </li>
          <li>
            <a href="#!" class="text-blue">FAQ</a>
          </li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md " width="20%">
        <h5 class="text-uppercase fw-bold" style="font-size:20px">Social Media</h5>

        <section class="mb-4">
      <!-- Facebook -->
        <div class="fb hover-shadow" role="button">
        <a href="#" class="bi-facebook"></a> Examomo


        </div><br>

      <!-- Instagram -->
      <div class="ig hover-shadow" role="button">
      <i href="#" class="bi-instagram"></i> Examomo

      </div><br>

      <!-- Gmail -->
      <div class="gm hover-shadow" role="button">
      <a href="#" class="bi-google"></a> Examomo@gmail.com 

      </div><br>

      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3 vw-100">
    
  <p class="copyright" style="color:black" >Copyright ©2022 Exammomo</a>

  <a style="margin-left: 10%; color:black" class="text-black hover-shadow" href="*">Privacy Policy</a>

  <a style="margin-left: 10%; color:black" class="text-black hover-shadow" href="*">Terms and Conditions</a>

  </div>
  <!-- Copyright -->
</footer>

<?php mysqli_close($con);?>

</html>
