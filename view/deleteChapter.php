<?php $title = 'Suppression des Chapitres'; ?>
        
<?php ob_start(); ?>

<?php include('menuAdmin.php')?>

    <h1 id=titleDelete style="padding-top:90px;text-align:center;"><span class="badge badge-danger">SUPPRESSION DES CHAPITRES</span></h1>
    <section id="deleteChapters" style="margin:auto;width:100%;padding-top:100px;">
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
                    <a href="index.php?action=deleteChapter&id=<?= $chapter->id() ?>" class="btn btn-danger">Supprimer</a>
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