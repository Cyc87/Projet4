<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Administrateur</title>
</head>

<body>
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

</body>

</html> 