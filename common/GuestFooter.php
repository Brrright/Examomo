
<!DOCTYPE html>
  


<head>
</head>

<body>
  <br></br>
</body>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>

<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
  rel="stylesheet"
/>

<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
  .container{
    position: static;
    bottom: 0;
    display: flex;
    flex-wrap: wrap;
  }


  html {
  min-height: 100%;
}

body {
    background-image: linear-gradient( rgb(186, 228, 242),rgb(197, 242, 184));
    height: 100%;
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
  <div class="container">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col ">
        <img src="img/ExamomoLogo_transparent.png"
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

    <a style="margin-left: 10%" class="text-black" href="*">Privacy Policy</a>

    <a style="margin-left: 10%" class="text-black" href="*">Terms and Conditions</a>

  </div>
  <!-- Copyright -->
</footer>

<?php mysqli_close($con);?>

</html>
