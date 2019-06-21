<?php $title = 'Création d\'un nouveau compte administrateur'; ?>

<?php ob_start(); ?>

<?php require "menuAdmin.php"; ?>

    <h1 id=titleCreation style="padding-top:90px;text-align:center;"><span class="badge badge-primary">CREATION COMPTE</span></h1>

    <section id="newAccount">
        <div id="crossNewAccount">
            <a href="index.php?action=admin">
                <input id="imgNewAccount" type="image" alt="image" src="images/croix.png">
            </a>
        </div>
        <form action="index.php?action=creationAccount" method="post" id="formAccount">

            <div class="form-group">
                <label for="inputNom" id="labelAccountName">Nom</label>
                <input type="text" class="form-control" placeholder="Nom" name="nom" value="<?php if (isset($name) and !empty($name)) {
                                                                                                echo $name;
                                                                                            } ?>">
            </div>
            <div class="form-group">
                <label for="inputNom" id="labelAccountPseudo">Pseudo</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Pseudo" name="pseudo" value="<?php if (isset($pseudo)) {
                                                                                                                        echo $pseudo;
                                                                                                                    } ?>">
            </div>
            <div class="form-group">
                <label for="inputPassword" id="labelAccountMdp">Mot de passe</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password1" value="<?php if (isset($password1)) {
                                                                                                                                    echo $password1;
                                                                                                                                } ?>">
            </div>
            <div class="form-group">
                <label for="inputPassword1" id="labelAccountMdp2">Confirmation mot de passe</label>
                <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password2" value="<?php if (isset($password2)) {
                                                                                                                                    echo $password2;
                                                                                                                                } ?>">
            </div>
            <div class="form-group">
                <label for="inputEmail1" id="labelAccountMail">Adresse mail</label>
                <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Entrez email" name="mail" value="<?php if (isset($mail)) {
                                                                                                                                                            echo $mail;
                                                                                                                                                        } ?>">
            </div>
            <button type="submit" class="btn btn-primary">Créer compte</button>
        </form>
        <?php
            if(isset($_SESSION['message'])){ ?>
                <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            }
        ?>
    
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>