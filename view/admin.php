<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <title>Administration</title>
    </head>
       <?php require "view/menuAdmin.php" ?>
    <body>
    <?php
        if(isset($_SESSION['message'])){ ?>
        <div class="alert alert-<?=$_SESSION['msg_type'] ?>" style="top:62px">
    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        }
    ?>
    </div>
    <section id="commentSigned">
        <div class="row col-12">
            <?php
                foreach($comment as $comment) {
            ?>
            <div id="cardText" class="card text-white bg-info" style="width: 500px;height:350px;top:100px;margin-top:20px">
                <div class="card-header" style="color:black"><p><?= $comment->pseudo() ?> a commenté le  <?= $comment->dateTimeComment() ?></p></div>
                    <div class="card-body">
                        <h5 class="card-title" style="color:black"><?= $comment->messageComment() ?></h5>
                    </div>
                    <a href="index.php?action=admin&edit=<?= $comment->id() ?>&supprSigned" class="btn btn-danger" >Supprimer</a>
                    <a href="index.php?action=admin&edit=<?= $comment->id() ?>&restoreSigned" class="btn btn-warning" >Ne pas en tenir compte</a>
                </div>
            <?php
                }
            ?>
                
            </div>
           
        </div>
       
    </section>
     
            
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html> 