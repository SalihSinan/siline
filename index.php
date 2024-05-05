<?php
$lang_selected = "fr";
$title = "Home";
require_once ("include/header.inc.php");
require_once ("include/functions.inc.php");
?>

<div class="text-overlay">
    <img src="images/train.png" alt="Bienvenue sur notre site de trains" width="1300" height="650" />
    <h1>Sur SiLine recherchez <span id="dynamicText">vos itinéraires</span></h1>

    <div class="search-bar">
        <label for="searchInput">Recherche :</label>
        <input type="text" id="searchInput" placeholder="Rechercher une page...">
        <button onclick="search()">Rechercher une page sur le site</button>
    </div>
</div>


<?php
$images = [
    "photos/image_trainvert.png",
    "photos/image_trainbleu.png",
    "photos/image_trainjaune.png",
    "photos/image_trainrouge.png"
];
$selectedImage = choisir_image_aléatoire($images);
?>

<img id="Train" src="<?php echo $selectedImage; ?>" alt="Train" width="500" height="200" />


<section>
    <h2>Planifiez vos voyages en toute simplicité avec nos horaires de trains! Ne soyez plus jamais en retards!
    </h2>
    <p>Explorez notre site pour découvrir des informations essentielles sur les itinéraires, les horaires de
        trains et les gares, et dites adieu aux retards avec une planification sans faille!</p>
</section>

<section>
    <h2>Nos Grandes Gares</h2>
    <div class="gare-container">
        <div class="gare">
            <a href="https://www.garesetconnexions.sncf/fr/gares-services/paris-gare-lyon" target="_blank">
                <img src="images/paris.png" alt="Gare de Lyon" />
            </a>
            <h3>Gare de Lyon</h3>
            <p>La Gare de Lyon est l'une des plus grandes gares ferroviaires de Paris, située dans le 12e
                arrondissement. Elle dessert principalement les destinations du sud-est de la France. Pour plus
                d'informations, nous vous dirigeons vers le site officiel de la RATP.</p>
        </div>
        <div class="gare">
            <a href="https://www.garesetconnexions.sncf/fr/gares-services/marseille-saint-charles" target="_blank">
                <img src="images/marseille.png" alt="Gare de Marseille Saint-Charles" />
            </a>
            <h3>Gare de Marseille Saint-Charles</h3>
            <p>La Gare de Marseille Saint-Charles est la principale gare ferroviaire de Marseille, desservant
                des
                destinations nationales et internationales. Elle est située dans le 1er arrondissement. Pour
                plus
                d'informations, nous vous dirigeons vers le site officiel de la RATP.</p>
        </div>
        <div class="gare">
            <a href="https://www.westfield.com/france/forumdeshalles" target="_blank">
                <img src="images/chatelet.png" alt="Gare de Châtelet - Les Halles" />
            </a>
            <h3>Gare de Châtelet - Les Halles</h3>
            <p>La Gare de Châtelet - Les Halles est l'une des plus grandes stations souterraines de métro et RER
                de
                Paris, située dans le 1er arrondissement. Elle est également un important pôle d'échange. Pour
                plus
                d'informations, nous vous dirigeons vers le site officiel de la RATP.</p>
        </div>
    </div>
</section>


<section>
    <h2>Les Gares aux Alentours</h2>
    <div class="gare-container">
        <div class="gare">
            <a href="https://www.transilien.com/fr/gare/cergy-le-haut-8738265" target="_blank">
                <img src="images/cergy_le_haut.png" alt="Gare de Cergy-le-Haut" />
            </a>
            <h3>Gare de Cergy-le-Haut</h3>
            <p>La Gare de Cergy-le-Haut est une importante gare ferroviaire de la ligne L du Transilien, et du
                rer A.
                Située dans le quartier du même nom, elle dessert Cergy et ses environs. C'est le terminus des
                trains
                deservie paar cergy prefecture. Pour plus d'informations, nous vous dirigeons vers le site
                officiel de
                Transilien.</p>
        </div>
        <div class="gare">
            <a href="https://www.transilien.com/fr/gare/cergy-prefecture-8738190" target="_blank">
                <img src="images/cergy_prefecture.png" alt="Gare de Cergy-Préfecture" />
            </a>
            <h3>Gare de Cergy-Préfecture</h3>
            <p>La Gare de Cergy-Préfecture est une gare SNCF et RATP située dans le quartier de
                Cergy-Préfecture. Elle
                est desservie par le RER A, du transilien L, et plusieurs lignes de bus. C'est également la gare
                la plus
                proche de notre établissement. Pour plus d'informations, nous vous dirigeons vers le site
                officiel de
                Transilien.</p>
        </div>
        <div class="gare">
            <a href="https://www.transilien.com/fr/gare/cergy-saint-christophe-8738249" target="_blank">
                <img src="images/cergy_saint_cristophe.png" alt="Gare de Cergy-Saint-Christophe" />
            </a>
            <h3>Gare de Cergy-Saint-Christophe</h3>
            <p>La Gare de Cergy-Saint-Christophe est une gare ferroviaire de la ligne L du Transilien, située
                dans le
                quartier de Cergy-Saint-Christophe. Elle dessert la région de Cergy. Pour plus d'informations,
                nous vous
                dirigeons vers le site officiel de Transilien.</p>
        </div>
    </div>
