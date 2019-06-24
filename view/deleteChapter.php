<?php $title = 'Suppression des Chapitres'; ?>
        
<?php ob_start(); ?>

<?php include('menuAdmin.php')?>

    <h1 id=titleDelete style="padding-top:90px;text-align:center;"><span class="badge badge-danger">SUPPRESSION DES CHAPITRES</span></h1>
    <section id="deleteChapters" style="margin:auto;width:100%;padding-top:100px;">
        
        <div class="row" id="rowDelete">
            
            <?php
                foreach ($chapter as $chapter) {
            ?>
            <div id="cardText" class="card text-white bg-light mb-3" style="width: 300px;">
                <div class="card-header" style="color:black"><?= $chapter->numberChapter() ?></div>
                <div class="card-body">
                    <h5 class="card-title" style="color:black"><?= $chapter->titleChapter() ?></h5>
                    <a  href="index.php?action=deleteChapter&id=<?= $chapter->id() ?>" style="color:white;text-decoration:none;"class="btn btn-danger">Supprimer</a>
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

<?php $content = ob_get_clean(); ?>

<?php require ('template.php'); ?>