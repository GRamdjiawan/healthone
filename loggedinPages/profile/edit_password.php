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
        $myPassword = $data['password'];
        if(isset($_POST['editPassword'])){
            $currentPassword = filter_input(INPUT_POST, 'currentPassword', FILTER_SANITIZE_STRING);
            $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
            $repeatNewPassword = filter_input(INPUT_POST, 'repeatNewPassword', FILTER_SANITIZE_STRING);
            if($currentPassword == ''){
                $color = 'danger';
                $status = 'Geen huidig wachtwoord ingevuld';
            }else if($currentPassword === $myPassword) {
                if($newPassword == '' || $repeatNewPassword == ''){
                    $color = 'danger';
                    $status = 'Geen nieuwe wachtwoorden ingevuld';
                }else if($newPassword === $repeatNewPassword) {
                    $updatePasssword = $db->prepare("UPDATE user SET password = :password WHERE id = :id");                                                                                                                       
                    $updatePasssword->bindParam('id', $id);
                    $updatePasssword->bindParam('password', $newPassword);
                    if($updatePasssword->execute()) {
                        $_SESSION['changePassword'] = true;
                        header("Location: ./profile.php");
                    } else {
                        $currentPassword = '';
                        $newPassword = '';
                        $repeatNewPassword = '';
                        $status = "Er is een fout opgetreden";
                        $color = "danger";
                    }
                } else {
                    $color = 'danger';
                    $status = 'Nieuwe wachtwoorden komen niet overeen';
                }
            } else {
                $color = 'danger';
                $status = 'De huidige wachtwoord klopt niet';
            }
        } else {
            $currentPassword = '';
            $newPassword = '';
            $repeatNewPassword = '';
        }
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
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class='container container-xxl p-3 my-5'>
        <?php
            include_once('../../templates/header.php');
            include_once('../templates/profileMenu.php');
            include_once('../templates/banner.php');
        ?> 
        <form action="" method="post" class="mt-5">
            <div class="row mb-3">
                <div class="form-floating ">
                    <input type="password" name="currentPassword" class="form-control" id="floatingInput" placeholder="Huidige Wachtwoord">
                    <label for="floatingInput" class="px-3">Huidige Wachtwoord</label>
                </div>
            </div>
            <div class="row my-3">
                <div class="form-floating col">
                    <input type="password" name="newPassword" class="form-control" id="floatingInput" placeholder="Nieuw Password">
                    <label for="floatingInput" class="px-3">Nieuw Password</label>
                </div>

                <div class="form-floating col">
                    <input type="password" name="repeatNewPassword" class="form-control" id="floatingPassword" placeholder="Herhaal Nieuw Wachtwoord">
                    <label for="floatingPassword" class="px-3">Herhaal Nieuw Wachtwoord</label>
                </div>  
            </div>
            <?php
                if(isset($status)) {
                    echo"
                    <div class='alert alert-".$color." alert-dismissible fade show' role='alert'>
                        ".$status."
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            ?>  
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href="../loggedin.php" class="btn btn-danger">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <button type="submit" name="editPassword"class="btn btn-success">
                    <i class="bi bi-pencil-fill"></i>   
                </button>
            </div>
        </form>
        <hr>
        <?php
            include_once('../../templates/footer.php');
        ?> 
    </div>  
</body>
</html>