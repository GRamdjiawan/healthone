<?php   
    session_start();
    include_once('../dbConnection.php');

    if(isset($_SESSION['loggedIn'])){
        $id = $_SESSION['loggedIn'];
        $users = $db->prepare("SELECT * FROM user WHERE id = :id");
        $users->bindParam("id", $id);
        $users->execute();
        $data = $users->fetch(PDO::FETCH_ASSOC);
        $admin = $data['rollen'];
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
            include_once('./templates/menu.php');
        ?> 
            
        <div class='row'>
            <img src='../img/healthone-banner.png' class='img-fluid' alt='Health One'>
        </div>

        <div class='row mt-2'>
            <div class='path mb-2'>
                <a href='#'>Home</a> 
                / 
                <a href='#'>Contact</a>
            </div>
        </div>
        <div class="row contact">
        <!-- border border-dark -->
        <div class=" col-md-6  d-flex justify-content-center align-items-center">
            <div class="row px-2">


                <a href="#" class="col-md-3 p-5 m-1 border border-dark d-flex flex-column justify-content-center align-items-center" style="color: black; box-shadow: 1px 1px 10px black; text-decoration: none;">
                    <i class="bi bi-envelope-fill p-1" style="font-size: 3rem; "></i>
                    E-mail
                    
                </a>
                <a href="#" class="col-md-3 p-5 m-1 border border-dark d-flex flex-column justify-content-center align-items-center" style="color: black; box-shadow: 1px 1px 10px black; text-decoration: none;">
                    <i class="bi bi-telephone-fill p-1" style="font-size: 3rem; "></i>
                    Bell ons
                    
                </a>
                <a href="#" class="col-md-3 p-5 m-1 border border-dark d-flex flex-column justify-content-center align-items-center" style="color: black; box-shadow: 1px 1px 10px black; text-decoration: none;">
                    <i class="bi bi-bluetooth p-1" style="font-size: 3rem; "></i>
                    Connect 
                    
                </a>
                <a href="#" class="col-md-3 p-5 m-1 border border-dark d-flex flex-column justify-content-center align-items-center" style="color: black; box-shadow: 1px 1px 10px black; text-decoration: none;">
                    <i class="bi bi-pinterest p-1" style="font-size: 3rem; "></i>
                    Pintrest
                    
                </a>
                <a href="#" class="col-md-3 p-5 m-1 border border-dark d-flex flex-column justify-content-center align-items-center" style="color: black; box-shadow: 1px 1px 10px black; text-decoration: none;">
                    <i class="bi bi-twitter p-1" style="font-size: 3rem; "></i>
                    Twitter

                </a>
                <a href="#" class="col-md-3 p-5 m-1 border border-dark d-flex flex-column justify-content-center align-items-center" style="color: black; box-shadow: 1px 1px 10px black; text-decoration: none;">
                    <i class="bi bi-linkedin p-1" style="font-size: 3rem; "></i>
                    Linkedin
                    
                </a>
                

            </div>
            


        </div>
            
        <div class=" col-md-6 d-flex justify-content-center align-items-center">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe  id="gmap_canvas" 
                    src="https://maps.google.com/maps?q=tinwerf%2010&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">

                    </iframe>
                    <br><style>.mapouter{position:relative;text-align:right;height:100%;width:100%;box-shadow: 1px 1px 10px black;}</style>
                    <style>.gmap_canvas {background:none!important;height:100%;width:100%;}</style>
                    <style>#gmap_canvas {height:500px;width:100%;}</style>
                </div>
            </div>
        </div>

        <?php            
            echo "<hr>";
                    
            include_once('../templates/footer.php');

        ?> 

    </div>  

</body>
</html>