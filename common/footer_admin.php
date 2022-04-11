<style>
  .footer-container{

    bottom: 0;
    display: flex;
    flex-wrap: wrap;
    box-shadow:  0 6px 20px 0 rgba(0, 0, 0, 0.19);
    padding: 30px;
 
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
            <a href="#!" class="text-blue">Manage Students</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Manage Lecturers</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Manage Admins</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Manage Classes</a>
          </li>
          <li>
            <a href="#!" class="text-blue">Manage Modules</a>
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
  <div class="text-center p-3">
    
    <a class="text-black hover-shadow" href="*">Copyright ©2020 Exammomo</a>

    <a style="margin-left: 10%" class="text-black hover-shadow" href="*">Privacy Policy</a>

    <a style="margin-left: 10%" class="text-black hover-shadow" href="*">Terms and Conditions</a>

  </div>
  <!-- Copyright -->
</footer>

<?php mysqli_close($con);?>

</html>