</section>

<section>
    <h2>Explorez Notre Site</h2>
    <div class="page-container">
        <div class="page">
            <a href="depart.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <img src="images/depart.png" alt="Page Départ" width="20" height="20" />
            </a>
            <h3>Départ</h3>
            <p>Consultez les horaires de départ des trains depuis les grandes gares.</p>
        </div>
        <div class="page">
            <a href="profil.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <img src="images/propos.png" alt="Page Profil" width="20" height="20" />
            </a>
            <h3>A propos</h3>
            <p>Découvrez des informations sur les utilisateurs et sur le site.</p>
        </div>
        <div class="page">
            <a href="itineraire.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <img src="images/itineraire.png" alt="Page Itinéraire" width="20" height="20" />
            </a>
            <h3>Itinéraire</h3>
            <p>Planifiez vos voyages en consultant les itinéraires disponibles.</p>
        </div>
    </div>
    <div class="page-container">
        <div class="page">
            <a href="statistiques.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <img src="images/statistiques.png" alt="Page Statistiques" width="20" height="20" />
            </a>
            <h3>Statistiques</h3>
            <p>Consultez les données statistiques sur les recherches de gares et les tendances de voyage.</p>
        </div>
        <div class="page">
            <a href="tech.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <img src="images/tech.png" alt="Page Technique" width="20" height="20" />
            </a>
            <h3>Technique</h3>
            <p>Découverte des API, et leur fonctionnement.</p>
        </div>
        <div class="page">
            <a href="avis.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>">
                <img src="images/avis.png" alt="Page Avis" width="20" height="20" />
            </a>
            <h3>Avis</h3>
            <p>Laissez votre avis sur notre site et consultez les avis des autres utilisateurs.</p>
        </div>
    </div>
</section>

<script>
    // <![CDATA[
    const words = ['vos itinéraires', 'les départs', 'les statistiques', 'les avis', 'les profils'];
    let currentIndex = 0;
    let currentWord = '';
    let letterIndex = 0;
    let intervalId = null;

    function changeText() {
        if (letterIndex === 0) {
            currentWord = words[currentIndex];
            document.getElementById('dynamicText').textContent = '';
        }

        if (letterIndex < currentWord.length) {
            document.getElementById('dynamicText').textContent += currentWord[letterIndex];
            letterIndex++;
        } else {
            clearInterval(intervalId);
            letterIndex = currentWord.length;
            setTimeout(deleteText, 1000); // Ajouter un délai d'attente avant la suppression
        }
    }

    function deleteText() {
        intervalId = setInterval(function () {
            if (letterIndex > 0) {
                document.getElementById('dynamicText').textContent = currentWord.substring(0, letterIndex - 1);
                letterIndex--;
            } else {
                clearInterval(intervalId);
                currentIndex = (currentIndex + 1) % words.length;
                intervalId = setInterval(changeText, 100); // Définir la vitesse de l'affichage des lettres ici
            }
        }, 100);
    }

    intervalId = setInterval(changeText, 100); // Définir la vitesse de l'affichage des lettres pour le premier mot ici
    //]]>
</script>

<script>
    // <![CDATA[
    function search() {
        // Récupérer le texte saisi dans la barre de recherche et le convertir en minuscules
        var searchText = document.getElementById('searchInput').value.toLowerCase();

        // Vérifier les mots-clés et rediriger l'utilisateur en conséquence
        switch (searchText) {
            case "départ":
                window.location.href = 'depart.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>';
                break;
            case "a propos":
            case "profil":
            case "pourquoi":
                window.location.href = 'profil.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>';
                break;
            case "recherche":
            case "itinéraire":
            case "itineraire":
                window.location.href = 'itineraire.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>';
                break;
            case "statistiques":
            case "statistique":
                window.location.href = 'statistiques.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>';
                break;
            case "tech":
                window.location.href = 'tech.php<?php echo isset($_GET['style']) ? '?style=' . $_GET['style'] : ''; ?>';
                break;
            default:
                // Si aucun mot-clé correspondant n'est trouvé, afficher "page non trouvée"
                document.getElementById('searchResult').textContent = "Page non trouvée";

        }
    }
    //]]>
</script>

<?php include ("include/footer.inc.php"); ?>