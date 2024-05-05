<?php
$lang_selected = "en";
$title = "Tech";
require_once ("include/header.inc.php");
require_once ("include/functions.inc.php");
?>
<h1>Page Technique</h1>

<section>
    <!-- Intégration de l'image du jour de l'API APOD -->
    <h2>Image du jour - NASA APOD</h2>
    <?php if ($image_of_the_day && $image_of_the_day['type'] === 'image'): ?>
        <img src="<?php echo $image_of_the_day['url']; ?>" alt="APOD Image" />
    <?php elseif ($image_of_the_day && $image_of_the_day['type'] === 'video'): ?>
        <video controls>
            <source src="<?php echo $image_of_the_day['url']; ?>" type="video/mp4">
            Votre navigateur ne supporte pas les vidéos mp4.
        </video>
    <?php else: ?>
        <p>Impossible de récupérer l'image du jour.</p>
    <?php endif; ?>
    <?php if ($image_of_the_day): ?>
        <h3>
            <?php echo $image_of_the_day['title']; ?>
        </h3>
        <p>
            <?php echo $image_of_the_day['explanation']; ?>
        </p>
    <?php endif; ?>
</section>

<section>
    <!-- Affichage des informations de localisation à partir de GeoPlugin XML-->
    <?php if ($geoData): ?>
        <h2>Informations de localisation pour l'adresse IP:
            <?php echo isset($_GET['ip']) ? htmlspecialchars($_GET['ip']) : ''; ?>
        </h2>
        <p><strong>Pays:</strong>
            <?php echo htmlspecialchars($geoData['country']); ?>
        </p>
        <p>
            <strong>Région:</strong>
            <?php echo htmlspecialchars($geoData['region']); ?>
        </p>
        <p><strong>Ville:</strong>
            <?php echo htmlspecialchars($geoData['city']); ?>
        </p>
        <p><strong>Latitude:</strong>
            <?php echo htmlspecialchars($geoData['latitude']); ?>
        </p>
        <p><strong>Longitude:</strong>
            <?php echo htmlspecialchars($geoData['longitude']); ?>
        </p>
    <?php else: ?>
        <p><strong>Impossible de récupérer les informations de localisation.</strong></p>
    <?php endif; ?>
</section>


<section>
    <!-- Affichage des informations de localisation à partir de GeoPlugin JSON -->
    <h2>Informations de localisation - GeoPlugin</h2>
    <?php if ($geoplugin_data && isset($geoplugin_data['geoplugin_countryName'])): ?>
        <p><strong>Pays:</strong>
            <?php echo $geoplugin_data['geoplugin_countryName']; ?>
        </p>
        <p><strong>Région:</strong>
            <?php echo $geoplugin_data['geoplugin_region']; ?>
        </p>
        <p><strong>Ville:</strong>
            <?php echo $geoplugin_data['geoplugin_city']; ?>
        </p>
        <p><strong>Latitude:</strong>
            <?php echo $geoplugin_data['geoplugin_latitude']; ?>
        </p>
        <p><strong>Longitude:</strong>
            <?php echo $geoplugin_data['geoplugin_longitude']; ?>
        </p>
        <p><strong>Monnaie:</strong>
            <?php echo $geoplugin_data['geoplugin_currencyCode']; ?>
        </p>
    <?php else: ?>
        <p><strong>Impossible de récupérer les informations de localisation.</strong></p>
    <?php endif; ?>
</section>


<section>
    <!-- Affichage des informations de localisation à partir de ipinfo.io -->
    <h2>Informations de localisation - ipinfo.io</h2>
    <?php if ($ipinfo_data && isset($ipinfo_data['city'])): ?>
        <p><strong>Pays:</strong>
            <?php echo $ipinfo_data['country']; ?>
        </p>
        <p><strong>Région:</strong>
            <?php echo $ipinfo_data['region']; ?>
        </p>
        <p><strong>Ville:</strong>
            <?php echo $ipinfo_data['city']; ?>
        </p>
        <p><strong>Latitude:</strong>
            <?php echo $ipinfo_data['loc']; ?>
        </p>
        <p><strong>Longitude:</strong>
            <?php echo $ipinfo_data['loc']; ?>
        </p>
    <?php else: ?>
        <p><strong>Impossible de récupérer les informations de localisation.</strong></p>
    <?php endif; ?>
</section>



<section>
    <?php
    // Appel de la fonction et affichage du résultat
    echo whatismyapi();
    ?>
</section>

<?php include ("include/footer.inc.php"); ?>