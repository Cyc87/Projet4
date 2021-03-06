<?php $title = 'Jean Forteroche'; ?>
    
<?php ob_start(); ?>
    <header>
        <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed; width:100%">
            <a class="navbar-brand" style="color:white" href="index.php?action=home">Jean Forteroche</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" style="margin-top: 5px" href="#about">A propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="margin-top: 5px" href="#index_Chapters">Chapitres</a>
                    </li>
                </ul>
            </div>
        </nav>   
    </header>
    <section>
        <picture>
            <img src="images/1.jpg" class="img-fluid1" alt="Responsive image">
        </picture>
    </section>
    
    <section id="about">
        <div class="row">
            <div class="container-fluid">
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
        <div class="row d-flex justify-content-around" id="index_Chapters">
            <h1>CHAPITRES</h1>
            <?php
                foreach ($chapter as $chapter) {
            ?>
            <div class="card text-white bg-light mb-3" style="width: 300px;">
                <div class="card-header" style="color:black"><?= $chapter->numberChapter() ?></div>
                <div class="card-body">
                    <h5 class="card-title" style="color:black"><?= $chapter->titleChapter() ?></h5>
                    <a  href="index.php?action=article&edit=<?= $chapter->id() ?>" style="color:white;text-decoration:none;" class="btn btn-dark">Voir plus...</a>
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
                        <li style="color:white ; font-size:20px" > Rejoignez-moi : </li>
                        <li class="list-inline-item">
                            <a href="index.php?action=home">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="index.php?action=home">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="index.php?action=home">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-pinterest fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="index.php?action=home">
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
                        <li style="color:white ; font-size:20px" > Liens utiles : </li>
                        <li class="list-inline-item" style=" font-size:20px">
                            <a href="index.php?action=home">Mentions légales</a>
                        </li>
                        <li class="list-inline-item" style=" font-size:20px">
                            <a href="index.php?action=login">Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="copyright" class="footer-copyright text-center py-3">© 2019 Copyright:
            <a href=""> cyc-developpement</a>
        </div>
    </footer>
        
<?php $content = ob_get_clean(); ?>

<?php require('template.php') ?>