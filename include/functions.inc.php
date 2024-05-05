<?php
/**
 * @brief Récupère l'image ou la vidéo du jour à partir de l'API de la NASA.
 *
 * Cette fonction récupère l'image ou la vidéo du jour à partir de l'API de la NASA en utilisant
 * l'URL spécifiée. Elle vérifie le type de média (image ou vidéo) et retourne un tableau
 * contenant les informations pertinentes.
 *
 * @param string $url L'URL de l'API de la NASA pour obtenir l'image ou la vidéo du jour.
 * @return array|false Un tableau contenant les informations sur l'image ou la vidéo du jour
 * (type, URL, titre, explication) ou false si aucune image ou vidéo n'est disponible.
 */
$current_date = date('Y-m-d');
$apod_url = 'https://api.nasa.gov/planetary/apod?api_key=iW4qjJCIJJLxgMcgcTabxGOgznXIvg3N1OhSXEHX&date=' . $current_date;

/**
 * @brief Récupère l'image ou la vidéo du jour à partir de l'URL fournie.
 *
 * Cette fonction récupère l'image ou la vidéo du jour en utilisant l'URL spécifiée.
 * Elle vérifie le type de média (image ou vidéo) en fonction de l'extension de l'URL
 * et retourne un tableau contenant les informations pertinentes.
 *
 * @param string $url L'URL à partir de laquelle récupérer l'image ou la vidéo du jour.
 * @return array|false Un tableau contenant les informations sur l'image ou la vidéo du jour
 * (type, URL, titre, explication) ou false si aucune image ou vidéo n'est disponible.
 */
function getImageOfTheDay($url)
{
    $response = @json_decode(@file_get_contents($url)); // Suppression des erreurs avec @
    if ($response && isset($response->url)) {
        if (pathinfo($response->url, PATHINFO_EXTENSION) === 'mp4') {
            return array(
                'type' => 'video',
                'url' => $response->url,
                'title' => isset($response->title) ? $response->title : '',
                'explanation' => isset($response->explanation) ? $response->explanation : ''
            );
        } else {
            return array(
                'type' => 'image',
                'url' => $response->url,
                'title' => isset($response->title) ? $response->title : '',
                'explanation' => isset($response->explanation) ? $response->explanation : ''
            );
        }
    }
    return false;
}

// Essayez de récupérer l'image de la journée actuelle
$image_of_the_day = getImageOfTheDay($apod_url);

// Si aucune image n'est disponible pour la journée actuelle, essayez la veille
if (!$image_of_the_day) {
    $yesterday_date = date('Y-m-d', strtotime('-1 day'));
    $apod_url_yesterday = 'https://api.nasa.gov/planetary/apod?api_key=iW4qjJCIJJLxgMcgcTabxGOgznXIvg3N1OhSXEHX&date=' . $yesterday_date;
    $image_of_the_day = getImageOfTheDay($apod_url_yesterday);
}

/**
 * @brief Obtient les informations de localisation à partir de l'API Geoplugin au format XML.
 *
 * Cette fonction utilise l'adresse IP du client pour interroger l'API Geoplugin et obtenir
 * les informations de localisation telles que le pays, la région, la ville, la latitude et
 * la longitude au format XML.
 *
 * @return array Un tableau contenant les informations de localisation (pays, région, ville,
 * latitude, longitude).
 */
function getGeoLocation()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = "http://www.geoplugin.net/xml.gp?ip=$ip";
    $response = file_get_contents($url);
    $xml = simplexml_load_string($response);

    // Récupérer les informations de localisation
    $country = (string) $xml->geoplugin_countryName;
    $region = (string) $xml->geoplugin_region;
    $city = (string) $xml->geoplugin_city;
    $latitude = (string) $xml->geoplugin_latitude;
    $longitude = (string) $xml->geoplugin_longitude;

    return array(
        'country' => $country,
        'region' => $region,
        'city' => $city,
        'latitude' => $latitude,
        'longitude' => $longitude
    );
}

$geoData = getGeoLocation();

//API Geoplugin JSON
$ip_address = $_SERVER['REMOTE_ADDR'];
$geoplugin_url = 'http://www.geoplugin.net/json.gp?ip=' . $ip_address;
$geoplugin_data = json_decode(file_get_contents($geoplugin_url), true);

