  <nav class="navbar navbar-expand-lg navbar-light blur-bg" id="header">
    <div class="container">
      <!-- Some link need to use if else statement to do, will add on soon (to check session, knowing which role) -->
      <a class="navbar-brand logo-style ms-2" href="guest_home_page.php" style="font-weight: bold; font-family: 'Caveat'; font-size: 32px; color: #2B5EA4; text-shadow: 0px 2px #707b8b93;">
        <img class="navbar-brand" src="img/logo_small_no_text.png" alt="Examomo logo" width="50px" height="50px" >
        Examomo
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navmenu" >
        <ul class="navbar-nav ms-auto mb-2 me-5 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" style="color:#2B5EA4;" href="guest_home_page.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:#2B5EA4; "href="guest_registration_page.php">Company Registration</a>
          </li>
          

        <!-- Drop down Nav Item -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#2B5EA4;">
              <span style="width:30px; height:30px" class="bi bi-person-circle"></span>
              Login as
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="login_page.php?role=student">Student</a></li>
              <li><a class="dropdown-item" href="login_page.php?role=lecturer">Lecturer</a></li>
              <li><hr class="dropdown-divider" style="width:100%"></li>
              <li><a class="dropdown-item" href="login_page.php?role=admin">Admin</a></li>
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

