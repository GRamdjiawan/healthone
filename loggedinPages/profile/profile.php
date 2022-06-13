<?php
    session_start();
    include_once('../../dbConnection.php');

    $id = $_SESSION['loggedIn'];

    if(isset($id)) {

        $user = $db->prepare("SELECT * FROM user WHERE id = :id");
        $user->bindParam('id', $id);
        $user->execute();
        $data = $user->fetch(PDO::FETCH_ASSOC);
        $voornaam = $data['firstname'];
        $achternaam = $data['lastname'];
        $email = $data['email'];
        $wachtwoord = $data['password'];
    } else {
        
        $_SESSION['failedlLogin'] = true;
        header("Location: ../../index.php");
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


    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>
    <div class='container container-xxl p-3 my-5'>
        <?php
            include_once('../../templates/header.php');
            
            include_once('../templates/profileMenu.php');
                
            
            include_once('../templates/banner.php');
            
        ?> 

        <div class="row my-3 border-bottom border-dark">
            <div class="col-md-2">
                Email:
            </div>
            <div class="col-md-4">
                <b><?=$email?></b>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <div class="row my-3 border-bottom border-dark">
            <div class="col-md-2">
                Voornaam:
            </div>
            <div class="col-md-4">
                <b><?=$voornaam?></b>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <div class="row my-3 border-bottom border-dark">
            <div class="col-md-2">
                Achternaam:
            </div>
            <div class="col-md-4">
                <b><?=$achternaam?></b>
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a href="./edit_profile.php" class="btn btn-success">Profile aanpassen</a>
            <a href="./edit_password.php" class="btn btn-danger">Wachtwoord aanpassen</a>
        </div>
       

        <?php
          
            
            echo "<hr>";
            
            include_once('../../templates/footer.php');
            
        ?> 

    </div>  

</body>
</html>