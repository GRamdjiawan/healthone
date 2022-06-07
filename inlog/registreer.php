<?php
    include_once('../dbConnection.php');
    
    
    if(isset($_POST['registreer'])) {
        $filterVoornaam = filter_input(INPUT_POST, "voornaam");
        $filterAchternaam = filter_input(INPUT_POST, "achternaam");
        $voornaam = strtolower($filterVoornaam);
        $achternaam = strtolower($filterAchternaam);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $wachtwoord1 = filter_input(INPUT_POST, "wachtwoord1");
        $wachtwoord2 = filter_input(INPUT_POST, "wachtwoord2");

        if($wachtwoord1 == $wachtwoord2) {
            $wachtwoord = $wachtwoord1;
            $wachtwoordStatus = true;
        } else {
            $wachtwoordStatus = false;
        }

        $gebruikerBestaat = false;
        $users = $db->prepare("SELECT * FROM user");
        $users->execute();
        $allUsers = $users->fetchAll(PDO::FETCH_ASSOC);
        foreach($allUsers as $data){
            if($email == $data['email']) {
                $gebruikerBestaat = true;
            }
        }

        if (($voornaam == '') ||($achternaam == '') ||($email == '') ||($wachtwoord1 == '')||($wachtwoord2 == ''))  {
            $foutmelding = 'danger';
            $gebruikerStatus = 'Geen ingevulde velden';
            
            $voornaam = '';
            $achternaam = '';
            $email = '';
            $wachtwoord1 = '';
            $wachtwoord2 = '';
        } else if (!$wachtwoordStatus) {
            $foutmelding = 'danger';
            $gebruikerStatus = 'Wachtwoorden komen niet overeen';

            $wachtwoord = '';
            $wachtwoord1 = '';
            $wachtwoord2 = '';
            
        }else if ($gebruikerBestaat == true) {
            $foutmelding = 'danger';
            $gebruikerStatus = 'Deze gegevens bestaan al';
            
            $voornaam = '';
            $achternaam = '';
            $email = '';
            $wachtwoord = '';
            $wachtwoord1 = '';
            $wachtwoord2 = '';
            
        } else{
            $foutmelding = 'success';
            $gebruikerStatus = 'Geregistreerd';
            $rol = 'gebruiker';
            
            $registreer = $db->prepare("INSERT INTO user (firstname, lastname, email, password, rollen) 
            VALUES (:firstname , :lastname, :email, :password, :rollen)");

            $registreer->bindParam("firstname", $voornaam);
            $registreer->bindParam("lastname", $achternaam);
            $registreer->bindParam("email", $email);
            $registreer->bindParam("password", $wachtwoord);
            $registreer->bindParam("rollen", $rol);

            if($registreer->execute()) {
                $voornaam = '';
                $achternaam = '';
                $email = '';
                $wachtwoord = '';
                $wachtwoord1 = '';
                $wachtwoord2 = '';
                
            } else {
                echo "Er is een fout opgetreden";
            }

            }

    } else {
        $voornaam = '';
        $achternaam = '';
        $email = '';
        $wachtwoord = '';
        $wachtwoord1 = '';
        $wachtwoord2 = '';
        
        $gebruikerStatus = '';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthOne</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">


    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class='container container-xxl p-3 my-5'>
        <?php
            include_once('../templates/header.php');
            include_once('../templates/menu.php');
            include_once('../templates/banner.php');

            echo "
                <div class='row mt-2'>
                    <div class='path mb-2'>
                    <a href='../index.php'>Home</a> 
                        / 
                        <a href='./inlog.php'>Inloggen</a>
                        / 
                        Registreer
                    </div>
                </div>
            ";
        ?>

        <form action="" method="post">
            <div class="row mb-3">
                <div class="form-floating col">
                    <input type="text" name="voornaam" class="form-control" id="floatingInput" placeholder="Kees" value="<?php echo ucfirst($voornaam);?>">
                    <label for="floatingInput" class="px-3">Voornaam</label>
                </div>
                <div class="form-floating col">
                    <input type="text" name="achternaam" class="form-control" id="floatingPassword" placeholder="de Bakker" value="<?php echo ucfirst($achternaam);?>">
                    <label for="floatingPassword" class="px-3">Achternaam</label>
                </div>  

            </div>
            <div class="row mb-3">
                <div class="form-floating col">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="naam@email.com" value="<?php echo $email;?>">
                    <label for="floatingInput" class="px-3">E-mailadres</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-floating col">
                    <input type="password" name="wachtwoord1" class="form-control" id="floatingPassword" placeholder="Wachtwoord" value="<?php echo $wachtwoord;?>">
                    <label for="floatingPassword" class="px-3">Wachtwoord</label>
                </div>  
                <div class="form-floating col">
                    <input type="password" name="wachtwoord2" class="form-control" id="floatingPassword" placeholder="Wachtwoord" value="<?php echo $wachtwoord;?>">
                    <label for="floatingPassword" class="px-3">Herhaal uw wachtwoord</label>
                </div>  
            </div>
            
            <button type="submit" name="registreer"class="btn btn-primary">Registreer</button>
            <br>

            <div class='alert alert-<?= $foutmelding?> alert-dismissible fade show' role='alert'>
                <?= $gebruikerStatus?>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>

            <a href="./inlog.php">Login</a>
            
        </form>

        <?php
                    
            echo "<hr>";
                    
            include_once('../templates/footer.php');

        ?> 

    </div>  

</body>
</html>