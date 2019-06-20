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
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <title>Modification des chapitres</title>
        <!-- <script src="tinymce/js/tinymce/tinymce.min.js"></script> -->
        <script>
            tinymce.init({
                selector: 'textarea',
                language : "fr_FR",
                forced_root_block : false,
                force_br_newlines : true,
                force_p_newlines : false

            });
        </script>
    </head>
    <body>
        <?php
            include('menuAdmin.php');
        ?>
        <h1 id="titleModification" style="padding-top:90px;text-align:center;"><span class="badge badge-warning">MODIFICATION CHAPITRES</span></h1>
        <section id="modificationChapters" style="margin:auto;width:100%;margin-top: -50px;">
            <div class="row col-12">
                <?php
                foreach ($chapter as $chapter) {
                    ?>
                <div id="modification_chapitre" class="card text-center" style="margin:0 auto;">
                    <div style="color:black;padding-bottom:10px;width:300px" class="card-header">
                        <?= $chapter->numberChapter() ?>
                    </div>
                    <div class="card-body">
                        <h5 style="color:black;" class="card-title"><?= $chapter->titleChapter() ?></h5>
                        <a  href="index.php?action=modificationChapter&edit=<?= $chapter->id() ?>" class="btn btn-primary">Editer</a>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
        </section>
        <section id="modification_chapter">
            <div id="crossModifChapter">
                <a href="index.php?action=admin">
                    <input id="imgModificationChapter" type="image" alt="image" src="images/croix.png">
                </a>
            </div>
            <form action="index.php?action=modificationChapter&edit=<?= $_GET['edit'] ?>" method="post">
                <?php if(isset($commentModifChapter)){
                    foreach ($commentModifChapter as $commentModifChapter) { ?>
                <div class="form-group">
                    <label id="chapter" style="color:white">Chapitre : </label>
                    <input type="text" name="numberChapter" id="numberChapter" class="form-control" placeholder="Chapitre X" value="<?= $commentModifChapter->numberChapter() ?> " >
                </div>
                <div class="form-group">
                    <label id="titleChapitre"style="color:white" >Titre :</label>
                    <input type="text" name="titleChapter" id="titleChapter" class="form-control" placeholder="Titre" value="<?= $commentModifChapter->titleChapter() ?> " >
                </div>
                <div class="form-group">
                    <label for="formControlTextarea"></label>
                    <textarea name="contentChapter" id="contentChapter" class="form-control" rows="3"><?= $commentModifChapter->contentChapter() ?> </textarea>
                </div>
                <?php
                }
            }
                ?>
                <button  name="modif" type="submit" class="btn btn-warning"><a style="color:white"; >Modifier / Sauvegarder</a></button>
            
            </form>
            <?php
                if(isset($_SESSION['message'])){
            ?>
                <div class="alert alert-<?=$_SESSION['msg_type'] ?>" style="top:-122px">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                }
            ?>
        </section>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>