<?php $title ='Modification des Chapitres'; ?>

    <script>
        tinymce.init({
            selector: 'textarea',
            language : "fr_FR",
            forced_root_block : false,
            force_br_newlines : true,
            force_p_newlines : false

        });
    </script>
    
<?php ob_start(); ?>

<?php include('menuAdmin.php'); ?>

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
        
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>