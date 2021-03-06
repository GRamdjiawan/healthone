<?php
    session_start();
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


    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <div class='container container-xxl p-3 my-5'>
        <?php
            include_once('./templates/header.php');
            include_once('./templates/menu.php');
        ?>
        <div class='row'>
            <img src='./img/healthone-banner.png' class='img-fluid' alt='Health One'>
        </div>
        <div class='row mt-2'>
            <a href='#' class='mb-5'>Home</a> 
            <?php
                if (isset($_SESSION['failedlLogin'])) {
                    echo"
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Niet ingelogd
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>";
                    unset($_SESSION['failedlLogin']);
                } 
            ?>

            <h5> Sportcenter HealthOne</h5> 
            <br>
            <p class='text-break'>
                Fit en gezond zijn is geen vanzelfsprekendheid.
                We moeten er zelf wat voor doen. Goede, gezonde voeding is hiervoor de basis
                Bewegen hoort hier ook bij. Regelmatig bewegen zorgt voor een goede doorbloeding en 
                draagt bij aan ontspanning van lichaam en geest.
                Sporten is goed voor sterkere spieren en voor de conditie. Sportcenter Health One
                heeft verschillende sportapparaten om mee te kunnen werken aan je conditie. 
            </p>
        </div>
        <hr>
        <?php
            include_once('./templates/footer.php');
        ?> 

    </div>  

</body>
</html>