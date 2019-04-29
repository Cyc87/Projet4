<?php
session_start();

if (isset($_SESSION['user'])) {
    
    header('Location: admin.php');
    exit();
}
if (!empty($_POST)) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->prepare("SELECT * FROM `users` WHERE username = :username");

    $req->execute(array(
        "username" => $_POST['usernameAdmin']
    ));

    $data = $req->fetch(PDO::FETCH_ASSOC);

    if ($data) 
    {  
        if (password_verify($_POST['password'], $data['password1']))  {
            $_SESSION['user'] = $data['id'];
            header('Location: admin.php');
            exit();
        } else {
            $errorPassword = 'Votre mot de passe est invalide';
        }
    } else {
        $errorUsername = 'Votre login est invalide';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Administrateur</title>
</head>

<body>
    <section id="administration">
        <div id="crossAdmin">
            <a href="index.php">
                <input id="imgAdmin" type="image" alt="image" src="images/croix.png">
            </a>
        </div>
        <form id="formAdmin" action="login.php" method="post">
            <div class="form-group">
                <label for="label"></label>
                <input type="text" class="form-control" name="usernameAdmin" placeholder="Admin" required="">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"></label>
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
                
            </div>
            <button type="submit" class="btn btn-primary">Connection</button>
        </form>
        <p>
            <?php if (isset($erreurUsername)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $erreurUsername; ?>
            </div>
            <?php   
            }
            ?>
        </p>
        <p>
            <?php if (isset($errorPassword)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorPassword; ?>
            </div>
            <?php   
            }
            ?>
        </p>
    </section>

</body>

</html> 