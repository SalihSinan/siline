<?php
$lang_selected = "fr";
$title = "Itineraire";
require_once ("include/header.inc.php");
require_once ("include/functions.inc.php");
?>

<h1>Rechercher des Itinéraires</h1>

<section>
    <h2>Explorez les Villes sans Perdre votre Chemin : Trouvez vos Itinéraires de Gare à Gare Facilement!</h2>
    <p>Sur cette page, vous pouvez rechercher vos itinéraires afin de savoir comment vous rendre d'une gare à une autre,
        éliminant ainsi tout risque de vous perdre. Ne soyez jamais désorienté dans aucune ville grâce à notre
        application, où nous avons inclus les limites géographiques les plus étendues. Vous ne vous sentirez plus jamais
        comme un touriste dans une ville inconnue, car notre outil vous fournira les itinéraires les plus directs et les
        plus pratiques pour vous déplacer en toute confiance, où que vous alliez.</p>
</section>

<section>
    <h2>Commencez votre recherche dès maintenant!</h2>

    <form method="POST" action="#">
        <label for="from">De :</label>
        <input type="text" id="from" name="from" placeholder="Entrez un lieu en France" required="" />
        <label for="to">À :</label>
        <input type="text" id="to" name="to" placeholder="Entrez un lieu en France" required="" />
        <label for="departure_time">Heure de départ :</label>
        <input type="time" id="departure_time" name="departure_time" required="" />
        <button style="background: linear-gradient(to right, #0044CC, #DB4437);" type="submit">Rechercher</button>
    </form>

    <?php
    $apiKey = "165bf327-a1fd-46ff-a463-9562c73233ae";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $from = urlencode($_POST['from']);
        $to = urlencode($_POST['to']);
        $departure_time = urlencode($_POST['departure_time']); // Récupérer l'heure de départ
    
        // Convertir l'heure de départ en un format compatible avec l'API de la SNCF
        $departure_datetime = date('Y-m-d') . 'T' . $departure_time . ':00';

        // Obtenir l'identifiant de la gare de départ
        $fromId = getStationId($_POST['from']);
        // Obtenir l'identifiant de la gare d'arrivée
        $toId = getStationId($_POST['to']);

        if ($fromId && $toId) {
            // Construire l'URL avec les identifiants des gares et l'heure de départ pour rechercher les itinéraires
            $url = "https://api.sncf.com/v1/coverage/sncf/journeys?from=$fromId&to=$toId&datetime=$departure_datetime&count=5";

            // Effectuer la requête à l'API de la SNCF
            $options = array(
                'http' => array(
                    'header' => "Authorization: $apiKey"
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $data = json_decode($result, true);

            if ($data && isset($data['journeys'])) {
                echo "<div class='container'>";
                echo "<h2>Résultats de la recherche :</h2>";
                foreach ($data['journeys'] as $journey) {
                    $fromName = $_POST['from'];
                    $toName = $_POST['to'];

                    echo "<p>Gare de départ : $fromName</p>";
                    echo "<p>Gare d'arrivée : $toName</p>";
                    $departureDateTime = DateTime::createFromFormat('Ymd\THis', $journey['departure_date_time']);
                    echo "<p>Départ : " . $departureDateTime->format('H:i-d/m/Y') . "</p>";
                    $arrivalDateTime = DateTime::createFromFormat('Ymd\THis', $journey['arrival_date_time']);
                    echo "<p>Arrivée : " . $arrivalDateTime->format('H:i-d/m/Y') . "</p>";
                    echo "<p>Étapes :</p>";
                    foreach ($journey['sections'] as $section) {
                        if ($section['type'] == 'public_transport') {
                            $fromStation = $section['from']['name'];
                            $toStation = $section['to']['name'];
                            $mode = $section['display_informations']['commercial_mode'];
                            $line = $section['display_informations']['label'];
                            $direction = $section['display_informations']['direction'];
                            echo "<p>De la gare $fromStation, prendre le $mode $line en direction de $direction jusqu'à la gare $toStation pendant " . formatDuration($section['duration']) . "</p>";
                        } elseif ($section['type'] == 'waiting') {
                            echo "<p>Attendre " . formatDuration($section['duration']) . "</p>";
                        } elseif ($section['type'] == 'transfer') {
                            echo "<p>Marcher " . formatDuration($section['duration']) . " jusqu'à " . $section['from']['name'] . "</p>";
                        }
                    }
                }
                echo "</div>";
            } else {
                echo "<div class='container'>";
                echo "<h2>Aucun résultat trouvé.</h2>";
                echo "</div>";
            }
        } else {
            echo "<div class='container'>";
            echo "<h2>Impossible de trouver les identifiants des gares spécifiées.</h2>";
            echo "</div>";
        }
    }
    ?>
</section>

<?php include 'include/footer.inc.php'; ?>