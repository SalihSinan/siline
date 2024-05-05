<?php
$lang_selected = "fr";
$title = "Plan";
require_once ("include/header.inc.php");
?>

<h1>Plan du site</h1>

<section id="site-plan">
    <h2>Voici la liste des pages</h2>
    <ol id="site-plan-list">
        <li class="animated-item">
            <a href="index.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <figure class="slide-from-left">
                    <img src="images/acceuil2.png" alt="Accueil" width="100" />
                    <figcaption>Accueil</figcaption>
                </figure>
            </a>
        </li>
        <li class="animated-item">
            <a href="itineraire.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <figure class="slide-from-left">
                    <img src="images/itineraire.png" alt="itineraire" width="100" />
                    <figcaption>Itinéraire</figcaption>
                </figure>
            </a>
        </li>
        <li class="animated-item">
            <a href="depart.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <figure class="slide-from-left">
                    <img src="images/depart.png" alt="Prochain Depart" width="100" />
                    <figcaption>Prochain Depart</figcaption>
                </figure>
            </a>
        </li>
        <li class="animated-item">
            <a href="statistiques.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <figure class="slide-from-left">
                    <img src="images/statistiques.png" alt="Statistiques" width="100" />
                    <figcaption>Statistiques</figcaption>
                </figure>
            </a>
        </li>
        <li class="animated-item">
            <a href="profil.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <figure class="slide-from-left">
                    <img src="images/profil.png" alt="A Propos" width="100" />
                    <figcaption>A propos</figcaption>
                </figure>
            </a>
        </li>
        <li class="animated-item">
            <a href="avis.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <figure class="slide-from-left">
                    <img src="images/avis.png" alt="Avis" width="100" />
                    <figcaption>Avis</figcaption>
                </figure>
            </a>
        </li>
        <li class="animated-item">
            <a href="tech.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <figure class="slide-from-left">
                    <img src="images/tech.png" alt="Avis" width="100" />
                    <figcaption>Tech</figcaption>
                </figure>
            </a>
        </li>
    </ol>
    <div class="train-container1">
        <div class="container1">
            <div class="content1">
                <div class="track"></div>
                <div class="train1">
                    <div class="front"></div>
                    <div class="wheels">
                        <div class="smallOne"></div>
                        <div class="smallTwo"></div>
                        <div class="smallThree"></div>
                        <div class="smallFour"></div>
                        <div class="smallFive"></div>
                        <div class="smallSix"></div>
                        <div class="big"></div>
                    </div>
                    <div class="cord"></div>
                    <div class="coach"></div>
                    <div class="coachTwo"></div>
                    <div class="windows"></div>
                    <div id="up1" class="steam"></div>
                    <div id="up" class="steam2"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include ("include/footer.inc.php"); ?>