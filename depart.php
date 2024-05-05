<?php
$lang_selected = "fr";
$title = "Depart";
require_once ("include/header.inc.php");
?>

<h1>Recherche de départ depuis une gare</h1>

<section>
    <h2>Ne manquez plus votre train : Trouvez vos prochains départs en un instant!</h2>
    <p>Sur cette page, vous avez la possibilité de consulter facilement les prochains départs à partir d'une gare
        spécifique ou même de toutes les gares d'une ville. Ne cherchez plus d'excuses pour ne pas savoir par où
        commence votre voyage en train. Avec notre outil convivial et intuitif, planifiez vos déplacements en un clin
        d'œil et ne manquez jamais votre train. Que vous soyez un voyageur occasionnel ou un habitué des rails, notre
        service vous permettra de partir l'esprit tranquille, en sachant exactement où et quand vous devez être pour
        embarquer vers votre prochaine destination.</p>
</section>
<section>
    <h2>Commencez votre recherche dès maintenant!</h2>
    <form id="searchForm">
        <label for="query">Entrez le nom de la gare:</label>
        <input type="text" id="query" placeholder="Entrez le nom de la gare" />
        <button style="background: linear-gradient(to right, #0044CC, #DB4437);" type="submit">Rechercher</button>
    </form>

    <div id="searchResults"></div>
</section>

<section>
    <h2>Voici la liste de vos 5 dernières gares recherchées :</h2>
    <?php
    // Affichage de la liste des dernières gares recherchées
    if (isset($_COOKIE['recent_searches'])) {
        $searches = json_decode($_COOKIE['recent_searches'], true);
        if (!empty($searches)) {
            echo "<ul>";
            foreach ($searches as $search) {
                echo "<li>{$search['gare']} ({$search['date']} à {$search['heure']})</li>";
            }
            echo "</ul>";
        }
    }
    ?>
</section>



<script>
    // <![CDATA[
    document.getElementById("searchForm").addEventListener("submit", function (event) {
        event.preventDefault();

        var query = document.getElementById("query").value;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "include/functions.inc.php?action=search&query=" + encodeURIComponent(query), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById("searchResults").innerHTML = xhr.responseText;
                    // Charger les données et dessiner le graphique après la recherche
                    loadDataAndDrawChart();
                } else {
                    console.error("Erreur lors de la requête AJAX: " + xhr.status);
                }
            }
        };
        xhr.send();
    });

    // Fonction pour charger les données à partir du fichier CSV et dessiner le graphique
    function loadDataAndDrawChart() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var data = xhr.responseText.split('\n');
                    var chartData = [['Gare', 'Nombre de Recherches']];
                    for (var i = 0; i < data.length; i++) {
                        var row = data[i].split(',');
                        if (row.length === 1) {
                            var count = parseInt(row[1]) || 1;
                            chartData.push([row[0], count]);
                        }
                    }
                    // Dessiner le graphique
                    drawChart(chartData);
                } else {
                    console.error("Erreur lors du chargement du fichier CSV: " + xhr.status);
                }
            }
        };
        xhr.open("GET", "searches.csv", true);
        xhr.send();
    }
    //]]>
</script>

<?php include 'include/footer.inc.php'; ?>