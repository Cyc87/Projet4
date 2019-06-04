<?php

    require "Comment.php";
    require "CommentManager.php";


    try {
        $bdd= new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }   


    $edit_chapter = htmlspecialchars($_GET['edit']);

    $chapter = $bdd->prepare('SELECT * FROM chapter WHERE id =?');
    $chapter->execute(array($edit_chapter));
    if ($chapter->rowCount() == 1) {
        $chapter = $chapter->fetch();
    }

    $commentChapter = $bdd->query ('SELECT id, pseudo, messageComment, DATE_FORMAT(dateTimeComment, "%d/%m/%Y à %Hh%i") AS dateTimeComment FROM comment WHERE idCommentChapter= '.$_GET['edit'].' ORDER BY ID DESC LIMIT 0, 5'); 

    if(isset($_POST['validate'])){
  
        if (isset($_POST['pseudo']) &&!empty($_POST['pseudo']) && isset($_POST['message']) &&!empty($_POST['message'])){

            $pseudo = htmlspecialchars($_POST['pseudo']);
            $messageComment = htmlspecialchars($_POST['message']);
            $signalement = "0";
            // $req = $bdd->prepare('INSERT INTO comment (pseudo, messageComment, idCommentChapter ,signalement) VALUES(?, ?, ?, ?)');
            // $req->execute(array($pseudo, $message,$_GET['edit'], $signalement));
            
            $commentManager = new CommentManager();
            $comment = new CommentChapter([
                "pseudo" => $pseudo,
                "messageComment" => $messageComment,
                "idCommentChapter" => $_GET['edit'],
                "signalement" => $signalement,
            ]);
            $commentManager->addComment($comment);
            
            header('Location: commentChapter.php?edit=' . $_GET['edit']);
        }  
    }

    if(isset($_GET['signed'])){
        $signalement = "1";
        $modifSigned_id = $_GET['signed'];
        // $req = $bdd->prepare('UPDATE comment SET signalement= :signalement WHERE id = :id ');
        // $req->execute(array(
        //     'signalement' => $signalement,
        //     'id' => $modifSigned_id,    
        // ));
        $commentManager = new CommentManager();   
        $comment = new CommentChapter([
            'signalement' => $signalement,
            'id' => $modifSigned_id,  
            ]);
        
        $commentManager->updateComment($comment);
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
            <title>Commentaires</title>
        </head>
        <body>
            <section>
                <form action="commentChapter.php?edit=<?= $_GET['edit'] ?>" method="get">
                    <div class="card" style="width: 100%;height:auto ">
                        <div class="card-body">
                            <h6 class="card-title"><?= $chapter['numberChapter']?></h6>
                            <h2 class="card-subtitle mb-2 text-muted text-center"><?= $chapter['titleChapter']?></h2></br>
                            <p class="card-text text-justify"><?= $chapter['contentChapter']?></p>   
                        </div>
                    </div>
                </form>   
            </section>
            <section>
                <div class="card">
                    <div class="card-title">
                        <h1 id=titreCommentaire style="padding-top:90px;text-align:center;"><span class="badge badge-info">Votre commentaire</span></h1>
                    </div>
                    <div class="card-body";>
                        <form  action="commentChapter.php?edit=<?= $_GET['edit'] ?>" method="post">
                            <div class="form-group row">
                                <label for="author" class="col-sm-3 col-form-label"></label>
                                <input type="text" name="pseudo" placeholder="Pseudo" class="form-control col-sm-6">
                            </div>

                            <div class=" form-group row ">
                                <label for="comment" class="col-sm-3 col-form-label"></label>
                                <textarea id="comment" name="message" placeholder="Votre commentaire (Pas plus de 250 caractères...)" class="form-control col-sm-6 "></textarea> 
                            </div>
                            <button type="submit" name="validate" class="btn btn-info" style="margin-left:70%;margin-top:10px;">Valider</button>
                        </form>
                    </div>
                </div>
            </section>
            <section>  
                <form  action="commentChapter.php?edit=<?= $_GET['edit'] ?>" method="post">
                    <?php
                    while ($data = $commentChapter->fetch()) {   
                ?>
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;  margin: auto; margin-top:100px;">
                    <div class="card-header"><?= $data['pseudo'] ?></div>
                        <div class="card-body">
                            <h5 class="card-title">Le <?= $data['dateTimeComment'] ?></h5>
                            <p class="card-text"><?= $data['messageComment'] ?></p>
                        </div>
                            <a href="commentChapter.php?edit=<?= $_GET['edit'] ?>&signed=<?=$data['id'] ?>" name="report" class="btn btn-outline-danger btn-sm" style="color:white">Signaler</a>
                  
                </div>
                <?php
                    }    
                ?>
                </form>      
            </section>
            <div >
               <a class="btn btn-info" style="margin-left:70%;margin-top:100px;margin-bottom:50px;color:white;text-decoration:none;"href="index.php">Retour à l'accueil</a>
            </div>
            
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
    </html>