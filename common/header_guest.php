<nav class="navbar fixed-top navbar-expand-lg">
  <div class="container-fluid">
    <!-- Some link need to use if else statement to do, will add on soon (to check session, knowing if user login onot) -->
    <a class="navbar-brand logo-style ms-2" href="guest_home_page.php">
      <img src="img/logo_small_no_text.png" alt="Examomo logo" width="40px" height="40px" >
      Examomo
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 me-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="guest_home_page.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Company Registration</a>
        </li>
        

      <!-- Drop down Nav Item -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="width:30px; height:30px" class="bi bi-person-circle"></span>
            Login as...
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Student</a></li>
            <li><a class="dropdown-item" href="#">Lecturer</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Admin</a></li>
          </ul>
        </li>
      </ul>

      <!-- Search bar -->
        <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
    </div>
  </div>
</nav>
