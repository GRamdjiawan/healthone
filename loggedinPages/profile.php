<?php
    session_start();
    include_once('../dbConnection.php');

    $id = filter_input(INPUT_GET, $_GET['id'], FILTER_VALIDATE_INT);
    $user = $db->prepare("SELECT * FROM user WHERE id = :id");
    $user->bindParam('id', $id);
    $user->execute();
    
    $result = $user->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as &$data) {
        $voornaam = $data['firstname'];
        $achternaam = $data['lastname'];
        $email = $data['email'];
        $wachtwoord = $data['password'];

    
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
            
            include_once('./templates/menu.php');
                
            
            include_once('../templates/banner.php');
            
        ?> 

        <div class="row my-3 border-bottom border-dark">
            <div class="col-md-2">
                Email:
            </div>
            <div class="col-md-4">
                <?php echo $email;?>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <div class="row my-3 border-bottom border-dark">
            <div class="col-md-2">
                Voornaam:
            </div>
            <div class="col-md-4">
                <?php echo $voornaam;?>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <div class="row my-3 border-bottom border-dark">
            <div class="col-md-2">
                Achternaam:
            </div>
            <div class="col-md-4">
                <?php echo $achternaam;?>
            </div>
            <div class="col-md-6">

            </div>
        </div>

       <form action="" method="post">
            <button type="submit" name="profile"class="btn btn-success">Profile aanpassen</button>
            <button type="submit" name="registreer"class="btn btn-danger">Wachtwoord aanpassen</button>
       </form>
        
       

        <!-- <form action="" method="post">
            <div class="row mb-3">
                <div class="form-floating col">
                    <input type="text" name="voornaam" class="form-control" id="floatingInput" placeholder="Kees" value="<?php echo $voornaam;?>">
                    <label for="floatingInput" class="px-3">Voornaam</label>
                </div>
                <div class="form-floating col">
                    <input type="text" name="achternaam" class="form-control" id="floatingPassword" placeholder="de Bakker" value="<?php echo $achternaam;?>">
                    <label for="floatingPassword" class="px-3">Achternaam</label>
                </div>  

            </div>
            <div class="row mb-3">
                <div class="form-floating col">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="naam@email.com" value="<?php echo $email;?>">
                    <label for="floatingInput" class="px-3">E-mailadres</label>
                </div>
                <div class="form-floating col">
                    <input type="password" name="wachtwoord" class="form-control" id="floatingPassword" placeholder="Wachtwoord" value="<?php echo $wachtwoord;?>">
                    <label for="floatingPassword" class="px-3">Wachtwoord</label>
                </div>  

            </div>
            
            <button type="submit" name="registreer"class="btn btn-primary"></button>

        </form> -->

        <?php
          
            
            echo "<hr>";
            
            include_once('../templates/footer.php');
            
        ?> 

    </div>  

</body>
</html>