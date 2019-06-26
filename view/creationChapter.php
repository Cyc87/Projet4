<?php $title = 'Création des Chapitres'; ?>
        
<?php ob_start(); ?>
    
    <?php 
        require "menuAdmin.php";
    ?>
    <h1 id="titleCreateChapter" style="padding-top:90px;text-align:center;"><span class="badge badge-success">CREATION CHAPITRE</span></h1>

    <section id="chapters">
        <div id="crossCreateChapter">
            <a href="index.php?action=admin">
                <input id="imgCreateChapter" type="image" alt="image" src="images/croix.png">
            </a>
        </div>
        <form action="index.php?action=creationChapter" method="post" id="creationChapter">
            <div class="form-group">
                <label id="chapter">Chapitre : </label>
                <input type="text" name="numberChapter"  id="numberChapterId" class="form-control" placeholder="Chapitre X" value="<?php if (isset($numberChapter)) {
                                                                                                                                        echo $numberChapter;                                                                                                                    } ?>">
            </div>
            <div class="form-group">
                <label id="titleChapterId">Titre :</label>
                <input type="text" name="titleChapter" id="titleChapter"  class="form-control" placeholder="Titre" value="<?php if (isset($titleChapter)) {
                                                                                                                                    echo $titleChapter;
                                                                                                                                } ?>">
            </div>
            <div class="form-group">
                <label for="formControlTextarea"style="color:white">Contenu :</label>
                <textarea name="contentChapter" id="textareaForm" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" id="createSave" class="btn btn-success">Créer / Sauvegarder</button>

        </form>

        <?php
            if(isset($_SESSION['message'])){
        ?>
            <div class="alert alert-<?=$_SESSION['msg_type'] ?>" style="top: -55px; width: 100%; position: absolute;">
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    }
                ?>
            </div>  
    </section>    
        
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>