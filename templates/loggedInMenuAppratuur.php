<nav class="navbar navbar-expand-lg bg-light p-2">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a class="nav-link" href="../loggedinPages/loggedin.php">SportCenter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./categorieen.php">SportApparatuur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../loggedinPages/contact.php">Contact</a>
          </li>

       
        
        </ul>

        <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../loggedinPages/loggedin.php"><strong><?php echo $voornaam." ".$achternaam;?></strong></a></li>
            <li><a class="dropdown-item" href="../loggedinPages/profile/profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="../loggedinPages/log_out.php">Uitloggen</a></li>
          </ul>
        </li>

        </ul>
       
       
    </div>
</nav>