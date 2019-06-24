<?php $title = 'Administration'; ?>

<?php ob_start(); ?>

<?php require "view/menuAdmin.php" ?>
    
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
        <div class="row" id="rowcommentSigned">
            <?php
                foreach($comment as $comment) {
            ?>
            <div id="cardText" class="card text-white bg-info" style=";height:350px;top:100px;margin-top:20px">
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
     
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>