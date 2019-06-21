<?php $title ='Commentaires'; ?>

<?php ob_start(); ?>

    <section>
        <form action="index.php?action=commentChapter&edit=<?= $_GET['edit'] ?>" method="get">
            <div class="card" style="width: 100%;height:auto ">
                <div class="card-body">
                <?php foreach($commentReadChapter as $commentReadChapter) { ?>
                    <h3 class="card-title"><?= $commentReadChapter->numberChapter() ?> </h3>
                    <h1 class="card-subtitle mb-2 text-muted text-center"><?= $commentReadChapter->titleChapter() ?></h1><br/>
                    <p class="card-text text-justify"><?= $commentReadChapter->contentChapter() ?></p>   
                <?php
                    }
                ?>
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
                <form  action="index.php?action=article&edit=<?= $_GET['edit'] ?>" method="post">
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
        <form  action="index.php?action=article&edit=<?= $_GET['edit'] ?>" method="post">
            <?php
                foreach ($commentRead as $commentRead) {
            ?>
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;  margin: auto; margin-top:100px;" >
            <div class="card-header"><?= $commentRead->pseudo() ?></div>
                <div class="card-body">
                    <h5 class="card-title">Le <?= $commentRead->dateTimeComment() ?></h5>
                    <p class="card-text"><?= $commentRead->messageComment() ?></p>
                </div>
                    <a href="index.php?action=article&edit=<?= $_GET['edit'] ?>&signed=<?= $commentRead->id() ?>" name="report" class="btn btn-outline-danger btn-sm" style="color:white">Signaler</a>  
                </div>
            <?php
                }    
            ?>
        </form>      
    </section>
    <section>
        <div>
            <a id="returnHome"class="btn btn-info" style="margin-left:50%;margin-top:100px;margin-bottom:50px;color:white;text-decoration:none;"href="index.php?action=home">Retour à l'accueil</a>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
