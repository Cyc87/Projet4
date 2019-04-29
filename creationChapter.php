<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header('Location: admin.php');
        exit();
    }
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    if(!empty($_POST))
    {
        $number=trim(htmlspecialchars($_POST['number_chapter']));
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <title>Création des chapitres</title>
    </head>
    <body>
        <?php 
            include("menuAdmin.php");
        ?>
    <h1 id="titleCreateChapter" style="padding-top:90px;text-align:center;"><span class="badge badge-success">CREATION CHAPITRE</span></h1>

    <section id="chapters">
        <div id="crossCreateChapter">
            <a href="admin.php">
                <input id="imgCreateChapter" type="image" alt="image" src="images/croix.png">
            </a>
        </div>
        <form action="creationChapter.php" method="post" id="creationChapter">
            <div class="form-group">
                <label id="chapter">Chapitre : </label>
                <input type="text" name="number_chapter" style="text-transform: capitalize;" id="numberChapter" class="form-control" placeholder="Chapitre X" value="<?php if (isset($number) and !empty($number)) {
                                                                                                                                        echo $number;
                                                                                                                                    } ?>">
            </div>
            <div class="form-group">
                <label id="titleChapter">Titre :</label>
                <input type="text" name="titleChapter" id="titleChapter" style="text-transform: capitalize;" class="form-control" placeholder="Titre" value="<?php if (isset($title) and !empty($title)) {
                                                                                                                                    echo $title;
                                                                                                                                } ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1"></label>
                <textarea name="contentChapter" id="contentChapter" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Créer / Sauvegarder</button>
        </form>
    </section>    
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>