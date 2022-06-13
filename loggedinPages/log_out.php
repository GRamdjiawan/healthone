<?php
    session_start();
    include_once('../dbConnection.php');

    if(isset($_SESSION['loggedIn'])){
        if(isset($_POST["ja"])){
            session_destroy();
            header("Location: ../index.php");
        }
        $id = $_SESSION['loggedIn'];
        $users = $db->prepare("SELECT * FROM user WHERE id = :id");
        $users->bindParam("id", $id);
        $users->execute();
        $data = $users->fetch(PDO::FETCH_ASSOC);
        $admin = $data['rollen'];
        if($admin == 'admin') {
            $isAdmin = true;
        } else {
            $isAdmin = false;
        }

        $voornaam = $data['firstname'];
        $achternaam = $data['lastname'];
    } else {
        $_SESSION['failedlLogin'] = true;
        header("Location: ../index.php");
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

            if ($isAdmin == true){
                
        ?>

        <nav class="navbar navbar-expand-lg bg-light p-2">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="./loggedin.php">SportCenter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin/beheer.php">Beheer</a>
                </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ">
                    <a class="nav-link" href="#">Admin Uitloggen</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <?php
            } else {
                include_once('./templates/menu.php');
            }
            include_once('../templates/banner.php');
        ?>
        <div class='row mt-2 text-center'>
            <div class='path mb-2 text-start'>
                <a href='./loggedIn.php'>Home</a> 
                / 
                <a href='#'>log out</a>
            </div>
            <h3>Wilt u uitloggen?</h3>
            <form action="" method="post" class="row">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="submit" name="ja" class="btn btn-success">Ja</button>
                    <a href="./loggedIn.php" class="btn btn-danger">Nee</a>
                </div>

            </form>
        </div>
        <hr>
        <?php        
            include_once('../templates/footer.php');
        ?> 
    </div>  
</body>
</html>