//API Ipinfo
$ip_address = $_SERVER['REMOTE_ADDR'];
$ipinfo_url = 'https://ipinfo.io/' . $ip_address . '/geo';
$ipinfo_data = json_decode(file_get_contents($ipinfo_url), true);

/**
 * @brief Obtient les informations de localisation à partir de l'API WhatIsMyIP.
 *
 * Cette fonction utilise l'adresse IP du client pour interroger l'API WhatIsMyIP
 * et obtenir des informations de localisation telles que le pays, la région, la ville,
 * la latitude et la longitude au format XML.
 *
 * @return string Les informations de localisation au format HTML si la requête réussit,
 * ou un message d'erreur sinon.
 */
function whatismyapi(): string
{
    $apiKey = '6bd6621abc2d3c409d7017d858a1e892';

    // Essayer de récupérer l'adresse IPv6 de la requête entrante
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        // Utiliser une adresse IPv6 statique comme fallback si l'adresse IPv6 n'est pas disponible
        $ip = '::1'; // Adresse IPv6 pour la boucle locale
    }

    $url = "https://api.whatismyip.com/ip-address-lookup.php?key=$apiKey&input=$ip&output=xml";

    $xmlString = file_get_contents($url);

    if ($xmlString === false) {
        return "Erreur : impossible de récupérer les données depuis l'API";
    } else {
        // Charger les données XML dans un objet PHP
        $xml = simplexml_load_string($xmlString);

        if ($xml === false) {
            return "Erreur : impossible de traiter les données XML";
        } else {
            // Extraire les informations souhaitées
            $result = "<h2>WhatIsMyAPI:</h2>";
            $result .= "<p><strong>Status</strong>: " . $xml->query_status->query_status_code . "</p>";
            $result .= "<p><strong>IP</strong>: " . $xml->server_data->ip . "</p>";
            $result .= "<p><strong>Pays</strong>: " . $xml->server_data->country . "</p>";
            $result .= "<p><strong>Region</strong>: " . $xml->server_data->region . "</p>";
            $result .= "<p><strong>Ville</strong>: " . $xml->server_data->city . "</p>";
            $result .= "<p><strong>Latitude</strong>: " . $xml->server_data->latitude . "</p>";
            $result .= "<p><strong>Longitude</strong>: " . $xml->server_data->longitude . "</p>";
            return $result;
        }
    }
}

// Clé d'authentification SNCF
$api_key = "165bf327-a1fd-46ff-a463-9562c73233ae";

/**
 * @brief Obtient les départs depuis une gare spécifique.
 *
 * Cette fonction utilise l'API SNCF pour récupérer les départs de trains
 * depuis une gare spécifique identifiée par son ID.
 *
 * @param string $station_id L'ID de la gare pour laquelle on veut obtenir les départs.
 * @return array|string Un tableau contenant les informations sur les départs de trains
 * ou une chaîne de caractères contenant un message d'erreur en cas d'échec.
 */
function getDeparturesFromStation($station_id)
{
    global $api_key;
    $api_url = "https://api.sncf.com/v1/coverage/sncf/stop_areas/$station_id/departures";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $api_key));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        return "Erreur lors de la requête vers l'API SNCF.";
    } else {
        $data = json_decode($response, true);
        $departures = array();
        foreach ($data['departures'] as $departure) {
            $train_type = $departure['display_informations']['commercial_mode'];
            $line = $departure['display_informations']['code'];

            if ($train_type === 'RER') {
                // Ajout du nom complet du RER (RER A, RER B, etc.)
                $train_type .= ' ' . $line;
            } else {
                // Ajout du numéro de ligne pour les autres types de trains
                $train_type .= ' ' . $line;
            }

            $departures[] = array(
                'departure_time' => $departure['stop_date_time']['departure_date_time'],
                'departure_station' => $departure['stop_point']['name'],
                'arrival_station' => $departure['display_informations']['direction'],
                'train_type' => $train_type
            );
        }
        return $departures;
    }
}

/**
 * @brief Obtient la liste des gares disponibles à partir de l'API SNCF.
 *
 * Cette fonction interroge l'API SNCF pour récupérer la liste des gares disponibles.
 *
 * @return array|string Un tableau contenant les informations sur les gares disponibles
 * ou un message d'erreur en cas d'échec de la requête vers l'API SNCF.
 */
