<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: admin.php');
    exit();
}
try {
    $bdd= new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$chapter = $bdd->query('SELECT * FROM chapter ORDER BY dateCreationChapter DESC LIMIT 5');

$validation = 0;
$edit_chapter['numberChapter'] = '';
$edit_chapter['titleChapter'] = '';
$edit_chapter['contentChapter'] = '';

$dataSearch['numberChapter'] = '';
$dataSearch['titleChapter'] = '';
$dataSearch['contentChapter'] = '';

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $validation= true;
    $edit_id = htmlspecialchars($_GET['edit']);
    $edit_chapter = $bdd->prepare('SELECT * FROM chapter WHERE id = ?');
    $edit_chapter->execute(array($edit_id));
    if ($edit_chapter->rowCount() == 1) {
        $edit_chapter = $edit_chapter->fetch();
    } else {
        $errorEdit = 'Le chapitre n\'existe pas';
    }
}

if (isset($_GET['dataSearch']) && !empty($_GET['dataSearch'])){
    $dataSearch_id = htmlspecialchars($_GET['dataSearch']);
    $dataSearch = $bdd->prepare('SELECT * FROM chapter WHERE numberChapter LIKE "%'. $dataSearch_id.'%"');
    $dataSearch->execute(array($dataSearch_id));

    if ($dataSearch->rowCount() == 1) {
        $dataSearch = $dataSearch->fetch();
    } else {
        $errorDataSearch = 'Le chapitre n\'existe pas';
    }
}

if (isset($_GET['modif'])) {
    
    $number = htmlspecialchars($_GET['numero_chapitre']);
    $title = htmlspecialchars($_GET['titre_chapitre']);
    $contenu = htmlspecialchars($_GET['contenu_chapitre']);
    $id = $_GET['modif'];
    
    $modification = $bdd->prepare("UPDATE chapter SET numberChapter= :numberChapter, titleChapter= :titleChapter, contentChapter= :contentChapter  WHERE id = :id");
      
    $modification->execute(array(
        'numberChapter' => $number,
        'titleChapter' => $title,
        'contentChapter' => $contenu,
        'id' => $id,
        
    ));
    var_dump($number, $title, $contenu, $id);
    $success = "Votre chapitre a été modifié avec succés !";
    // header('location: modificationChapter.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> 
        <title>Modification des chapitres</title>
    </head>
    <body>
        <?php
            include('menuAdmin.php');
        ?>
        <h1 id="titreModification" style="padding-top:90px;text-align:center;"><span class="badge badge-warning">MODIFICATION CHAPITRES</span></h1>
        <section id="modificationChapters" style="margin:auto;width:100%;margin-top: -50px;">
            <div class="row col-12">
                <?php
                while ($c = $chapter->fetch()) {
                    ?>
                <div id="modification_chapitre" class="card text-center" style="margin:0 auto;">
                    <div style="color:black;padding-bottom:10px;" class="card-header">
                        <?= $c['numberChapter'] ?>
                    </div>
                    <div class="card-body">
                        <h5 style="color:black;" class="card-title"><?= $c['titleChapter'] ?></h5>
                        <a href="modificationChapter.php?edit=<?= $c['id'] ?>" class="btn btn-primary">Editer</a>
                    </div>
                </div>
                <?php 
                }
                    $chapter->closeCursor();
                ?>
            </div>
            <nav class="navbar navbar-light bg-light nav justify-content-center" style="margin-top:50px;">
                <form class="form-inline" method="GET" action="modificationChapter.php?edit="<?=  $c['id']  ?>>
                    <input class="form-control mr-sm-2" style = "text-transform: capitalize;" type="search" placeholder="ChapitreX" aria-label="Search" name="dataSearch">      
                    <button name="search" type="submit" class="btn btn-primary my-2 my-sm-0"><a >Chercher</a></button>       
                </form>
            </nav>
        </section>
        <section id="modification_chapter">
            <form action="modificationChapter.php" method="get" name="modificationChapter">
                <div id="crossCreateChapter">
                    <a href="admin.php">
                        <input id="imgModificationChapter" type="image" alt="image" src="images/croix.png">
                    </a>
                </div>
                <div class="form-group">
                    <label id="chapter" style="color:white">Chapitre : </label>
                    <input type="text" name="numero_chapitre" id="numero_chapitre" class="form-control" placeholder="Chapitre X" <?php if($validation == true) { ?> value="<?= $edit_chapter['numberChapter']?> " <?php } else{ ?> value="<?= $dataSearch['numberChapter']?> " <?php } ?> >
                </div>
                <div class="form-group">
                    <label id="titleChapitre"style="color:white" >Titre :</label>
                    <input type="text" name="titre_chapitre" id="titre_chapitre" class="form-control" placeholder="Titre" <?php if($validation == true) { ?> value="<?= $edit_chapter['titleChapter']?> " <?php } else{ ?> value="<?= $dataSearch['titleChapter']?> " <?php } ?> >
                </div>
                <div class="form-group">
                    <label for="formControlTextarea"></label>
                    <textarea name="contenu_chapitre" id="contenu_chapitre" class="form-control" rows="3"><?php if($validation == true) { ?><?= $edit_chapter['contentChapter']?> <?php } else{ ?><?= $dataSearch['contentChapter']?> <?php } ?></textarea>
                </div>
                
                <button name="modif" type="submit" class="btn btn-warning"><a style="color:white">Modifier / Sauvegarder</a></button>
            
            </form>
        </section>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <p>
            <?php if (isset($errorEdit)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorEdit; ?>
            </div>
            <?php   
            }
            ?>
        </p>
        <p>
            <?php if (isset($errorDataSearch)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorDataSearch; ?>
            </div>
            <?php   
            }
            ?>
        </p>
        <p>
            <?php if (isset($success)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $success; ?>
            </div>
            <?php   
            }
            ?>
        </p>
    </body>
</html>