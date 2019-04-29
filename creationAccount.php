<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header('Location: admin.php');
        exit();
    }
    if (!empty($_POST))
    {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    

        $name = trim(htmlspecialchars($_POST['nom']));
        $pseudo = trim(htmlspecialchars($_POST['pseudo']));
        $password1 = trim(htmlspecialchars($_POST['password1']));
        $password2 = trim(htmlspecialchars($_POST['password2']));
        $mail = trim(htmlspecialchars($_POST['mail']));
        $validation = true;

        if (empty($name) || empty($pseudo) || empty($password1) || empty($password2) || empty($mail))
        {
            $errorfields = "Tous les champs sont obligatoires ";
            $validation = false;
        }
        if (strlen($name) > 30) {
            $errorContentName = "Votre nom doit faire moins de 30 caractères";
            $validation = false;
        }
        if(strlen($pseudo) < 3 && strlen($pseudo) >= 20)
        {
            $errorContentPseudo = "Votre pseudo doit être compris entre 3 et 20 caractères";
            $validation = false; 
        }
        if(!empty($_POST['pseudo']))
        {
            $req = $bdd->prepare("SELECT * FROM `users` WHERE pseudo = :pseudo");
            $req->execute(array(
                "pseudo" => $pseudo
            ));
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if ($data == true)
            {
                $errorPseudo = "Pseudo déjà existant";
                $validation = false;
            }
        }
        if (strlen($password1) < 8 && strlen($password1) >= 255) {
            $errorPassword = "Votre mot de passe doit être compris entre 8 et 255 caractères";
            $validation = false;
        }
        if ($password1 != $password2) {
            $errorPasswordDifferent = "Mots de passe différents";
            $validation = false;
        }
        if(!empty($_POST['mail']))
        {
            $req = $bdd->prepare('SELECT * FROM users WHERE mail = :mail');
            $req->execute(array(
                "mail" => $mail
            ));
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if($data == true)
            {
                $errorMail = "Mail déjà existant";
                $validation = false;
            }
        }
        if($validation == true)
        {
            $password1 = password_hash($password1, PASSWORD_DEFAULT);

            $req = $bdd->prepare("INSERT INTO users(username, pseudo, password1, mail) VALUES (?,?,?,?)");
            $req->execute(array(
                $name,
                $pseudo,
                $password1,
                $mail
            ));
            $success = "Votre compte a été crée avec succés !";
            header('Location: index.php');
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <title>Création d'un nouveau compte administrateur</title>
    </head>
    <body>
        <?php 
            include("menuAdmin.php");
        ?>
        <h1 id=titleCreation style="padding-top:90px;text-align:center;"><span class="badge badge-primary">CREATION COMPTE</span></h1>

    <section id="newAccount">
        <div id="crossNewAccount">
            <a href="admin.php">
                <input id="imgNewAccount" type="image" alt="image" src="images/croix.png">
            </a>
        </div>
        <form action="creationAccount.php" method="post" id="formAccount">

            <div class="form-group">
                <label for="inputNom" id="labelAccountName">Nom</label>
                <input type="text" class="form-control" placeholder="Nom" name="nom" value="<?php if (isset($name) and !empty($name)) {
                                                                                                echo $name;
                                                                                            } ?>">
            </div>
            <div class="form-group">
                <label for="inputNom" id="labelAccountPseudo">Pseudo</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Pseudo" name="pseudo" value="<?php if (isset($pseudo)) {
                                                                                                                        echo $pseudo;
                                                                                                                    } ?>">
            </div>
            <div class="form-group">
                <label for="inputPassword" id="labelAccountMdp">Mot de passe</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password1" value="<?php if (isset($password1)) {
                                                                                                                                    echo $password1;
                                                                                                                                } ?>">
            </div>
            <div class="form-group">
                <label for="inputPassword1" id="labelAccountMdp2">Confirmation mot de passe</label>
                <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password2" value="<?php if (isset($password2)) {
                                                                                                                                    echo $password2;
                                                                                                                                } ?>">
            </div>
            <div class="form-group">
                <label for="inputEmail1" id="labelAccountMail">Adresse mail</label>
                <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Entrez email" name="mail" value="<?php if (isset($mail)) {
                                                                                                                                                            echo $mail;
                                                                                                                                                        } ?>">
            </div>
            <button type="submit" class="btn btn-primary">Créer compte</button>
        </form>
        <p>
            <?php if (isset($errorfields)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorfields; ?>
            </div>
            <?php   
            }
            ?>
        </p>
        <p>
            <?php if (isset($errorContentName)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorContentName; ?>
            </div>
            <?php   
            }
            ?>
        </p>
        <p>
            <?php if (isset($errorContentPseudo)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorContentPseudo; ?>
            </div>
            <?php   
            }
            ?>
        </p>
        <p>
            <?php if (isset($errorPseudo)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorPseudo; ?>
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
        <p>
            <?php if (isset($errorPasswordDifferent)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorPasswordDifferent; ?>
            </div>
            <?php   
            }
            ?>
        </p>
        <p>
            <?php if (isset($errorMail)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMail; ?>
            </div>
            <?php   
            }
            ?>
        </p>
        <p>
            <?php if (isset($success)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $success; ?>
            </div>
            <?php   
            }
            ?>
        </p>
    </section>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>