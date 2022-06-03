<?php   
    session_start();
    include_once('../dbConnection.php');

    $id = filter_input(INPUT_GET, $_GET['id'], FILTER_VALIDATE_INT);
    $product = $db->prepare("SELECT * FROM product WHERE id = :id");
    $product->bindParam('id', $id);
    $product->execute();
    $result = $product->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as &$data) {
        $naam = $data['naam'];
        $_SESSION['productNaam'] = $naam;
        $foto = $data['foto'];
    }

    
    if(isset($_POST['verwijder'])) {
        // verwijdert  $foto uit de map img
        unlink("../img/".$foto);
    
        $delete = $db->prepare("DELETE FROM product WHERE id = :id ");
        $delete->bindParam('id', $id);

        if($delete->execute()){

            // error op beheer.php 
            header("Location: ./beheer.php");
            $_SESSION['verwijdert'] = true;
        
        } else {
        }

    } else if(isset($_POST['back'])) {
        header("Location: ./beheer.php");
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
            
            include_once('./templates/adminMenu.php');
                
            
            include_once('../templates/banner.php');
        ?>

        <form action="" method="post"  class="my-3">
            <h2>Wil je de <strong><?php echo $naam;?></strong> verwijderen</h2>
           
            
            <button type="submit" name="back" class="btn btn-success">
                <i class="bi bi-arrow-left"></i>
            </button>
            <button type="submit" name="verwijder" class="btn btn-danger">
                <i class="bi bi-trash3-fill"></i>
            </button>


        </form>

    

        <?php

            
            echo "<hr>";
            
            include_once('../templates/footer.php');
            
        ?> 

    </div>  

</body>
</html>