

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
            include_once('../dbConnection.php');

            include_once('../templates/header.php');
            include_once('../templates/menu.php');
            include_once('../templates/banner.php');

            $id = filter_input(INPUT_GET, $_GET['id'], FILTER_VALIDATE_INT);
            $categorie = $db->prepare("SELECT * FROM categorie WHERE id = :id");
            $categorie->bindParam("id", $id);
            $categorie->execute();

            $result = $categorie->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as &$data) {
                echo "
                <div class='row mt-2'>
                    <div class='path mb-2'>
                        <a href='../index.php'>Home</a> 
                        / 
                        <a href='./categorieen.php'>Categorie</a>
                        /
                        <a href='#'>".$data['naam']."</a>
                    </div>
                </div>
            ";
            }

            
            $categorie = $db->prepare("SELECT * FROM product WHERE categorie_id = :id");
            $categorie->bindParam("id", $id);
            $categorie->execute();

            $result = $categorie->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as &$data) {
                echo "<div class='categorie-items d-flex justify-content-center align-items-center'>";
                echo "<a href='./product.php?id=".$data['id']."' class='d-flex flex-column align-items-center'>";
                echo "<img src='../img/".$data['foto']."' alt='".$data['naam']."' class='img-fluid'>";
    
                echo "<span class='product-naam'>".$data['naam']."</span>";
    
                echo "</a>";
    
                echo "</div>";
            }  
                    
            echo "<hr>";
                    
            include_once('../templates/footer.php');

        ?> 

    </div>  

</body>
</html>