<?php
    include_once('../dbConnection.php');
    session_start();
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if(isset($_SESSION['loggedIn'])) {
        $loggedInId = $_SESSION['loggedIn']; 
        $user = $db->prepare("SELECT * FROM user WHERE id = :id");
        $user->bindParam('id', $loggedInId);
        $user->execute();
        $data = $user->fetch(PDO::FETCH_ASSOC);
        $voornaam = $data['firstname'];
        $achternaam = $data['lastname'];

        if(isset($_POST['submit'])) {
            $points = $_POST['points'];
            $review = filter_input(INPUT_POST, 'review', FILTER_DEFAULT);
            if($review == '' || $points == 0) {
                $color = 'danger';
                $status = 'Geen ingevoerde velden';
            } else if( $points > 0 && $review !== '') {
                $insertReview = $db->prepare("INSERT INTO reviews (bericht, punten, user_id, product_id) 
                VALUES (:bericht, :punten, :user_id, :product_id)");
                $insertReview->bindParam("bericht", $review);
                $insertReview->bindParam("punten", $points);
                $insertReview->bindParam("user_id", $loggedInId);
                $insertReview->bindParam("product_id", $id);
                if($insertReview->execute()) {
                    $color = 'success';
                    $status = 'Review toegevoegd';
                    $points = 0;
                    $review = '';
                } else {
                    echo "Er is een fout opgetreden";
                }
            }
        } else {
            $color = '';
            $status = '';
            $points = '';
            $review = '';
        }

    } else {
        $loggedInId = '';
    }
    $producten = $db->prepare("SELECT * FROM product WHERE id = :id");
    $producten->bindParam("id", $id);
    $producten->execute();
    $data = $producten->fetch(PDO::FETCH_ASSOC);
    $productNaam = $data['naam'];
    $catId = $data['categorie_id'];
    $categorie = $db->prepare("SELECT * FROM categorie WHERE id = :catId");
    $categorie->bindParam("catId", $catId);
    $categorie->execute();
    $categorieInfo = $categorie->fetch(PDO::FETCH_ASSOC);
    $appratuur = $categorieInfo['naam'];
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
            if(isset($_SESSION['loggedIn'])){
                include_once('../templates/loggedInMenuAppratuur.php');
            } else {
                include_once('../templates/menu.php');
            }
            include_once('../templates/banner.php');
        ?>    
        <div class='row mt-2'>
            <div class='path mb-2'>
                <a href='../index.php'>Home</a> 
                / 
                <a href='./categorieen.php'>Categorie</a>
                /
                <a href='./apparatuur.php?id=<?=$catId?>'><?=$appratuur?></a>
                /
                <?=$productNaam?>
            </div>
        </div>
        <?php    
            $producten = $db->prepare("SELECT * FROM product WHERE id = :id");
            $producten->bindParam("id", $id);
            $producten->execute();
            $data = $producten->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class='product px-3'>
            <img src="../img/<?= $data['foto']?>" alt="<?=$data['naam']?>" class='img-fluid h-50' ><br>
            <h4><?= $data['naam']?></h4>
            <p><?= $data['omschrijving']?></p>
        </div>
        <?php
            if(isset($_SESSION['loggedIn'])){
        ?>
        
        <div class="row d-flex justify-content-center align-items-center">
            <form action=" " method="post" class="w-50 ">
                <div class="row">
                    <div class="col-md-6 d-f"><b>Voornaam: </b><?= ucfirst($voornaam)?></div>
                    <div class="col-md-6"><b>Achternaam: </b><?= ucfirst($achternaam)?></div>
                </div>
                <select class="form-select" name="points" aria-label="Default select example" value="<?=$points?>">
                    <option selected>Aantal punten</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <div class="form-floating">
                    <textarea class="form-control" name="review" placeholder="Review" id="floatingTextarea">
                    </textarea>
                    <label for="floatingTextarea">Review</label>
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" name="submit" class="btn btn-warning ">
                        <i class="bi bi-star"></i>    
                    </button>
                </div>
            </form>
        </div>
        <?php
            echo"
                <div class='alert alert-".$color." alert-dismissible fade show' role='alert'>
                ".$status."
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            } else{
        ?>
        <p>
            Wil je een review achter laten?
            <a href="../inlog/inlog.php">Log dan eerst in</a>
        </p>
        <?php
            }
            echo "<div class='row mx-0 my-5'py-4>";
            $reviews = $db->prepare("SELECT * FROM reviews WHERE product_id = :id");
            $reviews->bindParam("id", $id);
            $reviews->execute();
            $result = $reviews->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as &$data) {
                $user = $db->prepare("SELECT * FROM user WHERE id = :id");
                $user->bindParam("id", $data['user_id']);
                $user->execute();
                $user = $user->fetch(PDO::FETCH_ASSOC);
                echo "<span class='name py-1 border border-dark bg-secondary bg-opacity-50'><b>".ucfirst($user['firstname'])."</b> <b>".ucfirst($user['lastname'])."</b>";
                
                echo " (". $data['datum'].") </span>
                    <div class='bottom-review py-1 border-end border-bottom border-start border-dark'>
                    <span class='bericht'>". ucfirst($data['bericht'])."</span>
                    <br>
                    <span class='stars'> ".$data['punten']."/5 punten</span>
                    </div>
                ";
            }
            echo "</div>";
            echo "<hr>";
            include_once('../templates/footer.php');
        ?> 
    </div>  
</body>
</html>