<?php
    session_start();
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $chapters = $bdd->query('SELECT * FROM `chapter` ORDER BY dateCreationChapter');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Jean Forteroche</title>
</head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" style="font-size:40px;" href="#">Jean Forteroche</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" style="font-size:30px;margin-top: 8px;" href="#about">A propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size:30px;margin-top: 8px;" href="#index_Chapters">Chapitres</a>
                        </li>
                    </ul>
                </div>
            </nav>   
        </header>
        <section>
            <picture>
                <img src="images/1.jpg" class="img-fluid" alt="Responsive image">
            </picture>
        </section>
        </div>
        </section>
        <section id="about">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1 id="titleAbout">Jean Forteroche</h1> <br />
                        <h2 id="subtitleAbout"> L'aventurier de l'écriture et du voyage</h2>
                    </div>
                    <p id="textAbout">Quod opera consulta cogitabatur astute, ut hoc insidiarum genere Galli periret avunculus, ne eum ut praepotens acueret in fiduciam exitiosa coeptantem. verum navata est opera diligens hocque dilato Eusebius praepositus cubiculi missus est Cabillona aurum secum perferens, quo per turbulentos seditionum concitores occultius distributo et tumor consenuit militum et salus est in tuto locata praefecti. deinde cibo abunde perlato castra die praedicto sunt mota.
                        Sed quid est quod in hac causa maxime homines admirentur et reprehendant meum consilium, cum ego idem antea multa decreverim, que magis ad hominis dignitatem quam ad rei publicae necessitatem pertinerent? Supplicationem quindecim dierum decrevi sententia mea. Rei publicae satis erat tot dierum quot C. Mario ; dis immortalibus non erat exigua eadem gratulatio quae ex maximis bellis. Ergo ille cumulus dierum hominis est dignitati tributus.
                        Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.
                        Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.
                        Denique Antiochensis ordinis vertices sub uno elogio iussit occidi ideo efferatus, quod ei celebrari vilitatem intempestivam urgenti, cum inpenderet inopia, gravius rationabili responderunt; et perissent ad unum ni comes orientis tunc Honoratus fixa constantia restitisset.</p>
                </div>
            </div>
        </section>

        <section id="chaptersElement">
            <div class="row" id="index_Chapters">
                <h1>CHAPITRES</h1>
                <?php
                    while ($c = $chapters->fetch()) {
                ?>
                <div id="cardText" class="card text-white bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header" style="color:black"><?= $c['numberChapter'] ?></div>
                    <div class="card-body">
                        <h5 class="card-title" style="color:black"><?= $c['titleChapter'] ?></h5>
                        <a  href="commentChapter.php?edit=<?= $c['id'] ?>" style="color:white;text-decoration:none;"class="btn btn-dark">Voir plus...</a>
                    </div>
                </div>
                <?php 
                }
                ?>
                </div>
        </section>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mx-auto">
                        <ul class="list-inline text-center">
                            <h5> Rejoignez-moi : </h5>
                            <li class="list-inline-item">
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-pinterest fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 mx-auto">
                        <ul class="secondary-menu list-inline text-center">
                            <h5>Liens utiles</h5>
                            <li class="list-inline-item">
                                <a href="">Mentions légales</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="admin.php">Admin</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="copyright" class="footer-copyright text-center py-3">© 2019 Copyright:
                <a href=""> cyc-developpement</a>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html> 