<nav class="navbar navbar-expand-lg bg-light p-2">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a class="nav-link" href="/healthone/loggedinPages/loggedin.php?id=<?php echo $_GET['id'];?>">SportCenter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">SportApparatuur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/healthone/loggedinPages/contact.php?id=<?php echo $_GET['id'];?>">Contact</a>
          </li>

       
        
        </ul>

        <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="./loggedin.php"><strong><?php echo $voornaam." ".$achternaam;?></strong></a></li>
            <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="./log_out.php">Uitloggen</a></li>
          </ul>
        </li>

        </ul>
       
       
    </div>
</nav>