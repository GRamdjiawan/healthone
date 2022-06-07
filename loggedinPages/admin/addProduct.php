<?php
    session_start();
    include_once('../../dbConnection.php');
    
    if(isset($_POST['voeg'])) {
        $productBestaat = false;
        $success = false;
        $exist = false;
        $NaN = false;
        
        $naam = $_POST['naam'];
        $categorie = $_POST['categorie'];
        $omschrijving = $_POST['omschrijving'];
        $foto = $_FILES['file'];
        
        $fotoName = $foto['name'];
        $fotoDir = 'C:/xampp/htdocs/healthone/img/'.$foto['name'];
        move_uploaded_file($foto['tmp_name'],$fotoDir);
        
        
        
        
        $product = $db->prepare("SELECT * FROM product");
        $product->execute();
        $result = $product->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as &$data) {
            if(($naam == $data['naam']) && ($categorie == $data['categorie_id'])) {
                $productBestaat = true;
            }
            
        }
        
        
        if (($naam == '') ||($foto == '') ||($omschrijving == ''))  {
            $NaN = true;
            
        } else if ($productBestaat == true) {
            $exist = true;
            
        } else{
            
            $voegProduct = $db->prepare("INSERT INTO product (naam, foto, omschrijving, categorie_id) 
            VALUES (:naam, :foto, :omschrijving, :categorie_id )");

            $voegProduct->bindParam("naam", $naam);
            $voegProduct->bindParam("foto", $fotoName);
            $voegProduct->bindParam("omschrijving", $omschrijving);
            $voegProduct->bindParam("categorie_id", $categorie);

            if($voegProduct->execute()) {
                $success = true;
                $naam = '';
                $categorie = '';
                $omschrijving = '';
                $foto = '';


                
            } else {
                echo "Er is een fout opgetreden";
            }
        }


    }else {
        $naam = '';
        $categorie = '';
        $omschrijving = '';
        $foto = '';

        $productBestaat = false;
        $success = false;
        $exist = false;
        $NaN = false;
        
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
            
            include_once('../templates/adminMenu.php');
                
            
            include_once('../templates/banner.php');
        ?>

        <form action="" method="post" enctype="multipart/form-data" class="my-3">
            <div class="row mb-3">
                <div class="form-floating col">
                    <input type="text" name="naam" class="form-control" id="floatingInput" placeholder="Naam" >
                    <label for="floatingInput" class="px-3">Naam</label>
                </div>

                <div class="form-floating col">
                    <select class="form-select" name="categorie" id="floatingSelect" aria-label="Floating label select example">
                        <?php
                            $options = $db->prepare("SELECT * FROM categorie");
                            $options->execute();
                            $result = $options->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as &$data) {
                                echo "<option value='".$data['id']."'>".$data['naam']."</option>";
                            }
                        ?>
                    </select>
                    <label for="floatingSelect">Kies een categorie</label>
                </div>  
            </div>

            <div class="row mb-3">
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="omschrijving" placeholder="omschrijving" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Omschrijving</label>
                </div>
                <div class=" mb-3">
                    <label for="formFile" class="form-label">Foto van het apparaat: </label>
                    <input class="form-control" type="file" id="formFile" name="file">
                </div>  
            </div>
            
            <button type="submit" name="voeg" class="btn btn-success">
                <i class="bi bi-plus-lg"></i>
            </button>
        </form>

    

        <?php

            if ($exist == true){
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Geen ingevulden velden!
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                
                
            }else if($NaN == true) {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Product bestaat al!
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";

            }else if($success == true) {
                $_SESSION['productGevoegd'] = true;
               header('Location: beheer.php');
            }

            echo "<hr>";
            
            include_once('../../templates/footer.php');
            
        ?> 

    </div>  

</body>
</html>