function getStationsList()
{
    global $api_key;
    $api_url = "https://api.sncf.com/v1/coverage/sncf/stop_areas?count=1000";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . $api_key));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        return "Erreur lors de la requête vers l'API SNCF.";
    } else {
        $data = json_decode($response, true);
        return $data['stop_areas'];
    }
}

/**
 * @brief Recherche une gare par son nom.
 *
 * Cette fonction recherche une gare par son nom en utilisant une correspondance partielle.
 *
 * @param string $query Le nom de la gare à rechercher.
 * @return array Un tableau contenant les gares correspondant à la requête.
 */
function searchStationByName($query)
{
    $stations = getStationsList();
    $results = array();

    foreach ($stations as $station) {
        $station_name = strtolower($station['label']);
        $query = strtolower($query);
        if (strpos($station_name, $query) !== false) {
            $results[] = $station;
        }
    }

    return $results;
}

// Vérifier si la variable $query est définie
if (isset($_GET['query'])) {
    // Effectuer une recherche de gare par nom
    $query = $_GET['query'];
    $search_query = $query;
    $search_results = searchStationByName($search_query);

    // Récupération des gares recherchées depuis le cookie (s'il existe)
    $searches = isset($_COOKIE['recent_searches']) ? json_decode($_COOKIE['recent_searches'], true) : array();

    // Ajout de la nouvelle recherche à la liste des gares recherchées
    $searches[] = array(
        'gare' => $query,
        'date' => date('Y-m-d'),
        'heure' => date('H:i:s')
    );

    // Limiter le nombre de recherches enregistrées à, par exemple, 5
    $max_searches = 5;
    if (count($searches) > $max_searches) {
        array_shift($searches);
    }

    // Enregistrement des gares recherchées dans le cookie
    setcookie('recent_searches', json_encode($searches), time() + (86400 * 30), "/"); // valable pendant 30 jours

    // Afficher les résultats de la recherche
    if (!empty($search_results)) {
        foreach ($search_results as $result) {
            $station_id = $result['id'];
            echo "<h2>Prochains départs depuis le {$result['label']}</h2>";
            echo "<table>";
            echo "<tr><th>Arrivée</th><th>Heure de départ</th><th>RER/Train</th></tr>";

            // Récupérer les prochains départs depuis la gare recherchée
            $departures = getDeparturesFromStation($station_id);
            if (!is_string($departures)) {
                foreach ($departures as $departure) {
                    // Afficher les informations sur l'arrivée (nom de la gare)
                    echo "<tr>";
                    echo "<td>{$departure['arrival_station']}</td>";

                    // Afficher l'heure de départ
                    echo "<td>" . date('H:i', strtotime($departure['departure_time'])) . "</td>";

                    // Afficher le type de RER/train
                    echo "<td>{$departure['train_type']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>$departures</td></tr>";
            }

            echo "</table>";
        }
    } else {
        echo "Aucun résultat trouvé pour '$search_query'.";
    }
}

/**
 * @brief Obtient l'identifiant d'une gare à partir de son nom.
 *
 * Cette fonction interroge l'API SNCF pour obtenir l'identifiant d'une gare en fonction de son nom.
 *
 * @param string $stationName Le nom de la gare pour laquelle obtenir l'identifiant.
 * @return string|null L'identifiant de la gare si trouvé, sinon null.
 */
function getStationId($stationName)
{
    $apiKey = "165bf327-a1fd-46ff-a463-9562c73233ae";
    $url = "https://api.sncf.com/v1/coverage/sncf/places?q=" . urlencode($stationName);
    $options = array(
        'http' => array(
            'header' => "Authorization: $apiKey"
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $data = json_decode($result, true);
    if ($data && isset($data['places'][0]['id'])) {
        return $data['places'][0]['id'];
    } else {
        return null;
    }
}

/**
 * @brief Formate la durée en minutes et secondes.
 *
 * Cette fonction prend une durée en secondes en entrée et la formate en minutes et secondes.
 *
 * @param int $duration La durée en secondes à formater.
 * @return string La durée formatée au format "X min Y sec".
 */
function formatDuration($duration)
{
    $seconds = $duration % 60;
    $minutes = ($duration - $seconds) / 60;
    return "$minutes min $seconds sec";
}

/**
 * @brief Ajoute une recherche au fichier CSV.
 *
 * Cette fonction prend le nom d'une gare en entrée et l'ajoute au fichier CSV des recherches.
 *
 * @param string $gare Le nom de la gare à ajouter au fichier CSV.
 * @return void
 */
function addSearchToCSV($gare)
{
    $file = 'searches.csv';
    $fp = fopen($file, 'a');
    fputcsv($fp, array($gare)); // Ajouter la nouvelle recherche au fichier CSV
    fclose($fp);
}

// Récupération de la gare depuis la requête et ajout au fichier CSV
if (isset($_GET['query'])) {
    $gare = $_GET['query'];
    addSearchToCSV($gare);
}

/**
 * @brief Envoie un email.
 *
 * Cette fonction envoie un email à une adresse spécifiée avec un sujet et un contenu donnés.
 *
 * @param string $expediteur L'adresse email de l'expéditeur.
 * @param string $message Le contenu du message à envoyer.
 * @return bool True si l'email est envoyé avec succès, sinon false.
 */
function envoyer_email($expediteur, $message)
{
    $destinataire = "sinansalih.yuksel@gmail.com";
    $sujet = "Nouveau message du formulaire de contact";

    // En-têtes pour l'email
    $headers = "From: $expediteur \r\n";
    $headers .= "Reply-To: $expediteur \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    // Envoi de l'email
    return mail($destinataire, $sujet, $message, $headers);
}

/**
 * @brief Enregistre un avis dans un fichier texte.
 *
 * Cette fonction prend l'expéditeur et le message d'un avis en entrée et les enregistre dans un fichier texte.
 *
 * @param string $expediteur L'adresse email de l'expéditeur de l'avis.
 * @param string $message Le contenu de l'avis à enregistrer.
 * @return int|false Le nombre d'octets écrits dans le fichier en cas de succès, sinon false.
 */
function enregistrer_avis($expediteur, $message)
{
    $nouvel_avis = "De: $expediteur\nMessage: $message\n\n";
    return file_put_contents('avis.txt', $nouvel_avis, FILE_APPEND);
}

/**
 * @brief Récupère les derniers avis enregistrés dans un fichier texte.
 *
 * Cette fonction récupère les 10 derniers avis enregistrés dans un fichier texte et les retourne sous forme de tableau.
 *
 * @return array|false Un tableau contenant les 10 derniers avis enregistrés, ou false si le fichier n'existe pas.
 */
function recuperer_derniers_avis()
{
    $avis_file = "avis.txt";
    if (file_exists($avis_file)) {
        $avis = file($avis_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $total_avis = count($avis);
        $start_index = max(0, $total_avis - 10); // Récupérer les 10 derniers avis
        return array_slice($avis, $start_index);
    } else {
        return false;
    }
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * @brief Choisit aléatoirement une image parmi un tableau d'images.
 *
 * Cette fonction sélectionne aléatoirement une image parmi un tableau d'images fourni en entrée.
 * Elle garantit que l'image sélectionnée est différente de l'image précédemment sélectionnée.
 *
 * @param array $images Un tableau contenant les chemins vers les images parmi lesquelles choisir.
 * @return string Le chemin vers l'image sélectionnée.
 */
function choisir_image_aléatoire($images)
{
    if (!isset($_SESSION['previous_image'])) {
        $_SESSION['previous_image'] = $images[array_rand($images)];
    }

    do {
        $randomIndex = array_rand($images);
        $selectedImage = $images[$randomIndex];
    } while ($selectedImage == $_SESSION['previous_image']);

    $_SESSION['previous_image'] = $selectedImage;
    return $selectedImage;
}

/**
 * @brief Charge les données à partir d'un fichier CSV.
 *
 * Cette fonction lit les données à partir d'un fichier CSV contenant des noms de gares et les retourne sous forme de tableau.
 *
 * @return array Un tableau contenant les noms de gares enregistrés dans le fichier CSV, convertis en minuscules.
 */
function loadCSVData()
{
    $file = 'include/searches.csv';
    $data = array();

    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Convertir chaque nom de gare en minuscules avant de les stocker
            $data[] = strtolower($row[0]);
        }
        fclose($handle);
    }

    return $data;
}

?>