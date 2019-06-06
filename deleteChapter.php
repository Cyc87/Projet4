<?php

    session_start();

    require "Chapter.php";
    require "ChapterManager.php";

    require "Comment.php";
    require "CommentManager.php";

    if (!isset($_SESSION['user'])) {
        header('Location: admin.php');
        exit();
    }
    // try {
    //     $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
    // } catch (Exception $e) {
    //     die('Erreur : ' . $e->getMessage());
    // }

    // $chapter = $bdd->query('SELECT * FROM chapter ORDER BY dateCreationChapter');

    $chapterManager = new ChapterManager();       
    $chapter = $chapterManager->readAllChapter();
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $suppr_id = htmlspecialchars($_GET['id']);
        // $supprChapter = $bdd->prepare('DELETE FROM chapter WHERE id = ?');
        // $supprChapter->execute(array($suppr_id));

        // $supprComment = $bdd->prepare('DELETE From comment WHERE id_article = ?');
        // $supprComment->execute(array($suppr_id));

        $deletechapter = new ChapterManager();
        $deletechapter->deletechapter($suppr_id);

        $deleteComment = new CommentManager();
        $deleteComment->deleteCommentSigned($suppr_id);
        
        
        $_SESSION['message'] = "Le chapitre ainsi que les commentaires sont bien supprimés ! ";
        $_SESSION['msg_type'] = "success";

        header('Location:admin.php');
        exit();
    
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
        <title>Suppression Chapitres</title>
    </head>

    <body>

        <?php include('menuAdmin.php')?>

        <h1 id=titreSuppression style="padding-top:90px;text-align:center;"><span class="badge badge-danger">SUPPRESSION DES CHAPITRES</span></h1>
        <section id="suppression_chapitres" style="margin:auto;width:100%;padding-top:100px;">
            <div class="row col-12">
                <?php
                foreach ($chapter as $chapter) {
                    ?>
                <div id="suppresion_chapitre" class="card text-center" style="margin:0 auto;">
                    <div style="color:black;padding-bottom:10px;width:300px" class="card-header">
                        <?= $chapter->numberChapter() ?>
                    </div>
                    <div class="card-body">
                        <h5 style="color:black;" class="card-title"><?= $chapter->titleChapter() ?></h5>
                        <a href="deleteChapter.php?id=<?= $chapter->id() ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </section>
        <?php
            if(isset($_SESSION['message'])){
        ?>
            <div class="alert alert-<?=$_SESSION['msg_type'] ?>" style="top:62px">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            }
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html> 