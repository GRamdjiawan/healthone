<?php
    session_start();
    include_once('../dbConnection.php');

    $category = [];
    
    
    $product = $db->prepare("SELECT * FROM categorie");
    $product->execute();
    
    $result = $product->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as &$data) {
    
        array_push($category, $data['naam']);
    
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


            echo "
            <div class='row mx-0 mt-3 px-1'>
            <table class='border-bottom border-darkborder-bottom p-5'>
                <tr>
                    <td class='border-bottom border-dark'>
                        Nr.
                    </td>
                    <td class='border-bottom border-dark'>
                        Naam
                    </td>
                    <td class='border-bottom border-dark'>
                        Categorie
                    </td>
                    <td class='border-bottom border-dark d-flex justify-content-center align-items-center'>
                        Aanpassen
                    </td>
                    <td class='border-bottom border-dark '>
                        Verwijderen
                    </td>
                </tr>";

                $counter = 0;
                
                $product = $db->prepare("SELECT * FROM product");
                $product->execute();
                
                $result = $product->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as &$data) {
                    $counter++;

                    
                    // ik weet niet echt hoe je btn hier kan gebruiken
                    if(($counter % 2) == 0) {
                        echo "
                        <tr class=''>
                            <td>
                                ".$counter."
                            </td>

                            <td>
                                ".$data['naam']."
                            </td>

                            <td>
                                ".$category[($data['categorie_id'] -1)]."
                            </td>

                            <td class=' d-flex justify-content-center align-items-center'>
                                <a href='./editProduct.php?id=".$data['id']."' class='link-success border border-dark px-2'> 
                                    <i class='bi bi-pencil-fill' ></i> 
                                </a>
                            </td>
                            
                            <td class=''>
                                <a href='./deleteProduct.php?id=".$data['id']."' class='link-danger border border-dark px-2'> 
                                    <i class='bi bi-trash3-fill'></i>
                                </a>
                            </td>
                            
                        </tr>
                        ";
                    } else {
                        echo "
                        <tr class='bg-secondary bg-opacity-50'>
                            <td>
                                ".$counter."
                            </td>

                            <td>
                                ".$data['naam']."
                            </td>

                            <td>
                                ".$category[($data['categorie_id'] -1)]."
                            </td>

                            <td class=' d-flex justify-content-center align-items-center'>
                                <a href='./editProduct.php?id=".$data['id']."' class='link-success border border-dark px-2'> 
                                    <i class='bi bi-pencil-fill' ></i> 
                                </a>
                            </td>

                            <td class=''>
                                <a href='./deleteProduct.php?id=".$data['id']."' class='link-danger border border-dark px-2'> 
                                    <i class='bi bi-trash3-fill'></i>
                                </a>
                            </td>

                        </tr>
                        ";
                    }
                    
                }

            
            echo "
            </table> 
            <span class='my-3'>
                <a href='./addProduct.php' class='link-success border border-dark px-2 '>
                    <i class='bi bi-plus-square-fill'></i>
                </a>
            </span>";

            if (isset($_SESSION['productGevoegd'])) {
                echo"
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Product toegevoegd
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>";

                unset($_SESSION['productGevoegd']);
                
            }else if($_SESSION['verwijdert']) {
               
                echo"
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        ".$_SESSION['productNaam']." is verwijdert
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>";

                unset($_SESSION['verwijdert']);
                
               
            } else {

            }
            
            echo "<hr>";
            
            include_once('../templates/footer.php');
            
        ?> 

    </div>  

</body>
</html>