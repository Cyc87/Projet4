<?php $title = 'Administrateur'; ?>
<?php ob_start(); ?>

<section id="administration">
    <div id="crossAdmin">
        <a href="index.php?action=home">
            <input id="imgAdmin" type="image" alt="image" src="images/croix.png">
        </a>
    </div>
    <form id="formAdmin" action="index.php?action=login" method="post">
        <div class="form-group">
            <label for="label"></label>
            <input type="text" class="form-control" name="usernameAdmin" placeholder="Admin" required="">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"></label>
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
            
        </div>
        <button type="submit" class="btn btn-primary">Connection</button>
    </form>
    <?php
        if(isset($_SESSION['message'])){
    ?>
        <div class="alert alert-<?=$_SESSION['msg_type'] ?>" style="top:62px">
    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        }
    ?>
</section>


<?php $content = ob_get_clean(); ?>
<?php require('template.php');