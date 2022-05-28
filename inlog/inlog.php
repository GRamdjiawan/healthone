<?php
    session_start();
    
    unset($_SESSION['admin']); 
    include_once('../dbConnection.php');
    
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
        
        $gebruikerBestaat = false;

        $users = $db->prepare("SELECT * FROM user");
        $users->execute();
        
        $result = $users->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as &$data) {

            if (($email == $data['email'])&&($wachtwoord == $data['password'])) {
                
                $gebruikerBestaat = true;
                $userId = $data['id'];
                
                if ($data['rollen'] == 'admin') {
                    $admin = true;
                } else {
                    $admin = false;
                }
            } 
        }
        
        if (($email == '') ||($wachtwoord == ''))  {
            $foutmelding = 'text-danger';
            $gebruikerStatus = 'Geen ingevulde velden';
            
        } else if (($gebruikerBestaat == true)&&($admin == true)) {
            $foutmelding = 'text-success';
            $gebruikerStatus = 'admin';
            
            $_SESSION['admin'] = true;
            
            header("Location: ../loggedinPages/loggedin.php?id=".$userId);
            
        } else if (($gebruikerBestaat == true)&&($admin == false)) {
            $foutmelding = 'text-success';
            $gebruikerStatus = 'gebruiker';
            
            header("Location: ../loggedinPages/loggedin.php?id=".$userId);
            
            
        } else{
            $foutmelding = 'text-danger';
            $gebruikerStatus = 'Gebruiker bestaat niet';
        }
        
        
        
    } else {
        $email = '';
        $wachtwoord = '';
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
                        <a href='#'>Inloggen</a>
                    </div>
                </div>
            ";
        ?>

        <form action="" method="post">
            <div class="row mb-3">
                <div class="form-floating col">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="naam@email.com" >
                    <label for="floatingInput" class="px-3">E-mailadres</label>
                </div>
                <div class="form-floating col">
                    <input type="password" name="wachtwoord" class="form-control" id="floatingPassword" placeholder="Wachtwoord" >
                    <label for="floatingPassword" class="px-3">Wachtwoord</label>
                </div>  

            </div>
            
            <button type="submit" name="login" class="btn btn-primary mb-3">Login</button>
            <p class="<?php echo $foutmelding;?>"><?php echo $gebruikerStatus;?></p>
            <br>

            <a href="./registreer.php">Registreer je hier</a>
            
        </form>

        <?php
                    
            echo "<hr>";
                    
            include_once('../templates/footer.php');

        ?> 

    </div>  

</body>
</html>